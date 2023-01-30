import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import UnoCSS from 'unocss/vite';
import presetMini from '@unocss/preset-mini';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin';
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue({
      template: { transformAssetUrls },
    }),
    UnoCSS({
      presets: [presetMini()],
    }),
    quasar({
      sassVariables: 'src/assets/styles/quasar-variables.sass',
    }),
  ],
  css: {
    preprocessorOptions: {
      scss: {
        indentedSyntax: true,
      },
    },
  },
  server: {
    host: '0.0.0.0',
    port: Number(process.env.DEV_PORT) || 3000,
  },
});
