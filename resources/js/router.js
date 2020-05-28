import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        path: '*',
        component: () => import(/* webpackChunkName: "not-found.bundle" */'./components/NotFound'),
    },
    {
        path: '/',
        component: () => import(/* webpackChunkName: "example.bundle" */'./components/ExampleComponent'),
    },
    {
        path: '/orders',
        component: () => import(/* webpackChunkName: "orders.bundle" */'./components/OrderList'),
    },
    {
        path: '/orders/1',
        component: () => import(/* webpackChunkName: "order-edit.bundle" */'./components/OrderEdit'),
    },
    {
        path: '/products',
        component: () => import(/* webpackChunkName: "order-edit.bundle" */'./components/ProductList'),
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;