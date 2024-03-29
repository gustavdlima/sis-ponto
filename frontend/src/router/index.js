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
		path: '/cadastroFuncionario',
		name: 'Cadastro',
		component: () => import('../views/CadastroFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroOperador',
		name: 'CadastroOperador',
		component: () => import('../views/CadastroOperador.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroHorario',
		name: 'CadastroHorario',
		component: () => import('../views/CadastroHorario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroCargo',
		name: 'CadastroCargo',
		component: () => import('../views/CadastroCargo.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroJustificativa',
		name: 'CadastroJustificativa',
		component: () => import('../views/CadastroJustificativa.vue'),
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
		path: '/listarHorarios',
		name: 'Horarios',
		component: () => import('../views/ListarHorarios.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarCargos',
		name: 'Cargos',
		component: () => import('../views/ListarCargos.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarJustificativas',
		name: 'Justificativas',
		component: () => import('../views/ListarJustificativas.vue'),
		meta: {
			requiresAuth: true
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

export default router;
