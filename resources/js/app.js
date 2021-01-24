import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './router';
import store from "./store/index"
import App from './App.vue';

require('./bootstrap');

Vue.use(Vuetify);

Object.defineProperty(Vue.prototype, '$lodash', { value: window._ });

new Vue({ 
    router,
    store,
    vuetify: new Vuetify(),
    render: (h) => h(App),
}).$mount('#app');
