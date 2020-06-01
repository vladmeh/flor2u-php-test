class Product {
    static all(page, callback) {
        const params = {page};
        axios
            .get('/api/products', {params})
            .then(response => {
                callback(null, response.data);
            })
            .catch(error => {
                callback(error, error.response.data);
            });
    }
}

export default Product;