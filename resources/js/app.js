import Vue from 'vue/dist/vue'
window.Vue = Vue

import App from './App.vue';
import VueRouter from 'vue-router';
import { routes } from './routes';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueRouter);
Vue.use(VueToast);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});

