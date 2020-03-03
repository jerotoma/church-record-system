// initial state
const state = {
    authUser: null,
    success: false,
    loggedIn: false,
  }

  // getters
  const getters = {
    authUser: state => state.authUser,
    success: state => state.success,
    loggedIn: state => state.loggedIn,
  }

  // actions
  const actions = {
    postLogin({ commit }, userCredentials) {
        commit('setLoading', true);
        commit('setMessage', '');
        commit('setHasMessage', false);
        var url = '/auth/login';
        axios.post(url, userCredentials)
        .then((response) => {
            if(response.data.success){
                const data = response.data;
                window.location.replace('/dashboard');
                commit('setAuthUser', data.user)
                //commit('setLoading', false);
            }
        }).catch((error) => {
            const resp = error.response;
            //console.log(resp);
            commit('setMessage', resp.data.message + '. ' + resp.data.errors.username[0]);
            commit('setLoading', false);
            commit('setHasMessage', true);
        });
    },
    postLogout({ commit }){
        var url = '/auth/logout';
      return new Promise((resolve, reject) => {
        axios.post(url, {})
        .then((response) => {
            const data = response.data;
            if(data){
               resolve(data);
            }
        }).catch((error) => {
           reject(error.response);
        });
      });
    }
  };

  // mutations
  const mutations = {
    setAuthUser (state, authUser) {
      state.authUser = authUser;
    },
  };

  export default {
    state,
    getters,
    actions,
    mutations
  }
