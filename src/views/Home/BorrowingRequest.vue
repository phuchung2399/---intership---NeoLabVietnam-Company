<template>
  <div id="borrowing_request">
    <div class="container">
      <div class="card">
        <div class="card-header">Device</div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3">
              <img v-bind:src="device.image" class="image-card" alt="device-image" srcset />
            </div>
            <div class="col-sm-9">
              <h5 class="card-title">{{device.device_name}}</h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <b>Label:</b>
                  {{device.label_name}}
                </li>
                <li class="list-group-item">
                  <b>Status:</b>
                  {{device.device_status}}
                </li>
                <li class="list-group-item">
                  <b>Category:</b>
                  {{device.category.category_name}}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <form v-on:submit="submitBorrow" method="POST">
        <div class="form-group">
          <label for="inputAddress">Project name *</label>
          <input v-model="projectName" type="text" class="form-control" id="inputProjectName" />
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <label>From datetime*</label>
            <datetime
              input-class="form-control"
              type="datetime"
              v-model="startDate"
              v-bind:min-datetime="minDate"
              format="yyyy-MM-dd HH:mm:ss"
              v-bind:minute-step="30"
            />
          </div>
          <div class="col-md-6">
            <label>To datetime*</label>
            <datetime
              input-class="form-control"
              type="datetime"
              v-model="endDate"
              v-bind:min-datetime="minDate"
              format="yyyy-MM-dd HH:mm:ss"
              v-bind:minute-step="30"
            />
          </div>
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Note</label>
          <textarea v-model="note" class="form-control" rows="3" placeholder="optional"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-submit">Send Borrowing Request</button>
        </div>
      </form>
      <p>{{minDate}}</p>
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

Vue.use(Datetime);

export default Vue.extend({
  name: "BorrowingRequest",
  data() {
    return {
      minDate: new Date().toISOString().toString(),

      deviceId: localStorage.getItem("device_id_borrow"),
      projectName: "",
      startDate: "",
      endDate: "",
      note: "",
    };
  },
  components: {
    datetime: Datetime,
  },
  computed: {
    device() {
      return this.$store.getters["device/device"];
    },
  },
  methods: {
    fetchOneDevice: function () {
      this.$emit("loadingEvent", true);
      this.$store.dispatch("device/getOneDevice", this.deviceId).then(() => {
        this.$emit("loadingEvent", false);
      });
    },

    submitBorrow: function (e) {
      e.preventDefault();

      this.$emit("loadingEvent", true);

      this.$store
        .dispatch("borrow/createBorrow", {
          device_id: this.deviceId,
          project_name: this.projectName,
          start_date: this.startDate,
          end_date: this.endDate,
          note: this.note,
        })
        .then(() => {
          this.$emit("loadingEvent", false);
          this.$router.replace({ name: "myBorrowing" });
        })
        .catch((error) => {
          alert(error);
        });
    },
  },
  created() {
    this.fetchOneDevice();
  },
});
</script>
<style scoped>
.btn-submit {
  width: 100%;
}
.image-card {
  max-width: 100%;
  height: 185px;
  display: block;
  margin: auto;
}
</style>