<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success">Update Profile</md-button>
                                <md-button class="md-raised md-success" @click="createUserModal()">Add User</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="users"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this table',
                            }">
                        </vue-good-table>
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
      columns: [
        {
          label: 'ID',
          field: 'id',
          type: Number
        },
        {
          label: 'Full Name',
          field: 'fullName',
        },
        {
          label: 'Gender',
          field: 'gender',
        },
        {
          label: 'Phone Number',
          field: 'phoneNumber',
        },
        {
          label: 'Community',
          field: 'community',
        },
        {
          label: 'Zone',
          field: 'zone',
        },
      ],
      users: [
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },
        {
          id: 1,
          fullName: "Dakota Rice",
          gender: "Male",
          phoneNumber: "+255768908785",
          community: "St. Micheal Community",
          zone: "St. Marry Zone"
        },

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
<style scoped>
    .main-panel > .content {
        padding:0;
    }
</style>
