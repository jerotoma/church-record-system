import DropDown from './shared/Dropdown.vue';
import DialogConfirmComponent from './shared/dialog/DialogConfirmComponent.vue';
import DashboardLayoutComponent from './layout/DashboardLayoutComponent.vue';

import TopNavbarComponent from './layout/TopNavbarComponent.vue';
import FooterComponent from './layout/FooterComponent.vue';
import MobileMenuComponent from './layout/MobileMenuComponent.vue';
import DashboardComponent from './pages/DashboardComponent.vue';
import UserViewComponent from './pages/users/UserViewComponent.vue';
import UserShowComponent from './pages/users/UserShowComponent.vue';
import MemberViewComponent from './pages/members/MemberViewComponent.vue';
import MemberShowComponent from './pages/members/MemberShowComponent.vue';
import CommunityViewComponent from './pages/hierarchies/communities/CommunityViewComponent.vue';
import ZoneViewComponent from './pages/hierarchies/zones/ZoneViewComponent.vue';


import ParishViewComponent from './pages/hierarchies/parishes/ParishViewComponent.vue';
import GivingTypeViewComponent from './pages/system-settings/giving-types/GivingTypeViewComponent.vue';
import PatronViewComponent from './pages/patrons/PatronViewComponent.vue';
import LoginComponent from './auth/LoginComponent.vue';

/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */

const GlobalComponents = {
  install(Vue) {
    Vue.component("drop-down", DropDown);
    Vue.component("dialog-confirm-component", DialogConfirmComponent);
    Vue.component("dashboard-layout-component", DashboardLayoutComponent);
     //Global Components
    Vue.component('top-navbar-component', TopNavbarComponent);
    Vue.component('footer-component', FooterComponent);
    Vue.component('mobile-menu-component', MobileMenuComponent);

    Vue.component('dashboard-component', DashboardComponent);

    Vue.component('user-view-component', UserViewComponent);
    Vue.component('user-show-component', UserShowComponent);

    Vue.component('member-view-component', MemberViewComponent);
    Vue.component('member-show-component', MemberShowComponent);

    Vue.component('community-view-component', CommunityViewComponent);
    Vue.component('zone-view-component', ZoneViewComponent);
    Vue.component('parish-view-component', ParishViewComponent);

    Vue.component('giving-type-view-component', GivingTypeViewComponent);

    Vue.component('patron-view-component', PatronViewComponent);

    Vue.component('login-component', LoginComponent);

  }
};

export default GlobalComponents;
