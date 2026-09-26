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
                'resources/css/pages/peta-sekolah.css',
                'resources/css/pages/prestasi.css',
                'resources/css/pages/spmb.css',
                'resources/css/pages/jurusan.css',
                'resources/css/pages/blud.css',
                'resources/js/app.js',
                'resources/js/pages/fasilitas.js',
                'resources/js/pages/ekstrakurikuler.js',
                'resources/js/pages/prestasi.js',
                'resources/js/pages/berita.js',
                'resources/js/pages/index.js',
                'resources/js/pages/blud.js',
                'resources/css/admin.css',
                'resources/js/admin.js',
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
