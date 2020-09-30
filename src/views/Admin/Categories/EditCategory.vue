<template>
  <div id="edit_category">
    <h1>Update Category</h1>
    <form id="edit_category_form" v-on:submit="submitForm" method="POST">
      <div class="form-group">
        <label for="exampleFormControlInput1">Device name *</label>
        <input
          v-model="category.category_name"
          type="text"
          class="form-control"
          placeholder="Category abc"
        />
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea v-model="category.description" class="form-control" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import Vue from "vue";
import { mapState, mapActions } from "vuex";

export default Vue.extend({
  name: "EditCategory",
  props: {
    id: null,
  },
  computed: {
    ...mapState("category", {
      category: (state) => state.category,
    }),
  },
  methods: {
    ...mapActions("category", ["getOneCategory", "updateCategory"]),

    submitForm: function (e) {
      e.preventDefault();

      let formData = {};

      formData["category_name"] = this.category.category_name;

      formData["description"] = this.category.description;

      this.$emit("loadingEvent", true);
      this.updateCategory({
        id: this.id,
        data: formData,
      })
        .then(() => {
          this.$emit("loadingEvent", false);
          this.$router.replace({ path: "/admin/categories" });
        })
        .catch((error) => {
          this.$emit("loadingEvent", false);
          alert(error);
        });
    },
  },
  created() {
    this.$emit("loadingEvent", true);
    this.getOneCategory(this.id).then(() => {
      this.$emit("loadingEvent", false);
    });
  },
});
</script>

<style scoped>
.form-group > .error {
  display: block;
  color: #f57f6c;
  font-size: 0.75rem;
  line-height: 1;
  margin-left: 14px;
  margin-bottom: 0.9375rem;
}
</style>