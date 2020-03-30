<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-50 text-right">
                                <div class="md-layout">

                                </div>
                            </div>
                            <div class="md-layout-item md-size-50 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createGivingModal()">Add Giving</md-button>
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
                            :rows="givings"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this giving',
                            }"
                            :pagination-options="{
                                enabled: true,
                                mode: 'records',
                                setCurrentPage: pagination.currentPage,
                                perPage: pagination.perPage,
                                perPageDropdown: [15, 30, 45, 60],
                            }">
                            <div slot="table-actions">
                                <div class="md-layout">
                                    <div class="md-layout-item md-medium-size-40 md-xsmall-size-40 md-size-40">
                                        <div class="md-title">Filter By</div>
                                    </div>
                                    <div class="md-layout-item md-medium-size-60 md-xsmall-size-60 md-size-60">
                                        <md-field>
                                            <md-select
                                                @md-selected="loadGivings()"
                                                v-model="givingTypeId"
                                                name="givingTypeId"
                                                id="givingType"
                                                placeholder='Giving Type'>
                                                <md-option
                                                    v-for="givingType in givingTypes"
                                                    :key="givingType.id"
                                                    :value="givingType.id">
                                                        {{givingType.name}}
                                                </md-option>
                                                <md-option :value="0">All</md-option>
                                            </md-select>
                                        </md-field>
                                    </div>
                                </div>
                            </div>
                            <template slot="table-row" slot-scope="props">
                                <span v-if="props.column.field == 'action'">
                                    <md-menu md-size="small" md-align-trigger>
                                        <md-button class="md-button md-just-icon md-simple text-success" md-menu-trigger>
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
                                <span v-else-if="props.column.field == 'datePaid'">
                                    <span class="text-primary">{{props.row.datePaid | moment("MMMM Do, YYYY")}}</span>
                                </span>
                                 <span v-else-if="props.column.field == 'givingType'">
                                    <span class="text-primary">{{props.row.givingType.name}}</span>
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
                    :show-dialog = "showEditDialog"
                    @onDialogClose = "onDialogClosed"
                    :giving="giving"
                ></giving-edit-component>
                 <dialog-confirm-component
                    :show-dialog = "showDeleteDialog"
                    @onActionConfirm = "onConfirm"
                ></dialog-confirm-component>
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
        'isLoading',
        'givingTypes',
        'pagination',
        'filterBy',
        'showCreateDialog',
        'showEditDialog',
        'showDeleteDialog',
      ]),
      mLoading: {
          get() { return this.isLoading; },
          set(value){
              this.$store.commit('setLoading', value);
          }
      }
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
    'giving-edit-component': GivingEditComponent,
    'giving-create-component': GivingCreateComponent,
  },
  data() {
    return {
      selected: [],
      givingTypeId: null,
      columns: [
        {
          label: 'Full Name',
          field: 'fullName',
        },
        {
          label: 'Amount',
          field: 'amount',
          tdClass: 'text-primary',
          formatFn: this.formatAmountSign,
        },
        {
          label: 'Giving Type',
          field: 'givingType',
          filterable: false,
          sortable: true,
        },
        {
          label: 'Zone',
          field: 'zone',
          filterable: false,
          sortable: true,
        },
        {
          label: 'Community',
          field: 'community',
          filterable: false,
          sortable: true,
        },
        {
          label: 'Date Paid',
          field: 'datePaid',
          tdClass: 'text-primary',
        },
        {
            label: 'Action',
            field: 'action',
            filterable: false,
            sortable: false,
            tdClass: 'text-success'
        }
      ],
    };
  },
  methods: {
    formatAmountSign(amount){
        return 'Tsh' + amount + '/=';
    },
    createGivingModal() {
        this.$store.commit('setShowCreateDialog', true);
    },
    onDialogClosed() {
        this.$store.commit('setShowDeleteDialog', false);
        this.$store.commit('setShowEditDialog', false);
        this.$store.commit('setShowCreateDialog', false);
        this.loadGivings();
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
        this.$store.commit('setShowCreateDialog', false);
        this.$store.commit('setShowDeleteDialog', false);
        this.$store.commit('setShowEditDialog', true);
    },
    deleteModal(giving) {
        this.$store.commit('setGiving', giving);
        this.$store.commit('setShowCreateDialog', false);
        this.$store.commit('setShowEditDialog', false);
        this.$store.commit('setShowDeleteDialog', true);
    },
    onConfirm(event) {
        this.$store.commit('setShowDeleteDialog', false);
        if (event.confirmed) {
            this.$store.dispatch('deleteGiving', this.giving).then((response) => {
                this.loadGivings();
            }).catch((error) => {
                console.log(error);
            });
        }
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
        this.loadGivings();
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
        this.loadGivings();
    },
    loadGivings() {
        if (this.givingTypeId == 0 || this.givingTypeId == null) {
            this.$store.dispatch('loadGivings', this.pagination);
        } else {
            this.$store.dispatch('loadGivingsByGivingType', {
                givingTypeId: this.givingTypeId,
                pagination: this.pagination
            });
        }
    },
  },
  created() {
      this.loadGivings();
      this.$store.dispatch('loadGivingTypes');
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
    .md-button.md-simple {
        box-shadow: 0 2px 2px 0 rgba(153, 153, 153, 0.14), 0 3px 1px -2px rgba(153, 153, 153, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);
        background-color:rgb(76, 175, 80);
        color: #FFF;
    }
    .md-field {
        width: 100%;
        height: 30px;
        min-height: 25px;
        margin: 0px;
        padding: 0px .52em;
        display: flex;
        position: relative;
        font-family: inherit;
        background-color: #FFF;
    }
    .md-field.md-has-placeholder .md-input,
    .md-field .md-input,
    .md-field .md-textarea {
        height: 32px;
        padding: 5px 0;
        font-size: 14px !important;
        -webkit-text-fill-color: #495057 !important;
    }
</style>
