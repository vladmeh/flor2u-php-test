<template>
    <div class="container mx-auto py-6" v-if="order">
        <h1 class="mb-3 text-3xl" v-text="'Заказ № ' + order.id"></h1>
        <div class="max-w-3xl px-12 py-8 shadow-lg">
            <h3 class="mb-3 text-xl font-medium">Состав заказа</h3>
            <table class="w-full mb-6">
                <tr v-for="product in order.products">
                    <td class="border-t border-b px-4 py-2" v-text="product.name"></td>
                    <td class="border-t border-b px-4 py-2" v-text="product.quantity + ' шт.'"></td>
                    <td class="border-t border-b px-4 py-2" v-text="(product.price * product.quantity) + ' руб.'"></td>
                </tr>
                <tr>
                    <td colspan="2" class="px-4 py-2 text-right font-medium">Итого, стоимость заказа:</td>
                    <td class="px-4 py-2 font-medium" v-text="costOrder + ' руб.'"></td>
                </tr>
            </table>
            <form @submit.prevent="onSubmit">
                <div class="mb-4">
                    <label class="block font-medium mb-2 text-gray-700" for="client_email">
                        Клиент
                    </label>
                    <input class="appearance-none border focus:border-gray-400 focus:outline-none leading-tight px-3 py-2 rounded shadow text-gray-700 w-full"
                           id="client_email"
                           type="email"
                           v-model="order.client_email"
                           required
                    >
                    <span class="text-red-500 text-xs"
                          v-if="form.errors.has('client_email')"
                          v-text="form.errors.get('client_email')"></span>
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-2 text-gray-700" for="partner">
                        Партнер
                    </label>
                    <div class="relative">
                        <select class="appearance-none border focus:border-gray-400 focus:outline-none leading-tight px-3 py-2 rounded shadow text-gray-700 w-full"
                                id="partner"
                                v-model="order.partner_id"
                                required
                        >
                            <option v-for="partner in $root.partners" :value="partner.id">{{ partner.name }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-red-500 text-xs"
                          v-if="form.errors.has('partner_id')"
                          v-text="form.errors.get('partner_id')"></span>

                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-2 text-gray-700" for="status">
                        Статус заказа
                    </label>
                    <div class="relative">
                        <select class="appearance-none border focus:border-gray-400 focus:outline-none leading-tight px-3 py-2 rounded shadow text-gray-700 w-full"
                                id="status"
                                v-model="order.status"
                                required
                        >
                            <option v-for="(value, key) in $root.statuses" :value="key">{{ value }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-red-500 text-xs"
                          v-if="form.errors.has('status')"
                          v-text="form.errors.get('status')"></span>

                </div>
                <div class="flex justify-end">
                    <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Order from "../model/Order";
    import Form from "../utilites/Form";

    export default {
        name: "OrderEdit",
        data() {
            return {
                order: null,
                form: new Form({}),
            }
        },
        beforeRouteEnter(to, from, next) {
            if (!to.params.order) {
                Order.find(to.params.id, (err, data) => {
                    next(vm => vm.order = data.data);
                });
            } else {
                next(vm => vm.order = to.params.order);
            }
        },
        computed: {
            costOrder() {
                return this.order.products.map(item => {
                    return item.price * item.quantity
                }).reduce((a, b) => a + b, 0);
            },
        },
        methods: {
            onSubmit() {
                this.form = new Form({
                    client_email: this.order.client_email,
                    partner_id: this.order.partner_id,
                    status: this.order.status
                });

                this.form.patch('/api/orders/' + this.order.id)
                    .then(response => this.$swal(response.message, '', 'success'));
            }
        }
    }
</script>