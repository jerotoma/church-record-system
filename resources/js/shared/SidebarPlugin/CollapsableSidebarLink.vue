<template>
    <md-list-item md-expand class="collapsable-item">
        <md-icon>{{link.icon}}</md-icon>
        <p>{{link.title}}</p>
        <md-list slot="md-expand">
            <slot>
                <md-list-item class="md-inset" v-for="(child, index) in link.children" :key="index">
                    {{child.title}}
                </md-list-item>
            </slot>
        </md-list>
    </md-list-item>
</template>
<script>
export default {
  inject: {
    autoClose: {
      default: true
    }
  },
  props: {
    link: {
      type: [String, Object],
      default: () => {
        return {
          name: "",
          path: "",
          icon: ""
        };
      }
    },
    tag: {
      type: String,
      default: "router-link"
    },
    to: {
      type: String,
      default: ''
    },
    isActive: {
        type: String,
        default: 'inactive'
    },
    hasChildren: {
        type: Boolean,
        default: false,
    }
  },
  methods: {
    hideSidebar() {
      if (
        this.autoClose &&
        this.$sidebar &&
        this.$sidebar.showSidebar === true
      ) {
        this.$sidebar.displaySidebar(false);
      }
    }
  }
};
</script>
<style></style>
