import Vue from 'vue'
import App from './App.vue'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css'

import "./assets/css/styles.css";
import "./assets/font-awesome-4.7.0/css/font-awesome.min.css";
import store from "./vuex/store/index";
import router from "./routes";

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
