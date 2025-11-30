<div x-data="{ activeIndex: 0 }" class="relative w-full flex items-center justify-center">
    <!-- Conteneur des images -->
    <div class="w-full h-[75vh] flex items-center justify-center">
        <template x-for="(imageSrc, index) in currentItem.mediaSrc" :key="index">
            <div x-show="activeIndex === index"
                 class="w-full h-full flex items-center justify-center">
                <img :src="imageSrc" :alt="currentItem.alt" class="max-w-full max-h-full object-contain">
            </div>
        </template>
    </div>

    <!-- Navigation interne au carrousel -->
    <button @click="activeIndex = (activeIndex === 0) ? currentItem.mediaSrc.length - 1 : activeIndex - 1"
            class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white rounded-full p-2 hover:bg-black/70 transition-colors duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </button>
    <button @click="activeIndex = (activeIndex === currentItem.mediaSrc.length - 1) ? 0 : activeIndex + 1"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white rounded-full p-2 hover:bg-black/70 transition-colors duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    </button>

    <!-- Indicateurs de progression -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
        <template x-for="(imageSrc, index) in currentItem.mediaSrc" :key="index">
            <button @click="activeIndex = index"
                    :class="activeIndex === index ? 'bg-white' : 'bg-white/50'"
                    class="w-2 h-2 rounded-full transition-colors duration-200"></button>
        </template>
    </div>
</div>



{{--si
<div x-data="{
        imageGalleryOpened: false,
        imageGalleryActiveUrl: null,
        imageGalleryImageIndex: null,
        imageGallery: [
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-01.jpeg',
                'alt': 'Photo of Mountains'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-02.jpeg',
                'alt': 'Photo of Mountains 02'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-03.jpeg',
                'alt': 'Photo of Mountains 03'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-04.jpeg',
                'alt': 'Photo of Mountains 04'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-05.jpeg',
                'alt': 'Photo of Mountains 05'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-06.jpeg',
                'alt': 'Photo of Mountains 06'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-07.jpeg',
                'alt': 'Photo of Mountains 07'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-08.jpeg',
                'alt': 'Photo of Mountains 08'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-09.jpeg',
                'alt': 'Photo of Mountains 09'
            },
            {
                'photo': 'https://cdn.devdojo.com/images/june2023/mountains-10.jpeg',
                'alt': 'Photo of Mountains 10'
            }
        ],
        imageGalleryOpen(event) {
            this.imageGalleryImageIndex = event.target.dataset.index;
            this.imageGalleryActiveUrl = event.target.src;
            this.imageGalleryOpened = true;
        },
        imageGalleryClose() {
            this.imageGalleryOpened = false;
            setTimeout(() => this.imageGalleryActiveUrl = null, 300);
        },
        imageGalleryNext(){
            this.imageGalleryImageIndex = (this.imageGalleryImageIndex == this.imageGallery.length) ? 1 : (parseInt(this.imageGalleryImageIndex) + 1);
            this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
        },
        imageGalleryPrev() {
            this.imageGalleryImageIndex = (this.imageGalleryImageIndex == 1) ? this.imageGallery.length : (parseInt(this.imageGalleryImageIndex) - 1);
            this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;

        }
    }"
     @image-gallery-next.window="imageGalleryNext()"
     @image-gallery-prev.window="imageGalleryPrev()"
     @keyup.right.window="imageGalleryNext();"
     @keyup.left.window="imageGalleryPrev();"
     class="w-full h-full select-none">
    <div class="mx-auto max-w-6xl opacity-0 duration-1000 delay-300 select-none ease animate-fade-in-view" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
        <ul x-ref="gallery" id="gallery" class="grid grid-cols-2 gap-5 lg:grid-cols-5">
            <template x-for="(image, index) in imageGallery">
                <li><img x-on:click="imageGalleryOpen" :src="image.photo" :alt="image.alt" :data-index="index+1" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]"></li>
            </template>
        </ul>
    </div>
    <template x-teleport="body">
        <div
            x-show="imageGalleryOpened"
            x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:leave="transition ease-in-in duration-300"
            x-transition:leave-end="opacity-0"
            @click="imageGalleryClose"
            @keydown.window.escape="imageGalleryClose"
            x-trap.inert.noscroll="imageGalleryOpened"
            class="fixed inset-0 z-[99] flex items-center justify-center bg-black/50 select-none cursor-zoom-out" x-cloak>
            <div class="flex relative justify-center items-center w-11/12 xl:w-4/5 h-11/12">
                <div @click="$event.stopPropagation(); $dispatch('image-gallery-prev')" class="flex absolute left-0 justify-center items-center w-14 h-14 text-white rounded-full translate-x-10 cursor-pointer xl:-translate-x-24 2xl:-translate-x-32 bg-white/10 hover:bg-white/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                </div>
                <img
                    x-show="imageGalleryOpened"
                    x-transition:enter="transition ease-in-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-50"
                    x-transition:leave="transition ease-in-in duration-300"
                    x-transition:leave-end="opacity-0 transform scale-50"
                    class="object-contain object-center w-full h-full select-none cursor-zoom-out" :src="imageGalleryActiveUrl" alt="" style="display: none;">
                <div @click="$event.stopPropagation(); $dispatch('image-gallery-next');" class="flex absolute right-0 justify-center items-center w-14 h-14 text-white rounded-full -translate-x-10 cursor-pointer xl:translate-x-24 2xl:translate-x-32 bg-white/10 hover:bg-white/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                </div>
            </div>
        </div>
    </template>
</div>--}}
