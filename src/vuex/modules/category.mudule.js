import CategoryService from "../../services/category.service";

export const category = {

    namespaced: true,

    state: () => ({
        categories: [],
        category: {}
    }),

    mutations: {
        SET_CATEGORIES_LIST(state, payload) {
            state.categories = payload
        },
        SET_CATEGORY(state, payload) {
            state.category = payload
        },
        REQUEST_SUCCESS(state) {
            state.requestStatus = true
        },
        REQUEST_FAILURE(state) {
            state.requestStatus = false
        }
    },
    actions: {

        async getCategories({ commit }) {
            await CategoryService.getAll().then((response) => {
                commit('SET_CATEGORIES_LIST', response.data.data)
            }).catch((error) => {
                console.log('-lg: error - ', error);
            });
        },

        async getOneCategory({ commit }, id) {
            await CategoryService.getById(id).then((response) => {
                commit('SET_CATEGORY', response.data.data);
            }).catch(error => {
                console.log('-lg: error - ', error);
            });
        },

        async createCategory({ commit }, payload) {
            await CategoryService.create(payload).then((response) => {
                commit('SET_CATEGORY', response.data.data);
                commit('REQUEST_SUCCESS');
            }).catch((error) => {
                commit('REQUEST_FAILURE');
                throw error;
            });
        },

        async updateCategory({ commit }, payload) {
            await CategoryService.update(payload.id, payload.data).then(() => {
                commit('REQUEST_SUCCESS');
            }).catch((error) => {
                commit('REQUEST_FAILURE');
                throw error;
            });
        },

        async deleteCategory({ commit }, payload) {
            await CategoryService.delete(payload.id).then(() => {
                commit('REQUEST_SUCCESS')
            }).catch((error) => {
                commit('REQUEST_FAILURE');
                throw error;
            });
        },
    },
    getters: {
        categories: (state) => {
            return state.categories;
        },
        categoryDevices: (state) => {
            return state.category.devices;
        },

    }
}