<template>
	<div class="grid h-full w-full m-auto">
		<DataTable :value="registro" stripedRows showGridLines="true" dataKey="id" :paginator="true" :rows="10" :rowsPerPageOptions="[5, 15, 30]" size="small">
			<Column field="data" header="Data"></Column>
			<Column field="diaSemana" header="Dia da Semana"></Column>
			<Column field="primeiro_ponto" header="Primeiro Horario"></Column>
			<Column field="segundo_ponto" header="Segundo Horario"></Column>
			<Column field="terceiro_ponto" header="Terceiro Horario"></Column>
			<Column field="quarto_ponto" header="Quarto Horario"></Column>
			<Column field="justificativa" header="Justificativa"></Column>
		</DataTable>
	</div>
</template>

<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { ref, watch } from 'vue';

const props = defineProps({
	registro: Array
});


</script>

<style scoped>

</style>
