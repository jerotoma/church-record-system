const actions =  {
//User sections
    loadCurrentUser(context){
        axios.get('/api/users/loggedIn/')
        .then((response) => {
            // console.log(response);
            context.commit("setUser", response.data.user);
        }).catch((error) => {
            console.log(error);
        });
    },
}

export default actions;
