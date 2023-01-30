import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        
    ],
    resolve: {
        alias: {
          '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
          '~css': path.resolve(__dirname, 'resources/css')
        },
    },
    server: {
        host: '0.0.0.0',
        port: Number(process.env.DEV_PORT) || 3000,
    },
});
