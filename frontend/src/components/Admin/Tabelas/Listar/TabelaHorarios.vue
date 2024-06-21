<template>
	<div class="grid h-full w-full m-auto p-2">
		<div class=" bg-white h-full w-full rounded-lg border-3 p-4">
			<DataTable :value="props.horarios" tableStyle="padding: 1rem;" paginator :rows="10"
				:rowsPerPageOptions="[10, 20, 30, 50]">
				<Column field="id" header="ID" sortable></Column>
				<Column field="primeiro_horario" header="Primeiro Horário"></Column>
				<Column field="segundo_horario" header="Segundo Horário"></Column>
				<Column field="terceiro_horario" header="Terceiro Horário"></Column>
				<Column field="quarto_horario" header="Quarto Horário"></Column>
				<Column field="" header="">
					<template #body="slotProps">
						<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
										@click="abrirEditarHorarioDialog(slotProps)">
										<i class="pi pi-w pi-pen-to-square" style="font-size: 1.8rem"></i>
						</Button>
					</template>
				</Column>
			</DataTable>
		</div>
	</div>

	<DialogEditarHorario :horario="horarioSelecionado" :isVisible="dialogEditarHorarioIsVisible" @atualizarDialogEditarHorarioBool="atualizarValorEditarHorarioBool" />
</template>

<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import DialogEditarHorario from '../../Dialog/EditarHorariosDialog.vue';

const props = defineProps({
	horarios: {
		type: Array,
		required: true
	}
});
const dialogEditarHorarioIsVisible = ref(false);
const horarioSelecionado = ref();

const abrirEditarHorarioDialog = (slotProps) => {
	horarioSelecionado.value = slotProps.data;
	dialogEditarHorarioIsVisible.value = true;
}

const atualizarValorEditarHorarioBool = (eventData) => {
	dialogEditarHorarioIsVisible.value = eventData.dialogEditarHorarioIsVisible;
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
