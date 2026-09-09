import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/pages/index.css',
                'resources/css/pages/visi-misi.css',
                'resources/css/pages/berita.css',
                'resources/css/pages/bkk.css',
                'resources/css/pages/ekstrakurikuler.css',
                'resources/css/pages/fasilitas.css',
                'resources/css/pages/guru.css',
                'resources/css/pages/lsp.css',
                'resources/css/pages/peta-kampus.css',
                'resources/css/pages/prestasi.css',
                'resources/css/pages/spmb.css',
                'resources/js/app.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
