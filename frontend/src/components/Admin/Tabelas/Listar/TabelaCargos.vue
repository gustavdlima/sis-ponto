<template>
	<div class="grid h-full w-full m-auto p-2">
		<div class=" bg-white h-full w-full rounded-lg border-3 p-4">
			<DataTable :value="props.cargos" tableStyle="padding: 1rem;" paginator :rows="10"
				:rowsPerPageOptions="[10, 20, 30, 50]">
				<Column field="id" header="ID" sortable></Column>
				<Column field="cargo" header="Cargo" ></Column>
				<Column field="" header="">
					<template #body="slotProps">
						<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
										@click="abrirEditarCargosDialog(slotProps)">
										<i class="pi pi-w pi-pen-to-square" style="font-size: 1.8rem"></i>
						</Button>
					</template>
				</Column>
			</DataTable>
		</div>
	</div>

	<DialogEditarCargos :cargo="cargoSelecionado" :isVisible="dialogEditarCargoIsVisible" @atualizarDialogEditarCargoBool="atualizarValorEditarCargoBool" />

</template>

<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import DialogEditarCargos from '../../Dialog/EditarCargosDialog.vue';

const props = defineProps({
	cargos: {
		type: Array,
		required: true
	}
});
const dialogEditarCargoIsVisible = ref(false);
const cargoSelecionado = ref();

const abrirEditarCargosDialog = (slotProps) => {
	cargoSelecionado.value = slotProps.data;
	dialogEditarCargoIsVisible.value = true;
	console.log(slotProps);
}

const atualizarValorEditarCargoBool = (eventData) => {
	dialogEditarCargoIsVisible.value = eventData.dialogEditarCargoIsVisible;
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
