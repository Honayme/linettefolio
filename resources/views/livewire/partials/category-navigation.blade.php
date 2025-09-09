<div>
    {{--
        Ce composant Blade utilise AlpineJS pour gérer l'interactivité du menu de navigation.
        - `x-data`: Initialise l'état d'AlpineJS (menu ouvert/fermé, menu actif).
        - `@mouseover` / `@mouseleave`: Déclenchent l'ouverture et la fermeture des sous-menus.
        - La logique est conçue pour être dynamique en bouclant sur la collection `$categories`.
    --}}
    <nav x-data="{
        navigationMenuOpen: false,
        navigationMenu: '',
        navigationMenuCloseDelay: 200,
        navigationMenuCloseTimeout: null,
        navigationMenuLeave() {
            let that = this;
            this.navigationMenuCloseTimeout = setTimeout(() => {
                that.navigationMenuClose();
            }, this.navigationMenuCloseDelay);
        },
        navigationMenuReposition(navElement) {
            this.navigationMenuClearCloseTimeout();
            this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
            this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) + 'px';
        },
        navigationMenuClearCloseTimeout() {
            clearTimeout(this.navigationMenuCloseTimeout);
        },
        navigationMenuClose() {
            this.navigationMenuOpen = false;
            this.navigationMenu = '';
        }
    }"
         class="relative z-10 w-auto">

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
                                <svg :class="{ '-rotate-180': navigationMenuOpen && navigationMenu === '{{ $category->slug }}' }" class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </button>
                            {{-- Sinon, on affiche un lien simple --}}
                        @else
                            <a href="{{-- route('category.show', $category->slug) --}}#" class="inline-flex justify-center items-center px-4 py-2 w-max h-10 text-sm font-medium rounded-md transition-colors hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-neutral-100 group">
                                {{ $category->name }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Conteneur pour les sous-menus déroulants --}}
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

            <div class="flex overflow-hidden justify-center w-auto h-auto bg-white rounded-md border shadow-sm border-neutral-200/70">
                {{-- On boucle à nouveau pour générer le contenu de chaque sous-menu potentiel --}}
                @foreach ($categories as $category)
                    @if ($category->children->isNotEmpty())
                        {{-- Le contenu de ce div ne sera visible que si la variable `navigationMenu` correspond au slug de la catégorie actuelle --}}
                        <div x-show="navigationMenu === '{{ $category->slug }}'" class="flex justify-center items-stretch p-6 w-full">
                            {{-- On pourrait avoir une mise en page plus complexe ici, mais pour l'exemple, on liste juste les enfants --}}
                            <div class="w-72">
                                @foreach ($category->children as $child)
                                    <a href="{{-- route('category.show', $child->slug) --}}#" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                                        <span class="block mb-1 font-medium text-black">{{ $child->name }}</span>
                                        {{-- Un espace pour une potentielle description --}}
                                        {{-- <span class="block font-light leading-5 opacity-50">{{ $child->description }}</span> --}}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </nav>
</div>
