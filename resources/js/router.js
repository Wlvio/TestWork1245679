import Vue from 'vue';
import VueRouter from 'vue-router';
import IndexPageComponent from './Pages/IndexPageComponent';

Vue.use(VueRouter);

const routes = [
  {
      name: 'index',
      path: '/',
      component:  IndexPageComponent
  },
];

const router = new VueRouter({ 
  mode: 'history',
  routes
});

export default router;
