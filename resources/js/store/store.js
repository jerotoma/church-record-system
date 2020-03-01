import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import auth from './modules/auth';
import users from './modules/users';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    users,
    auth,
  },
  state,
  getters,
  mutations,
  actions,
})
