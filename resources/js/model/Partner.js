class Partner {
    static all(then){
        return axios.get('/api/partners')
            .then(({data}) => then(data));
    }
}

export default Partner;