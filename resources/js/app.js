import Vue from 'vue';
import VueSwal from 'vue-swal'
import router from './router';
import App from "./App.vue";
import Partner from "./model/Partner";

require('./bootstrap');

Vue.use(VueSwal);

Vue.filter('currencyRub', function (value) {
    if (!value) {
        return '';
    }
    return value.toString().split('.')[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
});

new Vue({
    data: {
        partners: [],
        statuses: {
            0: "новый",
            10: "подтвержден",
            20: "завершен"
        },
    },
    created() {
        Partner.all(({data}) => this.partners = data);
    },
    router,
    render: h => h(App)
}).$mount('#app');