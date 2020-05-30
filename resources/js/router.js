import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        path: '*',
        name: 'notfound',
        component: () => import(/* webpackChunkName: "not-found.bundle" */'./components/NotFound'),
    },
    {
        path: '/',
        name: 'home',
        component: () => import(/* webpackChunkName: "example.bundle" */'./components/ExampleComponent'),
    },
    {
        path: '/orders',
        name: 'order.list',
        component: () => import(/* webpackChunkName: "orders.bundle" */'./components/OrderList'),
    },
    {
        path: '/orders/:id',
        name: 'order.show',
        component: () => import(/* webpackChunkName: "order-edit.bundle" */'./components/OrderEdit'),
        props: true,
    },
    {
        path: '/products',
        name: 'product.list',
        component: () => import(/* webpackChunkName: "order-edit.bundle" */'./components/ProductList'),
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;