/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import 'es6-promise/auto';
import store from './store/store';

// Plugins
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import Notifications from "./components/NotificationPlugin";
import MaterialDashboard from "./material-dashboard";
import GlobalVueGoodTable from "./global-vue-good-table";
import Chartist from "chartist";

Vue.prototype.$Chartist = Chartist;

Vue.use(MaterialDashboard);
Vue.use(GlobalComponents);
Vue.use(GlobalDirectives);
Vue.use(GlobalVueGoodTable);
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
 Vue.component('top-navbar-component', require('./pages/layout/TopNavbarComponent.vue').default);
 Vue.component('content-footer-component', require('./pages/layout/FooterComponent.vue').default);
 Vue.component('dashboard-content-component', require('./pages/layout/Content.vue').default);
 Vue.component('mobile-menu-component', require('./pages/layout/MobileMenuComponent.vue').default);

 Vue.component('user-view-component', require('./pages/users/UserViewComponent.vue').default);

 Vue.component('parish-view-component', require('./pages/parishes/ParishViewComponent.vue').default);
 Vue.component('parish-show-component', require('./pages/parishes/ParishShowComponent.vue').default);

 Vue.component('login-component', require('./auth/LoginComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    data: {
        Chartist: Chartist
    },
});
