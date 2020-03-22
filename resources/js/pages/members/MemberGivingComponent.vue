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
                                <span v-if="props.column.field == 'datePaid'">
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
            </div>
        </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  name: "member-giving-component",
  computed:{
      ...mapGetters([
        'givings',
        'giving',
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
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    },
    member: {
        type: Object,
        required: true,
    }
  },
  data() {
    return {
      selected: [],
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
      ],
    };
  },
  methods: {
    formatAmountSign(amount){
        return 'Tsh' + amount + '/=';
    },
    loadGivingsByMemberId() {
        this.$store.dispatch('loadGivingsByMemberId', {
            memberId: this.member.id,
            pagination: this.pagination
        });
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
        this.loadGivingsByMemberId();
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
        this.loadGivingsByMemberId();
    },
    filterColumn(){
        this.columns.filter(column => column.field !== 'action');
    }
  },
  created() {
    this.filterColumn();
    this.loadGivingsByMemberId();

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
