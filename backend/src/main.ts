import { createApp } from 'vue';
import { Quasar } from 'quasar';

// Import icon libraries
import '@quasar/extras/roboto-font/roboto-font.css';
import '@quasar/extras/material-icons/material-icons.css';

// A few examples for animations from Animate.css:
// import @quasar/extras/animate/fadeIn.css
// import @quasar/extras/animate/fadeOut.css

// Import Quasar css
import 'quasar/src/css/index.sass';

import 'uno.css';
import 'virtual:unocss-devtools';

import './assets/styles/style.css';

import App from './App.vue';
import { router } from './router';
import { pinia } from './store';

const app = createApp(App);

app.use(Quasar, {
  plugins: {}, // import Quasar plugins and add here
  /*~
  config: {
    brand: {
      // primary: '#e46262',
      // ... or all other brand colors
    },
    notify: {...}, // default set of options for Notify Quasar plugin
    loading: {...}, // default set of options for Loading Quasar plugin
    loadingBar: { ... }, // settings for LoadingBar Quasar plugin
    // ..and many more (check Installation card on each Quasar component/directive/plugin)
  }
  */
});

app.use(pinia);
app.use(router);
app.mount('#app');
