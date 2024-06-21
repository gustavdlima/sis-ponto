<template>
	<div class="grid h-full w-full m-auto">
		<div class="grid grid-rows-12 p-2">
			<div class="row-span-1 md:row-span-2">
				<AdminNavBar />
			</div>
			<div class="row-span-11 md:row-span-10">
				<TabelaOperadores :operadores="operadores" />
			</div>
		</div>
	</div>
</template>

<script setup>
import AdminNavBar from '../../../components/AdminNavBar.vue';
import useListarService from '../../../services/ListarService';
import TabelaOperadores from '../../../components/Admin/Tabelas/Listar/TabelaOperadores.vue';
import { ref, onMounted } from 'vue';

const operadores = ref([]);

onMounted(async () => {
	const response = await useListarService.listarOperadores();
	console.log(response.data);
	operadores.value = response.data;
});

</script>
