<template>
	<div class="grid h-full w-full m-auto">
		<div class="grid grid-rows-12 p-2">
			<div class="row-span-1 md:row-span-2">
				<AdminNavBar />
			</div>
			<div class="row-span-11 md:row-span-10">
						<TabelaJustificativa :justificativa="justificativa" />
			</div>
		</div>
	</div>
</template>

<script setup>
import AdminNavBar from '../../../components/AdminNavBar.vue';
import useListarService from '../../../services/ListarService';
import { ref, onMounted } from 'vue';
import TabelaJustificativa from '../../../components/Admin/Tabelas/Listar/TabelaJustificativa.vue';

const justificativa = ref([]);

onMounted(async () => {
	const response = await useListarService.listarJustificativas();
	justificativa.value = response.data;
});

</script>
