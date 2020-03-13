<template>
  <md-toolbar md-elevation="0" class="md-primary">
    <div class="md-toolbar-row">
      <div class="md-toolbar-section-start">
        <h3 class="md-title">{{ currentPageTitle }}</h3>
      </div>
      <div class="md-toolbar-section-end">
        <md-button
          class="md-just-icon md-simple md-toolbar-toggle"
          :class="{ toggled: $sidebar.showSidebar }"
          @click="toggleSidebar"
        >
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </md-button>

        <div class="md-collapse">
          <div class="md-autocomplete">
            <md-autocomplete
              class="search"
              v-model="selectedEmployee"
              :md-options="employees">
              <label>Search...</label>
            </md-autocomplete>
          </div>
          <md-list>
            <md-list-item href="/dashboard">
              <i class="material-icons">dashboard</i>
              <p class="hidden-lg hidden-md">Dashboard</p>
            </md-list-item>
            <li class="md-list-item">
              <div class="md-list-item-container md-button-clean dropdown">
                <div class="md-list-item-content">
                    <div class="md-list-item-content">
                        <md-menu md-size="medium" md-align-trigger>
                            <md-button md-menu-trigger class="md-button md-just-icon md-simple">
                                <md-avatar class="md-small">
                                    <img src="https://vuematerial.io/assets/examples/avatar.jpg" alt="Marcos Moura">
                                </md-avatar>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </md-button>
                            <md-menu-content>
                                <md-menu-item @click="goToLink('my-profile')">My Profile</md-menu-item>
                                <md-menu-item @click="goToLink('my-profile')">Settings</md-menu-item>
                                <md-divider class="md-inset"></md-divider>
                                <md-menu-item @click="goToLink('logout')">Logout</md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </div>
                </div>
              </div>
            </li>
          </md-list>
        </div>
      </div>
    </div>
  </md-toolbar>
</template>

<script>
export default {
    props: {
        currentPageTitle: {
            type: String,
            default: 'Dashboard',
        }
    },
    data() {
        return {
            selectedEmployee: null,
            employees: [
                "Jim Halpert",
                "Dwight Schrute",
                "Michael Scott",
                "Pam Beesly",
                "Angela Martin",
                "Kelly Kapoor",
                "Ryan Howard",
                "Kevin Malone"
            ]
        };
    },
    methods: {
        toggleSidebar() {
            console.log(this.$sidebar.showSidebar);
            this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
        },
        goToLink(path) {
            if (path == 'logout') {
                this.logout()
            } else {
                 window.location.replace('/dashboard/' + path);
            }
        },
        logout () {
            this.$store.dispatch('postLogout').then(() => {
                window.location.replace('/auth/login');
            }).catch( error => {
                console.log(error);
            });
        }
    }
};
</script>

<style lang="scss">
    .author-card {
        padding: 8px 16px;
        display: flex;
        align-items: center;
        .md-avatar {
            margin-right: 16px;
        }
        .author-card-info {
            display: flex;
            flex-flow: column;
            flex: 1;
        }
        span {
            font-size: 16px;
        }
        .author-card-links {
        display: flex;
            a + a {
                margin-left: 8px;
            }
        }
    }

</style>
