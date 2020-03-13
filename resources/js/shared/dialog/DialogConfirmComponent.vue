<template>
    <div>
        <md-dialog-confirm
            :md-active.sync="isActive"
            md-title="Confirm Action"
            :md-content="messageContent"
            md-confirm-text="Confirm"
            md-cancel-text="Cancel"
            @md-cancel="onCancel"
            @md-confirm="onConfirm">
        </md-dialog-confirm>
    </div>
</template>
<script>
  export default {
    name: 'DialogConfirmComponent',
    props: {
        showDialog: {
            type: Boolean,
            required: true,
        },
        messageContent: {
            type: String,
            default:'Are you sure you want to perform this action?'
        }
    },
     data(){
      return {
          isActive: false,
        };
    },
    watch:{
        showDialog: {
            handler(value, o) {
                this.isActive = value;
            },
            deep: true
        }
    },
    methods: {
        onConfirm () {
            this.isActive = false;
            this.$emit('onActionConfirm', {confirmed: true});
        },
        onCancel () {
            this.isActive = false;
            this.$emit('onActionConfirm', {confirmed: false});
        }
    }
  }
</script>
