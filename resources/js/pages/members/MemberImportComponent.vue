<template>
    <div>
        <md-dialog
            @md-closed="closeDialog()"
            :md-click-outside-to-close="false"
            :md-active.sync="showDialog">
            <form novalidate class="md-layout" @submit.prevent="validateFile()">
                <md-card>
                    <md-card-content>
                      <file-upload-component></file-upload-component>
                    </md-card-content>
                    <md-card-actions>
                        <md-button class="md-danger" @click="closeDialog()">Close</md-button>
                        <md-button type="submit" class="md-success" :disabled="isLoading">Upload File</md-button>
                    </md-card-actions>
                </md-card>
            <!-- <md-snackbar md-position="center" class="md-success" :md-active.sync="userSaved">The member {{ lastUser }} was saved with success!</md-snackbar> -->
            </form>
        </md-dialog>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    name: 'member-import-component',
     props: {
        showDialog: {
            type: Boolean,
            default: false,
        },
        dataBackgroundColor: {
            type: String,
            default: 'green'
        },
    },
    computed:{
        ...mapGetters([
            'isLoading',
        ]),
        hasMessage: {
            get(){return this.isMessage; },
            set(value) { this.$store.commit('setHasMessage', value);}
        }
    },
    data() {
        return {
            memberFile: null,
        }
    },
    methods: {
        closeDialog() {
            this.$emit("onDialogClose", {showDialog: false});
        },
        validateFile() {
            console.log(this.memberFile);
        },
        getUploadedFile() {
            this.memberFile = this.$refs['member_import_file'];
            console.log(this.memberFile);
        }
    }
}
</script>
<style scoped>
    .md-card {
        width: 450px;
    }
</style>
