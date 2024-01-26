<template>
	<div class="container bg-warning d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div class="row bg-dark h-75 w-100">
			<div class="col-md-3 bg-danger">
				<div class="row">
					<SideBar></SideBar>
				</div>
			</div>
			<div class="col bg-info">
				{{ authStore.getFuncionarios() }}
				<!-- <DataTable :data="authStore.getFuncionarios" :columns="columns" class="" :options="options">
					<thead>
						<tr>
						</tr>
					</thead>
				</DataTable> -->
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

DataTable.use(DataTablesCore, { responsive: true });
const authStore = useAuthStore();

const funcionarios = ref(authStore.authUser);

var columns = [
	{
		data: null, render: function (data, type, row, meta) { return `${meta.row}` }
	},
	{ data: 'nome' },
	{ data: 'matricula' },
	{ data: 'data_nascimento' },
]

var options = {
	language: language
}

function getFuncionarios() {
	return authStore.getFuncionarios();
}

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
