const state = {
    giving: {
        id: null,
        memberIds: [],
        givingTypeId: null,
        amount: null,
        datePaid: null,
    },
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
    deleteGiving({ commit }, giving) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'DELETE',
                url: '/rest/secured/givings/' + giving.id,
                data: {}
            }).then((response) => {
                const data = response.data;
                resolve(data);
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
    loadGivings({commit}, pagination){
        commit('setLoading', true);
        const url = '/rest/secured/givings?page='+ pagination.currentPage + '&perPage=' + pagination.perPage + '&sortType='+ pagination.sortType + '&sortField=' + pagination.sortField;
        axios.get(url)
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit("setGivings", data.givings);
            commit("setPagination", data.pagination);
        }).catch((error) => {
            console.log(error);
        });

    },
    loadGivingsByMemberId({commit}, data){
        commit('setLoading', true);
        const url = '/rest/secured/givings/members/' + data.memberId +'?page='+ data.pagination.currentPage + '&perPage=' + data.pagination.perPage + '&sortType='+ data.pagination.sortType + '&sortField=' + data.pagination.sortField;
        axios.get(url)
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit("setGivings", data.givings);
            commit("setPagination", data.pagination);
        }).catch((error) => {
            console.log(error);
        });
    },
    loadGivingsByGivingType({commit}, data){
        console.log(data);
        commit('setLoading', true);
        const url = '/rest/secured/givings/giving-types/' + data.givingTypeId +'?page='+ data.pagination.currentPage + '&perPage=' + data.pagination.perPage + '&sortType='+ data.pagination.sortType + '&sortField=' + data.pagination.sortField;
        axios.get(url)
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit("setGivings", data.givings);
            commit("setPagination", data.pagination);
        }).catch((error) => {
            console.log(error);
        });

    }
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
