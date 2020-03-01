<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                   <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-size-100 text-right" style="padding-right:0;">
                                <md-button class="md-raised md-success" @click="createParishModal()">Add Parish</md-button>
                            </div>
                        </div>
                        <vue-good-table
                            :columns="columns"
                            :rows="parishes"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Search this parish',
                            }">
                        </vue-good-table>
                    </md-card-content>
                </md-card>
                <parish-create-component
                    :show-dialog = "showCreateModal"
                    @onDialogClose = "onDialogClosed"
                ></parish-create-component>
            </div>
        </div>
  </div>
</template>
<script>
import ParishCreateComponent from './ParishCreateComponent.vue';
export default {
  name: "parish-table",
  props: {
    tableHeaderColor: {
      type: String,
      default: "green"
    }
  },
  components: {
      'parish-create-component': ParishCreateComponent,
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
          label: 'Parish Name',
          field: 'parishName',
        },
        {
          label: 'Parish Code',
          field: 'parishCode',
        }
      ],
      parishes: [
        {
          id: 1,
          parishName: "St. Pauls",
          parishCode: "ST-89",
        },
        {
          id: 1,
          parishName: "St. Pauls",
          parishCode: "ST-89",
        },
        {
          id: 1,
          parishName: "St. Pauls",
          parishCode: "ST-89",
        },
      ]
    };
  },
  methods: {
      createParishModal() {
          this.showCreateModal =  true;
      },
      onDialogClosed() {
          this.showCreateModal =  false;
      }
  }
};
</script>
<style scoped>
    .main-panel > .content {
        padding:0;
    }
</style>
