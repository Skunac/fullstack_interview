import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'

axios.po
loadFonts()

createApp(App)
  .use(vuetify)
  .mount('#app')
