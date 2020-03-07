<template>
  <div>
        <md-dialog
            @md-closed="closeDialog()"
            :md-click-outside-to-close="false"
            :md-active.sync="showDialog">
            <form novalidate class="md-layout" @submit.prevent="validateUser()">
                <md-card>
                    <md-card-header  :data-background-color="dataBackgroundColor">
                        <div class="md-title">Add New Patron</div>
                        <div class="md-subhead">Please fill all required details</div>
                    </md-card-header>
                    <md-card-content>
                        <md-content class="md-scrollbar">
                             <div class="md-layout">
                                <div class="md-layout-item md-small-size-100 md-size-33">
                                    <md-field>
                                        <label for="parish-id">Member</label>
                                        <md-select
                                            v-model="form.memberId"
                                            name="form.memberId"
                                            id="member-id">
                                            <md-option>
                                                Otoman Nkomanya
                                            </md-option>
                                        </md-select>
                                        <span class="md-error" v-if="!$v.form.memberId.required">The parish is required</span>
                                    </md-field>
                                </div>

                            </div>
                            <div class="md-layout">
                                <div class="md-layout-item md-small-size-100 md-size-100">
                                    <md-field :class="getValidationClass('amount')">
                                        <label for="fform-amount">Amount</label>
                                        <md-input id="fform-amount" v-model="form.amount" type="text" :disabled="isLoading"></md-input>
                                        <span class="md-error" v-if="!$v.form.amount.required">The amount is required</span>
                                        <span class="md-error" v-else-if="!$v.form.amount.minlength">Invalid amount</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-100">
                                    <md-datepicker v-model="form.datePaid" md-immediately>
                                        <label>Date Paid</label>
                                    </md-datepicker>
                                    <span class="md-error" v-if="!$v.form.datePaid.required">The patron code is required</span>
                                    <span class="md-error" v-else-if="!$v.form.datePaid.minlength">Invalid patron</span>
                                </div>
                            </div>
                        </md-content>
                    </md-card-content>
                    <md-card-actions>
                        <md-button class="md-danger" @click="closeDialog()">Close</md-button>
                        <md-button type="submit" class="md-primary" :disabled="isLoading">Create Patron</md-button>
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
        </md-dialog>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { patronForm, patronRequiredFields } from './patron-form-criteria';
import { mapGetters } from 'vuex';

export default {
    name: 'patron-create-component',
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
        showDialog: {
            type: Boolean,
            default: false,
        },
        dataBackgroundColor: {
            type: String,
            default: 'green'
        }
    },
    data: () => ({
        form: patronForm,
        userSaved: false,
        sending: false,
        lastUser: null,
    }),
    validations: {
        form: patronRequiredFields,
    },
    methods: {
        closeDialog() {
        this.$emit("onDialogClose", {showDialog: false});
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
            this.form.memberId = null;
            this.form.givingId = null;
            this.form.datePaid = null;
            this.form.amount = null;
            this.form.id= null;
        },
        createPatron () {
             this.$store.dispatch('postPatron', this.form)
             .then((response) => {
                 this.clearForm();
                 this.$emit("onDialogClose", {showDialog: false});
             }).catch((error) => {
                 this.$store.commit('setMessage', error.data.message);
             });
        },
        validateUser() {
            //console.log(this.$v);
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.createPatron();
            }
        },
        closeSnackBar(){
            this.$store.commit('setHasMessage', false);
        }

    }
}
</script>

<style lang="scss" scoped>
  .md-dialog {
    max-width: 100%;
    max-height: 100%
  }
  .md-progress-bar {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
  }
</style>
