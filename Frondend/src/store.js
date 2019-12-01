import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import router from '@/router';
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);
export default new Vuex.Store({
    plugins: [createPersistedState()],
    state: {
        user: null,
        isAuthenticated: false,
        loader:false,
        loginError:false
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        },
        setIsAuthenticated(state, payload) {
            state.isAuthenticated = payload;
        },
        setLoader(state, payload) {
            state.loader = payload;
        },
        setLoginError(state, payload) {
            state.loginError = payload;
        },
    },
    actions: {
        userLogin({ commit }, { email, password}) {
            const requestOptions = {
                client_id:process.env.VUE_APP_CLIENT_ID,
                client_secret:process.env.VUE_APP_SECRET_ID,
                username : email, 
                password: password,
                grant_type: 'password',
                scope: '*', 
            };
            axios.post(`${process.env.VUE_APP_BACKEND_URL}`+`/oauth/token`,requestOptions)
            .then(response => {
                const reuqest = {
                        email : email, 
                        password: password,
                        Accepts : 'application/json',
                        Authorization: "Bearer "+response.access_token,
                    };
                axios.post(`${process.env.VUE_APP_BACKEND_URL}`+`/api/login`,reuqest)
                .then(user => {
                    commit('setUser', user.data.success);
                    commit('setIsAuthenticated', true);
                    router.push('/orders');
                    commit('setLoginError', false);
                }).catch((error) => {
                    commit('setUser', null);
                    commit('setIsAuthenticated', false);
                    commit('setLoginError', true);
                });    
            }).catch((error) => {
                commit('setUser', null);
                commit('setIsAuthenticated', false);
                commit('setLoginError', true);
            });
        },
        userJoin({ commit }, { email, password , user_type}) {
            commit('setLoginError', false);
            const requestOptions = {
                password :password,
                email:email,
                name : email,
                user_type:user_type
            };
            axios.post(`${process.env.VUE_APP_BACKEND_URL}`+`/api/register` , requestOptions)
                .then(user => {
                    commit('setUser', user.data.success);
                    commit('setIsAuthenticated', true);
                    commit('setLoginError', false);
                    router.push('/orders');
                })
                .catch((error) => {
                    commit('setUser', null);
                    commit('setIsAuthenticated', false);
                    if(error.response && error.response.data){
                        commit('setLoginError', error.response.data.error.email[0]);
                    }
                });
        },
        userSignOut({ commit }) {    
            commit('setUser', null);
            commit('setIsAuthenticated', false);
            router.push('/');
        },
    },
    getters: {
        isAuthenticated(state) {
            return state.user !== null && state.user !== undefined;
        },
        isCustomer(state){
            return state.user !== null && state.user.user_type == "customer";
        },
        isRepaiman(state){
            return state.user !== null && state.user.user_type == "repairman";
        },
        getAuthenticatedId(state){
            return state.user.id;
        },
        getAuthenticatedUser(state){
            return state.user
        },
        getLoginError(state){
            return state.loginError;
        }
    }
});
