<template>
  <div id="create_device">
    <h1>Create Device</h1>
    <form id="create_device_form" v-on:submit="submitForm" method="POST">
      <div class="form-group">
        <label for="exampleFormControlInput1">Device name *</label>
        <input v-model="device_name" type="text" class="form-control" placeholder="Device abc" />
      </div>
      <div v-if="false" class="error">Device Name required</div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Label name *</label>
        <input v-model="label_name" type="text" class="form-control" placeholder="DV001" />
      </div>

      <div class="form-group">
        <label for="exampleFormControlSelect1">Category select *</label>
        <select v-model="category_id" class="form-control">
          <option
            v-for="category in categories"
            v-bind:key="category.id"
            v-bind:value="category.id"
          >{{category.category_name}}</option>
        </select>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Firmware version</label>
        <input v-model="firmware_version" type="text" class="form-control" placeholder />
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Seri/Imei</label>
        <input v-model="sn_imei" type="text" class="form-control" placeholder />
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Device Status Usable *</label>
        <input
          v-model="device_status"
          type="text"
          class="form-control"
          placeholder="Good, Bad, Like new, 99%, etc..."
        />
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea v-model="description" class="form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Note</label>
        <textarea v-model="note" class="form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleFormControlFile1">Image</label>
        <input type="file" ref="file" v-on:change="seleteFile()" class="form-control-file" />
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Available*</label>
        <select v-model="available" class="form-control">
          <option value="1">Available</option>
          <option value="2">Unavailable</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div v-if="false" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Device created</strong> You may check on devices list.
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
import categoryMixin from "../../../mixins/categoryMixin";

export default Vue.extend({
  name: "CreateDevice",
  mixins: [categoryMixin],
  data: function () {
    return {
      device_name: "",
      label_name: "",
      device_status: "",
      available: "",
      category_id: "",

      description: "",
      firmware_version: "",
      sn_imei: "",
      note: "",
      image: "",
    };
  },

  methods: {
    submitForm: function (e) {
      e.preventDefault();

      let formData = new FormData();

      formData.append("device_name", this.device_name);
      formData.append("label_name", this.label_name);
      formData.append("device_status", this.device_status);
      formData.append("available", this.available);
      formData.append("category_id", this.category_id);

      formData.append("description", this.description);
      formData.append("firmware_version", this.firmware_version);
      formData.append("sn_imei", this.sn_imei);
      formData.append("note", this.note);

      formData.append("image", this.image);

      this.$emit("loadingEvent", true);
      this.$store
        .dispatch("device/createDevice", formData)
        .then(() => {
          this.$emit("loadingEvent", false);
          this.$router.push({ path: "/admin/devices" });
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