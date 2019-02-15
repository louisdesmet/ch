import 'vuetify/dist/vuetify.css';

require('./bootstrap');


import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import axios from 'axios';
import App from './components/App';
import {routes} from './routes';
import data from './store';


window.axios = axios;
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);

const store = new Vuex.Store(data);

const router = new VueRouter({
    mode: 'history',
    routes
});

axios.interceptors.response.use(null, (error) => {
    if(error.response.status == 401) {
        store.commit('logout');
        router.push('/login');
    }
});

router.beforeEach((to, from, next) => {
    const auth = to.matched.some(record => record.meta.auth);
    const currentUser = store.state.currentUser;
    if(auth && !currentUser) {
        next('/login');
    } else if(to.path == '/login' && currentUser) {
        next('/');
    } else {
        next();
    }
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
