<template>
  <div>
       <form>
        <md-dialog
            @md-closed="closeDialog()"
            :md-click-outside-to-close="false"
            :md-active.sync="showDialog">
            <md-card>
                <md-card-header  :data-background-color="dataBackgroundColor">
                    <div class="md-title">Add New User</div>
                    <div class="md-subhead">Please fill all required details</div>
                </md-card-header>
                <md-card-content>
                     <md-content class="md-scrollbar">
                        <div class="md-layout">
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                <label>First Name</label>
                                <md-input v-model="firstName" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                <label>Last Name</label>
                                <md-input v-model="lastName" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>User Name</label>
                                    <md-input v-model="username" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                <label>Email Address</label>
                                <md-input v-model="emailAddress" type="email"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>Password</label>
                                    <md-input v-model="password" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>Confirm Password</label>
                                    <md-input v-model="confirmPassword" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>Street Address</label>
                                    <md-input v-model="streetAddress" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>Unit No</label>
                                    <md-input v-model="unitNumber" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>City</label>
                                    <md-input v-model="city" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>Postal Code</label>
                                    <md-input v-model="postalCode" type="number"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field>
                                    <label>State</label>
                                    <md-input v-model="state" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-50">
                                <md-field maxlength="5">
                                <label>Country</label>
                                <md-input v-model="country" type="text"></md-input>
                                </md-field>
                            </div>
                        </div>
                     </md-content>
                </md-card-content>
            </md-card>
            <md-dialog-actions>
                <md-button class="md-danger" @click="closeDialog()">Close</md-button>
                <md-button class="md-primary" @click="closeDialog()">Create</md-button>
            </md-dialog-actions>
        </md-dialog>
    </form>
  </div>
</template>

<script>


export  default {
    name: 'UserCreateComponent',
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
        firstName: null,
        lastName: null,
        username: null,
        emailAddress: null,
        password: null,
        confirmPassword: null,
        streetAddress: null,
        unitNumber: null,
        city: null,
        country: null,
        state: null,
        postalCode: null,
    }),
    methods: {
        closeDialog() {
           this.$emit("onDialogClose", {showDialog: false});
        }
    }
  }
</script>

<style lang="scss" scoped>
  .md-dialog {
    max-width: 100%;
    max-height: 100%
  }
</style>
