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

    // Add a request interceptor
    Axios.interceptors.request.use(function (config) {
    // Do something before request is sent
        store.commit('setLoader' , true);
        return config;
    }, function (error) {
        // Do something with request error
        store.commit('setLoader' , false);
        return Promise.reject(error);
    });

    // Add a response interceptor
    Axios.interceptors.response.use(function (response) {
        // Any status code that lie within the range of 2xx cause this function to trigger
        // Do something with response data
        store.commit('setLoader' , false);    
        return response;
  }, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
        store.commit('setLoader' , false);
        return Promise.reject(error);
  });

