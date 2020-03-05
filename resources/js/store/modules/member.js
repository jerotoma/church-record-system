// initial state
const state = {
    member: null,
    members: [],
    membersCount: 0
  }

  // getters
  const getters = {
      members: state => state.members,
      member: state => state.member,
      membersCount: state => state.membersCount,
  }

  // actions
  const actions = {
    getMembers ({ commit }) {
        axios({
            method: 'GET',
            url: '/rest/secured/members',
        })
        .then((response) => {
            const data = response.data;
            commit('setMembers', data.members);
            commit('setMembersCount', data.count);
        }).catch((error) => {
            console.log(error);
        });
    },
    postMember({ commit }, member) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'POST',
                url: '/rest/secured/members',
                data: member
            }).then((response) => {
                const data = response.data;
                commit('setMembers', data.member);
                resolve(data);
                //commit('setMembersCount', data.count);
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
  }

  // mutations
  const mutations = {
    setMember (state, member) {
      state.member = member
    },
    setMembers (state, members) {
        state.members = members
      },

    setMembersCount (state, count) {
      state.membersCount = count;
    }
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
