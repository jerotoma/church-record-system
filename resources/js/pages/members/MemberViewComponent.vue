<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success">Update Profile</md-button>
                                <md-button class="md-raised md-success" @click="createMemberModal()">Add Member</md-button>
                            </div>
                        </div>
                        <vue-good-table
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
                                            <md-menu-item @click="performAction('view', props.row.id)" class="text-right">
                                                <md-icon>visibility</md-icon>
                                                <span>View</span>
                                            </md-menu-item>
                                            <md-menu-item @click="performAction('edit', props.row.id)">
                                                <md-icon>edit</md-icon>
                                                <span>Edit</span>
                                            </md-menu-item>
                                            <md-menu-item @click="performAction('delete', props.row.id)">
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
                <member-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></member-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import MemberCreateComponent from './MemberCreateComponent.vue';
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
        ]),
    },
    components: {
        'member-create-component': MemberCreateComponent,
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
                    type: String
                },
            ]
        };
    },
    methods: {
        getFullName(member){
            return member.firstName + ' ' + member.lastName;
        },
        createMemberModal() {
            this.showCreateModal =  true;
        },
        onDialogClosed() {
            this.showCreateModal =  false;
        },
        loadMembers() {
            this.$store.dispatch('getMembers');
        },
        performAction(actionType, memberId) {
            switch(actionType) {
                case 'view':
                    window.location.assign('/dashboard/members/'+ memberId);
                    break;
                case 'edit':
                    this.editModal(memberId);
                    break;
                case 'delete':
                    this.deleteModal(memberId);
                    break;
            }
        },
        editModal(memberId) {

        },
        deleteModal(memberId) {

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
