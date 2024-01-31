
import App from './App.vue'
import { createApp, markRaw } from 'vue'
import router from './router/index.js'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { createPinia } from 'pinia'
import { useAuthStore } from './stores/authStore';
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

const pinia = createPinia()

const vuetify = createVuetify({
	components,
	directives
})


pinia.use(({ store }) => {
	store.$router = markRaw(router);
})

createApp(App)
.use(router)
.use(VueAxios, axios)
.use(pinia)
.use(vuetify)
.mount('#app')

const authStore = useAuthStore();

router.beforeResolve((to) => {
	if (to.meta.requiresAuth && !authStore.userLogged) {
		return { path: '/login' }
	} else {
		return true
	}
})
