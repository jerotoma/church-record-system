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
                <community-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                    :zone="zone"
                ></community-create-component>
                <community-edit-component
                    v-if="community.id"
                    :show-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                    :community="community"
                ></community-edit-component>
            </div>
        </div>
  </div>
</template>
<script>
import CommunityCreateComponent from './CommunityCreateComponent.vue';
import CommunityEditComponent from './CommunityEditComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "community-view-commponent",
  computed:{
      ...mapGetters([
        'communities',
        'community',
        'showCreateDialog',
        'showEditDialog'
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
    'community-edit-component': CommunityEditComponent,
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
           this.$store.commit('setShowCreateDialog', true);
      },
      onDialogClosed() {
            this.$store.commit('setShowEditDialog', false);
            this.$store.commit('setShowCreateDialog', false);
            this.loadCommunities();
      },
      loadCommunities() {
          this.$store.dispatch('loadCommunities', this.zone);
      },
      performAction(actionType, community) {
        switch(actionType) {
        case 'edit':
            this.editModal(community);
            break;
        case 'delete':
             this.deleteModal(community);
            break;
        }
    },
    editModal(community) {
        this.$store.commit('setCommunity', community);
        this.$store.commit('setShowEditDialog', true);
    },
    deleteModal(parish) {

    }
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
    .md-ripple > span {
        position: relative;
    }
</style>
