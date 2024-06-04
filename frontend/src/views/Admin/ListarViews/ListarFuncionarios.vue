<template>
	<div class="grid h-full w-full m-auto">
		<div class="grid grid-rows-12 p-2">
			<div class="row-span-1 md:row-span-2">
				<AdminNavBar />
			</div>
			<div class="row-span-11 md:row-span-10">
				<TabelaFuncionarios :funcionarios="funcionarios" />
			</div>
		</div>
	</div>
</template>

<script setup>
import AdminNavBar from '../../../components/AdminNavBar.vue';
import useListarService from '../../../services/ListarService';
import TabelaFuncionarios from '../../../components/Admin/Tabelas/TabelaFuncionarios.vue';
import { ref, onMounted } from 'vue';

const funcionarios = ref();

onMounted(async () => {
	const response = await useListarService.listarFuncionarios();
	funcionarios.value = response.data
	console.log(funcionarios.value)
});

</script>

<style scoped>
	p-datatable-header {
		padding: 1rem;
	}

	button {
		background-color: #1F2937 !important;
		border: none !important
	}
</style>
