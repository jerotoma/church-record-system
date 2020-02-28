<template>
  <div>
        <md-dialog
            @md-closed="closeDialog()"
            :md-click-outside-to-close="false"
            :md-active.sync="showDialog">
            <form novalidate class="md-layout" @submit.prevent="validateUser()">
                <md-card>
                    <md-card-header  :data-background-color="dataBackgroundColor">
                        <div class="md-title">Add New User</div>
                        <div class="md-subhead">Please fill all required details</div>
                    </md-card-header>
                    <md-card-content>
                        <md-content class="md-scrollbar">
                            <div class="md-layout">
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('firstName')">
                                        <label for="form-firstName">First Name</label>
                                        <md-input id="form-firstName" v-model="form.firstName" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.firstName.required">The first name is required</span>
                                        <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid first name</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('lastName')">
                                        <label for="form-lastName" >Last Name</label>
                                        <md-input id="form-lastName" v-model="form.lastName" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.lastName.required">The last name is required</span>
                                        <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid first name</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('username')">
                                        <label for="form-username">User Name</label>
                                        <md-input id="form-username" v-model="form.username" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.username.required">The username is required</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('emailAddress')">
                                        <label for="form-emailAddress">Email Address</label>
                                        <md-input id="form-emailAddress" v-model="form.emailAddress" type="email" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.emailAddress.required">The email address is required</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('password')">
                                        <label for="form-password">Password</label>
                                        <md-input id="form-password" v-model="form.password" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.password.required">The password is required</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('confirmPassword')">
                                        <label for="form-confirmPassword">Confirm Password</label>
                                        <md-input id="form-confirmPassword" v-model="form.confirmPassword" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.confirmPassword.required">The confirm password is required</span>
                                        <span class="md-error" v-if="!$v.form.confirmPassword.sameAsPassword">Password don't match</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('streetAddress')">
                                        <label for="form-streetAddress">Street Address</label>
                                        <md-input id="form-streetAddress" v-model="form.streetAddress" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.streetAddress.required">The street address is required</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field>
                                        <label for="form-unitNumber">Unit No</label>
                                        <md-input id="form-unitNumber" v-model="form.unitNumber" type="text" :disabled="sending"></md-input>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('city')">
                                        <label for="form-city">City</label>
                                        <md-input id="form-city" v-model="form.city" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.city.required">The city is required</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('postalCode')">
                                        <label for="form-postalCode">Postal Code</label>
                                        <md-input id="form-postalCode" v-model="form.postalCode" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.postalCode.required">The postal code is required</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('state')">
                                        <label for="form-state">State</label>
                                        <md-input id="form-state" v-model="form.state" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.state.required">The state is required</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-50">
                                    <md-field :class="getValidationClass('state')">
                                        <label for="form-country">Country</label>
                                        <md-input id="form-country" v-model="form.country" type="text" :disabled="sending"></md-input>
                                        <span class="md-error" v-if="!$v.form.country.required">The country is required</span>
                                    </md-field>
                                </div>
                            </div>
                        </md-content>
                    </md-card-content>
                    <md-card-actions>
                        <md-button class="md-danger" @click="closeDialog()">Close</md-button>
                        <md-button type="submit" class="md-primary" :disabled="sending">Create user</md-button>
                    </md-card-actions>
                </md-card>
                <md-snackbar md-position="center" class="md-success" :md-active.sync="userSaved">The user {{ lastUser }} was saved with success!</md-snackbar>
            </form>
        </md-dialog>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { userForm, userRequiredFields } from './user-form-criteria';

export default {
    name: 'FormValidation',
    mixins: [validationMixin],
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
        form: userForm,
        userSaved: false,
        sending: false,
        lastUser: null,
    }),
    validations: {
        form: userRequiredFields,
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
            this.form.firstName = null;
            this.form.lastName = null;
            this.form.emailAddress = null;
            this.form.gender = "male"
            this.form.username = null;
            this.form.password = null;
            this.form.confirmPassword = null;
            this.form.streetAddress = null;
            this.form.unitNumber = null;
            this.form.city = null;
            this.form.state = null;
            this.form.country = null;
            this.form.postalCode = null;
        },
        saveUser () {
            this.sending = true
            // Send a POST request
            axios({
                method: 'POST',
                url: '/api/users',
                data: this.form,
            })
            .then((response) => {
                console.log(response);
                this.lastUser = `${this.form.firstName} ${this.form.lastName}`
                this.userSaved = true
                this.sending = false
                this.clearForm();
            }).catch((error) => {
                // handle error
                this.sending = false
                console.log(error);
            });
        },
        validateUser() {
            //console.log(this.$v);
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.saveUser();
            }
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
