const state = {
    parish: null,
    parishes: [],
    community: null,
    communities: [],
    zone: null,
    zones: [],
};
const getters = {
    parish: state => state.parish,
    parishes: state => state.parishes,
    zone: state => state.zone,
    zones: state => state.zones,
    community: state => state.community,
    communities: state => state.communities,
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
    loadParishes({commit}){
        const url = '/rest/secured/parishes';
        axios.get(url)
        .then((response) => {
          commit("setParishes", response.data.parishes);
        }).catch((error) => {
            console.log(error);
        });

    },
    postCommunity({commit}, community) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/parishes/' + community.parishId + '/zones/' + community.zoneId + '/communities';
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
    loadCommunities({commit}, data){
        const url = '/rest/secured/parishes/' + data.parish_id + '/zones/' + data.id + '/communities';
        axios.get(url)
        .then((response) => {
            console.log(response.data);
            commit("setCommunities", response.data.communities);
        }).catch((error) => {
            console.log(error);
        });
    },
    postZone({commit}, zone) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/parishes/' + zone.parishId + '/zones';
        return new Promise((resolve, reject) => {
            axios.post(url, zone)
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
    loadZones({commit}, parishId){
        const url = '/rest/secured/parishes/' + parishId + '/zones';
        axios.get(url)
        .then((response) => {
          commit("setZones", response.data.zones);
        }).catch((error) => {
            console.log(error);
        });

    }
};
const mutations = {
    setParish(state, parish){
        state.parish = parish;
    },
    setParishes(state, parishes){
        state.parishes = parishes;
    },
    setCommunities(state, communities){
        state.communities = communities;
    },
    setCommunity(state, community){
        state.community = community;
    },
    setZone(state, zone){
        state.zone = zone;
    },
    setZones(state, zones){
        state.zones = zones;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
}
