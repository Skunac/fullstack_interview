import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue'
import HomeView from './views/HomeView.vue'
import CreateRecipe from './views/CreateRecipe.vue'
import ModifyRecipe from './views/ModifyRecipe.vue'
import vuetify from './plugins/vuetify';

const routes = [
  {path: '/', component: HomeView},
  {path: '/create', component: CreateRecipe},
  {name: 'modifyRecipe', path: '/modify', component: ModifyRecipe, props:true}
];

const router = createRouter({
  history: createWebHistory(),
  mode: 'history',
  routes
});

createApp(App)
  .use(router)
  .use(vuetify)
  .mount('#app');


