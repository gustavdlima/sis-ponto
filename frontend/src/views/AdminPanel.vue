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
				<DataTable :columns="columns" class="display">
					<thead>
						<tr>
						</tr>
					</thead>
				</DataTable>
			</div>
		</div>
	</div>
</template>

<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore, { responsive: true });

const columns = [
	{ data: 'name' },
	{ data: 'position' },
	{ data: 'office' },
	{ data: 'extn' },
	{ data: 'start_date' },
	{ data: 'salary' },
];

</script>

<style>
@import 'datatables.net-dt';
</style>
