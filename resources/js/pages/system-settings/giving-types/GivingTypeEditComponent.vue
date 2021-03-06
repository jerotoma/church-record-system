<template>
  <div style="width:750px;">
        <md-dialog
            @md-closed="closeDialog()"
            @md-opened="$dialog.disableDocBodyOverflow()"
            :md-click-outside-to-close="false"
            :md-active.sync="showEditDialog">
            <md-dialog-content>
                <form novalidate class="md-layout" @submit.prevent="validateUser()">
                    <md-card>
                        <md-card-header  :data-background-color="dataBackgroundColor">
                            <div class="md-title">Edit Giving Type</div>
                            <div class="md-subhead">Please fill all required details</div>
                        </md-card-header>
                        <md-card-content>
                            <md-content class="md-scrollbar">
                                <div class="md-layout">
                                    <div class="md-layout-item md-small-size-100 md-size-100">
                                        <md-field :class="getValidationClass('name')">
                                            <label for="form-fname">Name</label>
                                            <md-input id="form-name" v-model="form.name" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.name.required">The name is required</span>
                                            <span class="md-error" v-else-if="!$v.form.name.minlength">Invalid giving name</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('amount')">
                                            <label for="form-amount">Amount</label>
                                            <md-input id="form-amount" v-model="form.amount" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.amount.required">The amount is required</span>
                                            <span class="md-error" v-else-if="!$v.form.amount.minlength">Invalid giving</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('targetNumber')">
                                            <label for="form-targetNumber">Target Number</label>
                                            <md-input id="form-targetNumber" v-model="form.targetNumber" type="number" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.targetNumber.required">The target number is required</span>
                                            <span class="md-error" v-else-if="!$v.form.targetNumber.minlength">Invalid target number</span>
                                        </md-field>
                                    </div>
                                </div>
                                <div class="md-layout">
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('minAmount')">
                                            <label for="form-minAmount">Minimum amount</label>
                                            <md-input id="form-minAmount" v-model="form.minAmount" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.minAmount.required">The minimum amount is required</span>
                                            <span class="md-error" v-else-if="!$v.form.minAmount.minlength">Invalid minimum amount</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('maxAmount')">
                                            <label for="form-max-amount" >Maximum amount</label>
                                            <md-input id="form-max-amount" v-model="form.maxAmount" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.maxAmount.required">The maximum amount is required</span>
                                            <span class="md-error" v-else-if="!$v.form.maxAmount.minlength">Invalid maximum amount</span>
                                        </md-field>
                                    </div>
                                </div>
                                <div class="md-layout">
                                    <div class="md-layout-item md-small-size-100 md-size-100">
                                        <md-field :class="getValidationClass('description')">
                                            <label for="form-description">Description</label>
                                            <md-input id="form-description" v-model="form.description" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.description.required">The description is required</span>
                                            <span class="md-error" v-else-if="!$v.form.description.minlength">Invalid giving description</span>
                                        </md-field>
                                    </div>
                                </div>
                            </md-content>
                        </md-card-content>
                        <md-card-actions>
                            <md-button class="md-danger" @click="closeDialog()">Close</md-button>
                            <md-button type="submit" class="md-primary" :disabled="isLoading">Save Changes</md-button>
                        </md-card-actions>
                    </md-card>
                    <md-snackbar
                        md-position="center"
                        :md-duration="80000"
                        class="md-accent md-position-top"
                        :md-active.sync="hasMessage">
                            <span> {{ message }}! </span>
                            <md-button class="md-primary md-just-icon md-simple" @click="closeSnackBar()">
                                <md-icon>close</md-icon>
                            </md-button>
                    </md-snackbar>
                </form>
            </md-dialog-content>
        </md-dialog>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { givingTypeRequiredFields } from './giving-type-form-criteria';
import { mapGetters } from 'vuex';

export default {
    name: 'giving-type-edit-component',
    mixins: [validationMixin],
    computed: {
        ...mapGetters([
            'isLoading',
            'message',
            'isMessage'
        ]),
        hasMessage: {
            get(){return this.isMessage; },
            set(value) { this.$store.commit('setHasMessage', value);}
        }
    },
    props: {
        showEditDialog: {
            type: Boolean,
            default: false,
        },
        dataBackgroundColor: {
            type: String,
            default: 'green'
        },
        givingType: {
            type: Object,
            required: true,
        }
    },
    data(){
        let data = {

        };
        data = Object.assign({}, data, {form: this.givingType});
        return data;
    },
    validations: {
        form: givingTypeRequiredFields,
    },
    methods: {
        closeDialog() {
            this.$emit("onDialogClose", {showEditDialog: false});
            this.$dialog.enableDocBodyOverflow();
            this.clearForm();
        },
        getValidationClass (fieldName) {
            const field = this.$v.form[fieldName];

            if (field) {
                return {
                    'md-invalid': field.$invalid && field.$dirty
                }
            }
        },
        clearForm () {
            this.$v.$reset()
            this.form.name = null;
            this.form.amount = null;
            this.form.minAmount = null;
            this.form.maxAmount = null;
            this.form.targetNumber = null;
            this.form.description = null;
            this.form.id = null;
        },
        editGiving () {
             this.$store.dispatch('updateGivingType', this.form)
             .then((response) => {
                this.closeDialog();
             }).catch((error) => {
                 this.$store.commit('setMessage', error.data.message);
             });
        },
        validateUser() {
            //console.log(this.$v);
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.editGiving();
            }
        },
        closeSnackBar(){
            this.$store.commit('setHasMessage', false);
        }

    }
}
</script>

<style lang="scss" scoped>
  .md-progress-bar {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
  }
  .md-card {
      width: 450px;
      margin-bottom: 0;
  }
  .md-dialog-content{
      padding: 0;
  }
</style>
