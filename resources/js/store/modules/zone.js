const state = {
    zone: {
        name: null,
        code: null,
        id: null,
        parishId: null,
    },
    zones: [],
};
const getters = {
    zone: state => state.zone,
    zones: state => state.zones,
};
const actions = {
    postZone({commit}, zone) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/zones';
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
    updateZone({commit}, zone) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/zones';
        return new Promise((resolve, reject) => {
            axios.put(url, zone)
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
    loadZones({commit}){
        const url = '/rest/secured/zones';
        axios.get(url)
        .then((response) => {
          commit("setZones", response.data.zones);
        }).catch((error) => {
            console.log(error);
        });

    },
    loadZonesByParishId({commit}, data){
        const url = '/rest/secured/zones/parishes/' + data.id;
        axios.get(url)
        .then((response) => {
          commit("setZones", response.data.zones);
        }).catch((error) => {
            console.log(error);
        });
    }
};
const mutations = {
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
