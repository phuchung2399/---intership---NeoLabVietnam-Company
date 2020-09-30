<template>
  <div class="home_layout">
      <TopNav/>
      <router-view></router-view>
      <Footer/>
  </div>
</template>

<script lang="ts">
import Vue from "vue";

import TopNav from "../components/TopNav.vue";
import Footer from "../components/Footer.vue";

export default Vue.extend({
    name:'HomeLayout',
    components:{
        TopNav,
        Footer
    }
});
</script>