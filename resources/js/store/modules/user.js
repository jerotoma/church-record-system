// initial state
const state = {
    user: {
        firstName: null,
        lastName: null,
        middleName: null,
        email: null,
        phoneNumber: null,
        gender: 'male',
        occupation: null,
        streetAddress: null,
        parishId: null,
        zoneId: null,
        communityId: null,
        unitNumber: null,
        city: null,
        country: null,
        state: null,
        postalCode: null,
    },
    users: [],
    usersCount: 0
  }

  // getters
  const getters = {
      users: state => state.users,
      user: state => state.user,
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
    postUser({ commit }, user) {
        commit("setSending", true);
        return new Promise((resolve, reject) => {
                axios({
                method: 'POST',
                url: '/rest/secured/users',
                data: user
            }).then((response) => {
                const data = response.data;
                commit("setSending", false);
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                commit('setMessage', resp.data.message);
                commit('setLoading', false);
                commit('setHasMessage', true);
                reject(resp);
            });
        });
    },
    updateUser({ commit }, user) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'PUT',
                url: '/rest/secured/users',
                data: user
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
    deleteUser({ commit }, user) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'DELETE',
                url: '/rest/secured/users/' + user.id,
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
    }
  }

  // mutations
  const mutations = {
    setUser (state, user) {
      state.user = user
    },
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
