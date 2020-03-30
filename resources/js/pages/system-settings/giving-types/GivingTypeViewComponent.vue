<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createGivingModal()">Add Giving Type</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="givingTypes"
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
                <giving-type-create-component
                    :show-dialog = "showCreateDialog"
                    @onDialogClose = "onDialogClosed"
                ></giving-type-create-component>
                <giving-type-edit-component
                    v-if="givingType.id"
                    :givingType="givingType"
                    :show-edit-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                ></giving-type-edit-component>
            </div>
        </div>
  </div>
</template>
<script>
import GivingTypeCreateComponent from './GivingTypeCreateComponent.vue';
import GivingTypeEditComponent from './GivingTypeEditComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: "giving-view-table",
    computed:{
        ...mapGetters([
            'givingTypes',
            'givingType',
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
            'giving-type-create-component': GivingTypeCreateComponent,
            'giving-type-edit-component': GivingTypeEditComponent,
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
            this.$store.dispatch('loadGivingTypes');
        },
        performAction(actionType, givingType) {
            switch(actionType) {
            case 'view':
                window.location.assign('/dashboard/giving-types/'+ givingType.id);
                break;
            case 'edit':
                this.editModal(givingType);
                break;
            case 'delete':
                this.deleteModal(givingType);
                break;
            }
        },
        editModal(givingType) {
            this.$store.commit('setGivingType', givingType);
            this.$store.commit('setShowEditDialog', true);
        },
        deleteModal(givingType) {

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
