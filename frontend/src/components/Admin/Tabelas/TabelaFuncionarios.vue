<template>
	<div class="grid h-full w-full m-auto p-2 border-blue-950 rounded-lg">
		<div class=" bg-white rounded-lg border-3 p-4">
			<DataTable v-model:selection="funcionarioSelecionado" :value="funcionarios" selectionMode="single"
				size="normal" stripedRows :globalFilterFields="['nome', 'matricula']" sortMode="multiple"
				:filters="filters" :reorderableColumns="true" tableStyle="padding: 1rem;" paginator :rows="10"
				:rowsPerPageOptions="[5, 10, 20, 50]">
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
				<Column field="" header="" style="width: 15%">
					<template #body="slotProps">
						<div class="grid sm:gap-2 lg:grid-cols-5">
							<div class="lg:col-span-1">
								<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
									@click="abrirRegistro(slotProps)">
									<i class="pi pi-w pi-bars mt-1" style="font-size: 1.8rem"></i>
								</Button>
							</div>
							<div class="lg:col-span-1">
								<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
									@click="abrirRegistrarFalta(slotProps)">
									<i class="pi pi-w pi-calendar-times" style="font-size: 1.8rem"></i>
								</Button>
							</div>
							<div class="lg:col-span-1">
								<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
									@click="abrirEditarFuncionario(slotProps)">
									<i class="pi pi-w pi-user-edit" style="font-size: 1.8rem"></i>
								</Button>
							</div>
							<div class="lg:col-span-1">
								<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
									@click="abrirEditarDiasDaSemana(slotProps)">
									<i class="pi pi-w pi-calendar-clock" style="font-size: 1.8rem"></i>
								</Button>
							</div>
							<div class="lg:col-span-1">
								<Button class="botao-opcoes h-9 w-12 text-sm md:text-md"
									@click="abrirRemoverFuncionario(slotProps)">
									<i class="pi pi-w pi-times" style="font-size: 1.8rem"></i>
								</Button>
							</div>
						</div>
					</template>
				</Column>
			</DataTable>
		</div>
	</div>

	<RegistroDialog @atualizarDialogRegistroBool="atualizarValorRegistroBool"
		:propsObject="{ dialogRegistroIsVisible: dialogRegistroIsVisible, funcionarioSelecionado: funcionarioSelecionado, registroFuncionarioSelecionado: registroFuncionarioSelecionado, }" />

	<RegistrarFaltaDialog @atualizarDialogRegistrarFaltaBool="atualizarValorRegistrarFaltaBool"
		:is-visible="dialogRegistrarFaltaIsVisible" :funcionario="funcionarioSelecionado" />

	<EditarFuncionarioDialog @atualizarDialogEditarFuncionarioBool="atualizarDialogEditarFuncionarioBool"
	 :is-visible="dialogEditarFuncionarioIsVisible" :funcionario="funcionarioSelecionado" />

	 <EditarDiasDaSemanaDialog @atualizarDialogEditarDiasDaSemanaBool="atualizarDialogEditarDiasDaSemanaBool"
	 :is-visible="dialogEditarDiasDaSemanaIsVisible" :funcionario="funcionarioSelecionado"
	 :diasDaSemana="diasDaSemana"
	 :arrayHorarioSemanal="arrayHorarioSemanal" />

	<RemoverFuncionarioDialog @atualizarDialogRemoverFuncionarioBool="atualizarDialogRemoverFuncionarioBool"
	 :is-visible="dialogRemoverFuncionarioIsVisible" :funcionario="funcionarioSelecionado" />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import InputIcon from 'primevue/inputicon';
import IconField from 'primevue/iconfield';
import { FilterMatchMode } from 'primevue/api';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';

// componentizar esses botões e dialogos
import Button from 'primevue/button';
import RegistroDialog from '../Dialog/RegistroDialog.vue';
import RegistrarFaltaDialog from '../Dialog/RegistrarFaltaDialog.vue';
import useListarService from '../../../services/ListarService';
import EditarFuncionarioDialog from '../Dialog/EditarFuncionarioDialog.vue';
import RemoverFuncionarioDialog from '../Dialog/RemoverFuncionarioDialog.vue';
import EditarDiasDaSemanaDialog from '../Dialog/EditarDiasDaSemanaDialog.vue';

const props = defineProps({
	funcionarios: Array,
	diasDaSemana: Object
});

const dialogRegistroIsVisible = ref(false);
const dialogRegistrarFaltaIsVisible = ref(false);
const dialogEditarFuncionarioIsVisible = ref(false);
const dialogRemoverFuncionarioIsVisible = ref(false);
const dialogEditarDiasDaSemanaIsVisible = ref(false);
const funcionarioSelecionado = ref();
const diasDaSemana = ref({
	segunda: "",
	terca: "",
	quarta: "",
	quinta: "",
	sexta: "",
})
var registroFuncionarioSelecionado = ref();
const filters = ref({
	global: {
		matchMode: FilterMatchMode.CONTAINS
	}
});
const arrayHorarioSemanal = ref([]);


const criarStringDoHorario = (horario) => {
	if (horario == null)
	return;
	var string = "";

	string = horario.data.primeiro_horario + " ";
	string += horario.data.segundo_horario + " ";
	if (horario.data.terceiro_horario == null) {
		const object = {
			horario: string
		}
		return object;
	}
	string += horario.data.terceiro_horario + " ";
	string += horario.data.quarto_horario + " ";

	// transformar array em objeto
	const object = {
		horario: string
	}

	return object;
}

const gerarArrayDeHorarioSemanal = async () => {
	const arrayHorario = [];
	if (funcionarioSelecionado.value == null || funcionarioSelecionado.value.id_dia_da_semana == null) {
		arrayHorario[0] =
			{
				segunda: "",
				terca: "",
				quarta: "",
				quinta: "",
				sexta: ""
			}

		return arrayHorario;
	}
	const response = await useListarService.getDiasDaSemana(funcionarioSelecionado.value);

	if (response.data.length == 0)
		return;
	arrayHorario[0] = response.data.segunda;
	arrayHorario[1] = response.data.terca;
	arrayHorario[2] = response.data.quarta;
	arrayHorario[3] = response.data.quinta;
	arrayHorario[4] = response.data.sexta;

	for (let i = 0; i <= 4; i++) {
		var responseH;
		if (arrayHorario[i] != null)
			responseH = await useListarService.listarHorarioEspecifico	(arrayHorario[i])
		if (responseH.data.length == 0)
			i++;
		arrayHorario[i] = criarStringDoHorario(responseH);
	}

	const objeto = {
		segunda: arrayHorario[0],
		terca: arrayHorario[1],
		quarta: arrayHorario[2],
		quinta: arrayHorario[3],
		sexta: arrayHorario[4]
	}

	arrayHorario[0] = objeto;

	return arrayHorario;
}


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

const abrirRegistrarFalta = (slotProps) => {
	funcionarioSelecionado.value = slotProps.data;
	dialogRegistrarFaltaIsVisible.value = true;
}

const atualizarValorRegistrarFaltaBool = (eventData) => {
	dialogRegistrarFaltaIsVisible.value = eventData.dialogRegistrarFaltaIsVisible;
}

const abrirEditarFuncionario = async (slotProps) => {
	funcionarioSelecionado.value = slotProps.data;
	dialogEditarFuncionarioIsVisible.value = true;
}

const atualizarDialogEditarFuncionarioBool = (eventData) => {
	dialogEditarFuncionarioIsVisible.value = eventData.dialogEditarFuncionarioIsVisible;
}

const abrirRemoverFuncionario = (slotProps) => {
	funcionarioSelecionado.value = slotProps.data;
	dialogRemoverFuncionarioIsVisible.value = true;
}

const atualizarDialogRemoverFuncionarioBool = (eventData) => {
	dialogRemoverFuncionarioIsVisible.value = eventData.dialogRemoverFuncionarioIsVisible;
}

const abrirEditarDiasDaSemana = async (slotProps) => {
	funcionarioSelecionado.value = slotProps.data;
	arrayHorarioSemanal.value = await gerarArrayDeHorarioSemanal();
	if (funcionarioSelecionado.value.id_dia_da_semana != null) {
		const response = await useListarService.getDiasDaSemana(funcionarioSelecionado.value);
		diasDaSemana.value = response.data;
	}
	dialogEditarDiasDaSemanaIsVisible.value = true;
}

const atualizarDialogEditarDiasDaSemanaBool = (eventData) => {
	dialogEditarDiasDaSemanaIsVisible.value = eventData.dialogEditarDiasDaSemanaIsVisible;
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
