<template>
  <div>
        <md-dialog
            @md-closed="closeDialog()"
            :md-click-outside-to-close="false"
            :md-active.sync="showDialog">
            <form novalidate class="md-layout" @submit.prevent="validateUser()">
                <md-card>
                    <md-card-header  :data-background-color="dataBackgroundColor">
                        <div class="md-title">Add New Giving</div>
                        <div class="md-subhead">Please fill all required details</div>
                    </md-card-header>
                    <md-card-content>
                            <div class="md-layout">
                                <div class="md-layout-item md-small-size-100 md-size-100">
                                    <md-content class="md-scrollbar">
                                        <md-list class="md-triple-line md-dense">
                                            <template v-for="(member, memberIndex) in members">
                                                <md-list-item :key="memberIndex">
                                                    <md-avatar>
                                                        <img src="https://placeimg.com/40/40/people/1" alt="People">
                                                    </md-avatar>
                                                    <div class="md-list-item-text">
                                                        <span>{{member.firstName}} {{member.lastName}}</span>
                                                        <span>Email : {{member.email}} Mobile: {{member.phoneNumber}}</span>
                                                        <p>Belongs to {{member.community.zone.name}}'s zone and {{member.community.name}}'s community</p>
                                                    </div>
                                                    <div class="md-list-action md-simple">
                                                        <md-checkbox class="md-list-action" v-model="form.memberIds" :value="member.id"></md-checkbox>
                                                    </div>
                                                </md-list-item>
                                                <md-divider class="md-inset" :key=" 'divider-' + memberIndex"></md-divider>
                                            </template>
                                        </md-list>
                                    </md-content>
                                    <md-field>
                                        <label for="giving-type-id">Giving Type</label>
                                        <md-select
                                            v-model="form.givingTypeId"
                                            name="form.givingTypeId"
                                            id="giving-type-id">
                                            <md-option
                                            v-for="(givingType, givingTypeIndex) in givingTypes" :key="givingTypeIndex"
                                            :value="givingType.id">
                                                {{givingType.name}}
                                            </md-option>
                                        </md-select>
                                        <span class="md-error" v-if="!$v.form.givingTypeId.required">The giving type is required</span>
                                    </md-field>
                                </div>

                            </div>
                            <div class="md-layout">
                                <div class="md-layout-item md-small-size-100 md-size-100">
                                    <md-field :class="getValidationClass('amount')">
                                        <label for="form-amount">Amount</label>
                                        <md-input id="form-amount" v-model="form.amount" type="text" :disabled="isLoading"></md-input>
                                        <span class="md-error" v-if="!$v.form.amount.required">The amount is required</span>
                                        <span class="md-error" v-else-if="!$v.form.amount.minlength">Invalid amount</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-100">
                                    <md-field :class="getValidationClass('datePaid')">
                                        <md-datepicker v-model="form.datePaid" md-immediately>
                                            <label>Date Paid</label>
                                        </md-datepicker>
                                        <span class="md-error" v-if="!$v.form.datePaid.required">The date paid is required</span>
                                    </md-field>
                                </div>
                            </div>
                    </md-card-content>
                    <md-card-actions>
                        <md-button class="md-danger" @click="closeDialog()">Close</md-button>
                        <md-button type="submit" class="md-primary" :disabled="isLoading">Create Giving</md-button>
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
import { givingForm, givingRequiredFields } from './giving-form-criteria';
import { mapGetters } from 'vuex';

export default {
    name: 'giving-create-component',
    mixins: [validationMixin],
    computed: {
        ...mapGetters([
            'isLoading',
            'members',
            'givingTypes',
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
        form: givingForm,
        userSaved: false,
        sending: false,
        lastUser: null,
    }),
    validations: {
        form: givingRequiredFields,
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
            this.form.memberIds = [];
            this.form.givingTypeId = null;
            this.form.datePaid = null;
            this.form.amount = null;
            this.form.id= null;
        },
        createGiving () {
             this.$store.dispatch('postGiving', this.form)
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
                this.createGiving();
            }
        },
        closeSnackBar(){
            this.$store.commit('setHasMessage', false);
        },
        loadMembers() {
            this.$store.dispatch('getMembers');
        },
        loadGivingTypes() {
            this.$store.dispatch('loadGivingTypes');
        },
    },
    created(){
        this.loadMembers();
        this.loadGivingTypes();
    }
}
</script>

<style lang="scss" scoped>
    .md-card {
        margin-bottom: 0;
        width: 60vw;
    }
    .md-dialog {
        max-width: 100%;
        max-height: 100%;
    }
    .md-progress-bar {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
    }
    .md-content.md-scrollbar {
        max-height: 250px;
        overflow-y: scroll;
        overflow-x: unset;
        border: 1px solid rgba(#000, .12);
    }
    .md-list-item-content .md-list-action:last-of-type {
        margin: 0;
    }

</style>
