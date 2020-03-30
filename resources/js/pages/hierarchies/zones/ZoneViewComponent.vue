<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-primary" @click="viewParishesModal()">View Parishes</md-button>
                                <md-button class="md-raised md-primary" @click="viewCommunitiesModal()">View Communities</md-button>
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
                                            <template v-if="isAdmin">
                                                <md-menu-item @click="performAction('edit', props.row)">
                                                    <md-icon>edit</md-icon>
                                                    <span>Edit</span>
                                                </md-menu-item>
                                                <md-menu-item @click="performAction('delete', props.row)">
                                                    <md-icon>delete</md-icon>
                                                    <span>Delete</span>
                                                </md-menu-item>
                                            </template>
                                        </md-menu-content>
                                    </md-menu>
                                </span>
                                <span v-else-if="props.column.field == 'parish'">
                                    {{props.row.parish.name}}
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
        auth: {
            type: Object,
            required: true
        },
        isAdmin: {
            type: Boolean,
            required: true
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
            label: 'Name',
            field: 'name',
            },
            {
            label: 'Code',
            field: 'code',
            },
            {
            label: 'Parish',
            field: 'parish',
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
        viewParishesModal() {
            window.location.assign('/dashboard/parishes');
        },
        viewCommunitiesModal() {
            window.location.assign('/dashboard/communities');
        },
        onDialogClosed() {
                this.$store.commit('setShowEditDialog', false);
                this.$store.commit('setShowCreateDialog', false);
                this.loadZones();
        },
        loadZones() {
            this.$store.dispatch('loadZones');
        },
        performAction(actionType, zone) {
            switch(actionType) {
            case 'view':
                window.location.assign('/dashboard/zones/' + zone.id);
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
