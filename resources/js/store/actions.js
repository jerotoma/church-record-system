const actions =  {
//User sections
    loadLoggedInUser(context){
        axios.get('/rest/secured/users/logged-in')
        .then((response) => {
            console.log(response);
            context.commit("setAuth", response.data.auth);
        }).catch((error) => {
            console.log(error);
        });
    },
}

export default actions;
