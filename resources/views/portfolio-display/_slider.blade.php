<div x-data="{ activeIndex: 0 }" class="relative w-full flex items-center justify-center">
    <!-- Conteneur des images -->
    <div class="w-full h-[75vh] flex items-center justify-center">
        <template x-for="(image, index) in currentItem.mediaSrcs" :key="index">
            <div x-show="activeIndex === index" x-transition class="w-full h-full flex items-center justify-center">
                <img :src="image.src" :alt="image.alt" class="max-w-full max-h-full object-contain">
            </div>
        </template>
    </div>

    <!-- Navigation interne au slider -->
    <button @click="activeIndex = (activeIndex === 0) ? currentItem.mediaSrcs.length - 1 : activeIndex - 1"
            class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white rounded-full p-2 hover:bg-black/70">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </button>
    <button @click="activeIndex = (activeIndex === currentItem.mediaSrcs.length - 1) ? 0 : activeIndex + 1"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white rounded-full p-2 hover:bg-black/70">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    </button>
</div>
