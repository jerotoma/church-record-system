<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="importMember()">Import Members</md-button>
                                <md-button class="md-raised md-success" @click="createMemberModal()">Add Member</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            mode="remote"
                            @on-page-change="onPageChange"
                            @on-sort-change="onSortChange"
                            @on-column-filter="onColumnFilter"
                            @on-per-page-change="onPerPageChange"
                            :line-numbers="true"
                            :totalRows="pagination.total"
                            :isLoading.sync="mLoading"
                            :columns="columns"
                            :rows="members"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search for a member',
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
                <member-import-component
                    :show-dialog = "showImportDialog"
                    @onDialogClose = "onDialogClosed"
                ></member-import-component>
                <member-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                ></member-create-component>
                <member-edit-component
                     v-if="member.id"
                    :show-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                    :member="member"
                ></member-edit-component>
                <dialog-confirm-component
                    :show-dialog = "showDeleteDialog"
                    @onActionConfirm = "onConfirm"
                ></dialog-confirm-component>
            </div>
        </div>
  </div>
</template>
<script>
import MemberEditComponent from './MemberEditComponent.vue';
import MemberCreateComponent from './MemberCreateComponent.vue';
import MemberImportComponent from './MemberImportComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: "member-view-component",
    props: {
            tableHeaderColor: {
            type: String,
            default: "green"
        }
    },
    computed:{
        ...mapGetters([
            'members',
            'member',
            'showCreateDialog',
            'showEditDialog',
            'showDeleteDialog',
            'isLoading',
            'pagination',
        ]),
        mLoading: {
            get() { return this.isLoading; },
            set(value){
                this.$store.commit('setLoading', value);
            }
        }
    },
    components: {
        'member-edit-component': MemberEditComponent,
        'member-create-component': MemberCreateComponent,
        'member-import-component': MemberImportComponent,
    },
    data() {
        return {
            selected: [],
            showCreateModal: false,
            showImportDialog: false,
            columns: [
                {
                    label: 'Full Name',
                    field: 'fullName',
                    type: String
                },
                {
                    label: 'Gender',
                    field: 'gender',
                    type: String
                },
                {
                    label: 'Phone Number',
                    field: 'phoneNumber',
                    type: String
                },
                {
                    label: 'Community',
                    field: 'community',
                    type: Object,
                },
                {
                    label: 'Zone',
                    field: 'zone',
                    type: Object,
                },
                {
                    label: 'Action',
                    field: 'action',
                    type: String,
                    filterable: false,
                    sortable: false,
                },
            ]
        };
    },
    methods: {
        getFullName(member){
            return member.firstName + ' ' + member.lastName;
        },
        createMemberModal() {
            this.$store.commit('setShowCreateDialog', true);
        },
        onDialogClosed() {
            this.showImportDialog = false;
            this.$store.commit('setShowDeleteDialog', false);
            this.$store.commit('setShowEditDialog', false);
            this.$store.commit('setShowCreateDialog', false);
            this.loadMembers();
        },
        loadMembers() {
            this.$store.dispatch('getMembers', this.pagination);
        },
        onPageChange(params){
            //console.log('onPageChange', params);
            this.updateParams(params);
        },
        onSortChange(params) {
            let pagination = this.pagination;
            pagination.sortType = params[0].type;
            pagination.sortField = params[0].field;
            this.$store.commit('setPagination', pagination);
            this.loadMembers();
        },
        onColumnFilter(params) {
            console.log('onColumnFilter', params[0]);
            //this.updateParams(params[]);
        },
        onPerPageChange(params) {
            //console.log('onPerPageChange', params);
            this.updateParams(params);
        },
        updateParams(params) {
            let pagination = this.pagination;
            pagination.currentPage = params.currentPage;
            pagination.perPage = params.currentPerPage;
            pagination.prevPage = params.prevPage;
            this.$store.commit('setPagination', pagination);
            this.loadMembers();
        },
        performAction(actionType, member) {
            switch(actionType) {
                case 'view':
                    window.location.assign('/dashboard/members/'+ member.id);
                    break;
                case 'edit':
                    this.editModal(member);
                    break;
                case 'delete':
                    this.deleteModal(member);
                    break;
            }
        },
        editModal(member) {
            this.$store.commit('setMember', member);
            setTimeout(()=> {
                 this.$store.commit('setShowEditDialog', true);
            }, 100)

        },
        deleteModal(member) {
            this.$store.commit('setMember', member);
            this.$store.commit('setShowDeleteDialog', true);
        },
        onConfirm(event) {
            this.$store.commit('setShowDeleteDialog', false);
            if (event.confirmed) {
                this.$store.dispatch('deleteMember', this.member).then((response) => {
                    this.loadMembers();
                }).catch((error) => {
                    console.log(error);
                });
            }
        },
        importMember() {
            this.showImportDialog = true;
        }
    },
    created() {
        this.loadMembers();
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
