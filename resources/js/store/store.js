import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import auth from './modules/auth';
import users from './modules/users';
import member from './modules/member';
import parish from './modules/parish';
import giving from './modules/giving';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    users,
    auth,
    parish,
    member,
    giving
  },
  state,
  getters,
  mutations,
  actions,
})
