const state = {
    givingType: {
        id: null,
        name: null,
        amount: null,
        maxAmount: null,
        minAmount: null,
        description: null,
        targetNumber: null,
    },
    givingTypes: [],
};
const getters = {
    givingType: state => state.givingType,
    givingTypes: state => state.givingTypes,
};
const actions = {
    postGivingType({commit}, giving) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/giving-types';
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
    updateGivingType({commit}, giving) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/giving-types';
        return new Promise((resolve, reject) => {
            axios.put(url, giving)
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
    loadGivingTypes({commit}){
        const url = '/rest/secured/giving-types';
        axios.get(url)
        .then((response) => {
          commit("setGivingTypes", response.data.givingTypes);
        }).catch((error) => {
            console.log(error);
        });

    },
};
const mutations = {
    setGivingType(state, givingType){
        state.givingType = givingType;
    },
    setGivingTypes(state, givingTypes){
        state.givingTypes = givingTypes;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
}
