<template>
    <div class="container mx-auto py-6">
        <h1 class="mb-3 text-3xl">Список заказов</h1>
        <page-paginate :links="links" :meta="meta"></page-paginate>
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
                    >{{ order.id }}
                    </router-link>
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
    import PagePaginate from "./PagePaginate";

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
        beforeRouteEnter(to, from, next) {
            Order.all(to.query.page, (err, data) => {
                next(vm => vm.setOrders(err, data));
            });
        },
        beforeRouteUpdate(to, from, next) {
            this.orders = this.links = this.meta = null;
            Order.all(to.query.page, (err, data) => {
                this.setOrders(err, data);
                next();
            });
        },
        methods: {
            costOrder(products) {
                return products.map(item => {
                    return item.price * item.quantity
                }).reduce((a, b) => a + b, 0);
            },
            setOrders(err, {data: orders, links, meta}) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.orders = orders;
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