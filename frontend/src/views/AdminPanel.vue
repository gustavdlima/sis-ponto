<template>
	<div class="container bg-warning d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div class="row bg-dark h-75 w-100">
			<div class="col-md-3 bg-danger">
				<div class="row">
					<h2>ePonto</h2>
				</div>

				<div class="row">
					<ul class="list-group">
						<li class="list-group-item">Listar Funcionários</li>
						<li class="list-group-item">Cadastrar Funcionário</li>
					</ul>
				</div>
			</div>
			<div class="col bg-info">
				<DataTable :data="funcionarios" :columns="columns" class="display">
					<thead>
						<tr>
						</tr>
					</thead>
				</DataTable>
			</div>
		</div>
	</div>
</template>

<script>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore, { responsive: true });

export default {
	name: "AdminPanel",
	components: {
		DataTable: DataTable,
	},
	data() {
		return {
			funcionarios: null,
			columns:[
				{data:null, render: function(data, type, row, meta)
				{return `${meta.row}`}},
				{data:'nome'},
				{data:'matricula'},
				{data:'data_nascimento'},
			]
		}
	},
	methods: {
		async getFuncionarios() {
			const response = await this.$http.get('http://localhost:8000/api/funcionario');
			this.funcionarios = response.data;
			console.log(this.funcionarios);
		}
	},
	mounted() {
		this.getFuncionarios();
	}
}

</script>

<style>
@import 'datatables.net-dt';
</style>
