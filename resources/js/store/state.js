const state = {
    isLoading: false,
    isMessage: false,
    message: '',
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
        sortField: 'created_on',
    }
};

export default state;
