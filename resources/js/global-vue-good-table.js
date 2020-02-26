import VueGoodTablePlugin from 'vue-good-table';
// import the styles
import 'vue-good-table/dist/vue-good-table.css'

/**
 * This is the main Light Bootstrap Dashboard Vue plugin where dashboard related plugins are registerd.
 */
export default {
  install(Vue) {
    Vue.use(VueGoodTablePlugin);
  }
};
