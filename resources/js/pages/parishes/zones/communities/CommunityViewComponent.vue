<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createCommunityModal()">Add Community</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="communities"
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
                <community-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                    :zone="zone"
                ></community-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import CommunityCreateComponent from './CommunityCreateComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "community-view-commponent",
  computed:{
      ...mapGetters([
          'communities',
      ]),
  },
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    },
    zone: {
        type: Object,
        required: true,
        default: null,
    }
  },
  components: {
      'community-create-component': CommunityCreateComponent,
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
          label: 'Community Name',
          field: 'name',
        },
        {
          label: 'Community Code',
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
      createCommunityModal() {
          this.showCreateModal =  true;
      },
      onDialogClosed() {
          this.showCreateModal =  false;
          this.loadCommunities();
      },
      loadCommunities() {
          this.$store.dispatch('loadCommunities', this.zone);
      },
  },
  created() {
      this.loadCommunities();
  }
};
</script>
<style scoped>
    .main-panel > .content {
        padding:0;
    }
</style>
