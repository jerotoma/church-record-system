const mutations =  {
    setLoading(state, isLoading) {
        state.isLoading = isLoading;
    },
    setSending(state, isSending) {
        state.isSending = isSending;
    },
    setHasMessage(state, isMessage) {
        state.isMessage = isMessage;
    },
    setMessage(state, message) {
        state.message = message;
    },
    setPagination(state, pagination) {
        state.pagination = pagination;
    },
    setShowEditDialog(state, showEditDialog) {
        state.showEditDialog = showEditDialog;
    },
    setShowDeleteDialog(state, showDeleteDialog) {
        state.showDeleteDialog = showDeleteDialog;
    },
    setShowCreateDialog(state, showCreateDialog) {
        state.showCreateDialog= showCreateDialog;
    },
    setAuth(state, auth) {
        let currentUser = {
            userId: auth.id,
            fullName: auth.firstName + ' ' + auth.lastName,
            username: auth.username,
            roles: auth.roles,
            permissions: () => {
                let permissions = [];
                let roles = auth.roles;
                if (roles) {
                    roles.forEach(role => {
                        if (role.permissions) {
                            role.permissions.forEach(permission => {
                                permissions.push(permission);
                            });
                        }
                    });
                }
               return permissions;
            },
        }
        state.auth = currentUser;
    }
}

export default mutations;
