<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createGivingModal()">Add Giving</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="givings"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this giving',
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
                <giving-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                ></giving-create-component>
                <giving-edit-component
                    v-if="giving.id"
                    :giving="giving"
                    :show-edit-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                ></giving-edit-component>
            </div>
        </div>
  </div>
</template>
<script>
import GivingCreateComponent from './GivingCreateComponent.vue';
import GivingEditComponent from './GivingEditComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: "giving-view-table",
    computed:{
        ...mapGetters([
            'givings',
            'giving',
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
            'giving-create-component': GivingCreateComponent,
            'giving-edit-component': GivingEditComponent,
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
                label: 'Amount',
                field: 'amount',
                },
                {
                label: 'Max Amount',
                field: 'maxAmount',
                },
                {
                label: 'Min Amount',
                field: 'minAmount',
                },
                {
                label: 'Target Number',
                field: 'targetNumber',
                },
                {
                label: 'Action',
                field: 'action',
                }
            ],
        };
    },
    methods: {
        createGivingModal() {
            this.$store.commit('setShowCreateDialog', true);
        },
        onDialogClosed() {
            this.$store.commit('setShowEditDialog', false);
            this.$store.commit('setShowCreateDialog', false);
            this.loadGivings();
        },
        loadGivings() {
            this.$store.dispatch('loadGivings');
        },
        performAction(actionType, giving) {
            switch(actionType) {
            case 'view':
                window.location.assign('/dashboard/givings/'+ giving.id);
                break;
            case 'edit':
                this.editModal(giving);
                break;
            case 'delete':
                this.deleteModal(giving);
                break;
            }
        },
        editModal(giving) {
            this.$store.commit('setGiving', giving);
            this.$store.commit('setShowEditDialog', true);
        },
        deleteModal(giving) {

        }
    },
    created() {
        this.loadGivings();
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
