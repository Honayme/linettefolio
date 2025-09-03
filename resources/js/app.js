// resources/js/app.js

import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;

// Attend que le DOM soit entièrement chargé avant d'exécuter le code.
$(function() {
    console.log("DOM is ready. Loading plugins first...");

    // 1. On charge d'abord plugins.js
    import('./template/plugins.js')
        .then(() => {
            // 2. On utilise setTimeout pour pousser l'exécution de init.js
            //    à la fin de la file d'attente du navigateur.
            //    Cela garantit que TOUS les plugins ont eu le temps de s'initialiser.
            setTimeout(() => {
                console.log("Plugins should be fully initialized. Now loading init script.");
                import('./template/init.js');
            }, 0); // Le délai de 0ms est crucial ici
        })
        .catch(error => {
            console.error("Error loading template scripts:", error);
        });
});
