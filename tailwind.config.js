import forms from '@tailwindcss/forms'

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [
        require('./vendor/tallstackui/tallstackui/tailwind.config.js')
    ],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",

        './app/Providers/AppServiceProvider.php',

        './vendor/tallstackui/tallstackui/src/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                ...colors,

                'primary': {
                    DEFAULT: colors.indigo[400],
                    '50': colors.indigo[50],
                    '100': colors.indigo[100],
                    '200': colors.indigo[200],
                    '300': colors.indigo[300],
                    '400': colors.indigo[400],
                    '500': colors.indigo[500],
                    '600': colors.indigo[600],
                    '700': colors.indigo[700],
                    '800': colors.indigo[800],
                    '900': colors.indigo[900],
                    '950': colors.indigo[950],
                },
                'secondary': {
                    DEFAULT: colors.sky[400],
                    '50': colors.sky[50],
                    '100': colors.sky[100],
                    '200': colors.sky[200],
                    '300': colors.sky[300],
                    '400': colors.sky[400],
                    '500': colors.sky[500],
                    '600': colors.sky[600],
                    '700': colors.sky[700],
                    '800': colors.sky[800],
                    '900': colors.sky[900],
                    '950': colors.sky[950],
                },
                'dark': {
                    DEFAULT: colors.zinc[700],
                    '50': colors.zinc[50],
                    '100': colors.zinc[100],
                    '200': colors.zinc[200],
                    '300': colors.zinc[300],
                    '400': colors.zinc[400],
                    '500': colors.zinc[500],
                    '600': colors.zinc[600],
                    '700': colors.zinc[700],
                    '800': colors.zinc[800],
                    '900': colors.zinc[900],
                    '950': colors.zinc[950],
                }
            }
        },
    },
    plugins: [
        forms
    ],
}
