<template>
  <div id="admin_layout" class="bg-light">
    <TopNavAdmin />

    <div class="d-flex" id="wrapper">
      <SideNavAdmin />

      <!-- main content -->
      <div class="main">
        <Spinner v-bind:loading="loading" />
        <!-- breadcrumb -->
        <div class="row">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">
                <em class="fa fa-home"></em>
              </a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-title">Dashboard</h1>
          </div>
        </div>
        <router-view v-on:loadingEvent="onLoading"></router-view>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import Vue from "vue";
import TopNavAdmin from "../components/TopNavAdmin.vue";
import SideNavAdmin from "../components/SideNavAdmin.vue";
import Footer from "../components/Footer.vue";
import Spinner from "../components/Spinner.vue";

export default Vue.extend({
  name: "AdminLayout",
  components: {
    TopNavAdmin,
    SideNavAdmin,
    Footer,
    Spinner,
  },
  data: function () {
    return {
      loading: false,
    };
  },
  methods: {
    onLoading(value) {
      this.loading = value;
    },
  }
});
</script>

<style scoped>
.main {
  width: 100%;
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

.breadcrumb {
  border-radius: 0;
  padding: 10px 15px 10px 15px;
  background: #e9ecf2;
  margin: 0;
  flex: 1;
}
.breadcrumb > .active {
  color: #777;
}
.breadcrumb > li + li::before {
  padding: 0 5px;
  color: #ccc;
  content: "/\00a0";
}
h1.page-title {
  margin-top: 20px;
  border-bottom: 0;
}
</style>