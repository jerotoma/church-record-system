/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
const moment = require('vue-moment');
import 'es6-promise/auto';
import store from './store/store';

// Plugins
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import Notifications from "./shared/NotificationPlugin";
import MaterialDashboard from "./material-dashboard";
import GlobalVueGoodTable from "./global-vue-good-table";
import Chartist from "chartist";

Vue.prototype.$Chartist = Chartist;

Vue.use(moment);
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
Vue.component('top-navbar-component', require('./layout/TopNavbarComponent.vue').default);
Vue.component('footer-component', require('./layout/FooterComponent.vue').default);
Vue.component('mobile-menu-component', require('./layout/MobileMenuComponent.vue').default);

Vue.component('dashboard-component', require('./pages/DashboardComponent.vue').default);

Vue.component('user-view-component', require('./pages/users/UserViewComponent.vue').default);
Vue.component('user-show-component', require('./pages/users/UserShowComponent.vue').default);

Vue.component('member-view-component', require('./pages/members/MemberViewComponent.vue').default);
Vue.component('member-show-component', require('./pages/members/MemberShowComponent.vue').default);

Vue.component('community-view-component', require('./pages/hierarchies/communities/CommunityViewComponent.vue').default);
Vue.component('zone-view-component', require('./pages/hierarchies/zones/ZoneViewComponent.vue').default);
Vue.component('parish-view-component', require('./pages/hierarchies/parishes/ParishViewComponent.vue').default);

Vue.component('giving-view-component', require('./pages/givings/GivingViewComponent.vue').default);

Vue.component('patron-view-component', require('./pages/patrons/PatronViewComponent.vue').default);

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
    methods: {
        hideGlobalSpinner(){
            let globalSpinner = this.$refs.recordGlobalSpinner;//['record-global-spinner'];
            globalSpinner.style.display = 'none';
        }
    },
    mounted() {
       this.hideGlobalSpinner();
    }
});
