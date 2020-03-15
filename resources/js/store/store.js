import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import auth from './modules/auth';
import user from './modules/user';
import member from './modules/member';
import zone from './modules/zone';
import community from './modules/community';
import parish from './modules/parish';
import giving from './modules/giving';
import givingType from './modules/giving-type';
import permission from './modules/permission';
import role from './modules/role';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user,
        auth,
        parish,
        zone,
        community,
        member,
        givingType,
        giving,
        permission,
        role
    },
    state,
    getters,
    mutations,
    actions,
})
