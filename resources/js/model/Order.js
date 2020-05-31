class Order {
    static find(id, callback) {
        return axios
            .get('/api/orders/' + id)
            .then(response => {
                callback(null, response.data);
            })
            .catch(error => {
                callback(error, error.response.data);
            });
    }

    static all(page, callback) {
        const params = {page};
        axios
            .get('/api/orders', {params})
            .then(response => {
                callback(null, response.data);
            })
            .catch(error => {
                callback(error, error.response.data);
            });
    }

}

export default Order;