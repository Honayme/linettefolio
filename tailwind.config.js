// tailwind.config.js
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
/** @type {import('tailwindcss').Config} */
export default {
    // 1. On utilise les chemins de Laravel pour que Tailwind scanne les bons fichiers
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        // 2. On place vos customisations dans "extend" pour ne pas écraser les classes par défaut de Tailwind
        extend: {
            screens: {
                'bigger': {'max': '1600px'},
                'large': {'max': '1200px'},
                'middle': {'max': '1040px'},
                'small': {'max': '768px'},
            },
            fontFamily: {
                poppins: ['Poppins', "sans-serif"],
                montserrat: ['Montserrat', "sans-serif"],
                mulish: ['Mulish', "sans-serif"],
            },
        },
    },

    // 3. On ajoute les plugins recommandés pour les formulaires et le contenu texte
    plugins: [
        forms,
        typography,
    ],
}
