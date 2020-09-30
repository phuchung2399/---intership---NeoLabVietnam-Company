<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img class="img-logo-nav" src="../assets/images/logo/gallery-devices-neolab.png" alt srcset />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarHome"
        aria-controls="navbarHome"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHome">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">
              Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">FAQ</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fa fa-globe" aria-hidden="true"></i>
              Language
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Tiếng Việt</a>
              <a class="dropdown-item" href="#">English</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">日本人</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fa fa-user" aria-hidden="true"></i>
              User
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <router-link to="/user/profile" class="dropdown-item">Profile</router-link>
              <div class="dropdown-divider"></div>

              <router-link to="/user/my-borrowing" class="dropdown-item">My Borrowing</router-link>
              <div class="dropdown-divider"></div>

              <a v-on:click="signout" class="dropdown-item" href="#sign_out">Sign out</a>
              
            </div>
          </li>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>-->
      </div>
    </div>
  </nav>
</template>

<script lang="ts">
import Vue from "vue";
export default Vue.extend({
  name: "TopNav",
  methods: {
    signout: function () {
      this.$store.dispatch("auth/logout");
      this.$router.replace({ name: "Sigin" });
    },
  },
});
</script>
<style>
/* .nav {
  background-color: rgb(77, 77, 77) !important;
  box-shadow: 0.25px 0.15pz rgba(0, 0, 0, 0.137),
    inset 0 -1px 5px rgba(0, 0, 0, 0.25);
  position: static;
  top: 0;
} */
.dropdown-menu {
  left: auto;
  right: 0;
}
.nav-link {
  color: red;
}
.img-logo-nav {
  width: 170px;
  margin: auto;
}
</style>
