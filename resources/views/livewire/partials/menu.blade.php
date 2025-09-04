<div>

    <div class="leftpart w-[450px] h-[100vh] fixed flex items-center z-[12] px-[100px] py-[0px] bg-white">
        <div class="leftpart_inner w-full h-auto">
            <div class="logo" data-type="image">
                <a href="#">
                    <img class="max-w-[150px]" src="{{ asset('img/logo/dark.png') }}" alt="" />
                    <h3 class="font-poppins font-black text-[31px] tracking-[5px]">TOKYO</h3>
                </a>
            </div>
            <div class="menu px-[0px] py-[50px] w-full float-left">
                <ul class="m-0 list-none p-0">
                    <li class="m-0 w-full float-left">
                        <a href="{{ route('home') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="text-[#767676] inline-block font-medium font-montserrat transition-all duration-300 hover:text-black">
                            Home
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('about') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="text-[#767676] inline-block font-medium font-montserrat transition-all duration-300 hover:text-black">
                            About
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('services') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="text-[#767676] inline-block font-medium font-montserrat transition-all duration-300 hover:text-black">
                            Service
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('portfolio') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="text-[#767676] inline-block font-medium font-montserrat transition-all duration-300 hover:text-black">
                            Portfolio
                        </a>
                    </li>

                    <li class="m-0 w-full float-left">
                        <a href="{{ route('contact') }}" wire:navigate
                           wire:current.exact="text-black font-semibold"
                           class="text-[#767676] inline-block font-medium font-montserrat transition-all duration-300 hover:text-black">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
            <div class="copyright w-full float-left">
                <p class="text-[15px] text-[#999] font-montserrat leading-[25px]">&copy; 2022 Tokyo<br>Created by <a class="text-[#787878] font-medium transition-all duration-300 hover:text-black" href="https://themeforest.net/user/marketify" target="_blank">Marketify</a></p>
            </div>
        </div>
    </div>
</div>
