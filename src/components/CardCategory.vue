<template>
  <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
    <router-link :to="{name: 'categoryShow', params:{id: category_id} }">
      <div class="card">
        <img v-bind:src="imgUrl ? imgUrl : no_img" class="card-img-top card-img" alt="..." />
        <div class="card-body">
          <b class="card-text">{{title}}</b>
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Vue from "vue";

const noImg = require("../assets/images/logo-multi-device.png");

export default Vue.extend({
  name: "CardCategory",
  props: {
    imgUrl: String,
    title: String,
    category_id: Number,
  },
  data: function () {
    return {
      no_img: noImg,
      no_title: "Unknown",
    };
  },
});
</script>

<style scoped>
.card {
  margin-bottom: 15px;
}
.card {
  overflow: hidden;
  border: none;
  border-radius: 5%;
  box-shadow: 2px 2px 5px rgba(44, 44, 44, 0.315);
}
a {
  text-decoration: none;
}
.card-img {
  height: 200px;
  margin: auto;
  transition: 0.2s;
}
.card-img:hover {
  transform: scale(1.05);
}
.card-text {
  display: block;
  text-align: center;
  color: rgb(53, 53, 53);
}
</style>