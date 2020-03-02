<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
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
                                            <md-menu-item>
                                                <md-icon>visibility</md-icon>
                                                <span>View</span>
                                            </md-menu-item>
                                            <md-menu-item>
                                                <md-icon>edit</md-icon>
                                                <span>Edit</span>
                                            </md-menu-item>
                                            <md-menu-item>
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
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></zone-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import ZoneCreateComponent from './ZoneCreateComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "zone-table",
  computed:{
      ...mapGetters([
          'zones',
      ]),
  },
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    },
    parishName: {
        type: String,
        required: true,
    },
    parishId: {
        type: Number,
        required: true,
    }
  },
  components: {
      'zone-create-component': ZoneCreateComponent,
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
          this.showCreateModal =  true;
      },
      onDialogClosed() {
          this.showCreateModal =  false;
          this.loadZones();
      },
      loadZones() {
          this.$store.dispatch('loadZones');
      },
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
</style>
