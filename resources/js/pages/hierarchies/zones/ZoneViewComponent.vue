<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-50 text-left">
                                <h4 class="md-title text-sucess">Parish Name: {{parish.name}}</h4>
                            </div>
                            <div class="md-layout-item md-size-50 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createZoneModal()">Add Zone</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="zones"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this zone',
                            }">
                            <template slot="table-row" slot-scope="props">
                                <span v-if="props.column.field == 'action'">
                                    <md-menu md-size="small" md-align-trigger>
                                        <md-button class="md-button md-just-icon md-simple" md-menu-trigger>
                                            <md-icon>menu</md-icon>
                                        </md-button>
                                        <md-menu-content>
                                            <md-menu-item @click="performAction('view', props.row)">
                                                <md-icon>visibility</md-icon>
                                                <span>View</span>
                                            </md-menu-item>
                                            <md-menu-item @click="performAction('edit', props.row)">
                                                <md-icon>edit</md-icon>
                                                <span>Edit</span>
                                            </md-menu-item>
                                            <md-menu-item @click="performAction('delete', props.row)">
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
                <zone-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                    :parishId="parish.id"
                ></zone-create-component>
                <zone-edit-component
                    v-if="zone.id"
                    :show-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                    :zone="zone"
                ></zone-edit-component>
            </div>
        </div>
  </div>
</template>
<script>
import ZoneCreateComponent from './ZoneCreateComponent.vue';
import ZoneEditComponent from './ZoneEditComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "zone-table",
  computed:{
      ...mapGetters([
        'zones',
        'zone',
        'showCreateDialog',
        'showEditDialog'
      ]),
  },
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    },
    parish: {
        type: Object,
        required: true,
    }
  },
  components: {
      'zone-create-component': ZoneCreateComponent,
      'zone-edit-component': ZoneEditComponent
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
          label: 'Zone Name',
          field: 'name',
        },
        {
          label: 'Zone Code',
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
      createZoneModal() {
           this.$store.commit('setShowCreateDialog', true);
      },
      onDialogClosed() {
            this.$store.commit('setShowEditDialog', false);
            this.$store.commit('setShowCreateDialog', false);
            this.loadZones();
      },
      loadZones() {
          this.$store.dispatch('loadZones', this.parish.id);
      },
      performAction(actionType, zone) {
        switch(actionType) {
        case 'view':
            window.location.assign('/dashboard/parishes/'+ this.parish.id + '/zones/' + zone.id);
            break;
        case 'edit':
            this.editModal(zone);
            break;
        case 'delete':
             this.deleteModal(zone);
            break;
        }
    },
    editModal(zone) {
        this.$store.commit('setZone', zone);
        this.$store.commit('setShowEditDialog', true);
    },
    deleteModal(zone) {

    }
  },
  created() {
      this.loadZones();
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
