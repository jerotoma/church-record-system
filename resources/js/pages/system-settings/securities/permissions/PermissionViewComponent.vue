<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createPermissionModal()">Add Permission</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="mPermissions"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this giving type',
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
                                <span v-else>
                                {{props.formattedRow[props.column.field]}}
                                </span>
                            </template>
                        </vue-good-table>
                    </md-card-content>
                </md-card>
                <permission-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                ></permission-create-component>
                <permission-edit-component
                    v-if="permission.id"
                    :permission="permission"
                    :show-edit-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                ></permission-edit-component>
            </div>
        </div>
  </div>
</template>
<script>
import PermissionCreateComponent from './PermissionCreateComponent.vue';
import PermissionEditComponent from './PermissionEditComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: "permission-view-component",
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
    computed:{
        ...mapGetters([
            'permission',
        ]),
        mPermissions: {
           get(){
             return this.$store.getters.permissions;
           },
           set(value){
             return this.$store.commit('setPermissions', value);
           }
        }
    },
    components: {
        'permission-create-component': PermissionCreateComponent,
        'permission-edit-component': PermissionEditComponent,
    },
    data() {
        return {
            showCreateDialog: false,
            showEditDialog: false,
            selected: [],
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
                label: 'Slug',
                field: 'slug',
                },
                {
                label: 'Model',
                field: 'model',
                },
                {
                label: 'Description',
                field: 'description',
                },
                {
                label: 'Action',
                field: 'action',
                }
            ],
        };
    },
    methods: {
        createPermissionModal() {
            this.showCreateDialog = true;
            //this.$store.commit('setShowCreateDialog', true);
        },
        onDialogClosed() {
            this.showCreateDialog = false;
            this.showEditDialog = false;
            this.loadPermissions();
        },
        loadPermissions() {
            this.$store.dispatch('loadPermissions');
        },
        performAction(actionType, permission) {
            switch(actionType) {
            case 'view':
                window.location.assign('/dashboard/permissions/'+ permission.id);
                break;
            case 'edit':
                this.editModal(permission);
                break;
            case 'delete':
                this.deleteModal(permission);
                break;
            }
        },
        editModal(permission) {
            this.$store.commit('setPermission', permission);
            this.showEditDialog = true;
        },
        deleteModal(permission) {

        }
    },
    created() {
        this.loadPermissions();
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
    .md-tabs-content table thead {
        display: table-header-group;
    }
</style>
