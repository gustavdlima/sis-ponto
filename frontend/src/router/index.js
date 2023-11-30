import { createRouter, createWebHistory } from 'vue-router'

const routes = [
	{
		path: '/',
		name: 'Home',
		component: () => import('../views/Home.vue')
	},
	{
		path: '/login',
		name: 'Login',
		component: () => import('../views/BaterPonto.vue')
	},
	{
		path: '/cadastro',
		name: 'Cadastro',
		component: () => import('../views/Cadastro.vue')
	}

]

const router = createRouter ({
	history: createWebHistory(),
	routes
})

export default router;
