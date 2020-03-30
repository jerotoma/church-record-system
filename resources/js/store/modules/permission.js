const state = {
    permission: {
        id: null,
        name: null,
        slug: null,
        model: null,
        description: null
    },
    permissions: [],
};
const getters = {
    permission: state => state.permission,
    permissions: state => state.permissions,
};
const actions = {
    postPermission({commit}, permission) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/permissions';
        return new Promise((resolve, reject) => {
            axios.post(url, permission)
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
    updatePermission({commit}, permission) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/permissions/' + permission.id;
        return new Promise((resolve, reject) => {
            axios.put(url, permission)
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
    loadPermissions({commit}){
        const url = '/rest/secured/permissions';
        axios.get(url)
        .then((response) => {
          commit("setPermissions", response.data.permissions);
        }).catch((error) => {
            console.log(error);
        });

    },
};
const mutations = {
    setPermission(state, permission){
        state.permission = permission;
    },
    setPermissions(state, permissions){
        state.permissions = permissions;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
}
