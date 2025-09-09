<div>
    <!-- Composant autonome -->

    <div class="rightpart w-full min-h-[100vh] float-left relative bg-[#f8f8f8] pl-[450px]">
        <div
            class="rightpart_in relative w-full float-left clear-both border-solid border-[#ebebeb] border-l min-h-[100vh]">
            <div id="portfolio" class="tokyo_tm_section">
                <div class="container">
                    <div x-data="{
                                    currentFilter: '*',
                                    filterPortfolio(category) {
                                        this.currentFilter = category === this.currentFilter ? '*' : category;
                                    }
                                }" class="tokyo_tm_portfolio w-full h-auto clear-both float-left">
                        <div class="tokyo_tm_title w-full h-auto clear-both float-left mb-[62px]">
                            <div class="title_flex w-full h-auto clear-both flex justify-between items-end">
                                <div class="left">
                                    <span
                                        class="inline-block bg-[rgba(0,0,0,.04)] uppercase py-[4px] px-[10px] font-semibold text-[12px] text-[#333] font-montserrat tracking-[0px] mb-[11px]">Portfolio</span>
                                    <h3 class="font-extrabold font-montserrat">Creative Portfolio</h3>
                                </div>
                                <div class="portfolio_filter">
                                    @livewire('partials.category-navigation')
                                </div>
                            </div>
                        </div>
                        <div class="list_wrapper w-full h-auto clear-both float-left">
                            <ul class="gallery_zoom ml-[-40px] list-none">
                                @foreach ($portfolioItems as $item)
                                    @if($item->is_visible && $item->categories->isNotEmpty())
                                        @php
                                            $categorySlugs = $item->categories->pluck('slug')->implode(' ');
                                            $categoryNames = $item->categories->pluck('name')->implode(', ');
                                        @endphp
                                        <li class="mb-[40px] float-left w-1/3 pl-[40px]"
                                            x-show="currentFilter === '*' || '{{ $categorySlugs }}'.split(' ').includes(currentFilter)">
                                            <div
                                                class="inner w-full h-auto clear-both float-left overflow-hidden relative">
                                                <div class="entry tokyo_tm_portfolio_animation_wrap"
                                                     data-title="{{ $item->title }}"
                                                     data-category="{{ $categoryNames }}">

                                                     CAS 1: Le layout est une VIDÉO
                                                    @if ($item->layout === \App\Enums\PortfolioLayout::VIDEO && !empty($item->video_url))
                                                        @php
                                                            // Détermine la classe CSS du popup en fonction de l'URL
                                                            $popupClass = Illuminate\Support\Str::contains($item->video_url, 'youtube.com') ? 'popup-youtube' : 'popup-vimeo';
                                                        @endphp
                                                        <a class="{{ $popupClass }}" href="{{ $item->video_url }}">
                                                            <img class="opacity-0 min-w-full"
                                                                 src="{{ Storage::url($item->cover_image) }}"
                                                                 alt="{{ $item->cover_image_alt }}"/>
                                                            <div
                                                                class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                                                                data-img-url="{{ Storage::url($item->cover_image) }}"></div>
                                                        </a>

                                                         CAS 2: Le layout est une IMAGE unique
                                                    @elseif ($item->layout === \App\Enums\PortfolioLayout::IMAGE && !empty($item->cover_image))
                                                        <a class="zoom" href="{{ Storage::url($item->cover_image) }}">
                                                            <img class="opacity-0 min-w-full"
                                                                 src="{{ Storage::url($item->cover_image) }}"
                                                                 alt="{{ $item->cover_image_alt }}"/>
                                                            <div
                                                                class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                                                                data-img-url="{{ Storage::url($item->cover_image) }}"></div>
                                                        </a>

                                                         CAS 3: Le layout est une GALERIE d'images
                                                    @elseif ($item->layout === \App\Enums\PortfolioLayout::SLIDER && !empty($item->images))
                                                         Le premier lien ouvre la galerie sur la première image
                                                        <a class="zoom" href="{{ Storage::url($item->images[0]) }}">
                                                            <img class="opacity-0 min-w-full"
                                                                 src="{{ Storage::url($item->cover_image) }}"
                                                                 alt="{{ $item->cover_image_alt }}"/>
                                                            <div
                                                                class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                                                                data-img-url="{{ Storage::url($item->cover_image) }}"></div>
                                                        </a>
                                                         On ajoute les autres images en liens cachés pour que la lightbox puisse les trouver
                                                        <div class="hidden">
                                                            @foreach (array_slice($item->images, 1) as $image)
                                                                <a class="zoom" href="{{ Storage::url($image) }}"></a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{--<ul class="portfolio_list gallery_zoom ml-[-40px] list-none">
    <li class="vimeo mb-[40px] float-left w-1/3 pl-[40px]">
        <div class="inner w-full h-auto clear-both float-left overflow-hidden relative">
            <div class="entry tokyo_tm_portfolio_animation_wrap" data-title="Teresa Butler"
                 data-category="Vimeo">
                <a class="popup-vimeo" href="https://vimeo.com/337293658">
                    <img class="opacity-0 min-w-full"
                         src="https://picsum.photos/seed/large/600/600" alt=""/>
                    <div
                        class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                        data-img-url="https://picsum.photos/seed/large/600/600"></div>
                </a>
            </div>
        </div>
    </li>
    <li class="youtube mb-[40px] float-left w-1/3 pl-[40px]">
        <div class="inner w-full h-auto clear-both float-left overflow-hidden relative">
            <div class="entry tokyo_tm_portfolio_animation_wrap" data-title="Ashley Flores"
                 data-category="Youtube">
                <a class="popup-youtube" href="https://www.youtube.com/watch?v=7e90gBu4pas">
                    <img class="opacity-0 min-w-full"
                         src="https://picsum.photos/seed/large/600/600" alt=""/>
                    <div
                        class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                        data-img-url="https://picsum.photos/seed/large/600/600"></div>
                </a>
            </div>
        </div>
    </li>
    <li class="soundcloud mb-[40px] float-left w-1/3 pl-[40px]">
        <div class="inner w-full h-auto clear-both float-left overflow-hidden relative">
            <div class="entry tokyo_tm_portfolio_animation_wrap" data-title="Derek Smith"
                 data-category="Soundcloud">
                <a class="soundcloude_link mfp-iframe audio"
                   href="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/471954807&color=%23ff5500&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true">
                    <img class="opacity-0 min-w-full"
                         src="https://picsum.photos/seed/large/600/600" alt=""/>
                    <div
                        class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                        data-img-url="https://picsum.photos/seed/large/600/600"></div>
                </a>
            </div>
        </div>
    </li>
    <li class="image mb-[40px] float-left w-1/3 pl-[40px]">
        <div class="inner w-full h-auto clear-both float-left overflow-hidden relative">
            <div class="entry tokyo_tm_portfolio_animation_wrap" data-title="Gloria Jenkins"
                 data-category="Image">
                <a class="popup-vimeo" href="https://vimeo.com/337293658">
                    <img class="opacity-0 min-w-full"
                         src="https://picsum.photos/seed/thumb/600/600" alt="Image de remplacement"/>
                    <div
                        class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                        data-img-url="https://picsum.photos/seed/large/600/600"></div>
                </a>
            </div>
        </div>
    </li>
    <li class="detail mb-[40px] float-left w-1/3 pl-[40px]">
        <div class="inner w-full h-auto clear-both float-left overflow-hidden relative">
            <div class="entry tokyo_tm_portfolio_animation_wrap" data-title="Selena Gomez"
                 data-category="Detail">
                <a class="popup-vimeo" href="https://vimeo.com/337293658">
                    <img class="opacity-0 min-w-full"
                         src="https://picsum.photos/seed/thumb/600/600" alt="Image de remplacement"/>
                    <div
                        class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                        data-img-url="https://picsum.photos/seed/large/600/600"></div>
                </a>
            </div>
        </div>


        <!-- Portfolio Popup Start -->
        <div class="details_all_wrap w-full h-auto clear-both float-left">
            <div class="popup_details">
                <div class="main_details w-full h-auto clear-both flex mb-[90px]">
                    <div class="textbox w-[70%] pr-[40px]">
                        <p class="mb-[20px]">We live in a world where we need to move
                            quickly and iterate on our ideas as flexibly as possible.
                            Building mockups strikes the ideal balance between true-life
                            representation of the end product and ease of modification.</p>
                        <p>Mockups are useful both for the creative phase of the project -
                            for instance when you're trying to figure out your user flows or
                            the proper visual hierarchy - and the production phase when they
                            will represent the target product. Making mockups a part of your
                            creative and development process allows you to quickly and
                            easily ideate.</p>
                    </div>
                    <div class="detailbox w-[30%] pl-[40px]">
                        <ul class="list-none">
                            <li class="mb-[8px] w-full float-left">
                                <span class="first font-bold block text-black mb-[3px]">Client</span>
                                <span>Alvaro Morata</span>
                            </li>
                            <li class="mb-[8px] w-full float-left">
                                <span class="first font-bold block text-black mb-[3px]">Category</span>
                                <span><a
                                        class="text-[#767676] transition-all duration-300 hover:text-black"
                                        href="#">Detail</a></span>
                            </li>
                            <li class="mb-[8px] w-full float-left">
                                <span
                                    class="first font-bold block text-black mb-[3px]">Date</span>
                                <span>October 22, 2022</span>
                            </li>
                            <li class="w-full float-left">
                                <span class="first font-bold block text-black mb-[3px]">Share</span>
                                <ul class="share list-none relative top-[7px]">
                                    <li class="mr-[10px] inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-facebook-squared"></i></a></li>
                                    <li class="mr-[10px] inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-twitter-squared"></i></a></li>
                                    <li class="mr-[10px] inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-behance-squared"></i></a></li>
                                    <li class="inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-linkedin-squared"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="additional_images w-full h-auto clear-both float-left">
                    <ul class="ml-[-30px] list-none">
                        <li class="mb-[30px] float-left w-1/2 pl-[30px]">
                            <div
                                class="list_inner w-full h-auto clear-both float-left relative">
                                <div class="my_image relative">
                                    <img class="opacity-0 min-w-full"
                                         src="{{ asset('img/thumbs/4-2.jpg') }}" alt=""/>
                                    <div
                                        class="main absolute inset-0 bg-no-repeat bg-center bg-cover"
                                        data-img-url="{{ asset('img/portfolio/1.jpg') }}"></div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-[30px] float-left w-1/2 pl-[30px]">
                            <div
                                class="list_inner w-full h-auto clear-both float-left relative">
                                <div class="my_image relative">
                                    <img class="opacity-0 min-w-full"
                                         src="{{ asset('img/thumbs/4-2.jpg') }}" alt=""/>
                                    <div
                                        class="main absolute inset-0 bg-no-repeat bg-center bg-cover"
                                        data-img-url="{{ asset('img/portfolio/2.jpg') }}"></div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-[30px] float-left w-1/2 pl-[30px]">
                            <div
                                class="list_inner w-full h-auto clear-both float-left relative">
                                <div class="my_image relative">
                                    <img class="opacity-0 min-w-full"
                                         src="{{ asset('img/thumbs/4-2.jpg') }}" alt=""/>
                                    <div
                                        class="main absolute inset-0 bg-no-repeat bg-center bg-cover"
                                        data-img-url="{{ asset('img/portfolio/3.jpg') }}"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Portfolio Popup End -->
    </li>
    <li class="detail mb-[40px] float-left w-1/3 pl-[40px]">
        <div class="inner w-full h-auto clear-both float-left overflow-hidden relative">
            <div class="entry tokyo_tm_portfolio_animation_wrap" data-title="Ave Simone"
                 data-category="Detail">
                <a class="popup_info" href="#">
                    <img class="opacity-0 min-w-full"
                         src="{{ asset('img/thumbs/1-1.jpg') }}" alt=""/>
                    <div
                        class="abs_image absolute inset-0 bg-no-repeat bg-cover bg-center transition-all duration-300"
                        data-img-url="{{ asset('img/portfolio/8.jpg') }}"></div>
                </a>
            </div>
        </div>

        <!-- Portfolio Popup Start -->
        <div class="details_all_wrap w-full h-auto clear-both float-left">
            <div class="popup_details">
                <div class="main_details w-full h-auto clear-both flex mb-[90px]">
                    <div class="textbox w-[70%] pr-[40px]">
                        <p class="mb-[20px]">We live in a world where we need to move
                            quickly and iterate on our ideas as flexibly as possible.
                            Building mockups strikes the ideal balance between true-life
                            representation of the end product and ease of modification.</p>
                        <p>Mockups are useful both for the creative phase of the project -
                            for instance when you're trying to figure out your user flows or
                            the proper visual hierarchy - and the production phase when they
                            will represent the target product. Making mockups a part of your
                            creative and development process allows you to quickly and
                            easily ideate.</p>
                    </div>
                    <div class="detailbox w-[30%] pl-[40px]">
                        <ul class="list-none">
                            <li class="mb-[8px] w-full float-left">
                                <span class="first font-bold block text-black mb-[3px]">Client</span>
                                <span>Alvaro Morata</span>
                            </li>
                            <li class="mb-[8px] w-full float-left">
                                <span class="first font-bold block text-black mb-[3px]">Category</span>
                                <span><a
                                        class="text-[#767676] transition-all duration-300 hover:text-black"
                                        href="#">Detail</a></span>
                            </li>
                            <li class="mb-[8px] w-full float-left">
                                <span
                                    class="first font-bold block text-black mb-[3px]">Date</span>
                                <span>October 22, 2022</span>
                            </li>
                            <li class="w-full float-left">
                                <span class="first font-bold block text-black mb-[3px]">Share</span>
                                <ul class="share list-none relative top-[7px]">
                                    <li class="mr-[10px] inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-facebook-squared"></i></a></li>
                                    <li class="mr-[10px] inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-twitter-squared"></i></a></li>
                                    <li class="mr-[10px] inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-behance-squared"></i></a></li>
                                    <li class="inline-block"><a
                                            class="text-black text-[18px]" href="#"><i
                                                class="icon-linkedin-squared"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="additional_images w-full h-auto clear-both float-left">
                    <ul class="ml-[-30px] list-none">
                        <li class="mb-[30px] float-left w-1/2 pl-[30px]">
                            <div
                                class="list_inner w-full h-auto clear-both float-left relative">
                                <div class="my_image relative">
                                    <img class="opacity-0 min-w-full"
                                         src="{{ asset('img/thumbs/4-2.jpg') }}" alt=""/>
                                    <div
                                        class="main absolute inset-0 bg-no-repeat bg-center bg-cover"
                                        data-img-url="{{ asset('img/portfolio/1.jpg') }}"></div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-[30px] float-left w-1/2 pl-[30px]">
                            <div
                                class="list_inner w-full h-auto clear-both float-left relative">
                                <div class="my_image relative">
                                    <img class="opacity-0 min-w-full"
                                         src="{{ asset('img/thumbs/4-2.jpg') }}" alt=""/>
                                    <div
                                        class="main absolute inset-0 bg-no-repeat bg-center bg-cover"
                                        data-img-url="{{ asset('img/portfolio/2.jpg') }}"></div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-[30px] float-left w-1/2 pl-[30px]">
                            <div
                                class="list_inner w-full h-auto clear-both float-left relative">
                                <div class="my_image relative">
                                    <img class="opacity-0 min-w-full"
                                         src="{{ asset('img/thumbs/4-2.jpg') }}" alt=""/>
                                    <div
                                        class="main absolute inset-0 bg-no-repeat bg-center bg-cover"
                                        data-img-url="{{ asset('img/portfolio/3.jpg') }}"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Portfolio Popup End -->

    </li>
</ul>--}}
