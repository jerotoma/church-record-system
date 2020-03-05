<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createGivingModal()">Add Giving</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="givings"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this giving',
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
                <giving-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></giving-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import GivingCreateComponent from './GivingCreateComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "giving-table",
  computed:{
      ...mapGetters([
          'givings',
      ]),
  },
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    }
  },
  components: {
      'giving-create-component': GivingCreateComponent,
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
          label: 'Giving Name',
          field: 'name',
        },
        {
          label: 'Giving Code',
          field: 'code',
        },
        {
          label: 'Action',
          field: 'action',
        }
      ],
    };
  },
  methods: {
    createGivingModal() {
        this.showCreateModal =  true;
    },
    onDialogClosed() {
        this.showCreateModal =  false;
        this.loadGivings();
    },
    loadGivings() {
        this.$store.dispatch('loadGivings');
    },
    performAction(actionType, givingId) {
        switch(actionType) {
        case 'view':
            window.location.assign('/dashboard/givings/'+ givingId);
            break;
        case 'edit':
            this.editModal(givingId);
            break;
        case 'delete':
             this.deleteModal(givingId);
            break;
        }
    },
    editModal(givingId) {

    },
    deleteModal(givingId) {

    }
  },
  created() {
      this.loadGivings();
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
