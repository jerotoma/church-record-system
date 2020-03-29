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
import DialogPlugin from "./shared/dialog"
import MaterialDashboard from "./material-dashboard";
import GlobalVueGoodTable from "./global-vue-good-table";
import Chartist from "chartist";

Vue.prototype.$Chartist = Chartist;

Vue.use(moment);
Vue.use(DialogPlugin);
Vue.use(MaterialDashboard);
Vue.use(GlobalComponents);
Vue.use(GlobalDirectives);
Vue.use(GlobalVueGoodTable);
Vue.use(Notifications);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    data: {
        Chartist: Chartist,
    },
    watch: {
        showSidebar: {
            handler(newVal, oldVal){
                console.log(newVal);
            }
        }
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
