const actions =  {
//User sections
    loadLoggedInUser(context){
        axios.get('/rest/secured/users/logged-in')
        .then((response) => {
            context.commit("setLoading", false);
            context.commit("setAuth", response.data.auth);
        }).catch((error) => {
            context.commit("setLoading", false);
            console.log(error);
        });
    },
}

export default actions;
