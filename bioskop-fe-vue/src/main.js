import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2';

createApp(App).use(store).use(router).mount('#app')

Vue.use(VueSweetalert2);

new Vue({
  el: '#app',
  render: h => h(App)
});
