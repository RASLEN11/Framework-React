import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/admin/apply/job.css',
            'resources/css/admin/apply/internship.css',
            'resources/js/app.js', // keep your existing JS entry point
        ]),
    ],
});