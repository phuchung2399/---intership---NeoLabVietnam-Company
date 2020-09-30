<template>
  <div class="col-lg-3 col-md-4 col-6 wrap-card">
    <div class="slick-card">
      <router-link
        :to="{
      name: 'deviceDetail', 
      params:{
        id: device_id?device_id:0
        }
       }"
      >
        <div class="top-card">
          <span v-if="available" class="label-featured label-available">Available</span>
          <span v-else class="label-featured label-unavailable">Unavailable</span>

          <div class="image-card">
            <img v-bind:src="imgUrl ? imgUrl : no_img" alt />
          </div>
        </div>
      </router-link>

      <div class="bottom-card">
        <h2 class="device-title" style="font-size: 16px;">{{title}}</h2>
        <div class="action-card">
          <button v-on:click="borrowNow" class="btn btn-secondary">Borrow Now</button>
        </div>
        <div class="star-row">
          <i class="fa fa-star"></i>
          {{device_status}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
const noImg = require("../assets/images/logo-multi-device.png");

export default Vue.extend({
  name: "CardDevice",
  props: {
    device_id: Number,
    imgUrl: String,
    title: String,
    available: Number,
    device_status: String,
  },
  data: function () {
    return {
      no_img: noImg,
      no_title: "Unknown",
    };
  },
  methods: {
    borrowNow: function () {
      localStorage.setItem("device_id_borrow", this.device_id);
      this.$router.push({ name: "borrowingRequest" });
    },
  },
});
</script>

<style scoped>
.wrap-card {
  margin-bottom: 10px;
  padding-left: 5px;
  padding-right: 5px;
  transition: 0.25s;
  overflow: hidden;
  border: solid 1px rgba(206, 206, 206, 0.24);
  border-radius: 5px;
}
.wrap-card a {
  text-decoration: none;
}
.wrap-card:hover {
  box-shadow: 0px 2px 5px 0px rgba(116, 116, 116, 0.24);
}
.slick-card {
  border: none;
  border-radius: 5px;
  overflow: hidden;
}
.slick-card:hover {
  cursor: pointer;
}
.slick-card .top-card {
  width: 100%;
  position: relative;
}

.label-featured {
  position: absolute;
  padding: 2px;
  color: #ffff;
  border-radius: 5px;
  top: 20px;
  left: 20px;
  z-index: 1;
}
.label-available {
  background-color: #16b81e;
}
.label-unavailable {
  background-color: #b82916;
}
.image-card {
  overflow: hidden;
}
.image-card img {
  max-width: 100%;
  height: 185px;
  display: block;
  margin: auto;
}

.bottom-card {
  margin: 0 5px 0 5px;
}
.action-card {
  display: flex;
  justify-content: space-between;
}
.device-title {
  font-size: 16px;
  line-height: 28px;
}
.btn {
  padding: 5px 2.5px 5px 2.5px;
}
.star-row {
  margin-top: 15px;
}
</style>