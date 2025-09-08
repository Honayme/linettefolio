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

// La version améliorée avec la délégation d'événements
function tokyo_tm_trigger_menu_delegated(){
    "use strict";

    // On attache l'écouteur au 'document'
    // Il ne se déclenchera QUE si l'élément cliqué correspond au sélecteur
    // '.tokyo_tm_topbar .trigger .hamburger'
    jQuery(document).on('click', '.tokyo_tm_topbar .trigger .hamburger', function(){
        console.log('Hamburger clicked via delegation');
        var element 	    = jQuery(this);
        var mobileMenu		= jQuery('.tokyo_tm_mobile_menu');

        // Ton code existant reste le même
        if(element.hasClass('is-active')){
            element.removeClass('is-active');
            mobileMenu.removeClass('opened');
        }else{
            element.addClass('is-active');
            mobileMenu.addClass('opened');
        }
        return false;
    });

    // On fait de même pour les liens du menu
    jQuery(document).on('click', '.tokyo_tm_mobile_menu ul li a', function(){
        console.log('Menu link clicked via delegation');
        jQuery('.tokyo_tm_topbar .trigger .hamburger').removeClass('is-active');
        jQuery('.tokyo_tm_mobile_menu').removeClass('opened');
        return false;
    });
}

// Appelle cette fonction une seule fois au chargement initial de ton JS.
tokyo_tm_trigger_menu_delegated();
