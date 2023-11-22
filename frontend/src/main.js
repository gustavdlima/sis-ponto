
import App from './App.vue'
import { createApp } from 'vue'
import router from './router/index.js'

createApp(App)
	.use(router)
	.mount('#app')
