<template>
	<div class="grid h-full w-full m-auto">
		<div class="grid grid-rows-12 p-2">
			<div class="row-span-1 md:row-span-2">
				<AdminNavBar />
			</div>
			<div class="row-span-11 md:row-span-10">
					<TabelaCargos :cargos="cargos" />
			</div>
		</div>
	</div>
</template>

<script setup>
import AdminNavBar from '../../../components/AdminNavBar.vue';
import useListarService from '../../../services/ListarService';
import TabelaCargos from '../../../components/Admin/Tabelas/Listar/TabelaCargos.vue';
import { ref, onMounted } from 'vue'

const cargos = ref([]);

onMounted(async () => {
	const response = await useListarService.listarCargos();
	cargos.value = response.data;
	console.log(cargos.value)
});

</script>
