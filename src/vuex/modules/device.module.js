import DeviceService from "../../services/device.service";

export const device = {
    namespaced: true,

    state: {
        devices: [],
        device: {
            category: {}
        },
        requestStatus: null
    },
    mutations: {
        SET_DEVICES_LIST(state, payload) {
            state.devices = payload
        },
        SET_DEVICE(state, payload) {
            state.device = payload
        },

        CREATE_SUCCESS(state) {
            state.requestStatus = true
        },
        CREATE_FAILURE(state) {
            state.requestStatus = false
        },

        UPDATE_SUCCESS(state) {
            state.requestStatus = true
        },
        UPDATE_FAILURE(state) {
            state.requestStatus = false
        },

        REQUEST_SUCCESS(state){
            state.requestStatus = true
        },
        REQUEST_FAILURE(state){
            state.requestStatus = false
        }
    },
    actions: {

        async getDevices({ commit }) {
            try {
                const response = await DeviceService.getAll();
                commit('SET_DEVICES_LIST', response.data.data);
            } catch (error) {
                console.log('-lg: error -', error);
            }
        },

        async getOneDevice({ commit }, id) {
            await DeviceService.getById(id).then((response) => {
                commit('SET_DEVICE', response.data.data);
            }).catch((error) => {
                throw error;
            });
        },

        async getOneRelatedDevice({ commit }, id) {
            await DeviceService.getRelatedById(id).then((response) => {
                commit('SET_DEVICES_LIST', response.data.data);
            }).catch((error) => {
                throw error;
            });
        },

        async createDevice({ commit }, payload) {
            await DeviceService.create(payload).then((response) => {
                commit('SET_DEVICE', response.data.data);
                commit('CREATE_SUCCESS');
            }).catch((error) => {
                commit('CREATE_FAILURE');
                throw error;
            });
        },

         async updateDevice({ commit }, payload) {
            await DeviceService.update(payload.id, payload.data).then(() => {
                commit('UPDATE_SUCCESS');
            }).catch((error) => {
                commit('UPDATE_FAILURE');
                throw error;
            });
        },

         async deleteDevice({ commit }, payload) {
            await DeviceService.delete(payload.id).then(() => {
                commit('REQUEST_SUCCESS')
            }).catch((error) => {
                commit('REQUEST_FAILURE');
                throw error;
            });
        },

    },
    getters: {
        devices: (state) => {
            return state.devices;
        },
        device: (state) => {
            return state.device;
        },
    }
}