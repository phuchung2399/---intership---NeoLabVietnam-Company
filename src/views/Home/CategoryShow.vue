<template>
  <div id="category_show">
    <Spinner v-bind:loading="loading" />
    <!-- <h1>test</h1> -->
    <div class="row">
      <CardDevice
        v-for="device in devices"
        v-bind:key="device.id"
        v-bind:device_id="device.id"
        v-bind:title="device.device_name"
        v-bind:available="device.available"
        v-bind:imgUrl="device.image"
        v-bind:device_status="device.device_status"
      />
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import CardDevice from "../../components/CardDevice.vue";
import Spinner from "../../components/Spinner.vue";

export default Vue.extend({
  name: "CategoryShow",
  components: {
    CardDevice,
    Spinner,
  },
  data: function () {
    return {
      devices: [],
      loading: false,
    };
  },
  methods: {
    fetchAllDevices() {
      this.loading = true;

      this.$store
        .dispatch("device/getDevices")
        .then(() => {
          this.devices = this.$store.getters["device/devices"];
        })
        .finally(() => {
          this.loading = false;
        });
    },

    fetchByCategory() {
      this.loading = true;

      this.$store
        .dispatch("category/getOneCategory", this.$route.params.id)
        .then(() => {
          this.devices = this.$store.getters["category/categoryDevices"];
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
  created() {
    !this.$route.params.id ? this.fetchAllDevices() : this.fetchByCategory();
    // this.fetchByCategory();
  },
  watch: {
    $route: "fetchByCategory",
  },
});
</script>

<style scoped>
h1 {
  text-transform: uppercase;
}
</style>