<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createRoleModal()">Add Role</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="roles"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this role',
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
                <role-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                ></role-create-component>
                <role-edit-component
                    v-if="role.id"
                    :role="role"
                    :show-edit-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                ></role-edit-component>
            </div>
        </div>
  </div>
</template>
<script>
import RoleCreateComponent from './RoleCreateComponent.vue';
import RoleEditComponent from './RoleEditComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: "role-view-component",
    computed:{
        ...mapGetters([
            'roles',
            'role',
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
        'role-create-component': RoleCreateComponent,
        'role-edit-component': RoleEditComponent,
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
                label: 'Level',
                field: 'level',
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
        createRoleModal() {
            this.showCreateDialog = true;
            //this.$store.commit('setShowCreateDialog', true);
        },
        onDialogClosed() {
            this.showCreateDialog = false;
            this.showEditDialog = false;
            //this.$store.commit('setShowEditDialog', false);
            //this.$store.commit('setShowCreateDialog', false);
            this.loadRoles();
        },
        loadRoles() {
            this.$store.dispatch('loadRoles');
        },
        performAction(actionType, role) {
            switch(actionType) {
            case 'view':
                window.location.assign('/dashboard/roles/'+ role.id);
                break;
            case 'edit':
                this.editModal(role);
                break;
            case 'delete':
                this.deleteModal(role);
                break;
            }
        },
        editModal(role) {
            this.$store.commit('setRole', role);
            //this.$store.commit('setShowEditDialog', true);
            this.showEditDialog = true;
        },
        deleteModal(role) {

        }
    },
    created() {
        this.loadRoles();
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
