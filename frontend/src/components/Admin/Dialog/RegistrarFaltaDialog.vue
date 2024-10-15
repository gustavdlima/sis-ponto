<template>

	<Dialog v-model:visible="dialogRegistrarFaltaIsVisible" @update:visible="fecharRegistrarFaltaDialog" modal
		:closable="true" :resizable="false" :style="{ width: '50vh', height: '51vh' }">
		<template #header>
			<div class="grid justify-start w-full">
				<span class="text-blue-950 text-2xl font-semibold">
					Justificar Falta
				</span>
			</div>
		</template>
		<div class="grid">
			<div class="grid grid-rows-1 justify-center gap-2">
				<div class="row-span-1">
					<div class="grid grid-rows-3 gap-3">
						<div class="row-span-1">
							<Calendar v-model="formData.data" placeholder="Início" dateFormat="dd/mm/yy"
								class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" modelValue="Date" />
						</div>
						<div class="row-span-1">
							<Calendar v-model="formData.data2" placeholder="Fim" dateFormat="dd/mm/yy"
								class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" modelValue="Date" />
						</div>
						<div class="row-span-1">
							<Dropdown v-model="formData.id_justificativa" :options="justificativas" optionLabel="name"
								placeholder="Justificativa" class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
						</div>
					</div>
				</div>
				<div class="row-span-1 mt-2">
					<div class="grid justify-start">
						<span class="text-black text-md font-semibold">Quais pontos você quer justificar?</span>
					</div>
					<div class="grid grid-cols-3 gap-2 mt-2">
						<div class="col-span-1">
							<div>
								<Checkbox v-model="formData.primeiro_turno" inputId="primeiro_turno" name="primeiro_turno" value="True" />
								<label for="primeiro_turno" class="ml-2"> 1º </label>
							</div>
							<div>
								<Checkbox v-model="formData.quarto_turno" inputId="quarto_turno" name="quarto_turno" value="True" />
								<label for="quarto_turno" class="ml-2"> 4º </label>
							</div>
						</div>
						<div class="col-span-1">
							<div>
								<Checkbox v-model="formData.segundo_turno" inputId="segundo_turno" name="segundo_turno" value="True" />
								<label for="segundo_turno" class="ml-2"> 2º </label>
							</div>
						</div>
						<div class="col-span-1">
							<Checkbox v-model="formData.terceiro_turno" inputId="terceiro_turno" name="terceiro_turno" value="True" />
								<label for="terceiro_turno" class="ml-2"> 3º </label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<template #footer>
			<div class="grid justify-center">
				<Button label="Enviar" class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-md md:text-lg"
					@click="registrarFalta()" />
			</div>
		</template>
		<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
	</Dialog>

</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';
import Checkbox from 'primevue/checkbox';
import useListarService from '../../../services/ListarService';
import useUtils from '../../../services/Utils';
import DialogAlerta from '../../DialogAlerta.vue';

const emit = defineEmits(['atualizarDialogRegistrarFaltaBool']);
const props = defineProps({
	isVisible: Boolean,
	funcionario: Object
});
const dialogRegistrarFaltaIsVisible = ref(false);
const dialogMensagem = ref("");
const dialogVisivel = ref(false);
const justificativas = ref();
const formData = ref({
	id_justificativa: "",
	id_funcionario: "",
	data: "",
	data2: "",
	primeiro_turno: "",
	segundo_turno: "",
	terceiro_turno: "",
	quarto_turno: "",
});

const registrarFalta = async () => {
	if (formData.value.id_justificativa === "" || formData.value.data === "" || formData.value.data2 === "") {
		dialogMensagem.value = "Preencha todos os campos!";
		dialogVisivel.value = true;
		useUtils.sleep(1000).then(() => {
			dialogVisivel.value = false;
		});
		return;
	}
	tratarFormData();
	const response = await useListarService.registrarFalta(formData.value);
	handleResponse(response);
}

const handleResponse = async (response) =>  {
	switch (response.status) {
		case 201:
			dialogMensagem.value = "Falta justificada com sucesso!";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
				fecharRegistrarFaltaDialog();
			});
			break;
		default:
			dialogMensagem.value = response.data.message;
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			break;
	}
}

const fecharRegistrarFaltaDialog = () => {
	dialogRegistrarFaltaIsVisible.value = false;
	emit('atualizarDialogRegistrarFaltaBool', dialogRegistrarFaltaIsVisible.value);
	limparCampos();
}

const tratarFormData = () => {
	formData.value.data = useUtils.formatarData(formData.value.data);
	formData.value.data2 = useUtils.formatarData(formData.value.data2);
	formData.value.id_justificativa = parseInt(formData.value.id_justificativa.code);
	formData.value.id_funcionario = parseInt(props.funcionario.id);
	formData.value.primeiro_turno = (formData.value.primeiro_turno[0] === "True") ? true : false;
	formData.value.segundo_turno = (formData.value.segundo_turno[0] === "True") ? true : false;
	formData.value.terceiro_turno = (formData.value.terceiro_turno[0] === "True") ? true : false;
	formData.value.quarto_turno = (formData.value.quarto_turno[0] === "True") ? true : false;
}

const limparCampos = () => {
	formData.value.id_justificativa = "";
	formData.value.data = "";
	formData.value.data2 = "";
}

const getJustificativas = async () => {
	const response = await useListarService.justificativas();
	justificativas.value = response.data
	for (let i = 0; i < response.data.length; i++) {
		justificativas.value[i] =
		{
			name: response.data[i].justificativa,
			code: response.data[i].id
		}
	}
}

watch(props, (newValue) => {
	dialogRegistrarFaltaIsVisible.value = newValue.isVisible;
	if (formData.value.id_funcionario)
		formData.value.id_funcionario = newValue.funcionario.id;
});

onMounted(() => {
	getJustificativas();
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important;
}
</style>
