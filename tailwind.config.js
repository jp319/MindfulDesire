import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'logo-orange': '#FBB03B',
                'logo-blue': '#233DFF',
            }
        },
    },

    safelist: [
        {
            pattern: /bg-(red|blue|green|yellow|purple)-(500|600)/,
        },
    ],

    plugins: [forms, typography, require('@tailwindcss/aspect-ratio')],
};
