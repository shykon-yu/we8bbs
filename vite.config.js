import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // 👇 关键修复：Sail Docker 环境必须加这个
            hotFile: 'public/hot',
            valetTls: false,
        }),
    ],
    // 👇 Docker 环境强制配置
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    },
});
