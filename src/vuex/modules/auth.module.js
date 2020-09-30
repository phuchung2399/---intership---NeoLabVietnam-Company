// import Vuex from "vuex";
import AuthService from "../../services/auth.service";

const initialState = {
    accessToken: localStorage.getItem('access-token') || null,
    status: null,
    user: null,
    googleAuthUrl: null,
}

export const auth = {

    namespaced: true,

    state: () => (initialState),

    mutations: {

        REQUEST_AUTH_URL(state, payload) {
            state.googleAuthUrl = payload.url
        },

        AUTH_SUCCESS(state, payload) {
            state.status = true;
            state.accessToken = payload.accessToken;
            state.user = payload.user;
        },

        AUTH_FAILURE(state) {
            state.status = false;
            state.accessToken = null;
            state.user = null;
        },

        LOGOUT_SUCCESS(state) {
            state.state = false;
            state.accessToken = null;
            state.user = null;
        }

    },

    actions: {
        async auth({ commit }, accessToken) {

            await AuthService.authCheck(accessToken).then((response) => {

                localStorage.setItem('access-token', accessToken);

                commit('AUTH_SUCCESS', {
                    user: response.data.data,
                    accessToken: accessToken
                });

            }).catch((error) => {
                console.log('-lg: auth fail: ', error);
                localStorage.removeItem('access-token');
                commit('AUTH_FAILURE');
            });

            /* store access token by cookie*/
            // var cookieExpire = new Date();
            // cookieExpire.setTime(cookieExpire.getTime() + (2 * 24 * 60 * 60 * 1000));
            // document.cookie = "access-token=" + accessToken + ";expires=" + cookieExpire;
        },

        async request({ commit }) {
            await AuthService.authRequest().then((response) => {
                commit('REQUEST_AUTH_URL', {
                    url: response.data.url
                })
            });
        },

        logout({ commit }) {
            try {
                AuthService.logout();
                commit('LOGOUT_SUCCESS');
            } catch (error) {
                console.log('1-lg: auth fail: ', error);
                commit('AUTH_FAILURE');
            }
        }


    },

    getters: {
        loggedIn: state => {
            return state.accessToken ? true : false;
        },
        googleAuthUrl: state => {
            return state.googleAuthUrl;
        },
    }
}