import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';
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
            path: '/menu',
            name: 'menu',
            component: () => import('./views/Menu.vue')
        },
        {
            path: '/sign-in',
            name: 'signin',
            component: () => import('./views/Signin.vue')
        },
        {
            path: '/join',
            name: 'join',
            component: () => import('./views/Join.vue')
        },
        {
            path: '/createorder',
            name: 'createorder',
            component: () => import('./views/Createorder.vue')
        },
        {
            path: '/orders',
            name: 'orders',
            component: () => import('./views/Orders.vue')
        },
        {
            path: '/orderdetails/:id',
            name: 'orderdetails',
            component: () => import('./views/Orderdetails.vue')
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authRequired)) {
        if (!store.state.isAuthenticated) {
            console.log("wwww");
            next({
                path: '/sign-in'
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
