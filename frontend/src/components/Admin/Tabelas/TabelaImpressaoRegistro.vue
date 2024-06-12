<template>
	<div v-if="tabelaIsVisible" class="grid">
			<DataTable :value="registro" stripedRows showGridLines="true" dataKey="id" size="small" tableStyle=" font-size: 12px;">
				<Column field="dia" header="Data"></Column>
				<Column field="primeiro_ponto" header="Primeiro Horario"></Column>
				<Column field="segundo_ponto" header="Segundo Horario"></Column>
				<Column field="terceiro_ponto" header="Terceiro Horario"></Column>
				<Column field="quarto_ponto" header="Quarto Horario"></Column>
				<Column field="justificativa" header="Justificativa"></Column>
			</DataTable>
	</div>
</template>

<script setup>
import { ref, watch } from 'vue'
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const props = defineProps({
	registro: Array,
	isVisible: Boolean
});
const tabelaIsVisible = ref(false);

watch(props, (newValue) => {
	tabelaIsVisible.value = newValue.isVisible;
	// registroRef.value = newValue.registro;
	// tabelaIsVisible.value = newValue.isVisible;
});

</script>
