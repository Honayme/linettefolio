<div class="w-full h-[75vh]">
    <!-- On ajuste à la largeur ET on cache la barre d'outils -->
    <iframe :src="`${currentItem.mediaSrc}#view=Fit&toolbar=0`" width="100%" height="100%" style="border: none;"></iframe>
</div>
{{--<div class="w-full h-[75vh]">--}}
{{--    <object--}}
{{--        :data="`${currentItem.mediaSrc}#view=FitH&toolbar=0`"--}}
{{--        type="application/pdf"--}}
{{--        width="100%"--}}
{{--        height="100%"--}}
{{--    >--}}
{{--        <!-- Ce message s'affiche si le navigateur ne peut pas afficher le PDF -->--}}
{{--        <p>--}}
{{--            Impossible d'afficher le PDF. Vous pouvez le--}}
{{--            <a :href="currentItem.mediaSrc" target="_blank">télécharger ici</a>.--}}
{{--        </p>--}}
{{--    </object>--}}
{{--</div>--}}
