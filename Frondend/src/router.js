import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';
import orderdetails from './views/Orderdetails.vue';
import store from '@/store.js';

Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: () => import('./views/About.vue'),
            meta: {
                authRequired: true
            }
        },
        {
            path: '/sign-in',
            name: 'signin',
            component: () => import('./views/Signin.vue'),
        },
        {
            path: '/join',
            name: 'join',
            component: () => import('./views/Join.vue')
        },
        {
            path: '/createorder',
            name: 'createorder',
            component: () => import('./views/Createorder.vue'),
            meta: {
                authRequired: true
            }
        },
        {
            path: '/orders',
            name: 'orders',
            component: () => import('./views/Orders.vue'),
            meta: {
                authRequired: true
            }
        },
        {
            path: '/services',
            name: 'services',
            component: () => import('./views/Services.vue'),
            meta: {
                authRequired: true
            }
        },
        {
            path: '/orderdetails/:id',
            name: 'orderdetails',
            component: orderdetails,
            meta: {
                authRequired: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authRequired)) {
        if (!store.state.isAuthenticated) {
            next({
                path: '/sign-in'
            });
        } else {
            store.commit('setLoginError' , null);
            next();
        }
    } else {
        store.commit('setLoginError' , null);
        next();
    }
});

export default router;
