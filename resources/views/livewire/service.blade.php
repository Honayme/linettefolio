<div>
    <div class="rightpart w-full min-h-[100vh] float-left relative bg-[#f8f8f8] pl-[450px]">
        <div
            class="rightpart_in relative w-full float-left clear-both border-solid border-[#ebebeb] border-l min-h-[100vh]">
            <div id="service">
                <div class="container">
                    <div class="tokyo_tm_services w-full h-auto clear-both float-left py-[100px] px-0">
                        <div class="tokyo_tm_title w-full h-auto clear-both float-left mb-[62px]">
                            <div class="title_flex w-full h-auto clear-both flex justify-between items-end">
                                <div class="left">
                                    <span
                                        class="inline-block bg-[rgba(0,0,0,.04)] uppercase py-[4px] px-[10px] font-semibold text-[12px] text-[#333] font-montserrat tracking-[0px] mb-[11px]">Services</span>
                                    <h3 class="font-extrabold font-montserrat">What I Do</h3>
                                </div>
                            </div>
                        </div>
                        <div class="list w-full h-auto clear-both float-left">
                            <ul class="ml-[-40px] list-none flex flex-wrap">

                                {{-- On vérifie s'il y a des services à afficher --}}
                                @forelse ($services as $service)
                                    <li class="mb-[40px] w-1/3 pl-[40px]">
                                        <div
                                            class="list_inner w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border bg-white pt-[45px] pr-[30px] pb-[40px] pl-[30px] transition-all duration-300">
                                            <span
                                                class="number inline-block mb-[25px] relative w-[60px] h-[60px] leading-[60px] text-center rounded-full bg-[rgba(0,0,0,.03)] font-bold text-black font-montserrat transition-all duration-300">
                                                {{-- On affiche le numéro formaté (01, 02, etc.) --}}
                                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                            <h3 class="title font-bold text-black text-[18px] mb-[15px]">{{ $service->title }}</h3>
                                            <p class="text">{{ $service->excerpt }}</p>
                                            <div class="tokyo_tm_read_more">
                                                <a href="#"><span>Read More</span></a>
                                            </div>
                                            <a class="tokyo_tm_full_link" href="#"></a>

                                            <!-- Service Popup Start -->
                                            {{-- On utilise asset() pour générer le bon chemin vers l'image --}}
                                            <img class="popup_service_image hidden absolute z-[-111]"
                                                 src="{{ asset($service->image_path) }}"
                                                 alt="Image du service {{ $service->title }}"/>
                                            <div
                                                class="service_hidden_details opacity-0 invisible hidden absolute z-[-111]">
                                                <div
                                                    class="service_popup_informations w-full h-auto clear-both float-left">
                                                    <div class="descriptions w-full float-left">
                                                        {{-- IMPORTANT : On utilise {!! !!} pour que le HTML du contenu complet soit interprété et non affiché comme du texte brut --}}
                                                        {!! $service->full_content !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Service Popup End -->

                                        </div>
                                    </li>
                                @empty
                                    <li class="w-full text-center">
                                        <p>Aucun service n'est disponible pour le moment.</p>
                                    </li>
                                @endforelse

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tokyo_tm_partners w-full h-auto clear-both float-left bg-white py-[100px] px-0">
                    <div class="container">
                        <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                            <h3 class="text-[20px] font-bold">Partners</h3>
                        </div>
                        <div class="partners_inner w-full h-auto clear-both float-left">
                            <ul class="mt-[-2px] mr-[-10px] mb-[-2px] ml-[-2px] list-none pt-[2px] float-left pl-[2px]">
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/1.png') }}" alt="Logo partenaire 1"/>
                                    </div>
                                </li>
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/2.png') }}" alt="Logo partenaire 2"/>
                                    </div>
                                </li>
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/3.png') }}" alt="Logo partenaire 3"/>
                                    </div>
                                </li>
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/4.png') }}" alt="Logo partenaire 4"/>
                                    </div>
                                </li>
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/5.png') }}" alt="Logo partenaire 5"/>
                                    </div>
                                </li>
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/6.png') }}" alt="Logo partenaire 6"/>
                                    </div>
                                </li>
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/7.png') }}" alt="Logo partenaire 7"/>
                                    </div>
                                </li>
                                <li class="m-0 float-left w-1/4 border-solid border-[#eee] border-2 text-center h-[145px] leading-[145px] relative mt-[-2px] ml-[-2px] overflow-hidden">
                                    <div class="list_inner w-full h-full clear-both float-left opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[50%] max-h-[100px] inline-block" src="{{ asset('img/partners/dark/8.png') }}" alt="Logo partenaire 8"/>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tokyo_tm_facts w-full h-auto clear-both float-left px-0 pt-[100px] pb-[60px]">
                    <div class="container">
                        <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                            <h3 class="text-[20px] font-bold">Fun Facts</h3>
                        </div>
                        <div class="list w-full h-auto clear-both float-left">
                            <ul class="ml-[-40px] list-none">
                                <li class="mb-[40px] pl-[40px] w-1/3 float-left">
                                    <div
                                        class="list_inner  w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border text-center px-[20px] py-[40px]">
                                        <h3 class="font-semibold text-[20px] mb-[3px]">777+</h3>
                                        <span>Projects Completed</span>
                                    </div>
                                </li>
                                <li class="mb-[40px] pl-[40px] w-1/3 float-left">
                                    <div
                                        class="list_inner  w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border text-center px-[20px] py-[40px]">
                                        <h3 class="font-semibold text-[20px] mb-[3px]">3K</h3>
                                        <span>Happy Clients</span>
                                    </div>
                                </li>
                                <li class="mb-[40px] pl-[40px] w-1/3 float-left">
                                    <div
                                        class="list_inner  w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border text-center px-[20px] py-[40px]">
                                        <h3 class="font-semibold text-[20px] mb-[3px]">9K+</h3>
                                        <span>Lines of Code</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="tokyo_tm_pricing w-full h-auto clear-both float-left px-[0px] pt-[100px] pb-[60px] bg-white">
                    <div class="container">
                        <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                            <h3 class="text-[20px] font-bold">Pricing</h3>
                        </div>
                        <div class="list w-full h-auto clear-both float-left">
                            <ul class="ml-[-40px]">
                                <li class="mb-[40px] pl-[40px] w-1/3 float-left">
                                    <div
                                        class="list_inner w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border px-[40px] pt-[27px] pb-[45px]">
                                        <div class="price w-full float-left">
                                            <h3 class="text-[40px] font-semibold"><span>0<span class="currency">$</span></span>
                                            </h3>
                                        </div>
                                        <div class="plan w-full float-left">
                                            <h3 class="font-semibold text-[20px] border-solid border-[rgba(0,0,0,.1)] border-b mb-[20px] pb-[20px]">
                                                Free</h3>
                                        </div>
                                        <ul class="item list-none">
                                            <li class="active"><p>Premium Icons</p></li>
                                            <li class="opacity-50"><p>Quality Logo</p></li>
                                            <li class="opacity-50"><p>Stock Images</p></li>
                                            <li class="opacity-50"><p>Free Support</p></li>
                                        </ul>
                                        <div class="tokyo_tm_button" data-position="left">
                                            <a href="#">
                                                <span>Purchase</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-[40px] pl-[40px] w-1/3 float-left">
                                    <div
                                        class="list_inner w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border px-[40px] pt-[27px] pb-[45px]">
                                        <div class="price w-full float-left">
                                            <h3 class="text-[40px] font-semibold"><span>30<span
                                                        class="currency">$</span></span></h3>
                                        </div>
                                        <div class="plan w-full float-left">
                                            <h3 class="font-semibold text-[20px] border-solid border-[rgba(0,0,0,.1)] border-b mb-[20px] pb-[20px]">
                                                Basic</h3>
                                        </div>
                                        <ul class="item list-none">
                                            <li class="active"><p>Premium Icons</p></li>
                                            <li class="active"><p>Quality Logo</p></li>
                                            <li class="opacity-50"><p>Stock Images</p></li>
                                            <li class="opacity-50"><p>Free Support</p></li>
                                        </ul>
                                        <div class="tokyo_tm_button" data-position="left">
                                            <a href="#">
                                                <span>Purchase</span>
                                            </a>
                                        </div>
                                        <span
                                            class="popular absolute inline-block bg-black text-white text-[13px] px-[20px] pb-[3px] pt-0 top-[-17px] right-[10px]">Popular</span>
                                    </div>
                                </li>
                                <li class="mb-[40px] pl-[40px] w-1/3 float-left">
                                    <div
                                        class="list_inner w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border px-[40px] pt-[27px] pb-[45px]">
                                        <div class="price w-full float-left">
                                            <h3 class="text-[40px] font-semibold"><span>70<span
                                                        class="currency">$</span></span></h3>
                                        </div>
                                        <div class="plan w-full float-left">
                                            <h3 class="font-semibold text-[20px] border-solid border-[rgba(0,0,0,.1)] border-b mb-[20px] pb-[20px]">
                                                Premium</h3>
                                        </div>
                                        <ul class="item list-none">
                                            <li class="active"><p>Premium Icons</p></li>
                                            <li class="active"><p>Quality Logo</p></li>
                                            <li class="active"><p>Stock Images</p></li>
                                            <li class="active"><p>Free Support</p></li>
                                        </ul>
                                        <div class="tokyo_tm_button" data-position="left">
                                            <a href="#">
                                                <span>Purchase</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
