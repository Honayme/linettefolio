{{--
    Overlay PDF - version simple et robuste
    Changement clé:
    - Ne dépend plus de @transitionend pour charger le PDF.
    - Charge après ouverture via Alpine.nextTick + requestAnimationFrame.
    - Retry si le conteneur a une largeur 0 pour éviter le spinner infini.
--}}

<div
    x-data="pdfViewerOverlay()"
    x-show="isOpen"
    @open-pdf-overlay.window="open($event.detail.url)"
    @keydown.escape.window="close()"
    x-cloak
    style="display: none;"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-8"
    aria-labelledby="pdf-viewer-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Fond -->
    <div
        x-show="isOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-black bg-opacity-75"
        @click="close()"
    ></div>

    <!-- Conteneur principal -->
    <div
        x-show="isOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.stop
        class="relative flex flex-col w-full h-full max-w-5xl bg-gray-900 rounded-lg shadow-xl"
    >
        <!-- Titre / fermeture -->
        <header class="flex-shrink-0 flex items-center justify-between p-3 border-b border-gray-700">
            <h2 id="pdf-viewer-title" class="text-lg font-semibold text-white truncate" x-text="pdfFileName || 'Chargement...'"></h2>
            <button @click="close()" class="text-gray-400 hover:text-white transition-colors">&times;</button>
        </header>

        <!-- Zone Canvas -->
        <div x-ref="pdfContainer" class="flex-grow w-full h-full overflow-auto flex justify-center py-4" style="min-height: 0;">
            <div x-show="pageRendering || !numPages" class="flex items-center justify-center text-white">
                <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Chargement du document...</span>
            </div>
            <canvas x-ref="pdfCanvas" :class="{ 'hidden': pageRendering || !numPages }"></canvas>
        </div>

        <!-- Pagination -->
        <footer class="flex-shrink-0 bg-gray-800 text-white p-2 w-full flex items-center justify-center space-x-4">
            <button @click="prevPage()" :disabled="pageNum <= 1 || pageRendering" class="px-3 py-1 bg-gray-600 rounded disabled:opacity-50 disabled:cursor-not-allowed transition-colors">&#x2190; Précédent</button>
            <span class="text-sm">
                Page <span x-text="pageNum"></span> sur <span x-text="numPages > 0 ? numPages : '...' "></span>
            </span>
            <button @click="nextPage()" :disabled="pageNum >= numPages || pageRendering" class="px-3 py-1 bg-gray-600 rounded disabled:opacity-50 disabled:cursor-not-allowed transition-colors">Suivant &#x2192;</button>
        </footer>
    </div>
</div>

<script>
    function pdfViewerOverlay() {
        console.log('PDF Viewer Overlay initialized');
        return {
            // état
            isOpen: false,
            pdfUrl: null,
            pdfFileName: null,
            _loadingTask: null,
            _pdfDoc: null,
            _renderTask: null,
            numPages: 0,
            pageNum: 1,
            pageRendering: false,

            // API
            open(url) {
                console.log('PDF overlay open() called with:', url);
                if (!url) {
                    console.error('No URL provided to open()');
                    return;
                }
                this.pdfUrl = url;
                this.pdfFileName = this._extractName(url);
                this.isOpen = true;
                console.log('Overlay state set to open, isOpen:', this.isOpen);

                // Charge après rendu du DOM (ne dépend plus de transitionend)
                const start = () => this.loadAndRender();
                if (window.Alpine?.nextTick) {
                    Alpine.nextTick(() => requestAnimationFrame(start));
                } else {
                    requestAnimationFrame(start);
                }

                // Re-render si la taille du conteneur change (simple et sûr)
                this._watchResize();
            },

            close() {
                this.isOpen = false;
                setTimeout(() => this.cleanup(), 300);
            },

            cleanup() {
                try { this._renderTask?.cancel?.(); } catch(e) {}
                try { this._loadingTask?.destroy?.(); } catch(e) {}
                try { this._pdfDoc?.destroy?.(); } catch(e) {}
                this._renderTask = null;
                this._loadingTask = null;
                this._pdfDoc = null;
                this.pdfUrl = null;
                this.pdfFileName = null;
                this.numPages = 0;
                this.pageNum = 1;
                this.pageRendering = false;
                this._unwatchResize?.();
            },

            // coeur
            loadAndRender() {
                if (!this.pdfUrl || this._pdfDoc) return;

                console.log('Loading PDF:', this.pdfUrl);
                console.log('pdfjsLib available:', typeof pdfjsLib !== 'undefined');

                if (typeof pdfjsLib === 'undefined') {
                    console.error('pdfjsLib is not available!');
                    alert('PDF.js not loaded properly');
                    return;
                }

                this.pageRendering = true;

                const task = pdfjsLib.getDocument(this.pdfUrl);
                this._loadingTask = task;

                task.promise.then(pdf => {
                    this._pdfDoc = pdf;
                    this.numPages = pdf.numPages;
                    this.pageNum = 1;
                    this.renderPage(this.pageNum);
                }).catch(err => {
                    console.error('[PDF] load error', err);
                    this.pageRendering = false;
                    alert('Impossible de charger le document PDF.');
                    this.close();
                });
            },

            /*renderPage(num, retry = 0) {
                if (!this._pdfDoc) return;

                // annule rendu précédent
                try { this._renderTask?.cancel?.(); } catch(e) {}
                this._renderTask = null;

                const canvas = this.$refs.pdfCanvas;
                const container = this.$refs.pdfContainer;
                const width = container?.clientWidth || container?.getBoundingClientRect()?.width || 0;

                // conteneur pas encore dimensionné -> retry simple
                if (!width) {
                    if (retry < 20) { // max ~2s
                        setTimeout(() => this.renderPage(num, retry + 1), 100);
                    } else {
                        console.warn('[PDF] container width is 0 after retries');
                        this.pageRendering = false;
                    }
                    return;
                }

                this.pageRendering = true;

                this._pdfDoc.getPage(num).then(page => {
                    const unscaled = page.getViewport({ scale: 1 });
                    const scale = width / unscaled.width;
                    const viewport = page.getViewport({ scale });

                    canvas.width = Math.round(viewport.width);
                    canvas.height = Math.round(viewport.height);

                    const ctx = canvas.getContext('2d');
                    this._renderTask = page.render({ canvasContext: ctx, viewport });

                    return this._renderTask.promise;
                }).then(() => {
                    this.pageRendering = false;
                    this._renderTask = null;
                }).catch(err => {
                    if (err?.name !== 'RenderingCancelledException') {
                        console.error('[PDF] render error', err);
                    }
                    this.pageRendering = false;
                    this._renderTask = null;
                });
            },*/
            // Remplace ta méthode par celle-ci (utilise this.$refs correctement et gère l'absence de refs)
            renderPage(num, retry = 0) {
                if (!this._pdfDoc) return;

                // Récupération sûre des refs Alpine
                const refs = this.$refs || {};
                const container = refs.pdfContainer;
                const canvas = refs.pdfCanvas;

                // Si les refs ne sont pas encore dispo (DOM pas prêt), on réessaie
                if (!container || !canvas) {
                    if (retry < 20) {
                        return setTimeout(() => this.renderPage(num, retry + 1), 100);
                    }
                    this.pageRendering = false;
                    return;
                }

                // Annule un rendu en cours le cas échéant
                try { this._renderTask?.cancel?.(); } catch (e) {}
                this._renderTask = null;

                const width = container.clientWidth || container.getBoundingClientRect().width || 0;

                // Si le conteneur n'a pas encore de largeur, on réessaie
                if (!width) {
                    if (retry < 20) {
                        return setTimeout(() => this.renderPage(num, retry + 1), 100);
                    }
                    this.pageRendering = false;
                    return;
                }

                this.pageRendering = true;

                this._pdfDoc.getPage(num).then(page => {
                    const unscaled = page.getViewport({ scale: 1 });
                    const scale = width / unscaled.width;
                    const viewport = page.getViewport({ scale });

                    canvas.width = Math.round(viewport.width);
                    canvas.height = Math.round(viewport.height);

                    const ctx = canvas.getContext('2d');
                    this._renderTask = page.render({ canvasContext: ctx, viewport });
                    return this._renderTask.promise;
                }).then(() => {
                    this.pageRendering = false;
                    this._renderTask = null;
                }).catch(err => {
                    if (err?.name !== 'RenderingCancelledException') {
                        console.error('[PDF] render error', err);
                    }
                    this.pageRendering = false;
                    this._renderTask = null;
                });
            },

            prevPage() {
                if (this.pageNum <= 1 || this.pageRendering) return;
                this.pageNum--;
                this.renderPage(this.pageNum);
            },

            nextPage() {
                if (this.pageNum >= this.numPages || this.pageRendering) return;
                this.pageNum++;
                this.renderPage(this.pageNum);
            },

            // utils
            _extractName(url) {
                try { return decodeURIComponent(url.split('?')[0].split('/').pop() || 'Document.pdf'); }
                catch(e){ return 'Document.pdf'; }
            },

            _watchResize() {
                const el = this.$refs.pdfContainer;
                if (!el || this._resizeObs) return;
                const rerender = () => {
                    if (this._pdfDoc && !this.pageRendering) {
                        this.renderPage(this.pageNum);
                    }
                };
                if ('ResizeObserver' in window) {
                    this._resizeObs = new ResizeObserver(() => rerender());
                    this._resizeObs.observe(el);
                    this._unwatchResize = () => { this._resizeObs.disconnect(); this._resizeObs = null; };
                } else {
                    const onResize = () => rerender();
                    window.addEventListener('resize', onResize);
                    this._unwatchResize = () => window.removeEventListener('resize', onResize);
                }
            },
            _resizeObs: null,
            _unwatchResize: null,
        }
    }
</script>
