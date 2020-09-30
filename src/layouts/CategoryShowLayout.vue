<template>
  <div id="category_show_layout" class="container wrap-layout">
    <div class="row">
      <div class="col-lg-3">
        <!-- <h1 class="my-4">Categories</h1> -->
        <div class="list-group">
          <router-link
            v-for="category in categories"
            v-bind:key="category.id"
            :to="{name: 'categoryShow', params:{id: category.id}}"
            v-bind:class="{active: active_id == category.id ? true: false }"
            class="list-group-item"
          >{{category.category_name}}</router-link>
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
  name: "CategoryShowLayout",

  data: function () {
    return {
      categories: [],
      active_id: null,
    };
  },
  methods: {
    fetchCategories() {
      this.$store.dispatch("category/getCategories").then(() => {
        this.categories = this.$store.getters["category/categories"];
      });
    },
  },
  created() {
    this.fetchCategories();
    this.active_id = this.$route.params.id;
  },
  watch: {
    $route: function (val) {
      this.active_id = val.params.id;
    },
  },
});
</script>

<style scoped>

</style>