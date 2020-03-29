const state = {
    isLoading: false,
    isMessage: false,
    message: '',
    showEditDialog: false,
    showCreateDialog: false,
    showDeleteDialog: false,
    filterBy: '',
    pagination: {
        currentPage: 1,
        firstPageUrl: '',
        from: '',
        lastPage: '',
        lastPageUrl: '',
        nextPageUrl: '',
        path: '',
        perPage: 15,
        prevPageUrl: '',
        to: '',
        total: 0,
        sortType: 'desc',
        sortField: 'created_at',
    },
    auth: {
        userId: null,
        fullName: null,
        username: null,
        roles: null,
        permissions: null,
    }
};

export default state;
