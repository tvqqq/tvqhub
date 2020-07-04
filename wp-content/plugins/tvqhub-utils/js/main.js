import Vue from 'vue'
Vue.config.productionTip = false

import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)

import App from './App.vue'

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
    render: h => h(App)
});

