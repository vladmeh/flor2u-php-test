import Vue from 'vue';
import router from './router';
import App from "./App.vue";

require('./bootstrap');

Vue.filter('currencyRub', function (value) {
    if (!value) {
        return '';
    }
    return value.toString().split('.')[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
});

new Vue({
    router,
    render: h => h(App)
}).$mount('#app');