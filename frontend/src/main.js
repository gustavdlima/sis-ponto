
import App from './App.vue'
import { createApp } from 'vue'
import router from './router/index.js'
import axios from 'axios'
import VueAxios from 'vue-axios'

createApp(App)
	.use(router)
	.use(VueAxios, axios)
	.mount('#app')
