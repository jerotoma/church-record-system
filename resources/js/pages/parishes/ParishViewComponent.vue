<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createParishModal()">Add Parish</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="parishes"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this parish',
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
                <parish-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></parish-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import ParishCreateComponent from './ParishCreateComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "parish-table",
  computed:{
      ...mapGetters([
          'parishes',
      ]),
  },
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    }
  },
  components: {
      'parish-create-component': ParishCreateComponent,
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
          label: 'Parish Name',
          field: 'name',
        },
        {
          label: 'Parish Code',
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
    createParishModal() {
        this.showCreateModal =  true;
    },
    onDialogClosed() {
        this.showCreateModal =  false;
        this.loadPolishes();
    },
    loadPolishes() {
        this.$store.dispatch('loadParishes');
    },
    performAction(actionType, parishId) {
        switch(actionType) {
        case 'view':
            window.location.assign('/dashboard/parishes/'+ parishId);
            break;
        case 'edit':
            this.editModal(parishId);
            break;
        case 'delete':
             this.deleteModal(parishId);
            break;
        }
    },
    editModal(parishId) {

    },
    deleteModal(parishId) {

    }
  },
  created() {
      this.loadPolishes();
  }
};
</script>
<style scoped>
    .main-panel > .content {
        padding:0;
    }
</style>
