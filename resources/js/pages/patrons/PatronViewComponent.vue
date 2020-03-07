<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createPatronModal()">Add Patron</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="patrons"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this patron',
                            }">
                            <template slot="table-row" slot-scope="props">
                                <span v-if="props.column.field == 'action'">
                                    <md-menu md-size="small" md-align-trigger>
                                        <md-button class="md-button md-just-icon md-simple" md-menu-trigger>
                                            <md-icon>menu</md-icon>
                                        </md-button>
                                        <md-menu-content>
                                            <md-menu-item @click="performAction('view', props.row.id)">
                                                <md-icon>visibility</md-icon>
                                                <span>View</span>
                                            </md-menu-item>
                                            <md-menu-item @click="performAction('edit', props.row.id)">
                                                <md-icon>edit</md-icon>
                                                <span>Edit</span>
                                            </md-menu-item>
                                            <md-menu-item @click="performAction('delete', props.row.id)">
                                                <md-icon>delete</md-icon>
                                                <span>Delete</span>
                                            </md-menu-item>
                                        </md-menu-content>
                                    </md-menu>
                                </span>
                                <span v-else>
                                {{props.formattedRow[props.column.field]}}
                                </span>
                            </template>
                        </vue-good-table>
                    </md-card-content>
                </md-card>
                <patron-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></patron-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import PatronCreateComponent from './PatronCreateComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "patron-table",
  computed:{
      ...mapGetters([
          'patrons',
      ]),
  },
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    }
  },
  components: {
      'patron-create-component': PatronCreateComponent,
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
          label: 'Amount',
          field: 'amount',
        },
        {
          label: 'Giving Type',
          field: 'givingType',
        },
        {
          label: 'Zone',
          field: 'zone',
        },
        {
          label: 'Community',
          field: 'community',
        },
        {
          label: 'Date Paid',
          field: 'datePaid',
        },
        {
          label: 'Action',
          field: 'action',
        }
      ],
    };
  },
  methods: {
    createPatronModal() {
        this.showCreateModal =  true;
    },
    onDialogClosed() {
        this.showCreateModal =  false;
        this.loadPatrons();
    },
    loadPatrons() {
        this.$store.dispatch('loadPatrons');
    },
    performAction(actionType, patronId) {
        switch(actionType) {
        case 'view':
            window.location.assign('/dashboard/patrons/'+ patronId);
            break;
        case 'edit':
            this.editModal(patronId);
            break;
        case 'delete':
             this.deleteModal(patronId);
            break;
        }
    },
    editModal(patronId) {

    },
    deleteModal(patronId) {

    }
  },
  created() {
      this.loadPatrons();
  }
};
</script>
<style scoped>
    .main-panel > .content {
        padding:0;
    }
    .md-ripple > span {
        position: relative;
    }
</style>
