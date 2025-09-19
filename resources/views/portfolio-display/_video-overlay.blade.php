<!-- Overlay vidéo simple -->
<div x-data="{
    isOpen: false,
    videoUrl: null,
    open(url) {
        this.videoUrl = url;
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
    },
    close() {
        this.isOpen = false;
        this.videoUrl = null;
        document.body.style.overflow = 'auto';
        // Pause et reset la vidéo
        if (this.$refs.videoPlayer) {
            this.$refs.videoPlayer.pause();
            this.$refs.videoPlayer.currentTime = 0;
        }
    }
}"
@open-video-overlay.window="open($event.detail.url)"
x-show="isOpen"
x-cloak
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0"
@keydown.window.escape="close"
class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm">

    <!-- Fermer en cliquant à côté -->
    <div @click="close" class="absolute inset-0"></div>

    <!-- Contenu vidéo -->
    <div class="relative w-full max-w-6xl max-h-[90vh]" @click.stop>

        <!-- Bouton fermer -->
        <button @click="close"
                class="absolute top-4 right-4 text-white bg-black/50 rounded-full p-2 hover:bg-black/80 z-20 transition-colors">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Lecteur vidéo -->
        <div class="w-full h-full flex items-center justify-center">
            <video x-ref="videoPlayer"
                   x-show="videoUrl"
                   :src="videoUrl"
                   controls
                   autoplay
                   preload="metadata"
                   class="w-full h-full max-h-[85vh] object-contain rounded-lg shadow-2xl"
                   crossorigin="anonymous"
                   playsinline>
                Votre navigateur ne supporte pas la lecture de vidéos.
            </video>
        </div>
    </div>
</div>