<div>

    <div class="leftpart w-[450px] h-[100vh] fixed flex items-center z-[12] px-[100px] py-[0px] bg-white">
        <div class="leftpart_inner w-full h-auto">
            <div class="logo" data-type="image">
                <a href="#">
                    <img class="max-w-[150px]" src="{{ asset('img/logo/dark.png') }}" alt="" />
                    <h3 class="font-poppins font-black text-[31px] tracking-[5px]">Lina-Marie MICHEL</h3>
                </a>
            </div>
            <div class="menu px-[0px] py-[50px] w-full float-left">
                <ul class="m-0 list-none p-0 space-y-2">
                    <li class="m-0 w-full float-left">
                        <a href="{{ route('home') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="flex items-center text-[#767676] font-medium font-montserrat transition-all duration-300 hover:text-black">
                            <img src="{{ asset('img/svg/menu/home-run.svg') }}" alt="Accueil" class="w-4 h-4 mr-3">
                            Accueil
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('about') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="flex items-center text-[#767676] font-medium font-montserrat transition-all duration-300 hover:text-black">
                            <img src="{{ asset('img/svg/menu/avatar.svg') }}" alt="À Propos" class="w-4 h-4 mr-3">
                            À Propos
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('services') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="flex items-center text-[#767676] font-medium font-montserrat transition-all duration-300 hover:text-black">
                            <img src="{{ asset('img/svg/menu/setting.svg') }}" alt="Services" class="w-4 h-4 mr-3">
                            Services
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('portfolio') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="flex items-center text-[#767676] font-medium font-montserrat transition-all duration-300 hover:text-black">
                            <img src="{{ asset('img/svg/menu/briefcase.svg') }}" alt="Portfolio" class="w-4 h-4 mr-3">
                            Portfolio
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('contact') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="flex items-center text-[#767676] font-medium font-montserrat transition-all duration-300 hover:text-black">
                            <img src="{{ asset('img/svg/menu/mail.svg') }}" alt="Contact" class="w-4 h-4 mr-3">
                            Contact
                        </a>
                    </li>
                </ul>

            </div>
            <div class="copyright w-full float-left">
                <p x-data class="text-[15px] text-[#999] font-montserrat leading-[25px]">
                    &copy; <span x-text="new Date().getFullYear()"></span> All Rights Reserved.<br>
                </p>
            </div>
        </div>
    </div>
</div>
