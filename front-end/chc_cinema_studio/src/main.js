import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';

import FilmsList from '@/components/FilmsList.vue';
import FilmsDetail from '@/components/FilmsDetail.vue';
import FilmsCreate from '@/components/FilmsCreate.vue';
import FilmsProjection from '@/components/FilmsProjection.vue';


Vue.config.productionTip = false

Vue.use(VueRouter);

const routes = [
  {
    path: '/films/list',
    name: "films_list",
    component: FilmsList,
  },
  {
    path: '/films/detail/:id',
    name: "films_detail",
    component: FilmsDetail,
  },
  {
    path: '/films/create',
    name: "films_create",
    component: FilmsCreate,
  },
  {
    path: '/films/projection/:id',
    name: "films_projection",
    component: FilmsProjection,
  },
  
  {
    path: '',
    redirect: '/films/list',
  }
];


const router = new VueRouter({
  mode: "history",
  routes,
});

new Vue({
  render: h => h(App),
  router,
}).$mount('#app')
