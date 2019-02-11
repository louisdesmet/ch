export default {
    state: {
        welcomeMessage: 'welcome to the store'
    },
    mutations: {},
    getters: {
        welcome(state) {
            return state.welcomeMessage;
        }
    },
    actions: {}
};