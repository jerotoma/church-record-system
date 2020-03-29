<template>
  <div style="width:750px;">
        <md-dialog
            @md-closed="closeDialog()"
            :md-click-outside-to-close="false"
            :md-active.sync="showEditDialog">
            <md-dialog-content>
                <form novalidate class="md-layout" @submit.prevent="validateUser()">
                    <md-card>
                        <md-card-header  :data-background-color="dataBackgroundColor">
                            <div class="md-title">Edit Permission</div>
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
                                            <span class="md-error" v-else-if="!$v.form.name.minlength">Invalid permission name</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('slug')">
                                            <label for="form-slug">Slug</label>
                                            <md-input id="form-slug" v-model="form.slug" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.slug.required">The slug is required</span>
                                            <span class="md-error" v-else-if="!$v.form.slug.minlength">Invalid slug</span>
                                        </md-field>
                                    </div>
                                    <div class="md-layout-item md-small-size-100 md-size-50">
                                        <md-field :class="getValidationClass('model')">
                                            <label for="form-model">Level</label>
                                            <md-input id="form-model" v-model="form.model" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.model.required">The model is required</span>
                                            <span class="md-error" v-else-if="!$v.form.model.minlength">Invalid model</span>
                                        </md-field>
                                    </div>
                                </div>
                                <div class="md-layout">
                                    <div class="md-layout-item md-small-size-100 md-size-100">
                                        <md-field :class="getValidationClass('description')">
                                            <label for="form-description">Description</label>
                                            <md-input id="form-description" v-model="form.description" type="text" :disabled="isLoading"></md-input>
                                            <span class="md-error" v-if="!$v.form.description.required">The description is required</span>
                                            <span class="md-error" v-else-if="!$v.form.description.minlength">Invalid description</span>
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
import { permissionRequiredFields } from './permission-form-criteria';
import { mapGetters } from 'vuex';

export default {
    name: 'permission-edit-component',
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
        permission: {
            type: Object,
            required: true,
        }
    },
    data(){
        let data = {

        };
        data = Object.assign({}, data, {form: this.permission});
        return data;
    },
    validations: {
        form: permissionRequiredFields,
    },
    methods: {
        closeDialog() {
            this.$emit("onDialogClose", {showEditDialog: false});
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
            this.form.slug = null;
            this.form.model = null;
            this.form.description = null;
            this.form.id = null;
        },
        editPermission () {
             this.$store.dispatch('updatePermission', this.form)
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
                this.editPermission();
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
