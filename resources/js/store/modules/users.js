// initial state
const state = {
    users: [],
    usersCount: 0
  }

  // getters
  const getters = {
      users: state => state.users,
      usersCount: state => state.usersCount,
  }

  // actions
  const actions = {
    getUsers ({ commit }) {
        axios({
            method: 'GET',
            url: '/rest/secured/users',
        })
        .then((response) => {
            const data = response.data;
            commit('setUsers', data.users);
            commit('setUsersCount', data.count);
        }).catch((error) => {
            console.log(error);
        });
    },
  }

  // mutations
  const mutations = {
    setUsers (state, users) {
      state.users = users
    },

    setUsersCount (state, count) {
      state.usersCount = count;
    }
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
