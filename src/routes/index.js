import Vue from 'vue';
import Router from 'vue-router';

import HomeLayout from "../layouts/HomeLayout.vue";
import CategoryShowLayout from "../layouts/CategoryShowLayout.vue";
import AdminLayout from "../layouts/AdminLayout.vue";
import UserLayout from "../layouts/UserLayout.vue";


import Login from "../views/Auth/Login.vue";
import Home from "../views/Home/Home.vue";
import CategoryShow from "../views/Home/CategoryShow.vue";
import DeviceDetail from "../views/Home/DeviceDetail.vue";
import BorrowingRequest from "../views/Home/BorrowingRequest.vue";

import Profile from "../views/User/Profile.vue";
import MyBorrowing from "../views/User/MyBorrowing.vue";

import Dashboard from "../../src/views/Admin/Dashboard.vue";
import DeviceBoard from "../../src/views/Admin/Devices";
import CreateDevice from "../../src/views/Admin/Devices/CreateDevice.vue";
import EditDevice from "../../src/views/Admin/Devices/EditDevice.vue";

import CategoryBoard from "../../src/views/Admin/Categories";
import CreateCategory from "../../src/views/Admin/Categories/CreateCategory.vue";
import EditCategory from "../../src/views/Admin/Categories/EditCategory.vue";

import UserBoard from "../../src/views/Admin/Users";
import BorrowBoard from "../../src/views/Admin/Borrows";
// import Test from "../views/Home/Test.vue";

import store from '../vuex/store';
Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        // {
        //     path: '*',
        //     // component: Test

        // },
        {
            path: '/signin',
            name: 'Signin',
            component: Login,
            meta: {
                requiresVisitor: true
            }
        },
        {
            path: '/',
            component: HomeLayout,
            meta: {
                requiresAuth: true
            },
            children: [
                {
                    path: '',
                    name: 'Home',
                    component: Home
                },
                {
                    path: 'category-show',
                    component: CategoryShowLayout,
                    children: [
                        {
                            path: ':id',
                            props: true,
                            name: 'categoryShow',
                            component: CategoryShow,
                        },
                        {
                            path: '',
                            component: CategoryShow,
                        }
                    ]
                },
                {
                    path: 'devices/:id',
                    name: 'deviceDetail',
                    component: DeviceDetail,
                    props: true,
                },
                {
                    path: 'borrowing/request',
                    name: 'borrowingRequest',
                    component: BorrowingRequest
                },
                {
                    path: 'user',
                    component: UserLayout,
                    children: [
                        {
                            path: 'profile',
                            component: Profile
                        },
                        {
                            path: 'my-borrowing',
                            component: MyBorrowing,
                            name: 'myBorrowing'
                        }
                    ]
                }
            ]
        },
        {
            path: '/admin',
            component: AdminLayout,
            children: [
                {
                    path: '',
                    component: Dashboard
                },
                {
                    path: 'devices',
                    component: DeviceBoard
                },
                {
                    path: 'devices/create',
                    component: CreateDevice
                },
                {
                    path: 'devices/:id/edit',
                    props: true,
                    name: 'editDevice',
                    component: EditDevice
                },
                {
                    path: 'categories',
                    component: CategoryBoard
                },
                {
                    path: 'categories/create',
                    component: CreateCategory
                },
                {
                    path: 'categories/:id/edit',
                    props: true,
                    name: 'editCategory',
                    component: EditCategory
                },
                {
                    path: 'users',
                    component: UserBoard
                },
                {
                    path: 'borrows',
                    component: BorrowBoard
                }
            ]
        },
        {
            path: '/auth?access_token',
        }
    ]
});

router.beforeEach((to, from, next) => {

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters['auth/loggedIn']) {
            console.log('-lg route: ', store.getters['auth/loggedIn']);
            next({ name: 'Signin' });

        } else {
            next();
        }

    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters['auth/loggedIn']) {
            next({ name: 'Home' })
        } else
            next();
    }
    else {
        next();
    }

});

export default router;