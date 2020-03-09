const state = {
    community: {
        name: null,
        code: null,
        id: null,
        zoneId: null,
        parishId: null,
    },
    communities: [],
};
const getters = {
    community: state => state.community,
    communities: state => state.communities,
};
const actions = {
    postCommunity({commit}, community) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/communities';
        return new Promise((resolve, reject) => {
            axios.post(url, community)
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
    updateCommunity({commit}, community) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/communities';
        return new Promise((resolve, reject) => {
            axios.put(url, community)
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
    loadCommunities({commit}){
        const url = '/rest/secured/communities';
        axios.get(url)
        .then((response) => {
            console.log(response.data);
            commit("setCommunities", response.data.communities);
        }).catch((error) => {
            console.log(error);
        });
    },
    loadCommunitiesByZoneId({commit}, data){
        const url = '/rest/secured/communities/zones/' + data.id;
        axios.get(url)
        .then((response) => {
            console.log(response.data);
            commit("setCommunities", response.data.communities);
        }).catch((error) => {
            console.log(error);
        });
    },
};
const mutations = {
    setCommunities(state, communities){
        state.communities = communities;
    },
    setCommunity(state, community){
        state.community = community;
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
