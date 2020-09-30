<template>
  <footer class="footer-wrap page-footer font-small blue">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
      © 2020 Copyright:
      <a href="/">NeoLab DBS</a>
    </div>
    <!-- Copyright -->
  </footer>
</template>

<script lang="ts">
import Vue from "vue";
export default Vue.extend({
    name:'Footer'
});
</script>
<style scoped>
.footer-wrap{
  position: absolute;
  left: 0;
  right: 0;
}
</style>