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
		component: () => import('../views/CadastroFuncionario.vue')
	},
	{
		path: '/baterponto',
		name: 'BaterPonto',
		component: () => import('../views/BaterPonto.vue')
	},
	{
		path: '/admin',
		name: 'Admin',
		beforeEnter: (to, from, next) => {
			
		},
		component: () => import('../views/AdminPanel.vue')
	},
	{
		path: '/listarfuncionarios',
		name: 'Funcionarios',
		component: () => import('../views/ListarFuncionarios.vue')
	},
	{
		path: '/login',
		name: 'Login',
		component: () => import('../views/AdminLogin.vue')
	}
]

const router = createRouter ({
	history: createWebHistory(),
	routes
})

export default router;
