import Vue from 'vue'
import {BootstrapVue} from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from 'axios';
import VueRouter from 'vue-router'

Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(VueRouter);

// Plugin components
import App from './App.vue'
import Home from "./components/Home.vue";

const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: Home
        }
    ]
});

// Create a global mixin to expose strings, global config, and single backend resource.
Vue.mixin({
    computed: {
        nonce: function () {
            return TvqhubJs.nonce;
        }
    }
});

// Main Vue instance that bootstraps the frontend.
new Vue({
    el: '#tvqhub-utils-app',
    data: TvqhubJs.data,
    router,
    render: h => h(App)
});

