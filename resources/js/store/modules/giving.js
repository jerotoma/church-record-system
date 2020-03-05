const state = {
    giving: null,
    givings: [],
};
const getters = {
    giving: state => state.giving,
    givings: state => state.givings,
};
const actions = {
    postGiving({commit}, giving) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/givings';
        return new Promise((resolve, reject) => {
            axios.post(url, giving)
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
    loadGivings({commit}){
        const url = '/rest/secured/givings';
        axios.get(url)
        .then((response) => {
          commit("setGivings", response.data.givings);
        }).catch((error) => {
            console.log(error);
        });

    },
};
const mutations = {
    setGiving(state, giving){
        state.giving = giving;
    },
    setGivings(state, givings){
        state.givings = givings;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
}
