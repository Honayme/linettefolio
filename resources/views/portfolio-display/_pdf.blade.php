<div
    class="w-full h-[75vh] bg-gray-900 flex flex-col items-center justify-center"
    @modal-ready.window="if ($el.pdfDoc) renderPage(pageNum)"
    x-data="{
        numPages: 0,
        pageNum: 1,
        pageRendering: false,

        init() {
            // Stockage des objets non-réactifs pour éviter les problèmes avec Alpine
            this.$el.pdfDoc = null;
            this.$el.renderTask = null;

            // C'est la clé de la responsivité.
            // Il surveille le conteneur et relance le rendu si sa taille change.
            const resizeObserver = new ResizeObserver(() => {
                if (this.$el.pdfDoc && !this.pageRendering) {
                    // Pour le débogage : voir si le redimensionnement est détecté
                    console.log('Conteneur redimensionné, nouveau rendu demandé.');
                    this.renderPage(this.pageNum);
                }
            });
            resizeObserver.observe(this.$refs.pdfContainer);

            // Surveille le changement de la source du média pour charger un nouveau PDF
            this.$watch('currentItem.mediaSrc', newUrl => {
                if (newUrl && newUrl.toLowerCase().endsWith('.pdf')) {
                    this.loadPdf(newUrl);
                }
            });

            // Surveille le changement de numéro de page pour le rendu
            this.$watch('pageNum', newPageNum => {
                if (this.$el.pdfDoc) {
                    this.renderPage(newPageNum);
                }
            });
        },

        loadPdf(url) {
            pdfjsLib.getDocument(url).promise.then(pdf => {
                this.$el.pdfDoc = pdf;
                this.numPages = pdf.numPages;
                // Si la page actuelle est invalide pour le nouveau PDF, revenir à la première
                if (this.pageNum > pdf.numPages || this.pageNum === 0) {
                    this.pageNum = 1;
                }
                // Le ResizeObserver se chargera de lancer le premier rendu.
                // On peut quand même le forcer au cas où.

            });
        },

        renderPage(num) {
            if (!this.$el.pdfDoc || this.pageRendering) return;

            // Annule le rendu précédent s'il y en avait un en cours
            if (this.$el.renderTask) {
                this.$el.renderTask.cancel();
            }

            this.pageRendering = true;

            this.$el.pdfDoc.getPage(num).then(page => {
                const canvas = this.$refs.pdfCanvas;
                const ctx = canvas.getContext('2d');
                const container = this.$refs.pdfContainer;

                // Si le conteneur n'est pas visible, ne rien faire
                if (container.clientWidth === 0) {
                    this.pageRendering = false;
                    return;
                }

                // Calculer la taille idéale en fonction de la largeur du conteneur
                const viewport = page.getViewport({ scale: 1 });
                const scale = container.clientWidth / viewport.width;
                const scaledViewport = page.getViewport({ scale: scale });

                // Mettre à jour les ATTRIBUTS du canvas, pas le style !
                canvas.height = scaledViewport.height;
                canvas.width = scaledViewport.width;

                // Lancer le rendu PDF.js
                const renderContext = { canvasContext: ctx, viewport: scaledViewport };
                this.$el.renderTask = page.render(renderContext);

                this.$el.renderTask.promise.then(() => {
                    this.pageRendering = false;
                    this.$el.renderTask = null;
                }).catch(error => {
                    if (error.name !== 'RenderingCancelledException') {
                        console.error('Erreur de rendu PDF:', error);
                    }
                    this.pageRendering = false;
                    this.$el.renderTask = null;
                });
            });
        },

        prevPage() {
            if (this.pageNum > 1) this.pageNum--;
        },

        nextPage() {
            if (this.pageNum < this.numPages) this.pageNum++;
        }
    }"
>
    <!-- Conteneur qui grandit pour prendre l'espace. C'est LUI qu'on surveille. -->
    <div
        x-ref="pdfContainer"
        class="flex-grow overflow-auto w-full flex justify-center py-4"
        style="min-height: 0;"
    >
        <canvas x-ref="pdfCanvas"></canvas>
    </div>

    <!-- Contrôles -->
    <div class="flex-shrink-0 bg-gray-800 text-white p-2 w-full flex items-center justify-center space-x-4">
        <button @click="prevPage" :disabled="pageNum <= 1 || pageRendering" class="px-3 py-1 bg-gray-600 rounded disabled:opacity-50">&#x2190; Précédent</button>
        <span>Page <span x-text="pageNum"></span> sur <span x-text="numPages > 0 ? numPages : '...' "></span></span>
        <button @click="nextPage" :disabled="numPages === 0 || pageNum >= numPages || pageRendering" class="px-3 py-1 bg-gray-600 rounded disabled:opacity-50">Suivant &#x2192;</button>
    </div>
</div>
