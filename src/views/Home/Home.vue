<template>
  <div id="home" class="container">
    <Spinner v-bind:loading="loading"/>
    <h1>Welcome to DBS Neo-Lab Viet Nam</h1>
    <div class="row">
      <CardCategory
        v-for="category in categories"
        v-bind:key="category.id"
        v-bind:category_id="category.id"
        v-bind:imgUrl="category.image"
        v-bind:title="category.category_name"
      />
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import CardCategory from "../../components/CardCategory.vue";
import Spinner from "../../components/Spinner.vue";

export default Vue.extend({
  name: "Home",
  components: {
    CardCategory,
    Spinner,
  },
  data: function () {
    return {
      categories: [],
      loading: false,
    };
  },
  methods: {
    fetchCategories() {
      this.loading = true;

      this.$store
        .dispatch("category/getCategories")
        .then(() => {
          this.categories = this.$store.getters["category/categories"];
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
  created() {
    // console.log("token: ", this.$route.query.access_token);
    this.fetchCategories();
  },
});
</script>

<style scoped>
</style>