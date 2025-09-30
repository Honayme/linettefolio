@php
    use Illuminate\Support\Facades\Storage;
@endphp

<div x-data="serviceModal()">
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
                                    <h3 class="font-extrabold font-montserrat">Services</h3>
                                </div>
                            </div>
                        </div>
                        <div class="list w-full h-auto clear-both float-left">
                            <ul class="ml-[-40px] list-none flex flex-wrap">
                                @forelse ($services as $service)
                                    <li class="mb-[40px] w-1/3 pl-[40px]">
                                        <div
                                            class="list_inner w-full h-auto clear-both float-left relative border-solid border-[rgba(0,0,0,.1)] border bg-white pt-[45px] pr-[30px] pb-[40px] pl-[30px] transition-all duration-300"
                                            data-image-url="{{ Storage::url($service->image_path) }}">
                                            <span
                                                class="number inline-block mb-[25px] relative w-[60px] h-[60px] leading-[60px] text-center rounded-full bg-[rgba(0,0,0,.03)] font-bold text-black font-montserrat transition-all duration-300">
                                                {{-- On affiche le numéro formaté (01, 02, etc.) --}}
                                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                            <h3 class="title font-bold text-black text-[18px] mb-[15px]">{{ $service->title }}</h3>
                                            <p class="text">{{ $service->excerpt }}</p>
                                            <div class="tokyo_tm_read_more">
                                                <a href="#" @click.prevent="open($el.closest('.list_inner'))"><span>Lire la suite</span></a>
                                            </div>
                                            <a class="tokyo_tm_full_link" href="#" @click.prevent="open($el.closest('.list_inner'))"></a>

                                            <!-- Service Popup Start -->
                                            {{-- On utilise asset() pour générer le bon chemin vers l'image --}}
                                            <img class="popup_service_image w-full h-64 hidden absolute z-[-111]"
                                                 src="{{ Storage::url($service->image_path) }}"
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
                            <h3 class="text-[20px] font-bold">Ils m'ont fait confiance</h3>
                        </div>
                        <div class="partners_inner w-full h-auto clear-both float-left">
                            <ul class="flex flex-wrap justify-center items-center gap-5">

                                <!-- Les 'li' n'ont plus besoin de classes de largeur fixe comme w-1/4 -->
                                <!-- Ils sont maintenant des conteneurs flexibles pour centrer leur contenu -->
                                <li class="w-full sm:w-1/3 md:w-1/5 flex justify-center items-center border-2 border-solid border-gray-200 h-[145px] overflow-hidden">
                                    <div
                                        class="list_inner w-full h-full flex justify-center items-center opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[60%] max-h-[100px]"
                                             src="{{ asset('img/partners/astonehelmets.svg') }}"
                                             alt="Logo partenaire 1"/>
                                    </div>
                                </li>

                                <li class="w-full sm:w-1/3 md:w-1/5 flex justify-center items-center border-2 border-solid border-gray-200 h-[145px] overflow-hidden">
                                    <div
                                        class="list_inner w-full h-full flex justify-center items-center opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[60%] max-h-[100px]"
                                             src="{{ asset('img/partners/hibook.svg') }}" alt="Logo partenaire 2"/>
                                    </div>
                                </li>

                                <li class="w-full sm:w-1/3 md:w-1/5 flex justify-center items-center border-2 border-solid border-gray-200 h-[145px] overflow-hidden">
                                    <div
                                        class="list_inner w-full h-full flex justify-center items-center opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[60%] max-h-[100px]"
                                             src="{{ asset('img/partners/overlap.svg') }}" alt="Logo partenaire 3"/>
                                    </div>
                                </li>

                                <li class="w-full sm:w-1/3 md:w-1/5 flex justify-center items-center border-2 border-solid border-gray-200 h-[145px] overflow-hidden">
                                    <div
                                        class="list_inner w-full h-full flex justify-center items-center opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[60%] max-h-[100px]"
                                             src="{{ asset('img/partners/ridervalley.svg') }}" alt="Logo partenaire 4"/>
                                    </div>
                                </li>

                                <li class="w-full sm:w-1/3 md:w-1/5 flex justify-center items-center border-2 border-solid border-gray-200 h-[145px] overflow-hidden">
                                    <div
                                        class="list_inner w-full h-full flex justify-center items-center opacity-50 transition-all duration-300 hover:opacity-100">
                                        <img class="max-w-[70%] max-h-[100px]"
                                             src="{{ asset('img/partners/vquatrodesign.svg') }}"
                                             alt="Logo partenaire 5"/>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tokyo_tm_facts w-full h-auto clear-both float-left px-0 pt-[100px] pb-[60px] hidden md:block">
                    <div class="container">
                        <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                            <h3 class="text-[20px] font-bold">Quelques chiffres</h3>
                        </div>
                        <div class="list w-full">
                            <ul class="-mx-5 flex list-none flex-wrap">

                                <!-- Carte 1: Age -->
                                <li class="w-full px-5 pb-10 md:w-1/2 lg:w-1/3"
                                    x-data="factCard(25)"
                                    @mouseenter="isHovered = true"
                                    @mouseleave="isHovered = false">
                                    <div
                                        class="relative w-full cursor-pointer overflow-hidden border border-solid border-[rgba(0,0,0,.1)] p-10 text-center">
                                        <div class="relative z-10">
                                            <h3 class="mb-1 text-2xl font-semibold transition-colors duration-300"
                                                x-intersect:enter.once="startAnimation()"
                                                x-text="currentNumber"
                                                :class="isHovered ? 'text-white' : 'text-black'">
                                            </h3>
                                            <span class="transition-colors duration-300"
                                                  :class="isHovered ? 'text-white' : 'text-gray-600'">Age</span>
                                        </div>
                                        <div x-show="isHovered"
                                             x-transition:enter="transition ease-in-out duration-500 transform"
                                             x-transition:enter-start="translate-y-full"
                                             x-transition:enter-end="translate-y-0"
                                             x-transition:leave="transition ease-in-out duration-500 transform"
                                             x-transition:leave-start="translate-y-0"
                                             x-transition:leave-end="-translate-y-full"
                                             class="absolute inset-0 z-0 bg-orange" x-cloak>
                                        </div>
                                    </div>
                                </li>

                                <!-- Carte 2: Expériences -->
                                <li class="w-full px-5 pb-10 md:w-1/2 lg:w-1/3"
                                    x-data="factCard(6)"
                                    @mouseenter="isHovered = true"
                                    @mouseleave="isHovered = false">
                                    <div
                                        class="relative w-full cursor-pointer overflow-hidden border border-solid border-[rgba(0,0,0,.1)] p-10 text-center">
                                        <div class="relative z-10">
                                            <h3 class="mb-1 text-2xl font-semibold transition-colors duration-300"
                                                x-intersect:enter.once="startAnimation()"
                                                x-text="currentNumber"
                                                :class="isHovered ? 'text-white' : 'text-black'">
                                            </h3>
                                            <span class="transition-colors duration-300"
                                                  :class="isHovered ? 'text-white' : 'text-gray-600'">Expériences en entreprise</span>
                                        </div>
                                        <div x-show="isHovered"
                                             x-transition:enter="transition ease-in-out duration-500 transform"
                                             x-transition:enter-start="translate-y-full"
                                             x-transition:enter-end="translate-y-0"
                                             x-transition:leave="transition ease-in-out duration-500 transform"
                                             x-transition:leave-start="translate-y-0"
                                             x-transition:leave-end="-translate-y-full"
                                             class="absolute inset-0 z-0 bg-orange" x-cloak>
                                        </div>
                                    </div>
                                </li>

                                <!-- Carte 3: Entreprises -->
                                <li class="w-full px-5 pb-10 md:w-1/2 lg:w-1/3"
                                    x-data="factCard(4)"
                                    @mouseenter="isHovered = true"
                                    @mouseleave="isHovered = false">
                                    <div
                                        class="relative w-full cursor-pointer overflow-hidden border border-solid border-[rgba(0,0,0,.1)] p-10 text-center">
                                        <div class="relative z-10">
                                            <h3 class="mb-1 text-2xl font-semibold transition-colors duration-300"
                                                x-intersect:enter.once="startAnimation()"
                                                x-text="currentNumber"
                                                :class="isHovered ? 'text-white' : 'text-black'">
                                            </h3>
                                            <span class="transition-colors duration-300"
                                                  :class="isHovered ? 'text-white' : 'text-gray-600'">Entreprises satisfaites</span>
                                        </div>
                                        <div x-show="isHovered"
                                             x-transition:enter="transition ease-in-out duration-500 transform"
                                             x-transition:enter-start="translate-y-full"
                                             x-transition:enter-end="translate-y-0"
                                             x-transition:leave="transition ease-in-out duration-500 transform"
                                             x-transition:leave-start="translate-y-0"
                                             x-transition:leave-end="-translate-y-full"
                                             class="absolute inset-0 z-0 bg-orange" x-cloak>
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

    <!-- Modal de service -->
    <div x-show="isOpen"
         x-cloak
         @click="close()"
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/80 p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div @click.stop
             class="relative max-h-[90vh] w-full max-w-6xl overflow-y-auto bg-white rounded-lg shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            <!-- Bouton de fermeture -->
            <button @click="close()"
                    class="absolute right-6 top-6 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-black/50 text-white transition-colors hover:bg-black/70">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Image -->
            <div x-show="image" class="w-full">
                <img :src="image" :alt="title" class="h-80 w-full object-cover">
            </div>

            <!-- Contenu -->
            <div class="p-12">
                <h3 class="mb-8 text-4xl font-bold text-black" x-text="title"></h3>
                <div class="prose prose-lg max-w-none" x-html="content"></div>
            </div>
        </div>
    </div>
</div>

