import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                primary: '#FFC107',
                'primary-dark': '#FFA000',
                secondary: '#2B3440',
            },
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
            },
        },
    },

    plugins: [],
};
