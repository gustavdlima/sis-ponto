<template>
	<div class="grid h-full w-full m-auto p-2">
		<div class=" bg-white h-full w-full rounded-lg border-3 p-4">
			<DataTable :value="props.justificativa" tableStyle="padding: 1rem;" paginator :rows="10"
				:rowsPerPageOptions="[10, 20, 30, 50]">
				<Column field="id" header="ID" sortable></Column>
				<Column field="justificativa" header="Justificativa" ></Column>
				<Column field="" header="">
					<template #body="slotProps">
						<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
										@click="abrirEditarJustificativaDialog(slotProps)">
										<i class="pi pi-w pi-pen-to-square" style="font-size: 1.8rem"></i>
						</Button>
					</template>
				</Column>
			</DataTable>
		</div>
	</div>

	<DialogEditarJustificativa :justificativa="justificativaSelecionada" :isVisible="dialogEditarJustificativaIsVisible" @atualizarDialogEditarJustificativaBool="atualizarValorEditarJustificativaBool" />
</template>

<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import DialogEditarJustificativa from '../../Dialog/EditarJustificativasDialog.vue';

const props = defineProps({
	justificativa: {
		type: Array,
		required: true
	}
});
const dialogEditarJustificativaIsVisible = ref(false);
const justificativaSelecionada = ref();

const abrirEditarJustificativaDialog = (slotProps) => {
	justificativaSelecionada.value = slotProps.data;
	dialogEditarJustificativaIsVisible.value = true;
}

const atualizarValorEditarJustificativaBool = (eventData) => {
	dialogEditarJustificativaIsVisible.value = eventData.dialogEditarJustificativaIsVisible;
}

</script>

<style scoped>
p-datatable-header {
	padding: 1rem;
}

i {
	color: #1F2937 !important;
}

i:hover {
	color: aliceblue !important;
}

.botao-opcoes:hover {
	background-color: #1F2937 !important;
}

button {
	background-color: transparent !important;
	border: none !important;
}
</style>

