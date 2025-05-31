import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: 'var(--primary)', // #6C5CE7
                secondary: 'var(--secondary)', // #A29BFE
                accent: 'var(--accent)', // #FD79A8
                electric: 'var(--electric)', // #00CEC9
                dark: 'var(--dark)', // #0A0A0A
                light: 'var(--light)', // #FFFFFF
                surface: 'var(--surface)', // #1A1A1A
                muted: 'var(--muted)', // #74AFFF
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                primary: ['Inter', 'sans-serif'],
                display: ['Space Grotesk', 'sans-serif'],
                mono: ['JetBrains Mono', 'monospace'],
            },
        },
    },
    plugins: [forms],
};

