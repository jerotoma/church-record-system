<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                    <md-card-header data-background-color="green">
                        <div class="md-title">Employees Stats</div>
                        <p class="category">New employees on 15th September, 2016</p>
                        <md-button class="md-primary md-raised" @click="createUserModal()">Create User</md-button>
                    </md-card-header>
                    <md-card-content>
                       <md-table v-model="users" :table-header-color="tableHeaderColor">
                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <md-table-cell md-label="ID">{{ item.id }}</md-table-cell>
                                <md-table-cell md-label="Name">{{ item.name }}</md-table-cell>
                                <md-table-cell md-label="Salary">{{ item.salary }}</md-table-cell>
                                <md-table-cell md-label="Country">{{ item.country }}</md-table-cell>
                                <md-table-cell md-label="City">{{ item.city }}</md-table-cell>
                            </md-table-row>
                        </md-table>
                    </md-card-content>
                </md-card>
                <user-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></user-create-component>
            </div>
        </div>
  </div>
</template>
<script>
//import { UserCreateComponent } from './UserCreateComponent.vue';
export default {
  name: "users-table",
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    }
  },
  components: {
      //UserCreateComponent,
  },
  data() {
    return {
      selected: [],
      showCreateModal: false,
      users: [
        {
          id: 1,
          name: "Dakota Rice",
          salary: "$36,738",
          country: "Niger",
          city: "Oud-Turnhout"
        },
        {
          id: 2,
          name: "Minerva Hooper",
          salary: "$23,738",
          country: "Curaçao",
          city: "Sinaai-Waas"
        },
        {
          id: 3,
          name: "Sage Rodriguez",
          salary: "$56,142",
          country: "Netherlands",
          city: "Overland Park"
        },
        {
          id: 4,
          name: "Philip Chaney",
          salary: "$38,735",
          country: "Korea, South",
          city: "Gloucester"
        }
      ]
    };
  },
  methods: {
      createUserModal() {
          this.showCreateModal =  true;
      },
      onDialogClosed() {
          this.showCreateModal =  false;
      }
  }
};
</script>
