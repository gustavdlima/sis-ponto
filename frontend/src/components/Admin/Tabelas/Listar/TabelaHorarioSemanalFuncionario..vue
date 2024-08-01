<template>
		<div class="grid max-h-40">
			<DataTable columnResizeMode="fit" showGridlines :value="props.arrayHorarioSemanal" tableStyle="width: 30rem; height: 17rem;">

				<Column field="segunda.horario" header="Segunda"></Column>
				<Column field="terca.horario" header="Terça"></Column>
				<Column field="quarta.horario" header="Quarta"></Column>
				<Column field="quinta.horario" header="Quinta"></Column>
				<Column field="sexta.horario" header="Sexta"></Column>
			</DataTable>
		</div>
</template>

<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const props = defineProps({
		arrayHorarioSemanal: Array,
		funcionario: Object
	});
</script>
