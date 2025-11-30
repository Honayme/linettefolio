<div>
    {{-- Barre de navigation supérieure pour le mobile --}}
    <div class="tokyo_tm_topbar bg-white fixed top-0 left-0 right-0 h-[50px] z-[14] hidden">
        <div class="topbar_inner w-full h-full clear-both flex items-center justify-between py-0 px-[20px]">
            <div class="logo" data-type="image">
                <a href="{{ route('home') }}">
                    @if($siteSettings && $siteSettings->logo)
                        <img class="max-w-[100px] max-h-[40px]" src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->logo_alt ?? 'Logo' }}" />
                    @else
                        <img class="max-w-[100px] max-h-[40px]" src="{{ asset('img/logo/dark.png') }}" alt="Logo" />
                    @endif
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
            <ul class="m-0 list-none p-0">
                <li class="mb-[7px]">
                    <a href="{{ route('home') }}" wire:navigate
                       wire:current.exact="text-black font-semibold"
                       class="block text-[#767676] font-montserrat transition-colors duration-200 hover:text-black">
                        Accueil
                    </a>
                </li>

                <li class="mb-[7px]">
                    <a href="{{ route('about') }}" wire:navigate
                       wire:current.exact="text-black font-semibold"
                       class="block text-[#767676] font-montserrat transition-colors duration-200 hover:text-black">
                        À Propos
                    </a>
                </li>

                <li class="mb-[7px]">
                    <a href="{{ route('services') }}" wire:navigate
                       wire:current.exact="text-black font-semibold"
                       class="block text-[#767676] font-montserrat transition-colors duration-200 hover:text-black">
                        Services
                    </a>
                </li>

                <li class="mb-[7px]">
                    <a href="{{ route('portfolio') }}" wire:navigate
                       wire:current.exact="text-black font-semibold"
                       class="block text-[#767676] font-montserrat transition-colors duration-200 hover:text-black">
                        Portfolio
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact') }}" wire:navigate
                       wire:current.exact="text-black font-semibold"
                       class="block text-[#767676] font-montserrat transition-colors duration-200 hover:text-black">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>
