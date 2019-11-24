import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import router from '@/router';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        apiUrl: 'http://localhost:8000/',
        user: null,
        isAuthenticated: false,
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        },
        setIsAuthenticated(state, payload) {
            state.isAuthenticated = payload;
        },
    },
    actions: {
        userLogin({ commit }, { email, password}) {
            const requestOptions = {
                client_id:2,
                client_secret:"BRCX0XNG0R7GLlni8HmhcfFFKbhbdzilBvZQZ5wG",
                username : email, 
                password: password,
                grant_type: 'password',
                scope: '*', 
            };
            axios.post(`http://localhost:8000/oauth/token`,requestOptions)
            .then(response => {
                const reuqest = {
                        email : email, 
                        password: password,
                        Accept : 'application/json',
                        Authorization: "Bearer "+response.access_token,
                    };
                axios.post(`http://localhost:8000/api/login`,reuqest)
                .then(user => {
                    commit('setUser', user.data.success);
                    commit('setIsAuthenticated', true);
                    router.push('/about');
                }).catch(() => {
                    commit('setUser', null);
                    commit('setIsAuthenticated', false);
                    router.push('/');
                });    
            }).catch(() => {
                commit('setUser', null);
                commit('setIsAuthenticated', false);
                router.push('/');
            });
        },
        userJoin({ commit }, { email, password , user_type}) {
            const requestOptions = {
                password :password,
                email:email,
                name : email,
                user_type:user_type
            };
            axios.post(`http://localhost:8000/api/register` , requestOptions)
                .then(user => {
                    commit('setUser', user);
                    commit('setIsAuthenticated', true);
                    router.push('/about');
                })
                .catch(() => {
                    commit('setUser', null);
                    commit('setIsAuthenticated', false);
                    router.push('/');
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
            return state.user.id
        }
    }
});
