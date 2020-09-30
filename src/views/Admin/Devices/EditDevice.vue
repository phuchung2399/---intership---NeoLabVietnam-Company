<template>
  <div id="create_device">
    <h1>Update Device</h1>
    <form id="create_device_form" v-on:submit="submitForm" method="POST">
      <div class="form-group">
        <label for="exampleFormControlInput1">Device name *</label>
        <!-- <input v-model="device_name" type="text" class="form-control" placeholder="Device abc" /> -->
        <input
          v-model="device.device_name"
          type="text"
          class="form-control"
          placeholder="Device abc"
        />
      </div>
      <div v-if="false" class="error">Device Name required</div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Label name *</label>
        <input v-model="device.label_name" type="text" class="form-control" placeholder="DV001" />
      </div>

      <div class="form-group">
        <label for="exampleFormControlSelect1">Category select *</label>
        <!-- <select v-model="category_id" class="form-control"> -->
        <select v-model="device.category.id" class="form-control">
          <option
            v-for="category in categories"
            v-bind:key="category.id"
            v-bind:value="category.id"
          >{{category.category_name}}</option>
        </select>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Firmware version</label>
        <input v-model="device.firmware_version" type="text" class="form-control" placeholder />
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Seri/Imei</label>
        <input v-model="device.sn_imei" type="text" class="form-control" placeholder />
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Device Status Usable *</label>
        <input
          v-model="device.device_status"
          type="text"
          class="form-control"
          placeholder="Good, Bad, Like new, 99%, etc..."
        />
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea v-model="device.description" class="form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Note</label>
        <textarea v-model="device.note" class="form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Available*</label>
        <select v-model="device.available" class="form-control">
          <option value="1">Available</option>
          <option value="2">Unavailable</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div v-if="false" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Device updated.</strong> You may check on devices list.
      <button
        type="button"
        class="close"
        data-dismiss="alert"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { mapState } from "vuex";
import categoryMixin from "../../../mixins/categoryMixin";

export default Vue.extend({
  name: "UpdateDevice",
  mixins: [categoryMixin],
  props: {
    id: null,
  },
  data: function () {
    return {};
  },
  computed: {
    ...mapState("device", {
      device: (state) => state.device,
    }),
  },
  methods: {
    submitForm: function (e) {
      e.preventDefault();

      let formData = {};

      formData["device_name"] = this.device.device_name;
      formData["label_name"] = this.device.label_name;
      formData["device_status"] = this.device.device_status;
      formData["available"] = this.device.available;
      formData["category_id"] = this.device.category.id;

      formData["description"] = this.device.description;
      formData["firmware_version"] = this.device.firmware_version;
      formData["sn_imei"] = this.device.sn_imei;

      formData["note"] = this.device.note;

      this.$emit("loadingEvent", true);
      this.$store
        .dispatch("device/updateDevice", {
          id: this.id,
          data: formData,
        })
        .then(() => {
          this.$emit("loadingEvent", false);
          this.$router.push({ path: "/admin/devices" });
        })
        .catch((error) => {
          this.$emit("loadingEvent", false);
          alert(error);
        });
    },
  },
  created() {
    this.$store.dispatch("device/getOneDevice", this.id);
    this.fetchCategories();
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