<template>
  <div
    class="sidebar"
    :data-color="activeColor"
    :data-image="backgroundImage"
    :style="sidebarStyle">
    <div class="logo">
        <a href="/dashboard" class="simple-text logo-mini">
            <div class="logo-img">
                <img :src="imgLogo" alt="" />
            </div>
        </a>
        <a href="/dashboard" class="simple-text logo-normal">
            {{ title }}
        </a>
    </div>
    <div class="sidebar-wrapper">
      <slot name="content"></slot>
      <md-list class="nav" :md-expand-single="expandSingle">
        <slot>
          <sidebar-link
            v-for="(link, index) in sidebarLinks"
            :key="link.name + index"
            :to="link.path"
            :link="link">
          </sidebar-link>
        </slot>
      </md-list>
    </div>
  </div>
</template>
<script>
import SidebarLink from "./SidebarLink.vue";
import CollapsableSidebarLink from "./CollapsableSidebarLink.vue";

export default {
  components: {
    SidebarLink,
    CollapsableSidebarLink
  },
  props: {
    title: {
      type: String,
      default: "C-Record System"
    },
    backgroundImage: {
      type: String,
      default: '/storage/assets/img/sidebar-2.jpg',
    },
    imgLogo: {
      type: String,
      default: '/storage/assets/img/vue-logo.png',
    },
    expandSingle: {
        type: Boolean,
        default:true,
    },
    activeColor: {
      type: String,
      default: "green",
      validator: value => {
        let acceptedValues = ["", "purple", "blue", "green", "orange", "red"];
        return acceptedValues.indexOf(value) !== -1;
      }
    },
    sidebarLinks: {
      type: Array,
      default: () => []
    },
    autoClose: {
      type: Boolean,
      default: true
    }
  },
  provide() {
    return {
      autoClose: this.autoClose
    };
  },
  computed: {
    sidebarStyle() {
      return {
        backgroundImage: `url(${this.backgroundImage})`
      };
    }
  }
};
</script>
<style>
@media screen and (min-width: 991px) {
  .nav-mobile-menu {
    display: none;
  }
}
</style>
