import '@babel/polyfill';
import Vue from 'vue';
import './plugins/vuetify';

import App from './App.vue';
import router from './router';
import store from './store';
import axios from 'axios';
import '@/firebase/';

Vue.config.productionTip = false;
axios.defaults.headers.common['Authorization'] = 'Bearer test';

const app = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');
if (window.Cypress) {
    window.app = app;
}
