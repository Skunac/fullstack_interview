import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue'
import HomeView from './views/HomeView.vue'
import CreateRecipe from './views/CreateRecipe.vue'
import ModifyRecipe from './views/ModifyRecipe.vue'
import vuetify from './plugins/vuetify';

const routes = [
  {name: 'root', path: '/', component: HomeView},
  {name: 'create', path: '/create', component: CreateRecipe},
  {name: 'modifyRecipe', path: '/modify', component: ModifyRecipe}
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

createApp(App)
  .use(router)
  .use(vuetify)
  .mount('#app');


