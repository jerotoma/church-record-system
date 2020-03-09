import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import auth from './modules/auth';
import users from './modules/users';
import member from './modules/member';
import zone from './modules/zone';
import community from './modules/community';
import parish from './modules/parish';
import patron from './modules/patron';
import giving from './modules/giving';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    users,
    auth,
    parish,
    zone,
    community,
    member,
    giving,
    patron,
  },
  state,
  getters,
  mutations,
  actions,
})
