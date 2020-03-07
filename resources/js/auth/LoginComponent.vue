<template>
    <md-content class="md-elevation-3">
        <div class="title">
            <img src="https://vuematerial.io/assets/logo-color.png">
            <div class="md-title">Church Record System</div>
            <div class="md-body-1">Please enter your credential to login</div>
        </div>
        <div class="form">
            <md-field>
            <label>Username</label>
            <md-input v-model="login.username" autofocus></md-input>
            </md-field>
            <md-field md-has-password>
            <label>Password</label>
            <md-input v-model="login.password" @keyup.enter="auth()" type="password"></md-input>
            </md-field>
        </div>
        <div class="actions md-layout md-alignment-center-space-between">
            <a href="/reset-password">Reset password</a>
            <md-button class="md-raised md-primary" @click="auth()">Log in</md-button>
        </div>
        <div class="loading-overlay" v-if="isLoading">
            <md-progress-spinner md-mode="indeterminate" :md-stroke="2"></md-progress-spinner>
        </div>
        <md-snackbar
            md-position="center"
            :md-duration="80000"
            class="md-accent md-position-top"
            :md-active.sync="hasMessage">
                <span> {{ message }}! </span>
                <md-button class="md-primary md-just-icon md-simple" @click="closeSnackBar()">
                    <md-icon>close</md-icon>
                </md-button>
        </md-snackbar>
    </md-content>
</template>
<script>
import { mapState, mapGetters, mapActions } from 'vuex';
export default {
    name: "App",
    computed:{
        ...mapGetters([
            'authUser',
            'isLoading',
            'isMessage',
            'message'
        ]),
        hasMessage: {
            get() { return this.isMessage; },
            set(value) { this.$store.commit('setHasMessage', value);}
        }
    },
    data() {
    return {
      login: {
        username: "",
        password: ""
      }
    };
  },
  methods: {
    auth() {
        this.$store.dispatch('postLogin', this.login);
    },
    clearForm() {
        this.login = {
            username: "",
            password: ""
        };
    },
    closeSnackBar(){
        this.$store.commit('setHasMessage', false);
    }
  }
};
</script>

<style lang="scss" scoped>
.main-panel {
    width: 100%;
}
</style>
