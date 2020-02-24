/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from "vue-router";

// Plugins
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import Notifications from "./components/NotificationPlugin";
import MaterialDashboard from "./material-dashboard";
import Chartist from "chartist";

Vue.prototype.$Chartist = Chartist;


Vue.use(MaterialDashboard);
Vue.use(GlobalComponents);
Vue.use(GlobalDirectives);
Vue.use(Notifications);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

 //Global Components
 Vue.component('dashboard-component', require('./pages/DashboardComponent.vue').default);
 Vue.component('top-navbar-component', require('./pages/Layout/TopNavbarComponent.vue').default);
 Vue.component('content-footer-component', require('./pages/Layout/ContentFooter.vue').default);
 Vue.component('dashboard-content-component', require('./pages/Layout/Content.vue').default);
 Vue.component('mobile-menu-component', require('./pages/Layout/MobileMenu.vue').default);
 Vue.component('user-profile-component', require('./pages/UserProfile.vue').default);


 const router = new VueRouter({
    //routes, // short for routes: routes
    linkExactActiveClass: "nav-item active"
  });
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
        Chartist: Chartist
    },
});
