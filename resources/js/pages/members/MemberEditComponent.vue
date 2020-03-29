<template>
  <div>
        <md-dialog
            @md-closed="closeDialog()"
            @md-opened="$dialog.disableDocBodyOverflow()"
            :md-click-outside-to-close="false"
            :md-active.sync="showDialog">
            <form novalidate class="md-layout" @submit.prevent="validateMember()">
                <md-card>
                    <md-card-header  :data-background-color="dataBackgroundColor">
                        <div class="md-title">Add New Member</div>
                        <div class="md-subhead">Please fill all required details</div>
                    </md-card-header>
                    <md-card-content>
                        <md-content class="md-scrollbar">
                                <div class="md-layout">
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('firstName')">
                                            <label for="form-firstName">First Name</label>
                                            <md-input id="form-firstName" v-model="form.firstName" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.firstName.required">The first name is required</span>
                                            <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid first name</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('lastName')">
                                            <label for="form-lastName" >Last Name</label>
                                            <md-input id="form-lastName" v-model="form.lastName" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.lastName.required">The last name is required</span>
                                            <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid first name</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('middleName')">
                                            <label for="form-middleName">Middle Name</label>
                                            <md-input id="form-middleName" v-model="form.middleName" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.middleName.required">The middleName is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('email')">
                                            <label for="form-emailAddress">Email Address</label>
                                            <md-input id="form-emailAddress" v-model="form.email" type="email" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.email.required">The email address is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('phoneNumber')">
                                            <label for="form-phoneNumber">Phone number</label>
                                            <md-input id="form-phoneNumber" v-model="form.phoneNumber" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.phoneNumber.required">The phone number is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('occupation')">
                                            <label for="form-occupation">Occupation</label>
                                            <md-input id="form-occupation" v-model="form.occupation" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.occupation.required">The occupation is required</span>
                                        </md-field>
                                    </div>
                                </div>
                                <div class="md-layout">
                                    <div class="md-layout-item md-small-size-100 md-size-33">
                                        <md-field>
                                            <label for="parish-id">Parish</label>
                                            <md-select
                                                v-model="form.parishId"
                                                @md-selected="loadZones(form.parishId)"
                                                name="form.parishId"
                                                id="parish-id">
                                                <md-option
                                                    v-for="(parish, parishIndex) in parishes" :key="parishIndex"
                                                    :value="parish.id">
                                                        {{parish.name}}
                                                </md-option>
                                            </md-select>
                                            <span class="md-error" v-if="!$v.form.parishId.required">The parish is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-33" v-show="zones && zones.length > 0">
                                        <md-field>
                                            <label for="zone-id">Zone</label>
                                            <md-select
                                                v-model="form.zoneId"
                                                @md-selected="loadCommunities(form.parishId, form.zoneId)"
                                                name="form.zoneId" id="zone-id">
                                                <md-option
                                                    v-for="(zone, zoneIndex) in zones" :key="zoneIndex"
                                                    :value="zone.id">
                                                        {{zone.name}}
                                                </md-option>
                                            </md-select>
                                            <span class="md-error" v-if="!$v.form.zoneId.required">The zone is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-33" v-show="communities && communities.length > 0">
                                        <md-field>
                                            <label for="community-id">Community</label>
                                            <md-select
                                                v-model="form.communityId"
                                                name="form.communityId"
                                                id="community-id">
                                                <md-option
                                                    v-for="(community, communityIndex) in communities" :key="communityIndex"
                                                    :value="community.id">
                                                        {{community.name}}
                                                </md-option>
                                            </md-select>
                                            <span class="md-error" v-if="!$v.form.communityId.required">The community is required</span>
                                        </md-field>
                                    </div>
                                </div>
                                <div class="md-layout">
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('streetAddress')">
                                            <label for="form-streetAddress">Street Address</label>
                                            <md-input id="form-streetAddress" v-model="form.streetAddress" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.streetAddress.required">The street address is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field>
                                            <label for="form-unitNumber">Unit No</label>
                                            <md-input id="form-unitNumber" v-model="form.unitNumber" type="text" :disabled="isLoading"></md-input>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('city')">
                                            <label for="form-city">City</label>
                                            <md-input id="form-city" v-model="form.city" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.city.required">The city is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('postalCode')">
                                            <label for="form-postalCode">Postal Code</label>
                                            <md-input id="form-postalCode" v-model="form.postalCode" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.postalCode.required">The postal code is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('state')">
                                            <label for="form-state">State</label>
                                            <md-input id="form-state" v-model="form.state" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.state.required">The state is required</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('state')">
                                            <label for="form-country">Country</label>
                                            <md-input id="form-country" v-model="form.country" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.country.required">The country is required</span>
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
               <!-- <md-snackbar md-position="center" class="md-success" :md-active.sync="userSaved">The member {{ lastUser }} was saved with success!</md-snackbar> -->
            </form>
        </md-dialog>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { memberForm, memberRequiredFields } from './member-form-criteria';
import { mapGetters } from 'vuex';

export default {
    name: 'member-edit-component',
    mixins: [validationMixin],
    props: {
        showDialog: {
            type: Boolean,
            default: false,
        },
        dataBackgroundColor: {
            type: String,
            default: 'green'
        },
        member: {
            type: Object,
            required: true,
        }
    },
    computed:{
        ...mapGetters([
            'parishes',
            'communities',
            'zones',
            'isLoading',
            'message',
            'isMessage'
        ]),
        hasMessage: {
            get(){return this.isMessage; },
            set(value) { this.$store.commit('setHasMessage', value);}
        }
    },

    data(){
       let data = {};
        data = Object.assign({}, data, {form: this.member});
        return data;
    },
    validations: {
        form: memberRequiredFields,
    },
    methods: {
        closeDialog() {
            this.$emit("onDialogClose", {showDialog: false});
            this.$dialog.enableDocBodyOverflow();
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
            this.form.middleName = null;
            this.form.phoneNumber = null;
            this.form.occupation = null;
            this.form.streetAddress = null;
            this.form.unitNumber = null;
            this.form.city = null;
            this.form.state = null;
            this.form.country = null;
            this.form.postalCode = null;
            this.form.parishId = null;
            this.form.zoneId = null;
            this.form.communityId = null;
        },
        editMember() {
           this.$store.dispatch('updateMember', this.form).then((response) => {
                this.clearForm();
                this.$emit("onDialogClose", {showDialog: false});
            }).catch((error) => {
                this.$store.commit('setMessage', error.data.message);
            });
        },
        validateMember() {
            console.log(this.$v);
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.editMember();
            }
        },
        loadParishes() {
            this.$store.dispatch('loadParishes');
        },
        loadZones(parishId) {
            if (parishId) {
                this.form.zoneId = null;
                this.form.communityId = null;
                this.$store.commit('setZones', []);
                this.$store.commit('setCommunities', []);
                this.$store.dispatch('loadZonesByParishId', { id: parishId });
            }
        },
        loadCommunities(parishId, zoneId) {
            if (parishId && zoneId) {
                this.form.communityId = null;
                this.$store.commit('setCommunities', []);
                this.$store.dispatch('loadCommunitiesByZoneId', { id: zoneId, parish_id: parishId});
            }
        },
    },
    created(){
        this.loadParishes();
        this.$store.dispatch('loadCommunities');
        this.$store.dispatch('loadZones');
    }
}
</script>

<style lang="scss" scoped>
    .md-card {
        margin-bottom: 0;
    }
    .md-progress-bar {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
    }
</style>
