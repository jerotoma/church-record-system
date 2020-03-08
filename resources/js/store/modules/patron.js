const state = {
    patron: null,
    patrons: [],
};
const getters = {
    patron: state => state.patron,
    patrons: state => state.patrons,
};
const actions = {
    postPatron({commit}, patron) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        const url = '/rest/secured/patrons';
        return new Promise((resolve, reject) => {
            axios.post(url, patron)
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
    loadPatrons({commit}, pagination){
        commit('setLoading', true);
        const url = '/rest/secured/patrons?page='+ pagination.currentPage + '&perPage=' + pagination.perPage + '&sortType='+ pagination.sortType + '&sortField=' + pagination.sortField;
        axios.get(url)
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit("setPatrons", data.patrons);
            commit("setPagination", data.pagination);
        }).catch((error) => {
            console.log(error);
        });

    },
};
const mutations = {
    setPatron(state, patron){
        state.patron = patron;
    },
    setPatrons(state, patrons){
        state.patrons = patrons;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
}