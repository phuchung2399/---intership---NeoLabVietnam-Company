<template>
  <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">

        <a class="navbar-brand" href="#">
          <span>Neo-Lab DBS</span>
        </a>

        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
              <em class="fa fa-envelope"></em>
              <span class="label label-danger">15</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>

          <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
              <em class="fa fa-bell"></em>
              <span class="label label-info">5</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.container-fluid -->
  </nav>
</template>

<script>
import Vue from "vue";
export default Vue.extend({
  name: "TopNavAdmin",
});
</script>

<style scoped>
.navbar-custom {
  background: #222;
}
.navbar-header {
  float: left;
}
@media only screen and (max-width: 7680px) {
  .navbar-header {
    width: 100%;
  }
  .navbar-header .navbar-brand{
    margin-left: 25px;
  }
 
}

.navbar-header .navbar-brand {
  color: #fff;
  font-size: 20px;
  text-transform: uppercase;
  font-weight: 500;
  height: 60px;
}
.navbar-toggle {
  background: rgba(255, 255, 255, 0.1);
  padding: 12px;
  margin-top: 10px;
}
@media only screen and (min-width: 7680px) {
  .navbar-toggle {
    display: none;
  }
}

.navbar-header {
  width: 100%;
}
.navbar-right {
  float: right !important;
  margin-right: -15px;
}
.nav > li {
  position: relative;
  display: block;
}
.nav > li > a {
	position: relative;
	display: block;
	padding: 10px 15px;
}
.dropdown .label {
	top: -4px;
	left: 22px;
	padding-top: 4px;
	padding-bottom: 4px;
	position: absolute;
	border-radius: 9999px;
}
.dropdown a.dropdown-toggle {
  color: #fff;
  height: 40px;
  width: 40px;
  padding-top: 11px;
  padding-left: 9px;
}
.dropdown {
  background: rgba(255, 255, 255, 0.1);
  float: left;
  margin: 10px 8px;
  padding: 0px;
  border-radius: 4px;
}

.dropdown-messages {
  border: 1px solid #fff;
  width: 360px;
  background: rgba(255, 255, 255, 0.9);
  color: #444;
  font-size: 0.9em;
}
.dropdown-menu {
  z-index: 1001;
}
.dropdown-menu > li > a {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: 400;
  line-height: 1.42857143;
  color: #333;
  white-space: nowrap;
}
</style>