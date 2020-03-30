const actions =  {
//User sections
    loadLoggedInUser(context){
        context.commit("setLoading", true);
        axios.get('/rest/secured/users/logged-in')
        .then((response) => {
            context.commit("setLoading", false);
            context.commit("setAuth", response.data.auth);
        }).catch((error) => {
            console.log(error);
        });
    },
}

export default actions;
