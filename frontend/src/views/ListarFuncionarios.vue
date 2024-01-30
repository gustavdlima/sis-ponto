
<template>
	<div class="container bg-warning d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div class="row bg-dark h-75 w-100">
			<div class="col-md-3 bg-danger">
				<div class="row">
					<SideBar></SideBar>
				</div>
			</div>
			<div class="col bg-info">
				<DataTable id="table" :data="funcionarios" :language="language" :columns="columns" :options="options">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Setor</th>
						<th>Matricula</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Nome</th>
						<th>Setor</th>
						<th>Matricula</th>
					</tr>
				</tfoot>
				</DataTable>
			</div>
		</div>
	</div>
</template>

<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import SideBar from '../components/SideBar.vue';
import language from 'datatables.net-plugins/i18n/pt-BR.mjs';
import { useAuthStore } from '../stores/authStore';
import { ref } from 'vue';
import axios from 'axios';

const authStore = useAuthStore();
const funcionarios = ref('');
DataTable.use(DataTablesCore, { responsive: true });

const columns = [
	{ title: 'Nome', data: 'nome' },
	{ title: 'Setor', data: 'setor' },
	{ title: 'Matricula', data: 'matricula' },
]

const options = {
	language: language
}


function getFuncionarios() {
			const bearerToken = 'Bearer ' + authStore.userToken;
			axios.defaults.headers.common = {
				'Authorization': bearerToken
			}
			const response =  axios.get('http://localhost:8000/api/funcionarios').then(response => {
				funcionarios.value = response.data;
				console.log(response);
				console.log(funcionarios.value);
				return funcionarios.value;
			})
			.catch(error => {
				console.log(error);
			});
}

getFuncionarios();

</script>

<!-- <script>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import SideBar from '../components/SideBar.vue';
import language from 'datatables.net-plugins/i18n/pt-BR.mjs';


DataTable.use(DataTablesCore, { responsive: true });

export default {
	name: "ListarFuncionarios",
	components: {
		DataTable: DataTable,
		SideBar: SideBar,
	},
	data() {
		return {
			funcionarios: null,
			columns: [
				{
					data: null, render: function (data, type, row, meta) { return `${meta.row}` }
				},
				{ data: 'nome' },
				{ data: 'matricula' },
				{ data: 'data_nascimento' },
			],
			options: {
				language: language
			}
		}
	},
	methods: {
		async getFuncionarios() {
			const response = await this.$http.get('http://localhost:8000/sanctum/csrf-cookie');
			console.log(response);
			await this.$http.get('http://localhost:8000/sanctum/csrf-cookie');
			await this.$http.get('http://localhost:8000/api/funcionarios');
			this.funcionarios = response.data;
		}

	},
	mounted() {
		this.getFuncionarios();
	}
}

</script> -->

<style>
@import 'datatables.net-dt';
</style>
