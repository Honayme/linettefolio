<div>
    {{-- Barre de navigation supérieure pour le mobile --}}
    <div class="tokyo_tm_topbar bg-white fixed top-0 left-0 right-0 h-[50px] z-[14] hidden">
        <div class="topbar_inner w-full h-full clear-both flex items-center justify-between py-0 px-[20px]">
            <div class="logo" data-type="image">
                <a href="{{ route('home') }}">
                    <img class="max-w-[100px] max-h-[40px]" src="{{ asset('assets/img/logo/dark.png') }}" alt="Logo du site" />
                    {{-- J'ai gardé le H3 si jamais vous vouliez l'utiliser en mode "texte" --}}
                    <h3 class="font-black font-poppins text-[25px] tracking-[4px]">TOKYO</h3>
                </a>
            </div>
            <div class="trigger relative top-[5px]">
                <div class="hamburger hamburger--slider">
                    <div class="hamburger-box w-[30px]">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Le menu mobile qui s'affiche au clic --}}
    <div class="tokyo_tm_mobile_menu fixed top-[50px] right-[-200px] h-[100vh] w-[200px] z-[15] bg-white transition-all duration-300">
        <div class="menu_list w-full h-auto clear-both float-left text-right px-[20px] pt-[100px] pb-[0px]">
            <ul class="transition_link list-none">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }} mb-[7px]">
                    <a class="text-black font-montserrat" href="{{ route('home') }}">Home</a>
                </li>

                <li class="{{ request()->routeIs('about') ? 'active' : '' }} mb-[7px]">
                    <a class="text-black font-montserrat" href="{{ route('about') }}">About</a>
                </li>

                <li class="{{ request()->routeIs('services') ? 'active' : '' }} mb-[7px]">
                    <a class="text-black font-montserrat" href="{{ route('services') }}">Service</a>
                </li>

                <li class="{{ request()->routeIs('portfolio') ? 'active' : '' }} mb-[7px]">
                    <a class="text-black font-montserrat" href="{{ route('portfolio') }}">Portfolio</a>
                </li>

                <li class="{{ request()->routeIs('news') ? 'active' : '' }} mb-[7px]">
                    <a class="text-black font-montserrat" href="{{ route('news') }}">News</a>
                </li>

                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    <a class="text-black font-montserrat" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>

</div>
