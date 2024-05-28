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
		component: () => import('../views/Admin/CadastrarViews/CadastroFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/cadastroOperador',
		name: 'CadastroOperador',
		component: () => import('../views/Admin/CadastrarViews/CadastroOperador.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/cadastroHorario',
		name: 'CadastroHorario',
		component: () => import('../views/Admin/CadastrarViews/CadastroHorario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/cadastroCargo',
		name: 'CadastroCargo',
		component: () => import('../views/Admin/CadastrarViews/CadastroCargo.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/cadastroJustificativa',
		name: 'CadastroJustificativa',
		component: () => import('../views/Admin/CadastrarViews/CadastroJustificativa.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/listarfuncionarios',
		name: 'Funcionarios',
		component: () => import('../views/Admin/ListarViews/ListarFuncionarios.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/listarOperadores',
		name: 'Operadores',
		component: () => import('../views/Admin/ListarViews/ListarOperadores.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/listarHorarios',
		name: 'Horarios',
		component: () => import('../views/Admin/ListarViews/ListarHorarios.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/listarCargos',
		name: 'Cargos',
		component: () => import('../views/Admin/ListarViews/ListarCargos.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/listarJustificativas',
		name: 'Justificativas',
		component: () => import('../views/Admin/ListarViews/ListarJustificativas.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarFuncionario/:id',
		name: 'EditarFuncionario',
		component: () => import('../views/Admin/EditarViews/EditarFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarOperador/:id',
		name: 'EditarOperador',
		component: () => import('../views/Admin/EditarViews/EditarOperador.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarHorario/:id',
		name: 'EditarHorario',
		component: () => import('../views/Admin/EditarViews/EditarHorario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarCargo/:id',
		name: 'EditarCargo',
		component: () => import('../views/Admin/EditarViews/EditarCargo.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarJustificativa/:id',
		name: 'EditarJustificativa',
		component: () => import('../views/Admin/EditarViews/EditarJustificativa.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarFuncionario/:id',
		name: 'EditarFuncionario',
		component: () => import('../views/Admin/EditarViews/EditarFuncionario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarOperador/:id',
		name: 'EditarOperador',
		component: () => import('../views/Admin/EditarViews/EditarOperador.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarHorario/:id',
		name: 'EditarHorario',
		component: () => import('../views/Admin/EditarViews/EditarHorario.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarCargo/:id',
		name: 'EditarCargo',
		component: () => import('../views/Admin/EditarViews/EditarCargo.vue'),
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/admin/editarJustificativa/:id',
		name: 'EditarJustificativa',
		component: () => import('../views/Admin/EditarViews/EditarJustificativa.vue'),
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
