<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success">Update Profile</md-button>
                                <md-button class="md-raised md-success" @click="createMemberModal()">Add Member</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="members"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search for a member',
                            }">
                        </vue-good-table>
                    </md-card-content>
                </md-card>
                <member-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></member-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import MemberCreateComponent from './MemberCreateComponent.vue';

export default {
  name: "member-view-component",
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    }
  },
  components: {
      'member-create-component': MemberCreateComponent,
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
      members: [
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
      createMemberModal() {
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
