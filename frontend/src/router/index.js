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
		path: '/admin/cadastroFuncionario',
		name: 'Cadastro',
		component: () => import('../views/AdminCadastrarViews/CadastroFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroOperador',
		name: 'CadastroOperador',
		component: () => import('../views/AdminCadastrarViews/CadastroOperador.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroHorario',
		name: 'CadastroHorario',
		component: () => import('../views/AdminCadastrarViews/CadastroHorario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroCargo',
		name: 'CadastroCargo',
		component: () => import('../views/AdminCadastrarViews/CadastroCargo.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/cadastroJustificativa',
		name: 'CadastroJustificativa',
		component: () => import('../views/AdminCadastrarViews/CadastroJustificativa.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarfuncionarios',
		name: 'Funcionarios',
		component: () => import('../views/AdminListarViews/ListarFuncionarios.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarOperadores',
		name: 'Operadores',
		component: () => import('../views/AdminListarViews/ListarOperadores.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarHorarios',
		name: 'Horarios',
		component: () => import('../views/AdminListarViews/ListarHorarios.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarCargos',
		name: 'Cargos',
		component: () => import('../views/AdminListarViews/ListarCargos.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/listarJustificativas',
		name: 'Justificativas',
		component: () => import('../views/AdminListarViews/ListarJustificativas.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarFuncionario/:id',
		name: 'EditarFuncionario',
		component: () => import('../views/AdminEditarViews/EditarFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarOperador/:id',
		name: 'EditarOperador',
		component: () => import('../views/AdminEditarViews/EditarOperador.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarHorario/:id',
		name: 'EditarHorario',
		component: () => import('../views/AdminEditarViews/EditarHorario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarCargo/:id',
		name: 'EditarCargo',
		component: () => import('../views/AdminEditarViews/EditarCargo.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarJustificativa/:id',
		name: 'EditarJustificativa',
		component: () => import('../views/AdminEditarViews/EditarJustificativa.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarFuncionario/:id',
		name: 'EditarFuncionario',
		component: () => import('../views/AdminEditarViews/EditarFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarOperador/:id',
		name: 'EditarOperador',
		component: () => import('../views/AdminEditarViews/EditarOperador.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarHorario/:id',
		name: 'EditarHorario',
		component: () => import('../views/AdminEditarViews/EditarHorario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarCargo/:id',
		name: 'EditarCargo',
		component: () => import('../views/AdminEditarViews/EditarCargo.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/editarJustificativa/:id',
		name: 'EditarJustificativa',
		component: () => import('../views/AdminEditarViews/EditarJustificativa.vue'),
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
