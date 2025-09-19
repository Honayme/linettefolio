<!-- Lecteur vidéo unifié - Tous types de vidéos -->
<div x-data="{ playing: false }" x-init="console.log('🎬 Video component - currentItem:', currentItem)">
    <div class="w-full max-w-4xl mx-auto">
        <!-- Lecteur vidéo unifié -->
        <div class="relative w-full max-h-[70vh] overflow-hidden rounded-lg aspect-video bg-black">
            <video controls
                   preload="metadata"
                   class="object-contain relative z-10 w-full h-full bg-black"
                   crossorigin="anonymous"
                   playsinline>
                <source :src="currentItem?.mediaSrc" type="video/mp4" />
                Votre navigateur ne supporte pas la lecture de vidéos.
            </video>

        </div>
    </div>
</div>
