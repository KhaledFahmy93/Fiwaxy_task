import '@babel/polyfill';
import Vue from 'vue';
import './plugins/vuetify';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import App from './App.vue';
import router from './router';
import store from './store';
import Axios from 'axios';

Vue.use(VueSweetalert2);
Vue.config.productionTip = false;
const app = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');
if (window.Cypress) {
    window.app = app;
}
if(store.getters.isAuthenticated){
    Axios.defaults.headers.common['Authorization'] = "Bearer "+ store.getters.getAuthenticatedUser.token;
    Axios.defaults.headers.get['Accepts'] = 'application/json';
}

