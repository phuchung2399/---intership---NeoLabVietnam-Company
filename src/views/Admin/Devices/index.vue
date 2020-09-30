<template>
  <div id="device_board">
    <h1>Device board</h1>
    <div class>
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>
                  Manage
                  <b>Devices</b>
                </h2>
              </div>
              <div class="col-sm-6">
                <router-link to="devices/create" class="btn btn-success" data-toggle="modal">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  <span>Add New Device</span>
                </router-link>
                <!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                  <i class="fa fa-minus-circle" aria-hidden="true"></i>
                  <span>Delete</span>
                </a>-->
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
                <th>Device name</th>
                <th>Label</th>
                <th>Device status</th>
                <th>Available</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="device in devices" v-bind:key="device.id">
                <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1" />
                    <label for="checkbox1"></label>
                  </span>
                </td>
                <td>{{device.device_name}}</td>
                <td>{{device.label_name}}</td>
                <td>{{device.device_status}}</td>
                <td v-if="device.available">
                  <span class="indicator label-online" title="Available"></span>
                </td>
                <td v-else>
                  <span class="indicator label-offline" title="Unavailable"></span>
                </td>
                <td>{{device.category.category_name}}</td>
                <td>
                  <a
                    href="#editEmployeeModal"
                    class="view"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="View detail"
                  >
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </a>

                  <router-link
                    v-if="device.available"
                    :to="{name: 'editDevice', params: {id: device.id}}"
                    class="edit"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Edit"
                  >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </router-link>

                  <a
                    v-else
                    class="edit not-allow"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Edit"
                  >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>

                  <a
                    v-on:click="confirmDelete(device)"
                    href="#deleteDeviceModal"
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
                  <b>{{device.device_name}}</b>
                </div>+
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button
                    v-on:click="deleteDevice(device)"
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
import deviceMixin from "../../../mixins/deviceMixin";

export default Vue.extend({
  name: "DeviceBoard",
  data: function () {
    return {
      device: {},
    };
  },
  mixins: [deviceMixin],
  methods: {
    confirmDelete: function (device) {
      this.device = device;
    },

    deleteDevice: function (device) {
      this.$emit("loadingEvent", true);
      this.$store
        .dispatch("device/deleteDevice", device)
        .then(() => {
          this.$emit("loadingEvent", false);
          this.fetchAllDevices();
        })
        .catch((error) => {
          this.$emit("loadingEvent", false);
          alert(error);
        });
    },
  },
  created() {
    this.fetchAllDevices();
  },
  watch: {},
});
</script>

<style scoped>
.not-allow {
  opacity: 0.5;
}
.not-allow:hover {
  cursor: not-allowed;
}
.table-title .btn {
  color: #fff;
  float: right;
  font-size: 13px;
  border: none;
  min-width: 50px;
  border-radius: 2px;
  border: none;
  outline: none !important;
  margin-left: 10px;
}
table.table td a.view {
  color: #07a4ff;
}
table.table td a.edit {
  color: #ffc107;
}
table.table td a.delete {
  color: #f44336;
}
table.table td:last-child i {
  opacity: 0.9;
  font-size: 22px;
  margin: 0 5px;
}
.indicator {
  width: 10px;
  height: 10px;
  display: inline-block;
  border-radius: 9999px;
  margin-right: 5px;
}
.label-online {
  background-color: #1956d9;
}
.label-offline {
  background-color: #d92f19;
}
</style>