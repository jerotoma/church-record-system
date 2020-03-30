const getters = {
    auth: state => state.auth,
    isLoading: state => state.isLoading,
    isSending: state => state.isSending,
    isMessage: state => state.isMessage,
    message: state => state.message,
    pagination: state => state.pagination,
    showEditDialog: state => state.showEditDialog,
    showCreateDialog: state => state.showCreateDialog,
    showDeleteDialog: state => state.showDeleteDialog,
};

export default getters;
