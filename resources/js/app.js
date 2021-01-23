import Vue from 'vue';
import router from './router';
import Vuetify from 'vuetify';
import App from './App.vue';

require('./bootstrap');

Vue.use(Vuetify);

new Vue({ 
    router,
    vuetify: new Vuetify(),
    render: (h) => h(App),
}).$mount('#app');
