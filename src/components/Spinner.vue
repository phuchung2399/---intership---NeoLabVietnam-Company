<template>
  <div v-if="loading" id="spinner" class="spinner-container">
    <div class="spinner-wrap"></div>
  </div>
</template>

<script>
import Vue from "vue";
export default Vue.extend({
  name: "Spinner",
  props:{
    loading: Boolean
  }
});
</script>
<style scoped>
.spinner-container {
  background-color: rgb(255, 255, 255);
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  right: 0;
  z-index: 9999;
}
.spinner-wrap {
  position: absolute;
  top: 40%;
  left: 50%;
  width: 50px;
  height: 50px;
  border: 7px solid rgba(117, 117, 117, 0.431);
  border-radius: 50%;
  border-top-color: rgb(231, 128, 10);
  animation: spining 0.5s linear infinite;
}
@keyframes spining {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>