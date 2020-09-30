<template>
  <div class="my_borrowing">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <router-link :to="{path: ''}" v-bind:class="{active: !activeStatus ? true: false }" class="nav-link">All borrowing</router-link>
      </li>
      <li
        v-for="borrowStatusItem in borrowStatusList"
        :key="borrowStatusItem.status"
        class="nav-item"
      >
        <router-link
          :to="{path: '', query:{status: borrowStatusItem.status}}"
          v-bind:class="{active: borrowStatusItem.status == activeStatus ? true: false }"
          class="nav-link"
        >{{borrowStatusItem.title}}</router-link>
      </li>
    </ul>

    <div v-for="borrowItem in myBorrowing " :key="borrowItem.id" class="card">
      <div class="card-header">
        {{borrowItem.project_name}}
        <span
          v-if="borrowItem.status == 0"
          style="float: right"
        >Waiting to confirm</span>
        <span v-else-if="borrowItem.status == 3" style="float: right">Transferred</span>
        <span v-else-if="borrowItem.status == 4" style="float: right">Returned</span>
        <span v-else-if="borrowItem.status == 2" style="float: right">Cancelled</span>
        <span v-else-if="borrowItem.status == 5" style="float: right">Expired</span>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <img v-bind:src="borrowItem.device.image" class="image-card" alt="device-image" srcset />
          </div>
          <div class="col-sm-9">
            <h5 class="card-title">{{borrowItem.device.device_name}}</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <b>From Date:</b>
                {{borrowItem.start_date}}
              </li>
              <li class="list-group-item">
                <b>To Date:</b>
                {{borrowItem.end_date}}
              </li>
              <li class="list-group-item">
                <b>Category:</b>
                123
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import { mapState } from "vuex";

export default Vue.extend({
  name: "MyBorrowing",
  data() {
    return {
      activeStatus: null,
      borrowStatusList: [
        {
          status: 0,
          title: "To Confirm",
        },
        {
          status: 3,
          title: "Transferred",
        },
        {
          status: 4,
          title: "Returned",
        },
        {
          status: 2,
          title: "Cancelled",
        },
        {
          status: 5,
          title: "Expired",
        },
      ],
    };
  },
  computed: {
    ...mapState("user", {
      myBorrowing: (state) => state.myBorrowing,
    }),
  },
  created() {
    this.$store.dispatch("user/getMyBorrowing");
  },
  watch: {
    $route: function (val) {
      this.$store.dispatch("user/getMyBorrowing", val.query.status);
      this.activeStatus = val.query.status;
    },
  },
});
</script>
<style scoped>
.card {
  margin-top: 1em;
}
.image-card {
  width: 100%;
}
</style>