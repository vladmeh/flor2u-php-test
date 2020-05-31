<template>
    <div>
        <h1 class="mb-3 text-3xl">Список заказов</h1>
        <div class="mb-3 flex justify-between items-center">
            <div>
                <router-link
                        tag="button"
                        :to="{ query: {page: prevPage}}"
                        :disabled="!prevPage"
                        :class="!prevPage ? 'opacity-50 cursor-not-allowed' : ''"
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                >Previous</router-link>
                <router-link
                        tag="button"
                        :to="{ query: {page: nextPage}}"
                        :disabled="!nextPage"
                        :class="!nextPage ? 'opacity-50 cursor-not-allowed' : ''"
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                >Next</router-link>
            </div>
            <div v-text="paginationCount" class="font-bold"></div>
        </div>
        <table class="shadow-lg w-full table-auto">
            <thead>
            <tr>
                <th class="bg-gray-200 border px-4 py-4">Заказ №</th>
                <th class="bg-gray-200 border px-4 py-4">Партнер</th>
                <th class="bg-gray-200 border px-4 py-4">Стоимость Заказа</th>
                <th class="bg-gray-200 border px-4 py-4">Состав Заказа</th>
                <th class="bg-gray-200 border px-4 py-4">Статус Заказа</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders">
                <td class="border px-4 py-2">
                    <router-link
                            :to="{ name: 'order.show', params: { id: order.id, order: order } }"
                            class="flex hover:bg-gray-100 hover:shadow-outline items-center justify-center"
                    >{{ order.id }}</router-link>
                </td>
                <td class="border px-4 py-2" v-text="order.partner.name"></td>
                <td class="border px-4 py-2" v-text="costOrder(order.products) + ' руб.'"></td>
                <td class="border px-4 py-2">
                    <div v-for="product in order.products" v-text="product.name"></div>
                </td>
                <td class="border px-4 py-2" v-text="$root.statuses[order.status]"></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Order from "../model/Order";

    export default {
        name: "Orders",
        data() {
            return {
                orders: [],
                meta: null,
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null,
            }
        },
        computed: {
            nextPage() {
                if (! this.meta || this.meta.current_page === this.meta.last_page) {
                    return;
                }

                return this.meta.current_page + 1;
            },
            prevPage() {
                if (! this.meta || this.meta.current_page === 1) {
                    return;
                }

                return this.meta.current_page - 1;
            },
            paginationCount() {
                if (! this.meta) {
                    return;
                }

                const { current_page, last_page } = this.meta;

                return `${current_page} of ${last_page}`;
            },
        },
        beforeRouteEnter(to, from, next) {
            Order.all(to.query.page, (err, data) => {
                next(vm => vm.setData(err, data));
            });
        },
        beforeRouteUpdate(to, from, next){
            this.orders = this.links = this.meta = null;
            Order.all(to.query.page, (err, data) => {
                this.setData(err, data);
                next();
            });
        },
        methods: {
            fetchData() {
                return Order.all(orders => this.orders = orders);
            },
            costOrder(products) {
                return products.map(item => {
                    return item.price * item.quantity
                }).reduce((a, b) => a + b, 0);
            },
            setData(err, { data: orders, links, meta }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.orders = orders;
                    this.links = links;
                    this.meta = meta;
                }
            },
        }
    }
</script>