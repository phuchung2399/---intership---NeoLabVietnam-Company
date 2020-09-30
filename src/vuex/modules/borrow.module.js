import BorrowService from "../../services/borrow.service";

export const borrow = {
    namespaced: true,

    state: {
        borrows: [],
        borrow: {},
        requestStatus: null,
    },

    mutations: {
        SET_BORROWS_LIST(state, payload) {
            state.borrows = payload
        },
        SET_BORROW(state, payload) {
            state.borrow = payload
        },
        REQUEST_SUCCESS(state) {
            state.requestStatus = true
        },
        REQUEST_FAILURE(state) {
            state.requestStatus = false
        }
    },

    actions: {

        async getBorrows({ commit }) {

            await BorrowService.getAll().then((response) => {
                commit('SET_BORROWS_LIST', response.data.data);
                commit('REQUEST_SUCCESS');
            }).catch((error) => {
                commit('REQUEST_FAILURE');
                throw error;
            });

        },

        async getOneBorrow({ commit }, id) {

            await BorrowService.getById(id).then((response) => {
                commit('SET_BORROW', response.data.data);
                commit('REQUEST_SUCCESS');
            }).catch((error) => {
                commit('REQUEST_FAILURE');
                throw error;
            });

        },

        async createBorrow({ commit }, payload) {

            await BorrowService.create(payload).then(() => {
                commit('REQUEST_SUCCESS');
            }).catch((error) => {
                commit('REQUEST_FAILURE');
                throw error;
            });

        },
    },

    getters: {

    }
}