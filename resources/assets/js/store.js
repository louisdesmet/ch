import { getUser } from './auth'

const user = getUser();

export default {
    state: {
        currentUser: user,
        loggedIn: !!user,
        loading: false,
        auth_error: null,
        products: [],
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
        }

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
        }
    },
    actions: {
        login(context) {
            context.commit('login');
        },
        products(context) {
            axios.get('/api/products').then((response) => {
                console.log(response);
                context.commit('products', response.data);
            });
        }
    }
};