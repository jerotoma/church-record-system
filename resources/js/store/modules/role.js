const state = {
    role: {
        id: null,
        name: null,
        slug: null,
        level: null,
        description: null
    },
    roles: [],
};
const getters = {
    role: state => state.role,
    roles: state => state.roles,
};
const actions = {
    postRole({commit}, role) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/roles';
        return new Promise((resolve, reject) => {
            axios.post(url, role)
        .then((response) => {
            const data = response.data;
            if(data){
                commit('setLoading', false);
                resolve(data);
            }
        }).catch((error) => {
        const resp = error.response;
        //console.log(resp);
            commit('setMessage', resp.data.message);
            commit('setLoading', false);
            commit('setHasMessage', true);
            reject(resp);
        });
        });
    },
    updateRole({commit}, role) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/roles/' + role.id;
        return new Promise((resolve, reject) => {
            axios.put(url, role)
            .then((response) => {
                const data = response.data;
                if(data){
                    commit('setLoading', false);
                    resolve(data);
                }
            }).catch((error) => {
                const resp = error.response;
                //console.log(resp);
                commit('setMessage', resp.data.message);
                commit('setLoading', false);
                commit('setHasMessage', true);
                reject(resp);
        });
        });
    },
    loadRoles({commit}){
        const url = '/rest/secured/roles';
        axios.get(url)
        .then((response) => {
          commit("setRoles", response.data.roles);
        }).catch((error) => {
            console.log(error);
        });

    },
};
const mutations = {
    setRole(state, role){
        state.role = role;
    },
    setRoles(state, roles){
        state.roles = roles;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
}
