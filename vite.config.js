import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // Vite builds the shared styles, application JavaScript, and mobile navigation.
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/site-nav.js',
            ],
            refresh: true,
        }),
    ],
});
