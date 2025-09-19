<div>
    <script>
        function portfolioGallery(initialCategories, initialItems) {
            return {
                // --- ÉTAT (STATE) ---
                modalOpen: false,
                currentIndex: 0,
                activeParent: null,
                activeFilter: 'All',
                categories: initialCategories,
                items: initialItems,

                // --- GETTERS (Propriétés calculées) ---
                get filteredItems() {
                    const filtered = this.activeFilter === 'All' ?
                        this.items :
                        this.items.filter(item => item.tags.includes(this.activeFilter));
                    // console.log('filteredItems calculé:', filtered);
                    return filtered;
                },
                get currentItem() {
                    const item = this.filteredItems.length > 0 ? this.filteredItems[this.currentIndex] : null;
                    // console.log('currentItem calculé:', item);
                    return item;
                },

                // --- MÉTHODES ---
                init() {
                    console.log('Composant Alpine initialisé.');
                    this.$watch('modalOpen', open => {
                        document.body.style.overflow = open ? 'hidden' : 'auto';
                    });
                    this.$watch('currentIndex', index => {
                        // console.log('currentIndex mis à jour:', index);
                    });
                    this.$watch('filteredItems', items => {
                        // console.log('filteredItems mis à jour:', items);
                    });
                    this.$watch('currentItem', item => {
                        // console.log('currentItem mis à jour:', item);
                    });
                },
                selectFilter(filter, isParent = false) {
                    if (isParent) {
                        if (this.activeParent === filter) {
                            this.activeParent = null;
                            this.activeFilter = 'All';
                        } else {
                            this.activeParent = filter;
                            this.activeFilter = filter;
                        }
                    } else {
                        this.activeFilter = filter;
                        if (filter === 'All') {
                            this.activeParent = null;
                        } else {
                            // Trouver la catégorie parente de cette sous-catégorie
                            const parentCategory = this.categories.find(cat =>
                                cat.subcategories.includes(filter)
                            );
                            if (parentCategory) {
                                this.activeParent = parentCategory.name;
                            } else {
                                this.activeParent = null;
                            }
                        }
                    }
                    console.log('Filtre sélectionné:', filter, 'activeParent:', this.activeParent, 'activeFilter:', this.activeFilter);
                },
                openModal(index) {
                    // console.log('openModal appelé avec index:', index);
                    this.currentIndex = index;
                    this.modalOpen = true;
                },
                closeModal() {
                    console.log('closeModal appelé.');
                    this.modalOpen = false;
                },
                nextItem() {
                    if (!this.modalOpen || !this.filteredItems.length) return;
                    const newIndex = (this.currentIndex + 1) % this.filteredItems.length;
                    // console.log('nextItem: currentIndex mis à jour de', this.currentIndex, 'à', newIndex);
                    this.currentIndex = newIndex;
                },
                prevItem() {
                    if (!this.modalOpen || !this.filteredItems.length) return;
                    const newIndex = (this.currentIndex - 1 + this.filteredItems.length) % this.filteredItems.length;
                    // console.log('prevItem: currentIndex mis à jour de', this.currentIndex, 'à', newIndex);
                    this.currentIndex = newIndex;
                }
            }
        }
    </script>



    <div x-data='portfolioGallery(@json($alpineCategories), @json($alpineItems))' x-init="init()">
        <!-- Composant autonome -->
        <div class="rightpart w-full min-h-[100vh] float-left relative bg-[#f8f8f8] pl-[450px]">
            <div
                class="rightpart_in relative w-full float-left clear-both border-solid border-[#ebebeb] border-l min-h-[100vh]">
                <div id="portfolio" class="tokyo_tm_section">
                    <div class="container">
                        <div class="tokyo_tm_portfolio w-full h-auto clear-both float-left py-[100px] px-0">
                            <div class="tokyo_tm_title w-full h-auto clear-both float-left mb-[62px]">
                                <div class="title_flex w-full h-auto clear-both flex justify-between items-end">
                                    <div class="left">
                                    <span
                                        class="inline-block bg-[rgba(0,0,0,.04)] uppercase py-[4px] px-[10px] font-semibold text-[12px] text-[#333] font-montserrat tracking-[0px] mb-[11px]">Portfolio</span>
                                        <h3 class="font-extrabold font-montserrat">Creative Portfolio</h3>
                                    </div>

                                    <div class="portfolio_filter" x-data="{
                                        dropdownOpen: false,
                                        activeDropdown: null,
                                        closeTimeout: null,
                                        openDropdown(categoryName) {
                                            if (this.closeTimeout) {
                                                clearTimeout(this.closeTimeout);
                                                this.closeTimeout = null;
                                            }
                                            this.activeDropdown = categoryName;
                                            this.dropdownOpen = true;
                                        },
                                        closeDropdown() {
                                            this.closeTimeout = setTimeout(() => {
                                                this.dropdownOpen = false;
                                                this.activeDropdown = null;
                                            }, 150);
                                        }
                                    }">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <!-- Bouton "Tous" -->
                                            <button @click="selectFilter('All'); closeDropdown()"
                                                    :class="{ 'bg-[#f25835] text-white': activeFilter === 'All', 'text-[#767676] hover:text-black': activeFilter !== 'All' }"
                                                    class="filter-btn px-4 py-2 text-sm font-medium font-montserrat transition-colors duration-200 rounded-md">
                                                Tous
                                            </button>

                                            <!-- Boutons des catégories avec dropdowns -->
                                            <template x-for="category in categories" :key="category.name">
                                                <div class="relative"
                                                     @mouseenter="category.subcategories.length > 0 ? openDropdown(category.name) : null"
                                                     @mouseleave="closeDropdown()">
                                                    <button @click="selectFilter(category.name, true); closeDropdown()"
                                                            :class="{
                                                                'bg-[#f25835] text-white': activeFilter === category.name || activeParent === category.name,
                                                                'text-[#767676] hover:text-black': activeFilter !== category.name && activeParent !== category.name
                                                            }"
                                                            class="filter-btn px-4 py-2 text-sm font-medium font-montserrat transition-colors duration-200 rounded-md flex items-center gap-1">
                                                        <span x-text="category.name"></span>
                                                        <template x-if="category.subcategories.length > 0">
                                                            <svg class="w-4 h-4 transition-transform duration-200"
                                                                 :class="{ 'rotate-180': activeDropdown === category.name }"
                                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                            </svg>
                                                        </template>
                                                    </button>

                                                    <!-- Dropdown pour les sous-catégories -->
                                                    <template x-if="category.subcategories.length > 0">
                                                        <div x-show="dropdownOpen && activeDropdown === category.name"
                                                             x-transition:enter="transition ease-out duration-200"
                                                             x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                                             x-transition:leave="transition ease-in duration-150"
                                                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                                             x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                                             class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"
                                                             @mouseenter="openDropdown(category.name)"
                                                             @mouseleave="closeDropdown()"
                                                             @click.stop>
                                                            <!-- Option "Tout" pour la catégorie -->
                                                            <button @click="selectFilter(category.name); closeDropdown()"
                                                                    :class="{ 'bg-[#f25835] text-white': activeFilter === category.name, 'text-gray-700 hover:bg-gray-50': activeFilter !== category.name }"
                                                                    class="w-full text-left px-4 py-2 text-sm font-medium transition-colors duration-150"
                                                                    x-text="`Tout ${category.name}`">
                                                            </button>
                                                            <hr class="my-1 border-gray-100">
                                                            <!-- Sous-catégories -->
                                                            <template x-for="subcategory in category.subcategories" :key="subcategory">
                                                                <button @click="selectFilter(subcategory); closeDropdown()"
                                                                        :class="{ 'bg-[#f25835] text-white': activeFilter === subcategory, 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeFilter !== subcategory }"
                                                                        class="w-full text-left px-4 py-2 text-sm transition-colors duration-150"
                                                                        x-text="subcategory">
                                                                </button>
                                                            </template>
                                                        </div>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list_wrapper w-full h-auto clear-both float-left">
                                <ul class="gallery_zoom ml-[-40px] list-none">
                                    <!-- Grille Masonry -->
                                    <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-3 xl:columns-3 gap-4">
                                        <template x-for="(item, index) in filteredItems" :key="item.id">
                                            <div @click.prevent="item.mediaType === 'presentation'
                                                                 ? $dispatch('open-pdf-overlay', { url: item.mediaSrc })
                                                                 : openModal(index)"
                                                 class="mb-4 break-inside-avoid cursor-pointer group relative rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                                                <img :src="item.coverSrc" :alt="item.alt" :width="item.width"
                                                     :height="item.height" loading="lazy"
                                                     class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105"
                                                     :style="`aspect-ratio: ${item.width} / ${item.height}`" alt="">
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Modale (Lightbox) -->
                                    <div x-show="modalOpen" x-cloak
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                         @keydown.window.escape="closeModal"
                                         @keydown.window.arrow-right.prevent="nextItem"
                                         @keydown.window.arrow-left.prevent="prevItem" role="dialog" aria-modal="true"
                                         aria-labelledby="modal-title"
                                         class="fixed inset-0 z-50 flex items-center justify-center p-4">
                                        <div @click="closeModal"
                                             class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
                                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                             x-transition:enter="transition ease-out duration-300"
                                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave="transition ease-in duration-200"
                                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             class="relative w-full max-w-5xl max-h-[90vh] bg-white rounded-lg shadow-2xl flex flex-col items-center p-4"
                                             @click.stop>
                                            <button @click="closeModal"
                                                    class="absolute top-2 right-2 text-white bg-black/50 rounded-full p-1 hover:bg-black/80 z-20">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                <span class="sr-only">Fermer la modale</span>
                                            </button>
                                            <div class="w-full h-full flex items-center justify-center overflow-auto">
                                                <template x-if="currentItem">
                                                    <div x-init="console.log('currentItem.mediaType:', currentItem.mediaType)">
                                                        <div x-show="currentItem.mediaType === 'video'">
                                                            @include('portfolio-display._video')
                                                        </div>
                                                        <div x-show="currentItem.mediaType === 'image'">
                                                            @include('portfolio-display._image')
                                                        </div>
                                                        <div x-show="currentItem.mediaType === 'slider'">
                                                            @include('portfolio-display._slider')
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="w-full text-center mt-2 p-2 bg-gray-50 rounded-b-lg">
                                                <h2 id="modal-title" class="text-lg font-bold text-gray-800"
                                                    x-text="currentItem?.alt"></h2>
                                                <p class="text-sm text-gray-600"
                                                   x-text="currentItem?.tags.join(', ')"></p>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================================================== -->
    <!-- ============           PDF VIEWER            ============= -->
    <!-- ========================================================== -->
    @include('portfolio-display._pdf-viewer-overlay')

</div>


