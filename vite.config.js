import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/styles.css',
                'resources/css/dashboard.css',
                'resources/css/login.css',
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/js/login.js',
                'resources/js/register.js',
            ],
            refresh: true,
        }),
    ],
});

