<template>
  <div id="create_category">
    <h1>Create Category</h1>
    <form id="create_category_form" v-on:submit="submitForm" method="POST">
      <div class="form-group">
        <label for="exampleFormControlInput1">Category name *</label>
        <input v-model="category_name" type="text" class="form-control" placeholder="Category abc" />
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea v-model="description" class="form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleFormControlFile1">Image</label>
        <input type="file" ref="file" v-on:change="seleteFile()" class="form-control" />
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
  </div>
</template>

<script>
import Vue from "vue";

export default Vue.extend({
  name: "CreateCategory",
  data: function () {
    return {
      category_name: "",

      description: "",
   
      image: "",
    };
  },

  methods: {
    submitForm: function (e) {
      e.preventDefault();

      let formData = new FormData();

      formData.append("category_name", this.category_name);

      formData.append("description", this.description);

      formData.append("image", this.image);

      this.$emit("loadingEvent", true);
      this.$store
        .dispatch("category/createCategory", formData)
        .then(() => {
          this.$emit("loadingEvent", false);
          this.$router.replace({ path: "/admin/categories" });
        })
        .catch((error) => {
          this.$emit("loadingEvent", false);
          alert(error);
        });
    },

    seleteFile() {
      this.image = this.$refs.file.files[0];
    },
  },
  created() {
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