const state = {
    parish: {
        name: null,
        code: null,
        id: null,
    },
    parishes: [],
};
const getters = {
    parish: state => state.parish,
    parishes: state => state.parishes,
};
const actions = {
    postParish({commit}, parish) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/parishes';
        return new Promise((resolve, reject) => {
            axios.post(url, parish)
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
    updateParish({commit}, parish) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/parishes';
        return new Promise((resolve, reject) => {
            axios.put(url, parish)
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
    loadParishes({commit}){
        const url = '/rest/secured/parishes';
        axios.get(url)
        .then((response) => {
          commit("setParishes", response.data.parishes);
        }).catch((error) => {
            console.log(error);
        });

    },
};
const mutations = {
    setParish(state, parish){
        state.parish = parish;
    },
    setParishes(state, parishes){
        state.parishes = parishes;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
}
