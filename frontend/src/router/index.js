import { createRouter, createWebHistory } from 'vue-router'

const routes = [
	{
		path: '/',
		name: 'Home',
		component: () => import('../views/Home.vue')
	},
	{
		path: '/cadastro',
		name: 'Cadastro',
		component: () => import('../views/Cadastro.vue')
	},
	{
		path: '/baterponto',
		name: 'BaterPonto',
		component: () => import('../views/BaterPonto.vue')
	},
	{
		path: '/admin',
		name: 'Admin',
		component: () => import('../views/AdminDashboard.vue')
	}
]

const router = createRouter ({
	history: createWebHistory(),
	routes
})

export default router;
