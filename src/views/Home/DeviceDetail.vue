<template>
  <!-- Page Content -->
  <div class="container device-detail-wrap">
    <!-- Portfolio Item Row -->
    <div class="row">
      <div class="col-md-8">
        <img class="img-fluid" v-bind:src="device.image" alt />
      </div>

      <div class="col-md-4 device-detail">
        <h2 class="name">
          {{device.device_name}}
          <small>Label: {{device.label_name}}</small>
        </h2>

        <div class="status-wrap">
          <div>
            <i class="fa fa-star"></i>
            {{device.device_status}}
          </div>

          <div>
            <span class="fa fa-2x">
              <h5>(109) Borrowed</h5>
            </span>
          </div>
        </div>

        <div class="action-card">
          <!-- <button href class="btn btn-primary">Add to cart</button> -->
          <a href class="btn btn-secondary">Borrow Now</a>
        </div>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="tab-content">
          <b-tabs content-class="mt-3">
            <b-tab title="Description" active>
              <p>{{device.description}}</p>
            </b-tab>

            <b-tab title="Specification">
              <ul>
                <li>Firmware version: {{device.firmware_version}}</li>
                <li>Sn Imei: {{device.sn_imei}}</li>
              </ul>
            </b-tab>
          </b-tabs>
        </div>
      </div>
    </div>

    <!-- Related Projects Row -->
    <h3 class="my-4">Related Devices</h3>

    <div v-if="relatedDevices.length > 0" class="row">
      <CardDevice
        v-for="device in relatedDevices"
        v-bind:key="device.id"
        v-bind:device_id="device.id"
        v-bind:title="device.device_name"
        v-bind:available="device.available"
        v-bind:imgUrl="device.image"
        v-bind:device_status="device.device_status"
      />
    </div>
    <div v-else class="row">
      <h3>There are not any found</h3>
    </div>

    <!-- /.row -->
  </div>
  <!-- /.container -->
</template>
<script>
import Vue from "vue";
import CardDevice from "../../components/CardDevice.vue";

export default Vue.extend({
  name: "DeviceDetail",
  props: {
    id: null,
  },
  components: {
    CardDevice,
  },
  data: function () {
    return {
      device: {},
      relatedDevices: [],
    };
  },
  methods: {
    fetchOneDevice() {
      this.$store.dispatch("device/getOneDevice", this.id).then(() => {
        this.device = this.$store.getters["device/device"];
      });
    },

    fetchOneRelatedDevice() {
      this.$store.dispatch("device/getOneRelatedDevice", this.id).then(() => {
        this.relatedDevices = this.$store.getters["device/devices"];
      });
    },
  },
  created() {
    this.fetchOneDevice();
    this.fetchOneRelatedDevice();
  },
  watch: {
    $route: function () {
      this.fetchOneDevice();
      this.fetchOneRelatedDevice();
    },
  },
});
</script>

<style scoped>
.device-detail-wrap {
  padding-top: 15px;
}
.action-card {
  display: flex;
}
.img-fluid {
  max-width: 750px;
  max-height: 500px;
}
.product-detail .name {
  margin-top: 0;
  margin-bottom: 0;
}
.device-detail .name small {
  display: block;
}
.device-detail .fa-2x {
  font-size: 16px !important;
}
.device-detail .fa-2x > h5 {
  font-size: 14px;
  margin: 0;
}
.tab-content {
  padding-top: 15px;
}
</style>