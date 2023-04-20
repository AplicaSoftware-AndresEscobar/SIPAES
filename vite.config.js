import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const vuePlugin = require('@vitejs/plugin-vue')

export default defineConfig({
    plugins: [
        vuePlugin(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
