// tailwind.config.js
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: ['opacity-0','-translate-x-6','translate-x-6'],


    theme: {
        extend: {
            colors: {
                'orange': '#f25835',
                // Vous pourriez même en ajouter des variantes !
                // 'primary-light': '#fa7b5e',
                // 'primary-dark': '#c4462a',
            },
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
            keyframes: {
                'page-in': {
                    'from': { opacity: '0', transform: 'translateY(6px)' },
                    'to':   { opacity: '1', transform: 'translateY(0)'  },
                },
            },
            animation: {
                'page-in': 'page-in 300ms ease-out both',
            },
        },
    },

    plugins: [
        forms,
        typography,
    ],
}
