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
                            :rows="permissions"
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
    computed:{
        ...mapGetters([
            'permissions',
            'permission',
            'showCreateDialog',
            'showEditDialog'
        ]),
    },
    props: {
        tableHeaderColor: {
        type: String,
        default: "green"
        }
    },
    components: {
        'permission-create-component': PermissionCreateComponent,
        'permission-edit-component': PermissionEditComponent,
    },
    data() {
        return {
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
                label: 'Level',
                field: 'level',
                },
                {
                label: 'Model',
                field: 'model',
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
            this.$store.commit('setShowCreateDialog', true);
        },
        onDialogClosed() {
            this.$store.commit('setShowEditDialog', false);
            this.$store.commit('setShowCreateDialog', false);
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
            this.$store.commit('setShowEditDialog', true);
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
