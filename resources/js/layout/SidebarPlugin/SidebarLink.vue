<template>
  <li class="md-list-item">
    <a class="md-list-item-container md-button-clean"
        :class="{ active: isActive == 'active' ? true : false }"
        :href="to"
       @click="hideSidebar">
        <div class="md-list-item-content md-ripple">
            <slot>
                <md-icon>{{ link.icon }}</md-icon>
                <p>{{ link.name }}</p>
            </slot>
        </div>
    </a>
  </li>
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
