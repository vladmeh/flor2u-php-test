class Order {
    static all(then) {
        return fetch('/api/orders', {
            cache: "no-cache"
        }).then((response) => {
            return response.json();
        }).then(({data}) => then(data));
    }

    static getOrders(page, callback) {
        const params = {page};
        console.log(params);
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