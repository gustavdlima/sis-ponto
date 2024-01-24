import { createRouter, createWebHistory } from 'vue-router'

const routes = [
	{
		path: '/',
		name: 'Home',
		component: () => import('../views/Home.vue'),
		meta: {
			requiresAuth: false
		}
	},
	{
		path: '/cadastro',
		name: 'Cadastro',
		component: () => import('../views/CadastroFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/baterponto',
		name: 'BaterPonto',
		component: () => import('../views/BaterPonto.vue'),
		meta: {
			requiresAuth: false
		}
	},
	{
		path: '/admin',
		name: 'Admin',
		component: () => import('../views/AdminPanel.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarfuncionarios',
		name: 'Funcionarios',
		component: () => import('../views/ListarFuncionarios.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/login',
		name: 'Login',
		component: () => import('../views/AdminLogin.vue'),
		meta: {
			requiresAuth: false
		}
	}
]

const router = createRouter ({
	history: createWebHistory(),
	routes
})

router.beforeEach((to) => {
	if (to.meta.requiresAuth && !localStorage.getItem('Auth')) {
		return { name: 'Login' }
	} else {
		return true
	}
})

export default router;
