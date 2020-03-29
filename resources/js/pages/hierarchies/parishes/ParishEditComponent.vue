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
                        <div class="md-title">Add New Parish</div>
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
                                        <span class="md-error" v-else-if="!$v.form.name.minlength">Invalid name</span>
                                    </md-field>
                                </div>
                                <div class="md-layout-item md-small-size-100 md-size-100">
                                    <md-field :class="getValidationClass('code')">
                                        <label for="form-code" >Code</label>
                                        <md-input id="form-code" v-model="form.code" type="text" :disabled="isLoading"></md-input>
                                        <span class="md-error" v-if="!$v.form.code.required">The code is required</span>
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
        </md-dialog>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { parishForm, parishRequiredFields } from './parish-form-criteria';
import { mapGetters } from 'vuex';

export default {
    name: 'parish-edit-component',
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
        },
        parish: {
            type: Object,
            required: true
        }
    },
    data(){
        let data = {};
        data = Object.assign({}, data, {form: this.parish});
        return data;
    },
    validations: {
        form: parishRequiredFields,
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
            this.form.name = null;
            this.form.code = null;
            this.form.id= null;
        },
        editParish () {
             this.$store.dispatch('updateParish', this.form)
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
                this.editParish();
            }
        },
        closeSnackBar(){
            this.$store.commit('setHasMessage', false);
        }

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
