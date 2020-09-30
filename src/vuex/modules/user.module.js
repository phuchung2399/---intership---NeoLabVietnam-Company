import UserService from "../../services/user.service";

export const user = {
    namespaced: true,

    state: {
        users: [],
        user: {},
        profile: {},
        myBorrowing: [],
        requestStatus: null
    },
    mutations: {

        SET_LIST_USERS(state, payload) {
            state.users = payload
        },
        SET_PROFILE(state, payload) {
            state.profile = payload
        },
        SET_MY_BORROWING(state, payload) {
            state.myBorrowing = payload
        },

        REQUEST_SUCCESS(state) {
            state.requestStatus = true
        },
        REQUEST_FAILURE(state) {
            state.requestStatus = false
        }

    },
    actions: {

        async getProfile({ commit }) {
            await UserService.getProfile()
                .then((response) => {
                    commit('SET_PROFILE', response.data.data);
                    commit('REQUEST_SUCCESS');
                }).catch((error) => {
                    commit('REQUEST_FAILURE');
                    throw error;
                });
        },

        async getMyBorrowing({ commit }, payload = null) {
            await UserService.getBorrows(payload)
                .then((response) => {
                    commit('SET_MY_BORROWING', response.data.data);
                    commit('REQUEST_SUCCESS');
                }).catch((error) => {
                    commit('REQUEST_FAILURE');
                    throw error;
                });
        },

        async getUsers({ commit }) {
            await UserService.getAll()
                .then(response => {
                    commit('SET_LIST_USERS', response.data.data);
                }).catch(error => {
                    commit('REQUEST_FAILURE');
                    throw error;
                });
        }

    },
    getters: {
        // devices: (state) => {
        //     return state.devices;
        // },
        // device: (state) => {
        //     return state.device;
        // },
    }
}