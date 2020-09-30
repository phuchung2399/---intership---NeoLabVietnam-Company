<template>
  <div id="category_show_layout" class="container wrap-layout">
    <div class="row">
      <div class="col-lg-3">
        <div class="list-group">
          <router-link to="/user/profile" class="list-group-item">
            <em class="fa fa-user">&nbsp;</em>
            Profile
          </router-link>

          <router-link to="/user/my-borrowing" class="list-group-item">
            <em class="fa fa-exchange">&nbsp;</em>
            My Borrows
          </router-link>
        </div>
      </div>
      <div class="col-lg-9">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";

export default Vue.extend({
  name: "UserLayout",

  data: function () {
    return {
      categories: [],
      active_id: null,
    };
  },
});
</script>

<style scoped>
</style>