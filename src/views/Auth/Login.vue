<template>
  <div id="sigin">
    <!-- <NavAccess /> -->

    <div class="main-content">
      <div class="container">
        <div>
          <div class="logo">
            <a href="http://neo-lab.vn/">
              <img class="img-logo" src="../../assets/images/logo/logo.png" alt srcset />
            </a>
          </div>
          <div class="device-logo">
            <img class="img-device" src="../../assets/images/logo/gallery-devices.png" alt srcset />
          </div>
          <h2 style="text-align:center; color: #ec651a;">Devices Borrowing System</h2>

          <div>
            <a v-bind:href="googleAuthUrl" class="google btn">
              <i class="fa fa-google fa-fw"></i>
              Login with your Google G Suite NeoLab
            </a>
          </div>
        </div>
      </div>
      <div class="copyright">
        <p>Copyright © 2020. All rights reserved</p>
      </div>
    </div>

    <!-- <Footer /> -->
  </div>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
  name: "Sigin",
  data: function () {
    return {
      loading: false,
      googleAuthUrl: null,
    };
  },

  created() {
    if (this.$route.query.access_token) {
      this.$store
        .dispatch("auth/auth", this.$route.query.access_token)
        .then(() => {
          this.$router.push({ name: "Home" });
        });
    } else {
      this.$store.dispatch("auth/request").then(() => {
        this.googleAuthUrl = this.$store.getters["auth/googleAuthUrl"];
      });
    }
  },
});
</script>

<style scoped>
.main-content {
  display: block;
  margin-top: 45px;
}

.logo {
  width: 100%;
  display: flex;
}

.img-logo {
  width: 70px;
  margin: auto;
}

.device-logo {
  padding: 15px 0;
}

.img-device {
  display: block;
  width: 300px;
  margin: auto;
}

/* style inputs and link buttons */
input,
.btn {
  width: 50%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: auto;
  opacity: 0.85;
  display: block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none;
  /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* add appropriate colors to fb, twitter and google buttons */
.fb {
  background-color: #3b5998;
  color: white;
}

.twitter {
  background-color: #55acee;
  color: white;
}

.google {
  background-color: #dd4b39;
  color: white;
  text-align: center;
}

/* Two-column layout */
.col {
  float: left;
  width: 50%;
  margin: auto;
  padding: 0 50px;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* vertical line */
.vl {
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  border: 2px solid #ddd;
  height: 175px;
}

/* text inside the vertical line */
.vl-innertext {
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 50%;
  padding: 8px 10px;
}

/* hide some text on medium and large screens */
.hide-md-lg {
  display: none;
}

/* bottom container */
.bottom-container {
  text-align: center;
  background-color: #666;
  border-radius: 0px 0px 4px 4px;
}

/* Responsive layout - when the screen is less than 650px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 650px) {
  .col {
    width: 100%;
    margin-top: 0;
  }

  /* hide the vertical line */
  .vl {
    display: none;
  }

  /* show the hidden text on small screens */
  .hide-md-lg {
    display: block;
    text-align: center;
  }
}

.copyright {
  padding: 2em 0;
  text-align: center;
}

.copyright p {
  font-size: 15px;
  letter-spacing: 1px;
  color: rgb(124, 124, 124);
  line-height: 1.8em;
}
</style>