// resources/js/app.js

import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;

// Importer Livewire et son instance d'Alpine
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';


// --- Configuration de PDF.js (Méthode 100% ES Module / .mjs) ---

// 1. Importer la librairie principale en tant que module.
// On ne spécifie plus de chemin, `pdfjs-dist` va automatiquement
// nous donner son point d'entrée principal en module (.mjs).
import * as pdfjsLib from 'pdfjs-dist';

// 2. Importer le WORKER module pour la version 2.x
import pdfjsWorker from 'pdfjs-dist/build/pdf.worker.js?url';

// 3. Assigner l'URL du worker générée par Vite.
pdfjsLib.GlobalWorkerOptions.workerSrc = pdfjsWorker;

// 4. Exposer la librairie à 'window' pour Alpine.js.
window.pdfjsLib = pdfjsLib;


// Enregistrer votre composant DIRECTEMENT sur l'objet Alpine
Alpine.data('factCard', (targetNumber) => ({
    isHovered: false,      // Gère l'état de survol de la carte
    currentNumber: 0,      // Le nombre affiché actuellement
    target: targetNumber,  // Le nombre cible à atteindre
    hasAnimated: false,    // Pour s'assurer que l'animation ne se lance qu'une fois

    // Initialise l'animation du compteur
    startAnimation() {
        // Si l'animation a déjà eu lieu, on ne fait rien
        if (this.hasAnimated) return;
        this.hasAnimated = true;

        const duration = 1500; // Durée de l'animation en millisecondes
        let startTime = null;

        const animate = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);

            // Met à jour le nombre affiché en fonction de la progression
            this.currentNumber = Math.floor(progress * this.target);

            // Continue l'animation jusqu'à ce que la progression atteigne 100%
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };

        requestAnimationFrame(animate);
    }
}));

// Composant pour l'overlay PDF - Version simple et directe
Alpine.data('pdfViewerOverlay', () => ({
    isOpen: false,
    pdfUrl: null,
    pdfFileName: null,
    pdfDoc: null,
    pageNum: 1,
    numPages: 0,
    pageRendering: false,
    scale: 1.5,

    open(url) {
        this.pdfUrl = url;
        this.pdfFileName = url.split('/').pop();
        this.isOpen = true;

        // Attendre que l'overlay soit visible
        this.$nextTick(() => {
            this.loadPDF();
        });
    },

    close() {
        this.isOpen = false;
        this.cleanup();
    },

    cleanup() {
        this.pdfDoc = null;
        this.pdfUrl = null;
        this.pdfFileName = null;
        this.pageNum = 1;
        this.numPages = 0;
        this.pageRendering = false;
    },

    loadPDF() {
        if (!this.pdfUrl) return;

        const loadingTask = pdfjsLib.getDocument({
            url: this.pdfUrl,
            cMapUrl: '/node_modules/pdfjs-dist/cmaps/',
            cMapPacked: true
        });

        loadingTask.promise.then((pdfDoc) => {
            this.pdfDoc = pdfDoc;
            this.numPages = pdfDoc.numPages;
            this.pageNum = 1;
            this.renderPage(1);

        }).catch((error) => {
            console.error('Error loading PDF:', error);
            alert('Erreur de chargement du PDF: ' + error.message);
            this.close();
        });
    },

    renderPage(pageNumber) {
        if (!this.pdfDoc || this.pageRendering) return;

        this.pageRendering = true;

        // Utiliser Alpine.raw() pour éviter le proxy d'Alpine
        Alpine.raw(this.pdfDoc).getPage(pageNumber).then((page) => {
            const canvas = this.$refs.pdfCanvas;
            if (!canvas) {
                this.pageRendering = false;
                return;
            }

            const context = canvas.getContext('2d');
            const viewport = page.getViewport({ scale: this.scale });

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            return page.render(renderContext).promise;

        }).then(() => {
            this.pageRendering = false;

        }).catch((error) => {
            console.error('Error rendering PDF page:', error);
            this.pageRendering = false;
            alert('Erreur de rendu: ' + error.message);
        });
    },

    prevPage() {
        if (this.pageNum <= 1) return;
        this.pageNum--;
        this.renderPage(this.pageNum);
    },

    nextPage() {
        if (this.pageNum >= this.numPages) return;
        this.pageNum++;
        this.renderPage(this.pageNum);
    }
}));

// Maintenant que tout est configuré, démarrer Livewire (qui démarrera Alpine)
Livewire.start();

// Attend que le DOM soit entièrement chargé avant d'exécuter le code.
/*
$(function() {
    console.log("DOM is ready. Loading plugins first...");

    // 1. On charge d'abord plugins.js
    import('../../public/template/plugins.js')
        .then(() => {
            // 2. On utilise setTimeout pour pousser l'exécution de init.js
            //    à la fin de la file d'attente du navigateur.
            //    Cela garantit que TOUS les plugins ont eu le temps de s'initialiser.
            setTimeout(() => {
                console.log("Plugins should be fully initialized. Now loading init script.");
                import('../../public/template/init.js');
            }, 0); // Le délai de 0ms est crucial ici
        })
        .catch(error => {
            console.error("Error loading template scripts:", error);
        });
});
*/

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
