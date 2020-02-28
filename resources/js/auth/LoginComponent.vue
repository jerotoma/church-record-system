<template>
  <md-content class="md-elevation-3">
      <div class="title">
        <img src="https://vuematerial.io/assets/logo-color.png">
        <div class="md-title">Vue Material</div>
        <div class="md-body-1">Build beautiful apps with Material Design and Vue.js</div>
      </div>
      <div class="form">
        <md-field>
          <label>Username</label>
          <md-input v-model="login.username" autofocus></md-input>
        </md-field>
        <md-field md-has-password>
          <label>Password</label>
          <md-input v-model="login.password" type="password"></md-input>
        </md-field>
      </div>
      <div class="actions md-layout md-alignment-center-space-between">
        <a href="/resetpassword">Reset password</a>
        <md-button class="md-raised md-primary" @click="auth()">Log in</md-button>
      </div>
      <div class="loading-overlay" v-if="loading">
        <md-progress-spinner md-mode="indeterminate" :md-stroke="2"></md-progress-spinner>
      </div>
    </md-content>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      loading: false,
      login: {
        username: "",
        password: ""
      }
    };
  },
  methods: {
    auth() {
      // your code to login user
      // this is only for example of loading
        this.loading = true;
        axios({
            method: 'POST',
            url: '/auth/login',
            data: this.login,
        })
        .then((response) => {
            console.log(response);
            this.loading = false;
            this.clearForm();
        }).catch((error) => {
            this.loading = false;
            console.log(error);
        });
    },
    clearForm() {

    }
  }
};
</script>

<style lang="scss">
.main-panel {
    width: 100%;
}
</style>
