import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
// import eslintPlugin from "vite-plugin-eslint";

export default defineConfig({
  plugins: [
    // eslintPlugin(),
    laravel({
      input: ['resources/js/app.js'],
      refresh: true
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false
        }
      }
    })
  ],
  server: {
    // host: "0.0.0.0",
    // hmr: { protocol: "ws", host: "localhost", clientPort: 5175 },
    hmr: { host: 'localhost' }
  }
})
