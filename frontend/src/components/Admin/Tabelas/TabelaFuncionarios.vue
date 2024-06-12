<template>
	<div class="grid h-full w-full m-auto p-2 border-blue-950 rounded-lg">
		<div class=" bg-white rounded-lg border-3 p-4">
			<DataTable v-model:selection="funcionarioSelecionado" :value="funcionarios" selectionMode="single" size="normal"
				stripedRows :globalFilterFields="['nome', 'matricula']" sortMode="multiple" :filters="filters"
				:reorderableColumns="true" tableStyle="padding: 1rem;" paginator :rows="3"
				:rowsPerPageOptions="[5, 10, 20, 50]"
				>
				<template #header>
					<div class="grid justify-end">
						<IconField iconPosition="right">
							<InputIcon>
								<i class="pi pi-search" />
							</InputIcon>
							<InputText v-model="filters['global'].value" placeholder="Pesquisar"
								class="h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-sm md:text-md" />
						</IconField>
					</div>
				</template>
				<template #loading> Carregando os Funcionários</template>
				<Column field="nome" sortable header="Nome" style="width: 30%" />
				<Column field="matricula" sortable header="Matrícula" style="width: 25%" />
				<Column field="" header="" style="width: 35%">
					<template #body="slotProps">
						<div class="grid lg:content-center grid-rows-2 xl:grid-cols-2 gap-2">
							<div class="row-span-1 xl:col-span-1 grid justify-center">
								<Button label="Registro de Ponto"
									class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-sm md:text-md"
									@click="abrirRegistro(slotProps)" />
							</div>
							<div class="row-span-1 xl:col-span-1 grid justify-center">
								<Button label="Registrar Falta"
									class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-sm md:text-md" @click="registrarFalta(slotProps)" />
							</div>
						</div>
					</template>
				</Column>
			</DataTable>
		</div>
	</div>

	<RegistroDialog @updateDialogRegistroBool="atualizarValorRegistroBool" :propsObject="{ dialogRegistroIsVisible: dialogRegistroIsVisible, funcionarioSelecionado: funcionarioSelecionado, registroFuncionarioSelecionado: registroFuncionarioSelecionado }"/>

	<RegistrarFaltaDialog :is-visible="dialogRegistrarFaltaIsVisible" :funcionario="funcionarioSelecionado" @atualizarDialogRegistrarFaltaBool="atualizarValorRegistrarFaltaBool"/>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import InputIcon from 'primevue/inputicon';
import IconField from 'primevue/iconfield';
import { FilterMatchMode } from 'primevue/api';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import RegistroDialog from '../Dialog/RegistroDialog.vue';
import RegistrarFaltaDialog from '../Dialog/RegistrarFaltaDialog.vue';
import useListarService from '../../../services/ListarService';

const props = defineProps({
	funcionarios: Array
});

const dialogRegistroIsVisible = ref(false);
const dialogRegistrarFaltaIsVisible = ref(false);
const funcionarioSelecionado = ref();
var registroFuncionarioSelecionado = ref ();
const filters = ref({
	global: {
		matchMode: FilterMatchMode.CONTAINS
	}
});

const abrirRegistro = async (slotProps) => {
	funcionarioSelecionado.value = slotProps.data;
	const response = [
		await useListarService.registroFuncionario({
			id_funcionario: funcionarioSelecionado.value.id
		})
	]
	registroFuncionarioSelecionado.value = response[0].data;
	dialogRegistroIsVisible.value = true;
}

const atualizarValorRegistroBool = (eventData) => {
	dialogRegistroIsVisible.value = eventData.dialogRegistroIsVisible;
}

const registrarFalta = (slotProps) => {
	funcionarioSelecionado.value = slotProps.data;
	dialogRegistrarFaltaIsVisible.value = true;
}

const atualizarValorRegistrarFaltaBool = (eventData) => {
	dialogRegistrarFaltaIsVisible.value = eventData.dialogRegistrarFaltaIsVisible;
}

</script>

<style scoped>
p-datatable-header {
	padding: 1rem;
}

button {
	background-color: #1F2937 !important;
	border: none !important
}
</style>
