const Dialog = {


}

const DialogPlugin = {
    install(Vue) {
      Vue.mixin({
        data() {
          return {
            dialog: Dialog
          };
        },
        methods: {
            disableDocBodyOverflow(){
                document.body.style.overflow = 'hidden';
            },
            enableDocBodyOverflow(){
                document.body.style.overflow = 'auto';
            }
        },
      });

      Object.defineProperty(Vue.prototype, "$dialog", {
        get() {
          return this.$root;
        }
      });
    }
  };
  export default DialogPlugin;

