import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: '#1E1F22',
                bronze: '#CD7F32',
                silver: '#C0C0C0',
                gold: '#EDA711',
                emerald: '#50C878',
                blood: '#880808',
                ocean: '#010A2B',
                taupe: '#A68F53',
            },
        },
        screens: {
            'xs': '0px',
            'sm': '576px',
            'md': '768px',
            'lg': '992px',
            'xl': '1200px',
            '2xl': '1400px',
            '3xl': '1920px',
        },
    },

    plugins: [forms],
};
