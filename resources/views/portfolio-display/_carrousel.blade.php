<div x-data="{ activeIndex: 0 }" class="relative w-full flex items-center justify-center">
    <!-- Conteneur des images -->
    <div class="w-full h-[75vh] flex items-center justify-center">
        <template x-for="(imageSrc, index) in currentItem.mediaSrc" :key="index">
            <div x-show="activeIndex === index" x-transition class="w-full h-full flex items-center justify-center">
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
