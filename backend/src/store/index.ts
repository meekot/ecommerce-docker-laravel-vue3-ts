import { createPinia } from 'pinia';
import { markRaw } from 'vue';
import { router } from '../router';
import { Router } from 'vue-router';

declare module 'pinia' {
  interface PiniaCustomProperties {
    $router: Router;
  }
}

const pinia = createPinia();

pinia.use(({ store }) => {
  store.$router = markRaw(router);
});

export { pinia };
