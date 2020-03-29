<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success">Update Profile</md-button>
                                <md-button class="md-raised md-success" @click="createUserModal()">Add User</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="users"
                            :line-numbers="true"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search for a user',
                            }">
                            <template slot="table-row" slot-scope="props">
                                <span v-if="props.column.field == 'fullName'">
                                   {{props.row.firstName}}  {{props.row.lastName}}
                                </span>
                                <span v-else-if="props.column.field == 'community'">
                                    {{props.row.community.name}}
                                </span>
                                <span v-else-if="props.column.field == 'zone'">
                                   {{props.row.community.zone.name}}
                                </span>
                                <span v-else-if="props.column.field == 'permissions'">
                                   {{getPermissions(props.row.roles)}}
                                </span>
                                <span v-else-if="props.column.field == 'action'">
                                    <md-menu md-size="small" md-align-trigger>
                                        <md-button class="md-button md-just-icon md-simple" md-menu-trigger>
                                            <md-icon>menu</md-icon>
                                        </md-button>
                                        <md-menu-content>
                                            <md-menu-item @click="performAction('view', props.row)" class="text-right">
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
                <user-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                ></user-create-component>
                <user-edit-component
                     v-if="user.id"
                    :show-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                    :user="user"
                ></user-edit-component>
                <dialog-confirm-component
                    :show-dialog = "showDeleteDialog"
                    @onActionConfirm = "onConfirm"
                ></dialog-confirm-component>
            </div>
        </div>
  </div>
</template>
<script>
import UserEditComponent from './UserEditComponent.vue';
import UserCreateComponent from './UserCreateComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: "user-view-component",
    props: {
            tableHeaderColor: {
            type: String,
            default: "green"
        }
    },
    computed:{
        ...mapGetters([
            'users',
            'user',
            'showCreateDialog',
            'showEditDialog',
            'showDeleteDialog',
        ]),
    },
    components: {
        'user-edit-component': UserEditComponent,
        'user-create-component': UserCreateComponent,
    },
    data() {
        return {
            selected: [],
            showCreateModal: false,
            columns: [
                {
                    label: 'Full Name',
                    field: 'fullName',
                    type: String
                },
                {
                    label: 'Username',
                    field: 'username',
                    tdClass: 'text-primary',
                    type: String,
                },
                {
                    label: 'Email',
                    field: 'email',
                    type: String
                },
                {
                    label: 'Phone Number',
                    field: 'phoneNumber',
                    type: String
                },
                {
                    label: 'Roles',
                    field: 'roles',
                    type: Array,
                    formatFn: this.getRoles,
                    width: '150px'
                },
                {
                    label: 'Permissions',
                    field: 'permissions',
                    tdClass: 'text-primary',
                    type: Array,
                    width: '230px'
                },
                {
                    label: 'Action',
                    field: 'action',
                    sortable: false,
                    type: String
                },
            ]
        };
    },
    methods: {
        getFullName(user){
            return user.firstName + ' ' + user.lastName;
        },
        createUserModal() {
            this.$store.commit('setShowCreateDialog', true);
        },
        getPermissions(roles) {
            let permissionsToDisp = '';
            for (var i = 0; i < roles.length; i++) {
                for (var j = 0; j < roles[i].permissions.length; j++) {
                    permissionsToDisp += roles[i].permissions[j].name;
                    if (j !== roles[i].permissions.length - 1) {
                        permissionsToDisp += ', ';
                    }
                }
            }
            return permissionsToDisp;
        },
        getRoles(roles) {
            let rolesToDisp = '';
            for (var i = 0; i < roles.length; i++) {
                rolesToDisp += roles[i].name;
                if (i !== roles.length - 1) {
                   rolesToDisp += ', ';
                }
            }
            return rolesToDisp;
        },
        onDialogClosed() {
            this.$store.commit('setShowDeleteDialog', false);
            this.$store.commit('setShowEditDialog', false);
            this.$store.commit('setShowCreateDialog', false);
            this.loadUsers();
        },
        loadUsers() {
            this.$store.dispatch('getUsers');
        },
        performAction(actionType, user) {
            switch(actionType) {
                case 'view':
                    window.location.assign('/dashboard/users/'+ user.id);
                    break;
                case 'edit':
                    this.editModal(user);
                    break;
                case 'delete':
                    this.deleteModal(user);
                    break;
            }
        },
        editModal(user) {
            this.$store.commit('setUser', user);
            setTimeout(()=> {
                 this.$store.commit('setShowEditDialog', true);
            }, 100)

        },
        deleteModal(user) {
            this.$store.commit('setUser', user);
            this.$store.commit('setShowDeleteDialog', true);
        },
        onConfirm(event) {
            this.$store.commit('setShowDeleteDialog', false);
            if (event.confirmed) {
                this.$store.dispatch('deleteUser', this.user).then((response) => {
                    this.loadUsers();
                }).catch((error) => {
                    console.log(error);
                });
            }
        }
    },
    created() {
        this.loadUsers();
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
