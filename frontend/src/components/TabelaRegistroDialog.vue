<template>
		<Dialog  v-model:visible="dialogBool"
			modal
			:pt="{
				root: 'border-none',
				mask: {
					style: 'backdrop-filter: blur(2px)'
				}
			}"
			class="bg-blue-200">
			<template #container>
				<div class="grid justify-center">
					<div class="grid justify-center">
					<DataTable
						:value="registro"
						tableStyle="min-width: 30rem">
						<Column field="data" header="Data"></Column>
						<Column field="primeiro_ponto" header="Primeiro Ponto"></Column>
						<Column field="segundo_ponto" header="Segundo Ponto"></Column>
						<Column field="terceiro_ponto" header="Terceiro Ponto"></Column>
						<Column field="quarto_ponto" header="Quarto Ponto"></Column>
					</DataTable>
					</div>
				</div>
			</template>
		</Dialog>
</template>

<script setup>
import { ref } from 'vue';
import Dialog from 'primevue/dialog';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const props = defineProps({
	registro: Object
});

const dialogBool = ref(true);
</script>
