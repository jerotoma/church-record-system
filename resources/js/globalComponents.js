import DropDown from './shared/Dropdown.vue';
import DialogConfirmComponent from './shared/dialog/DialogConfirmComponent.vue';
import DashboardLayoutComponent from './layout/DashboardLayoutComponent.vue';

import NavbarComponent from './layout/NavbarComponent.vue';
import FooterComponent from './layout/FooterComponent.vue';
import MobileMenuComponent from './layout/MobileMenuComponent.vue';
import DashboardComponent from './pages/DashboardComponent.vue';
import UserViewComponent from './pages/users/UserViewComponent.vue';
import UserShowComponent from './pages/users/UserShowComponent.vue';
import MemberViewComponent from './pages/members/MemberViewComponent.vue';
import MemberShowComponent from './pages/members/MemberShowComponent.vue';
import CommunityViewComponent from './pages/hierarchies/communities/CommunityViewComponent.vue';
import ZoneViewComponent from './pages/hierarchies/zones/ZoneViewComponent.vue';
import SecurityViewComponent from './pages/system-settings/securities/SecurityViewComponent.vue';

import ParishViewComponent from './pages/hierarchies/parishes/ParishViewComponent.vue';
import GivingTypeViewComponent from './pages/system-settings/giving-types/GivingTypeViewComponent.vue';
import GivingViewComponent from './pages/contributions/givings/GivingViewComponent.vue';
import LoginComponent from './auth/LoginComponent.vue';
import {
    StatsCard,
    ChartCard,
    NavTabsCard,
    NavTabsTable,
    OrderedTable,
    SearchMember,
    FileUploadComponent
  } from './shared';

/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */

const GlobalComponents = {
  install(Vue) {
    Vue.component("drop-down", DropDown);
    Vue.component("dialog-confirm-component", DialogConfirmComponent);
    Vue.component("dashboard-layout-component", DashboardLayoutComponent);
     //Global Components
    Vue.component('navbar-component', NavbarComponent);
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
    Vue.component('security-view-component', SecurityViewComponent );

    Vue.component('giving-type-view-component', GivingTypeViewComponent);

    Vue.component('giving-view-component', GivingViewComponent);

    Vue.component('login-component', LoginComponent);

    Vue.component('stats-card', StatsCard);
    Vue.component('chart-card', ChartCard);
    Vue.component('nav-tabs-card', NavTabsCard);
    Vue.component('nav-tabs-table', NavTabsTable);
    Vue.component('ordered-table', OrderedTable);
    Vue.component('search-member', SearchMember);
    Vue.component('file-upload-component', FileUploadComponent);

  }
};

export default GlobalComponents;
