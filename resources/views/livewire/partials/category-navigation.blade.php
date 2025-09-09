<div>
    {{--
        Le conteneur x-data principal.
        - `navigationMenuOpen`: Gère la visibilité du dropdown desktop (vrai/faux).
        - `navigationMenu`: Stocke le slug de la catégorie survolée sur desktop pour afficher le bon contenu.
        - `mobileSubMenuOpen`: Stocke le slug de la catégorie ouverte dans l'accordéon mobile.
        - Les autres sont des fonctions utilitaires pour gérer les délais de fermeture au survol.
    --}}
    <nav x-data="{
        navigationMenuOpen: false,
        navigationMenu: '',
        navigationMenuCloseDelay: 200,
        navigationMenuCloseTimeout: null,
        mobileSubMenuOpen: null, // État pour l'accordéon mobile

        navigationMenuLeave() {
            let that = this;
            this.navigationMenuCloseTimeout = setTimeout(() => {
                that.navigationMenuClose();
            }, this.navigationMenuCloseDelay);
        },
        navigationMenuReposition(navElement) {
            this.navigationMenuClearCloseTimeout();
            if (window.innerWidth >= 1024) { // On s'assure d'être en vue desktop
                this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
                this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) + 'px';
            }
        },
        navigationMenuClearCloseTimeout() {
            clearTimeout(this.navigationMenuCloseTimeout);
        },
        navigationMenuClose() {
            this.navigationMenuOpen = false;
            this.navigationMenu = '';
        }
    }"
         class="relative z-10 w-full"
    >

        <!-- ================================================================= -->
        <!-- =================   VUE DESKTOP (à partir de md)   =============== -->
        <!-- ================================================================= -->
        <div class="hidden md:block">
            {{-- Boucle sur les catégories parentes pour créer la barre de navigation principale --}}
            <div class="relative">
                <ul class="flex flex-1 justify-center items-center p-1 space-x-1 list-none rounded-md border text-neutral-700 group border-neutral-200/80">
                    @foreach ($categories as $category)
                        <li>
                            {{-- Si la catégorie a des enfants, on affiche un bouton qui déclenche le sous-menu --}}
                            @if ($category->children->isNotEmpty())
                                <button
                                    :class="{ 'bg-neutral-100': navigationMenu === '{{ $category->slug }}', 'hover:bg-neutral-100': navigationMenu !== '{{ $category->slug }}' }"
                                    @mouseover="navigationMenuOpen = true; navigationMenuReposition($el); navigationMenu = '{{ $category->slug }}'"
                                    @mouseleave="navigationMenuLeave()"
                                    class="inline-flex justify-center items-center px-4 py-2 w-max h-10 text-sm font-medium rounded-md transition-colors hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none group">
                                    <span>{{ $category->name }}</span>
                                    <svg
                                        :class="{ '-rotate-180': navigationMenuOpen && navigationMenu === '{{ $category->slug }}' }"
                                        class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" aria-hidden="true">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                {{-- Sinon, on affiche un lien simple --}}
                            @else
                                <a href="#"
                                   class="inline-flex justify-center items-center px-4 py-2 w-max h-10 text-sm font-medium rounded-md transition-colors hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-neutral-100 group">
                                    {{ $category->name }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Conteneur pour les sous-menus déroulants avec les transitions originales --}}
            <div x-ref="navigationDropdown"
                 x-show="navigationMenuOpen"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90"
                 @mouseover="navigationMenuClearCloseTimeout()"
                 @mouseleave="navigationMenuLeave()"
                 class="absolute top-0 pt-3 duration-200 ease-out -translate-x-1/2 translate-y-11"
                 x-cloak>

                <div
                    class="flex overflow-hidden justify-center w-auto h-auto bg-white rounded-md border shadow-sm border-neutral-200/70">
                    @foreach ($categories as $category)
                        @if ($category->children->isNotEmpty())
                            <div x-show="navigationMenu === '{{ $category->slug }}'"
                                 class="flex justify-center items-stretch p-6 w-full">
                                <div class="w-72">
                                    @foreach ($category->children as $child)
                                        <a href="#" @click="navigationMenuClose()"
                                           class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                                            <span class="block mb-1 font-medium text-black">{{ $child->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ================================================================= -->
        <!-- ===================   VUE MOBILE (jusqu'à md)   ================== -->
        <!-- ================================================================= -->
        <div class="block md:hidden w-full border rounded-md">
            <ul class="flex flex-col list-none text-neutral-700">
                @foreach ($categories as $category)
                    <li class="w-full @if(!$loop->last) border-b border-neutral-200/80 @endif">
                        {{-- S'il y a des enfants, on crée un bouton pour déplier l'accordéon --}}
                        @if ($category->children->isNotEmpty())
                            <button @click="mobileSubMenuOpen = mobileSubMenuOpen === '{{ $category->slug }}' ? null : '{{ $category->slug }}'" class="flex justify-between items-center p-4 w-full text-left font-medium hover:bg-neutral-50 transition-colors">
                                <span>{{ $category->name }}</span>
                                <svg :class="{ 'rotate-180': mobileSubMenuOpen === '{{ $category->slug }}' }" class="w-4 h-4 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </button>
                            {{-- Le conteneur des enfants, qui s'affiche/se cache --}}
                            <div x-show="mobileSubMenuOpen === '{{ $category->slug }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="bg-neutral-50/70">
                                <ul>
                                    @foreach ($category->children as $child)
                                        <li>
                                            <a href="#" class="block py-3 px-8 w-full text-sm hover:bg-neutral-100 transition-colors">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- S'il n'y a pas d'enfant, c'est un lien simple --}}
                        @else
                            <a href="#" class="block p-4 w-full font-medium hover:bg-neutral-50 transition-colors">
                                {{ $category->name }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

    </nav>
</div>
