import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/auth/app.css',
                'resources/css/front/app.css',
                'resources/css/admin/app.css',

                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
