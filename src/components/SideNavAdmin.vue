<template>
  <!-- Sidebar -->
  <aside>
    <button class="btn btn-primary" id="menu-toggle">
      <!-- <i class="fa fa-arrow-left" aria-hidden="true"></i> -->
      <i class="fa fa-bars" aria-hidden="true"></i>
    </button>

    <div class="border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <div class="profile-sidebar">
          <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt />
          </div>

          <div class="profile-usertitle">
            <div class="profile-usertitle-name">Super Admin</div>
            <div class="profile-usertitle-status">
              <span class="indicator label-success"></span>Online
            </div>
          </div>
        </div>
      </div>

      <ul class="nav menu">
        <li class="active">
          <router-link to="/admin">
            <em class="fa fa-dashboard">&nbsp;</em> Dashboard
          </router-link>
        </li>
        <li>
          <router-link to="/admin/users">
            <em class="fa fa-user">&nbsp;</em> Users
          </router-link>
        </li>
        <li>
          <router-link to="/admin/devices">
            <em class="fa fa-desktop">&nbsp;</em> Devices
          </router-link>
        </li>
        <li>
          <router-link to="/admin/categories">
            <em class="fa fa-list-alt">&nbsp;</em> Categories
          </router-link>
        </li>
        <li>
          <router-link to="/admin/borrows">
            <em class="fa fa-exchange">&nbsp;</em> Borrows
          </router-link>
        </li>

        <li>
          <a>
            <em class="fa fa-power-off">&nbsp;</em> Logout
          </a>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script>
import Vue from "vue";
import $ from "jquery";
export default Vue.extend({
  name: "SideNavAdmin",

  mounted() {
    $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#sidebar-wrapper").toggleClass("toggled");
    });
  },
});
</script>

<style scoped>
#wrapper {
  overflow-x: hidden;
}

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  background-color: rgb(255, 255, 255);
  -webkit-transition: margin 0.25s ease-out;
  -moz-transition: margin 0.25s ease-out;
  -o-transition: margin 0.25s ease-out;
  transition: margin 0.25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}
#sidebar-wrapper.toggled {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
    min-width: 255px;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
  #menu-toggle {
    width: 50px;
    height: 50px;
    display: none;
  }
  .fa-bars {
    display: none;
  }
}
@media screen and (max-width: 768px) {
  #sidebar-wrapper {
    position: absolute;
    z-index: 2;
  }
  #menu-toggle {
    border-color: rgb(22, 22, 22);
    background-color: rgb(22, 22, 22);
    position: absolute;
    top: 10px;
  }
}

.sidebar-heading {
  border-bottom: 1px solid #e9ecf2;
}
.profile-sidebar {
  display: block;
}
.profile-userpic img {
  display: block;
  margin: auto;
  width: 50px;
  height: 50px;
  border-radius: 9999px !important;
}
.profile-usertitle {
  text-align: left;
  margin: 0 0 0 12px;
}
.profile-usertitle-name {
  font-size: 20px;
  margin-bottom: 0px;
  text-align: center;
}
.profile-usertitle-status {
  text-transform: uppercase;
  color: #aaa;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
  text-align: center;
}
.indicator {
  width: 10px;
  height: 10px;
  display: inline-block;
  border-radius: 9999px;
  margin-right: 5px;
}
.label-success {
  background-color: #8ad919;
}
.nav {
  display: block;
}
.nav li {
  height: 50px;
  font-size: 15px;
  line-height: 2em;
  color: #444444;
}
.nav li :hover {
  background-color: #007bff;
  color: #fff;
}
.nav .active > a {
  color: #fff;
  background-color: #007bff;
}
.nav > li > a {
  position: relative;
  display: block;
  padding: 10px 15px;
  text-decoration: none;
  color: #444444;
}
</style>