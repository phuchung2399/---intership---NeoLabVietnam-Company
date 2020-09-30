<template>
  <div id="user_board">
    <h1>Users board</h1>
    <div class>
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>
                  Manage
                  <b>Users</b>
                </h2>
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="userItem in users" :key="userItem.id">
                <td>{{userItem.name}}</td>
                <td>{{userItem.email}}</td>
                <td>{{userItem.active}}</td>
                <td>{{userItem.role.role_name}}</td>
                <td>
                  <!-- <router-link
                    :to="{name: 'editCategory'}"
                    class="edit"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Edit"
                  >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </router-link>

                  <a
                    class="delete"
                    data-toggle="modal"
                    data-placement="top"
                    data-target="#deleteDeviceModal"
                    title="Remove"
                  >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a> -->
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
                  <b>1</b>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
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
import { mapState, mapActions } from "vuex";

import "../../../assets/css/admin.css";
export default Vue.extend({
  name: "UserBoard",
  computed: {
    ...mapState("user", {
      users: (state) => state.users,
    }),
  },
  methods: {
    ...mapActions("user", ["getUsers"]),
  },
  created() {
    this.$emit("loadingEvent", true);
    this.getUsers().then(() => {
      this.$emit("loadingEvent", false);
    }).finally(()=>{
        this.$emit("loadingEvent", false);
    });
  },
});
</script>