
import App from './App.vue'
import { createApp } from 'vue'
import router from './router/index.js'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { createPinia } from 'pinia'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"


const pinia = createPinia()

createApp(App)
	.use(router)
	.use(VueAxios, axios)
	.use(pinia)
	.mount('#app')
