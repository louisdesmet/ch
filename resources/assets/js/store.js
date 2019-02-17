import { getUser } from './auth'

const user = getUser();

export default {
    state: {
        currentUser: user,
        loggedIn: !!user,
        loading: false,
        auth_error: null,
        products: [],
        users: [],
        vendors: [],
        categories: [],
        orders: [],
        userOrders: []
    },
    getters: {
        loading(state) {
            return state.loading;
        },
        loggedIn(state) {
            return state.loggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        products(state) {
            return state.products;
        },
        users(state) {
            return state.users;
        },
        vendors(state) {
            return state.vendors;
        },
        categories(state) {
            return state.categories;
        },
        orders(state) {
            return state.orders;
        },
        userOrders(state) {
            //console.log(state.userOrders);
            return state.userOrders;
        },
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.loggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.auth.access_token});
            localStorage.setItem('user', JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem('user');
            state.loggedIn = false;
            state.currentUser = null;
        },
        products(state, payload) {
            state.products = payload;
        },
        users(state, payload) {
            state.users = payload;
        },
        vendors(state, payload) {
            state.vendors = payload;
        },
        categories(state, payload) {
            state.categories = payload;
        },
        orders(state, payload) {
            state.orders = payload;
        },
        userOrders(state, payload) {
            state.userOrders = payload;
            console.log(state.userOrders);
        }

    },
    actions: {
        login(context) {
            context.commit('login');
        },
        products({commit, state}) {
            axios.get('/products', {
                headers: {
                    Authorization: 'Bearer ' + state.currentUser.token
                }
            }).then(response=>{
                commit('products', response.data.data);
            });
            /*await axios.get('/api/products').then((response) => {
                context.commit('products', response.data);
            });*/
        },
        users({commit, state}) {
            axios.get('/users/' + state.currentUser.id, {
                headers: {
                    Authorization: 'Bearer ' + state.currentUser.token
                }
            }).then(response=>{
                commit('users', response.data.data.users);
                console.log(response.data.data.orders);
                commit('userOrders', response.data.data.orders);
            });
            // await axios.get('/api/users/' + state.currentUser.id).then((response) => {
            //     commit('users', response.data.data.users);
            // });
        },
        vendors({commit, state}) {
            axios.get('/vendors', {
                headers: {
                    Authorization: 'Bearer ' + state.currentUser.token
                }
            }).then(response=>{
                commit('vendors', response.data.data);
            });
            // await axios.get('/api/vendors').then((response) => {
            //     context.commit('vendors', response.data);
            // });
        },
        categories({commit, state}) {
            axios.get('/categories', {
                headers: {
                    Authorization: 'Bearer ' + state.currentUser.token
                }
            }).then(response=>{
                commit('categories', response.data.data);
            });
            // await axios.get('/api/categories').then((response) => {
            //     context.commit('categories', response.data);
            // });
        },
        orders({commit, state}) {
            axios.get('/orders', {
                headers: {
                    Authorization: 'Bearer ' + state.currentUser.token
                }
            }).then(response=>{
                commit('orders', response.data.data);
            });
            // await axios.get('/api/orders').then((response) => {
            //     context.commit('orders', response.data);
            // });
        }
    }
};