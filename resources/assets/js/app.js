import 'vuetify/dist/vuetify.css';

require('./bootstrap');


import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import axios from 'axios';
import App from './components/App';
import {routes} from './routes';
import data from './store'


window.axios = axios;
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);

const store = new Vuex.Store(data);

const router = new VueRouter({
    mode: 'history',
    routes,
    store
});

router.beforeEach((to, from, next) => {
    // redirect to login page if not logged in and trying to access a restricted page
    const publicPages = ['/login'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem('user');

    if (authRequired && !loggedIn) {
        return next('/login');
    }

    next();
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
