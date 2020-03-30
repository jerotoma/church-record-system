<template>
  <div>
        <md-dialog
            @md-opened="$dialog.disableDocBodyOverflow()"
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
                                            <md-input id="form-firstName" v-model="form.firstName" type="text" :disabled="isSending"></md-input>
                                            <span class="md-error" v-if="!$v.form.firstName.required">The first name is required</span>
                                            <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid first name</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('lastName')">
                                            <label for="form-lastName" >Last Name</label>
                                            <md-input id="form-lastName" v-model="form.lastName" type="text" :disabled="isSending"></md-input>
                                            <span class="md-error" v-if="!$v.form.lastName.required">The last name is required</span>
                                            <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid first name</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('email')">
                                            <label for="form-emailAddress">Email</label>
                                            <md-input id="form-emailAddress" v-model="form.email" type="email" :disabled="isSending"></md-input>
                                            <span class="md-error" v-if="!$v.form.email.required">The email address is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('username')">
                                            <label for="form-username">Username</label>
                                            <md-input id="form-username" v-model="form.username" type="text" :disabled="isSending"></md-input>
                                            <span class="md-error" v-if="!$v.form.username.required">The username is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('password')">
                                            <label for="form-password">Password</label>
                                            <md-input id="form-password" v-model="form.password" type="password" :disabled="isSending"></md-input>
                                            <span class="md-error" v-if="!$v.form.password.required">The password is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('confirmPassword')">
                                            <label for="form-confirmPassword">Confirm Password</label>
                                            <md-input id="form-confirmPassword" v-model="form.confirmPassword" type="password" :disabled="isSending"></md-input>
                                            <span class="md-error" v-if="!$v.form.confirmPassword.required">The confirm password is required</span>
                                            <span class="md-error" v-if="!$v.form.confirmPassword.sameAsPassword">Password don't match</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-33" v-show="roles && roles.length > 0">
                                        <md-field :class="getValidationClass('roleId')">
                                            <label for="role-id">Roles</label>
                                            <md-select
                                                v-model="form.roleId"
                                                name="form.roleId"
                                                id="role-id">
                                                <md-option
                                                    v-for="(role, roleIndex) in roles" :key="roleIndex"
                                                    :value="role.id">
                                                        {{role.name}}
                                                </md-option>
                                            </md-select>
                                            <span class="md-error" v-if="!$v.form.roleId.required">The role is required</span>
                                        </md-field>
                                    </div>
                                </div>
                                <div class="md-layout" v-if="errors.length > 0">
                                    <div class="md-layout-item md-small-size-100 md-size-100">
                                        <md-card class="md-accent">
                                            <md-card-content>
                                                <span class="md-error" v-for="(error, index) in errors" :key="index">{{error}}.<br></span>
                                            </md-card-content>
                                        </md-card>
                                    </div>
                                </div>
                        </md-content>
                    </md-card-content>
                    <md-card-actions>
                        <md-button class="md-danger" @click="closeDialog()">Close</md-button>
                        <md-button type="submit" class="md-primary" :disabled="isSending">Create user</md-button>
                    </md-card-actions>
                </md-card>
            </form>
        </md-dialog>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { userForm, userRequiredFields } from './user-form-criteria';
import { mapGetters } from 'vuex';

export default {
    name: 'user-create-component',
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
    computed:{
      ...mapGetters([
            'roles',
            'isSending',
            'message',
            'isMessage'
        ]),
        hasMessage: {
            get(){return this.isMessage; },
            set(value) { this.$store.commit('setHasMessage', value);}
        }
    },
    data: () => ({
        form: userForm,
        isSuccess: false,
        errors: []
    }),
    validations: {
        form: userRequiredFields,
    },
    methods: {
        closeDialog() {
            this.$emit("onDialogClose", {showDialog: false});
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
            this.form.firstName = null;
            this.form.lastName = null;
            this.form.emailAddress = null;
            this.form.gender = "male"
            this.form.username = null;
            this.form.password = null;
            this.form.confirmPassword = null;
            this.form.roleId = null;
        },
        createUser () {
            this.isSuccess = false;
            this.$store.dispatch('postUser', this.form).then(response => {
                this.isSuccess = true;
                this.$emit("onUserCreated", {success: true});
                this.closeDialog();
            }).catch(error => {
                if(!error.data.success) {
                    const values = Object.values(error.data.errors)
                    for (const value of values) {
                        this.errors.push(value[0]);
                    }
                }
                this.$store.commit('setSending', false);
            });
        },
        validateUser() {
            //console.log(this.$v);
            this.errors = [];
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.createUser();
            }
        },
        loadParishes() {
            this.$store.dispatch('loadParishes');
        },
        loadZones(parishId) {
            this.form.zoneId = null;
            this.form.zoneId = null;
            this.$store.dispatch('loadZones', parishId);
        },
        loadCommunities(parishId, zoneId) {
            this.form.zoneId = null;
            this.$store.dispatch('loadCommunities', { id: zoneId, parish_id: parishId});
        },
    },
    created(){
        this.loadParishes();
        this.$store.dispatch('loadRoles');
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
</style>
