import Vue from "vue";
import Vuex from "vuex";
import { auth } from "../modules/auth.module";
import { category } from "../modules/category.mudule";
import { device } from "../modules/device.module";
import { borrow } from "../modules/borrow.module";
import { user } from "../modules/user.module";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
    },
    mutations: {
    },
    actions: {
    },
    modules: {
        auth: auth,
        category: category,
        device: device,
        borrow: borrow,
        user: user
    },
    getters: {
    },
});
