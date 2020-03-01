const mutations =  {
    setLoading(state, isLoading) {
        state.isLoading = isLoading;
    },
    setHasMessage(state, isMessage) {
        state.isMessage = isMessage;
    },
    setMessage(state, message) {
        state.message = message;
    }
}

export default mutations;
