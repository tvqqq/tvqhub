import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

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

