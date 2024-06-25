<template>
	<div class="grid h-full w-full m-auto p-2">
		<div class=" bg-white h-full w-full rounded-lg border-3 p-4">
			<DataTable :value="props.justificativa" tableStyle="padding: 1rem;" paginator :rows="10"
				:rowsPerPageOptions="[10, 20, 30, 50]">
				<Column field="id" header="ID" sortable></Column>
				<Column field="justificativa" header="Justificativa"></Column>
				<Column field="" header="">
					<template #body="slotProps">
						<div class="grid h-full w-full">
							<div class="grid grid-rows-1">
								<div class="row-span-1">
									<div class="grid sm:gap-2 lg:grid-cols-1">
										<div class="lg:col-span-1">
											<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
												@click="abrirEditarJustificativaDialog(slotProps)">
												<i class="pi pi-w pi-pen-to-square" style="font-size: 1.8rem"></i>
											</Button>
											<Button class="botao-opcoes h-9 w-12 text-sm md:text-md ml-2"
												@click="abrirRemoverJustificativa(slotProps)">
												<i class="pi pi-w pi-times" style="font-size: 1.8rem"></i>
											</Button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</template>
				</Column>
			</DataTable>
		</div>
	</div>

	<DialogEditarJustificativa :justificativa="justificativaSelecionada" :isVisible="dialogEditarJustificativaIsVisible"
		@atualizarDialogEditarJustificativaBool="atualizarValorEditarJustificativaBool" />

	<RemoverJustificativaDialog :isVisible="dialogRemoverJustificativaIsVisible"
		:justificativa="justificativaSelecionada"
		@atualizarDialogRemoverJustificativaBool="atualizarValorRemoverJustificativaBool" />
</template>

<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import DialogEditarJustificativa from '../../Dialog/EditarJustificativasDialog.vue';
import RemoverJustificativaDialog from '../../Dialog/RemoverJustificativaDialog.vue'

const props = defineProps({
	justificativa: {
		type: Array,
		required: true
	}
});
const dialogEditarJustificativaIsVisible = ref(false);
const dialogRemoverJustificativaIsVisible = ref(false);
const justificativaSelecionada = ref();


const abrirEditarJustificativaDialog = (slotProps) => {
	justificativaSelecionada.value = slotProps.data;
	dialogEditarJustificativaIsVisible.value = true;
}

const atualizarValorEditarJustificativaBool = (eventData) => {
	dialogEditarJustificativaIsVisible.value = eventData.dialogEditarJustificativaIsVisible;
}

const abrirRemoverJustificativa = (slotProps) => {
	justificativaSelecionada.value = slotProps.data;
	dialogRemoverJustificativaIsVisible.value = true;
}

const atualizarValorRemoverJustificativaBool = (eventData) => {
	dialogRemoverJustificativaIsVisible.value = eventData.dialogRemoverJustificativaIsVisible;
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
