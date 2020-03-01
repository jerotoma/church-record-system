const state = {
    parish: null,
    pashes: [],
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
    }
};
const mutations = {
    setParish(state, parish){
        state.parish = parish;
    },
    setParish(state, parishes){
        state.parishes = parishes;
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
