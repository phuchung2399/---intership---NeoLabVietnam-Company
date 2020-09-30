<template>
  <div id="category_board">
    <h1>Category board</h1>
    <div class>
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>
                  Manage
                  <b>Category</b>
                </h2>
              </div>
              <div class="col-sm-6">
                <router-link to="categories/create" class="btn btn-success" data-toggle="modal">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  <span>Add New Category</span>
                </router-link>
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="selectAll" />
                    <label for="selectAll"></label>
                  </span>
                </th>
                <th>Category name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="category in categories" :key="category.id">
                <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1" />
                    <label for="checkbox1"></label>
                  </span>
                </td>
                <td>{{category.category_name}}</td>
                <td class="description-cell">{{category.description}}</td>
                <td class="category-image-cell">
                  <img v-bind:src="category.image" alt="category_image" srcset />
                </td>
                <td>
                  <router-link
                    :to="{name: 'editCategory', params:{id: category.id}}"
                    class="edit"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Edit"
                  >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </router-link>

                  <a
                    v-on:click="confirmDelete(category)"
                    class="delete"
                    data-toggle="modal"
                    data-placement="top"
                    data-target="#deleteDeviceModal"
                    title="Remove"
                  >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>

          <!--Page Pagination -->
          <div class="clearfix">
            <div class="hint-text">
              Showing
              <b>5</b> out of
              <b>25</b> entries
            </div>
            <ul class="pagination">
              <li class="page-item disabled">
                <a href="#" class="page-link">Previous</a>
              </li>

              <li class="page-item">
                <a href="#" class="page-link">1</a>
              </li>
              <li class="page-item">
                <a href="#" class="page-link">2</a>
              </li>

              <li class="page-item">
                <a href="#" class="page-link">Next</a>
              </li>
            </ul>
          </div>

          <!-- Modal -->
          <div
            class="modal fade"
            id="deleteDeviceModal"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete device</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Do you really want to delete this device
                  <b>{{category.category_name}}</b>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button
                    v-on:click="deleteCategory(category)"
                    type="button"
                    class="btn btn-danger"
                    data-dismiss="modal"
                  >Delete</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { createNamespacedHelpers } from "vuex";

import "../../../assets/css/admin.css";

const { mapState } = createNamespacedHelpers("category");

export default Vue.extend({
  name: "CategoryBoard",
  data() {
    return {
      category: {},
    };
  },
  computed: {
    ...mapState({
      categories: (state) => state.categories,
    }),
  },
  methods: {
    confirmDelete: function (category) {
      this.category = category;
    },

    fetchCategories() {
      this.$emit("loadingEvent", true);

      this.$store
        .dispatch("category/getCategories")
        .then(() => {
          this.$emit("loadingEvent", false);
        })
        .finally(() => {
          this.$emit("loadingEvent", false);
        });
    },

    deleteCategory: function (category) {
      this.$emit("loadingEvent", true);
      this.$store
        .dispatch("category/deleteCategory", category)
        .then(() => {
          this.$emit("loadingEvent", false);
          this.fetchCategories();
        })
        .catch((error) => {
          this.$emit("loadingEvent", false);
          alert(error);
        });
    },
  },
  created() {
    this.fetchCategories();
  },
});
</script>

<style scoped>
.description-cell {
  overflow: hidden;
  max-width: 100px;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.category-image-cell {
  width: 100px;
}
.category-image-cell img {
  width: 100px;
  height: 60px;
}
</style>