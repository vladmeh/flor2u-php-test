<template>
    <div>
        <h1 class="mb-3 text-3xl">Список продутов</h1>
        <page-paginate :links="links" :meta="meta"></page-paginate>
        <table class="shadow-lg w-full table-auto">
            <thead>
            <tr>
                <th class="bg-gray-200 border px-4 py-4 cursor-pointer">Id</th>
                <th class="bg-gray-200 border px-4 py-4 cursor-pointer">Наименование</th>
                <th class="bg-gray-200 border px-4 py-4 cursor-pointer">Поставщик</th>
                <th class="bg-gray-200 border px-4 py-4 cursor-pointer">Цена</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products">
                <td class="border px-4 py-2" v-text="product.id"></td>
                <td class="border px-4 py-2" v-text="product.name"></td>
                <td class="border px-4 py-2" v-text="product.vendor.name"></td>
                <td class="border px-4 py-2" v-text="product.price"></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Product from "../model/Product";
    import PagePaginate from "./PagePaginate";

    export default {
        name: "ProductList",
        data() {
            return {
                products: [],
                meta: null,
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null
            }
        },
        beforeRouteEnter(to, from, next) {
            Product.all(to.query.page, (err, data) => {
                next(vm => vm.setProducts(err, data))
            })
        },
        beforeRouteUpdate(to, from, next) {
            this.products = this.links = this.meta = null;
            Product.all(to.query.page, (err, data) => {
                this.setProducts(err, data);
                next();
            });
        },
        methods: {
            setProducts(err, {data: products, links, meta}) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.products = products;
                    this.links = links;
                    this.meta = meta;
                }
            },
        },
        components: {
            PagePaginate
        }
    }
</script>