<div>
    <div class="rightpart w-full min-h-[100vh] float-left relative bg-[#f8f8f8] pl-[450px]">
        <div
            class="rightpart_in relative w-full float-left clear-both border-solid border-[#ebebeb] border-l min-h-[100vh]">
            <div id="about">
                <div class="container">
                    <div class="tokyo_tm_about w-full h-auto clear-both float-left py-[100px] px-0">
                        <div class="tokyo_tm_title w-full h-auto clear-both float-left mb-[62px]">
                            <div class="title_flex w-full h-auto clear-both flex justify-between items-end">
                                <div class="left">
                                    <span
                                        class="inline-block bg-[rgba(0,0,0,.04)] uppercase py-[4px] px-[10px] font-semibold text-[12px] text-[#333] font-montserrat tracking-[0px] mb-[11px]">About</span>
                                    <h3 class="font-extrabold font-montserrat">About Me</h3>
                                </div>
                            </div>
                        </div>
                        <div class="top_author_image w-full h-auto clear-both float-left relative mb-[35px]">
                            <img class="w-full h-auto object-cover" src="{{ asset('img/slider/1.jpg') }}"
                                 alt="Description pertinente de l'image">

                        </div>
                        <div
                            class="about_title w-full h-auto clear-both float-left border-solid border-[#DFDFDF] border-b pb-[20px] mb-[30px]">
                            <h3 class="text-[22px] font-bold">Lina-Marie MICHEL</h3>
                            <span>Marketing & Communication</span>
                        </div>
                        <div
                            class="about_text w-full h-auto clear-both float-left border-solid border-[#DFDFDF] border-b pb-[31px] mb-[30px]">
                            <p class="mb-[11px]">Chargée de communication et marketing digital avec plus de 6 ans
                                d’expérience. Gestion de projets multicanaux, community management et graphic design
                                (print & web).</p>
                            <p>Actuellement en poste chez Pellenc ST, je suis habituée à travailler en équipe
                                multiculturelle, à piloter des projets et à m’adapter au besoin.</p>
                        </div>
                        <div
                            class="tokyo_tm_short_info w-full h-auto clear-both float-left flex border-solid border-[#DFDFDF] border-b pb-[30px] mb-[40px]">
                            <div class="left w-1/2 pr-[50px]">
                                <div class="tokyo_tm_info w-full h-auto clear-both float-left">
                                    <ul class="m-0 list-none">
                                        <li class="m-0">
                                            <span class="min-w-[100px] float-left mr-[10px] font-bold text-black">Adresse:</span>
                                            <span>88c rue de bas vernaz, 74240 GAILLARD</span>
                                        </li>
                                        <li class="m-0">
                                            <span
                                                class="min-w-[100px] float-left mr-[10px] font-bold text-black">Email:</span>
                                            <span><a class="text-[#767676] transition-all duration-300 hover:text-black"
                                                     href="mailto:lina-marie.michel@hotmail.fr">lina-marie.michel@hotmail.fr</a></span>
                                        </li>
                                        <li class="m-0">
                                            <span class="min-w-[100px] float-left mr-[10px] font-bold text-black">Téléphone:</span>
                                            <span><a class="text-[#767676] transition-all duration-300 hover:text-black"
                                                     href="tel:+33605276622">+33 6 05 27 66 22</a></span>
                                        </li>
                                        <li class="m-0">
                                            <span class="min-w-[100px] float-left mr-[10px] font-bold text-black">Permis:</span>
                                            <span>Permis B, véhiculée</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="right w-1/2 pl-[50px]">
                                <div class="tokyo_tm_info">
                                    <ul class="m-0 list-none">
                                        <li class="m-0">
                                            <span class="min-w-[100px] float-left mr-[10px] font-bold text-black">Nationalité:</span>
                                            <span>Française</span>
                                        </li>
                                        <li class="m-0">
                                            <span class="min-w-[100px] float-left mr-[10px] font-bold text-black">Études:</span>
                                            <span>ESUPCOM</span>
                                        </li>
                                        <li class="m-0">
                                            <span class="min-w-[100px] float-left mr-[10px] font-bold text-black">Diplôme:</span>
                                            <span>Master</span>
                                        </li>
                                        <li class="m-0">
                                            <span class="min-w-[100px] float-left mr-[10px] font-bold text-black">Langues:</span>
                                            <span>Français, Anglais (B2), Italien</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tokyo_tm_button" data-position="left">
                            <a href="{{ asset('img/CV_22.08.jpg') }}" download>
                                <span>Télécharger le CV</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Le conteneur principal qui gère l'état de l'animation -->
                <div
                    class="tokyo_tm_progressbox w-full h-auto clear-both float-left bg-white pt-[93px] pr-[0px] pb-[100px] pl-[0px]">
                    <div class="container">
                        <!-- Conteneur principal qui détecte quand il devient visible pour démarrer les animations -->
                        <div class="in w-full h-auto clear-both float-left flex flex-col md:flex-row gap-y-10"
                             x-data="{ startAnimation: false }"
                             x-intersect:enter="startAnimation = true">

                            <!-- Colonne de gauche -->
                            <div class="left w-full md:w-1/2 md:pr-[50px]">
                                <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                                    <h3 class="text-[20px] font-bold">Graphisme & Web</h3>
                                </div>
                                <div class="tokyo_progress space-y-8">

                                    <!-- Compétence: Suite Adobe -->
                                    <div class="progress_inner"
                                         x-data="{ target: 95, current: 0, interval: null, speed: 15 }"
                                         x-init="$watch('startAnimation', value => {
                                        if (!value) return;
                                        interval = setInterval(() => {
                                            if (current < target) current++;
                                            else clearInterval(interval);
                                        }, speed);
                                     })">
                        <span>
                            <span class="label">Suite Adobe (Illustrator, InDesign, Photoshop)</span>
                            <span class="number"><span x-text="current">0</span>%</span>
                        </span>
                                        <div class="background bg-gray-200 rounded-full h-2">
                                            <div
                                                class="bar h-full bg-black rounded-full transition-all duration-100 ease-linear"
                                                :style="`width: ${current}%`"></div>
                                        </div>
                                    </div>

                                    <!-- Compétence: Premiere Pro -->
                                    <div class="progress_inner"
                                         x-data="{ target: 85, current: 0, interval: null, speed: 20 }"
                                         x-init="$watch('startAnimation', value => {
                                        if (!value) return;
                                        interval = setInterval(() => {
                                            if (current < target) current++;
                                            else clearInterval(interval);
                                        }, speed);
                                     })">
                        <span>
                            <span class="label">Premiere Pro</span>
                            <span class="number"><span x-text="current">0</span>%</span>
                        </span>
                                        <div class="background bg-gray-200 rounded-full h-2">
                                            <div
                                                class="bar h-full bg-black rounded-full transition-all duration-100 ease-linear"
                                                :style="`width: ${current}%`"></div>
                                        </div>
                                    </div>

                                    <!-- Compétence: WordPress -->
                                    <div class="progress_inner"
                                         x-data="{ target: 90, current: 0, interval: null, speed: 18 }"
                                         x-init="$watch('startAnimation', value => {
                                        if (!value) return;
                                        interval = setInterval(() => {
                                            if (current < target) current++;
                                            else clearInterval(interval);
                                        }, speed);
                                     })">
                        <span>
                            <span class="label">WordPress</span>
                            <span class="number"><span x-text="current">0</span>%</span>
                        </span>
                                        <div class="background bg-gray-200 rounded-full h-2">
                                            <div
                                                class="bar h-full bg-black rounded-full transition-all duration-100 ease-linear"
                                                :style="`width: ${current}%`"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Colonne de droite -->
                            <div class="right w-full md:w-1/2 md:pl-[50px]">
                                <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                                    <h3 class="text-[20px] font-bold">Marketing & Outils</h3>
                                </div>
                                <div class="tokyo_progress space-y-8">

                                    <!-- Compétence: Salesforce -->
                                    <div class="progress_inner"
                                         x-data="{ target: 90, current: 0, interval: null, speed: 18 }"
                                         x-init="$watch('startAnimation', value => {
                                        if (!value) return;
                                        interval = setInterval(() => {
                                            if (current < target) current++;
                                            else clearInterval(interval);
                                        }, speed);
                                     })">
                        <span>
                            <span class="label">Salesforce (CRM)</span>
                            <span class="number"><span x-text="current">0</span>%</span>
                        </span>
                                        <div class="background bg-gray-200 rounded-full h-2">
                                            <div
                                                class="bar h-full bg-black rounded-full transition-all duration-100 ease-linear"
                                                :style="`width: ${current}%`"></div>
                                        </div>
                                    </div>

                                    <!-- Compétence: Microsoft Office -->
                                    <div class="progress_inner"
                                         x-data="{ target: 95, current: 0, interval: null, speed: 15 }"
                                         x-init="$watch('startAnimation', value => {
                                         if (!value) return;
                                         interval = setInterval(() => {
                                             if (current < target) current++;
                                             else clearInterval(interval);
                                         }, speed);
                                         })">
                        <span>
                            <span class="label">Microsoft Office</span>
                            <span class="number"><span x-text="current">0</span>%</span>
                        </span>
                                        <div class="background bg-gray-200 rounded-full h-2">
                                            <div
                                                class="bar h-full bg-black rounded-full transition-all duration-100 ease-linear"
                                                :style="`width: ${current}%`"></div>
                                        </div>
                                    </div>

                                    <!-- Compétence: Canva -->
                                    <div class="progress_inner"
                                         x-data="{ target: 80, current: 0, interval: null, speed: 22 }"
                                         x-init="$watch('startAnimation', value => {
                                        if (!value) return;
                                        interval = setInterval(() => {
                                            if (current < target) current++;
                                            else clearInterval(interval);
                                        }, speed);
                                     })">
                        <span>
                            <span class="label">Canva</span>
                            <span class="number"><span x-text="current">0</span>%</span>
                        </span>
                                        <div class="background bg-gray-200 rounded-full h-2">
                                            <div
                                                class="bar h-full bg-black rounded-full transition-all duration-100 ease-linear"
                                                :style="`width: ${current}%`"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div
                    class="tokyo_tm_skillbox w-full h-auto clear-both float-left pt-[90px] pr-[0px] pb-[90px] pl-[0px]">
                    <div class="container">
                        <div class="in w-full h-auto clear-both float-left flex">
                            <div class="left w-1/2 pr-[50px]">
                                <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                                    <h3 class="text-[20px] font-bold">Knowledge</h3>
                                </div>
                                <div class="tokyo_tm_skill_list w-full h-auto clear-both float-left">
                                    <ul class="m-0 list-none">
                                        <li class="m-0 pl-[25px] relative">
                                            <span>
                                                <img class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]" src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>
                                                Suite Adobe (Illustrator, InDesign, Photoshop, Premiere Pro)
                                            </span>
                                        </li>
                                        <li class="m-0 pl-[25px] relative">
                                            <span>
                                                <img class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]" src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>
                                                Marketing &amp; Communication (Salesforce, Wordpress, E-mailing)
                                            </span>
                                        </li>
                                        <li class="m-0 pl-[25px] relative">
                                            <span>
                                                <img class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]" src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>
                                                Suite Microsoft Office
                                            </span>
                                        </li>
                                        <li class="m-0 pl-[25px] relative">
                                            <span>
                                                <img class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]" src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>
                                                Canva
                                            </span>
                                        </li>
                                        <li class="m-0 pl-[25px] relative">
                                            <span>
                                                <img class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]" src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>
                                                Sponsoring
                                            </span>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                            <div class="right w-1/2 pl-[50px]">
                                <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                                    <h3 class="text-[20px] font-bold">Centres d'intérêt</h3>
                                </div>
                                <div class="tokyo_tm_skill_list w-full h-auto clear-both float-left">
                                    <ul class="m-0 list-none">
                                        <li class="m-0 pl-[25px] relative">
                                            <span><img
                                            class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]"
                                            src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>Voyages (Amérique du Nord, Asie)</span>
                                        </li>
                                        <li class="m-0 pl-[25px] relative">
                                            <span><img
                                            class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]"
                                            src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>Randonnée (trekking)</span>
                                        </li>
                                        <li class="m-0 pl-[25px] relative">
                                            <span><img
                                            class="svg text-black w-[10px] h-[10px] absolute left-0 top-1/2 translate-y-[-50%]"
                                            src="{{ asset('img/svg/rightarrow.svg') }}" alt=""/>Littérature</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tokyo_tm_resumebox w-full h-auto clear-both float-left bg-white py-[93px] px-0">
                    <div class="container">
                        <div class="in w-full h-auto clear-both float-left flex">
                            <div class="left w-1/2 pr-[50px]">
                                <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                                    <h3 class="text-[20px] font-bold">Formations</h3>
                                </div>
                                <div class="tokyo_tm_resume_list w-full h-auto clear-both float-left">
                                    <ul class="m-0 list-none relative inline-block pt-[10px]">
                                        <li class="m-0 w-full float-left relative pl-[20px] pb-[45px]">
                                            <div class="list_inner w-full h-auto clear-both float-left relative flex">
                                                <div class="time w-1/2 pr-[20px]">
                                                    <span class="inline-block py-[5px] px-[25px] bg-[rgba(0,0,0,.05)] rounded-[50px] text-[14px] whitespace-nowrap">2020 - 2022</span>
                                                </div>
                                                <div class="place w-1/2 pl-[20px]">
                                                    <h3 class="text-[16px] mb-[2px] font-semibold">ESUPCOM</h3>
                                                    <span class="text-[14px]">Master Communication des entreprises &amp; des organisations</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-0 w-full float-left relative pl-[20px] pb-[45px]">
                                            <div class="list_inner w-full h-auto clear-both float-left relative flex">
                                                <div class="time w-1/2 pr-[20px]">
                                                    <span class="inline-block py-[5px] px-[25px] bg-[rgba(0,0,0,.05)] rounded-[50px] text-[14px] whitespace-nowrap">2017 - 2020</span>
                                                </div>
                                                <div class="place w-1/2 pl-[20px]">
                                                    <h3 class="text-[16px] mb-[2px] font-semibold">YNOV Campus</h3>
                                                    <span class="text-[14px]">Bachelor Communication &amp; Marketing digital</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-0 w-full float-left relative pl-[20px]">
                                            <div class="list_inner w-full h-auto clear-both float-left relative flex">
                                                <div class="time w-1/2 pr-[20px]">
                                                    <span class="inline-block py-[5px] px-[25px] bg-[rgba(0,0,0,.05)] rounded-[50px] text-[14px] whitespace-nowrap">2019</span>
                                                </div>
                                                <div class="place w-1/2 pl-[20px]">
                                                    <h3 class="text-[16px] mb-[2px] font-semibold">Dublin Business School</h3>
                                                    <span class="text-[14px]">Communication &amp; Management</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="right w-1/2 pl-[50px]">
                                <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                                    <h3 class="text-[20px] font-bold">Expériences</h3>
                                </div>
                                <div class="tokyo_tm_resume_list w-full h-auto clear-both float-left">
                                    <ul class="m-0 list-none relative inline-block pt-[10px]">
                                        <li class="m-0 w-full float-left relative pl-[20px] pb-[45px]">
                                            <div class="list_inner w-full h-auto clear-both float-left relative flex">
                                                <div class="time w-1/2 pr-[20px]">
                                                    <span class="inline-block py-[5px] px-[25px] bg-[rgba(0,0,0,.05)] rounded-[50px] text-[14px] whitespace-nowrap">2022 - Présent</span>
                                                </div>
                                                <div class="place w-1/2 pl-[20px]">
                                                    <h3 class="text-[16px] mb-[2px] font-semibold">Pellenc ST</h3>
                                                    <span class="text-[14px]">Chargée Marketing</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-0 w-full float-left relative pl-[20px] pb-[45px]">
                                            <div class="list_inner w-full h-auto clear-both float-left relative flex">
                                                <div class="time w-1/2 pr-[20px]">
                                                    <span class="inline-block py-[5px] px-[25px] bg-[rgba(0,0,0,.05)] rounded-[50px] text-[14px] whitespace-nowrap">2019 - 2022</span>
                                                </div>
                                                <div class="place w-1/2 pl-[20px]">
                                                    <h3 class="text-[16px] mb-[2px] font-semibold">RIDERVALLEY</h3>
                                                    <span class="text-[14px]">Alternante Chargée Communication</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-0 w-full float-left relative pl-[20px] pb-[45px]">
                                            <div class="list_inner w-full h-auto clear-both float-left relative flex">
                                                <div class="time w-1/2 pr-[20px]">
                                                    <span class="inline-block py-[5px] px-[25px] bg-[rgba(0,0,0,.05)] rounded-[50px] text-[14px] whitespace-nowrap">Mai - Août 2019</span>
                                                </div>
                                                <div class="place w-1/2 pl-[20px]">
                                                    <h3 class="text-[16px] mb-[2px] font-semibold">ILLUSIO</h3>
                                                    <span class="text-[14px]">Stage Community Manager</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-0 w-full float-left relative pl-[20px]">
                                            <div class="list_inner w-full h-auto clear-both float-left relative flex">
                                                <div class="time w-1/2 pr-[20px]">
                                                    <span class="inline-block py-[5px] px-[25px] bg-[rgba(0,0,0,.05)] rounded-[50px] text-[14px] whitespace-nowrap">Juil - Août 2018</span>
                                                </div>
                                                <div class="place w-1/2 pl-[20px]">
                                                    <h3 class="text-[16px] mb-[2px] font-semibold">SFC</h3>
                                                    <span class="text-[14px]">Stage Chargée de communication</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--<div class="tokyo_tm_testimonials w-full h-auto clear-both float-left py-[100px] px-0">
                    <div class="container">
                        <div class="tokyo_section_title w-full h-auto clear-both float-left mb-[40px]">
                            <h3 class="text-[20px] font-bold">Testimonials</h3>
                        </div>
                        <div class="list w-full h-auto clear-both float-left overflow-hidden">
                            <ul class="owl-carousel m-0 list-none cursor-e-resize">
                                <li>
                                    <div class="list_inner w-full h-auto clear-both float-left relative">
                                        <div
                                            class="text w-full h-auto clear-both float-left border-solid border-[#E5EDF4] border-2 p-[40px] mb-[30px] relative">
                                            <p>Beautiful minimalist design and great, fast response with support. Highly
                                                recommend. Thanks Marketify!</p>
                                        </div>
                                        <div
                                            class="details w-full h-auto clear-both float-left flex items-center pl-[20px]">
                                            <div class="image relative w-[60px] h-[60px]">
                                                <div
                                                    class="main absolute inset-0 bg-no-repeat bg-cover bg-center rounded-full"
                                                    data-img-url="{{ asset('img/testimonials/1.jpg') }}"></div>
                                            </div>
                                            <div class="info pl-[20px]">
                                                <h3 class="text-[16px] mb-[2px] font-semibold">Alexander Walker</h3>
                                                <span class="text-[14px]">Graphic Designer</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_inner w-full h-auto clear-both float-left relative">
                                        <div
                                            class="text w-full h-auto clear-both float-left border-solid border-[#E5EDF4] border-2 p-[40px] mb-[30px] relative">
                                            <p>These people really know what they are doing! Great customer support
                                                availability and supperb kindness.</p>
                                        </div>
                                        <div
                                            class="details w-full h-auto clear-both float-left flex items-center pl-[20px]">
                                            <div class="image relative w-[60px] h-[60px]">
                                                <div
                                                    class="main absolute inset-0 bg-no-repeat bg-cover bg-center rounded-full"
                                                    data-img-url="{{ asset('img/testimonials/2.jpg') }}"></div>
                                            </div>
                                            <div class="info pl-[20px]">
                                                <h3 class="text-[16px] mb-[2px] font-semibold">Isabelle Smith</h3>
                                                <span class="text-[14px]">Content Manager</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_inner w-full h-auto clear-both float-left relative">
                                        <div
                                            class="text w-full h-auto clear-both float-left border-solid border-[#E5EDF4] border-2 p-[40px] mb-[30px] relative">
                                            <p>I had a little problem and the support was just awesome to quickly solve
                                                the situation. And keep going on.</p>
                                        </div>
                                        <div
                                            class="details w-full h-auto clear-both float-left flex items-center pl-[20px]">
                                            <div class="image relative w-[60px] h-[60px]">
                                                <div
                                                    class="main absolute inset-0 bg-no-repeat bg-cover bg-center rounded-full"
                                                    data-img-url="{{ asset('img/testimonials/3.jpg') }}"></div>
                                            </div>
                                            <div class="info pl-[20px]">
                                                <h3 class="text-[16px] mb-[2px] font-semibold">Baraka Clinton</h3>
                                                <span class="text-[14px]">English Teacher</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
