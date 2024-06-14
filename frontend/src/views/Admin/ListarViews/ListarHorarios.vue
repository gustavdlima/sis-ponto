<template>
	<div class="grid h-full w-full m-auto">
		<div class="grid grid-rows-12 p-2">
			<div class="row-span-1 md:row-span-2">
				<AdminNavBar />
			</div>
			<div class="row-span-11 md:row-span-10">
				<TabelaHorarios :horarios="horarios" />
			</div>
		</div>
	</div>
</template>

<script setup>
import AdminNavBar from '../../../components/AdminNavBar.vue';
import useListarService from '../../../services/ListarService';
import TabelaHorarios from '../../../components/Admin/Tabelas/Listar/TabelaHorarios.vue';
import { ref, onMounted } from 'vue';

const horarios = ref();

onMounted(async () => {
	const response = await useListarService.listarHorarios();
	horarios.value = response.data;
	console.log(response.data);
});

</script>
