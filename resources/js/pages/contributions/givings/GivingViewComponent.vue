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

                            </div>
                            <template slot="table-row" slot-scope="props">
                                <span v-if="props.column.field == 'action'">
                                    <md-menu md-size="small" md-align-trigger>
                                        <md-button class="md-button md-just-icon md-simple text-success" md-menu-trigger>
                                            <md-icon>menu</md-icon>
                                        </md-button>
                                        <md-menu-content>
                                            <md-menu-item @click="performAction('view', props.row.id)">
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
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></giving-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import GivingCreateComponent from './GivingCreateComponent.vue';
import { mapGetters } from 'vuex';


export default {
  name: "giving-view-table",
  computed:{
      ...mapGetters([
          'givings',
          'isLoading',
          'pagination'
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
    }
  },
  components: {
      'giving-create-component': GivingCreateComponent,
  },
  data() {
    return {
      selected: [],
      showCreateModal: false,
      givingType: '',
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
          sortable: false,
        },
        {
          label: 'Zone',
          field: 'zone',
          filterable: false,
          sortable: false,
        },
        {
          label: 'Community',
          field: 'community',
          filterable: false,
          sortable: false,
        },
        {
          label: 'Date Paid',
          field: 'datePaid',
          tdClass: 'text-primary',
        },
        {
            label: 'Action',
            field: 'action',
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
        this.showCreateModal =  true;
    },
    onDialogClosed() {
        this.showCreateModal =  false;
        this.loadGivings();
    },
    loadGivings() {
        this.$store.dispatch('loadGivings', this.pagination);
    },
    performAction(actionType, givingId) {
        switch(actionType) {
        case 'view':
            window.location.assign('/dashboard/givings/'+ givingId);
            break;
        case 'edit':
            this.editModal(givingId);
            break;
        case 'delete':
             this.deleteModal(givingId);
            break;
        }
    },
    editModal(givingId) {

    },
    deleteModal(givingId) {

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
    .md-button.md-simple {
        box-shadow: 0 2px 2px 0 rgba(153, 153, 153, 0.14), 0 3px 1px -2px rgba(153, 153, 153, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);
        background-color:rgb(76, 175, 80);
        color: #FFF;
    }
</style>
