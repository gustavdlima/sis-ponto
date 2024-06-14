<template>
	<Dialog v-model:visible="dialogRegistrarFaltaIsVisible" modal :closable="true" :resizable="false"
		style="width: 25rem; height: 20rem">
		<template #header>
			<div class="grid justify-end w-full">
			</div>
		</template>
		<div class="grid">
			<div class="grid grid-rows-3 justify-center gap-3">
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
						placeholder="Justificativa" class="w-[16.6rem] h-[2.5rem]" />
				</div>
			</div>
		</div>
		<template #footer>
			<div class="grid justify-center">
				<Button label="Enviar" class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-sm md:text-md"
					@click="registrarFalta()" />
			</div>
		</template>
		<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }"/>
	</Dialog>

</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';
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
});

const registrarFalta = () => {
	if (formData.value.id_justificativa === "" || formData.value.data === "" || formData.value.data2 === "") {
		dialogMensagem.value = "Preencha todos os campos!";
		dialogVisivel.value = true;
		useUtils.sleep(1000).then(() => {
			dialogVisivel.value = false;
		});
		return;
	}
	tratarFormData();
	console.log(formData.value);
	useListarService.registrarFalta(formData.value).then(() => {
		dialogMensagem.value = "Falta registrada com sucesso!";
		dialogVisivel.value = true;
		useUtils.sleep(1000).then(() => {
			dialogVisivel.value = false;
			dialogRegistrarFaltaIsVisible.value = false;
			emit('atualizarDialogRegistrarFaltaBool', dialogRegistrarFaltaIsVisible.value);
			limparCampos();
		});
	});
}

const tratarFormData = () => {
	formData.value.data = useUtils.formatarData(formData.value.data);
	formData.value.data2 = useUtils.formatarData(formData.value.data2);
	formData.value.id_justificativa = parseInt(formData.value.id_justificativa.code);
	formData.value.id_funcionario = parseInt(props.funcionario.id);
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
			{ name: response.data[i].justificativa,
			code: response.data[i].id }
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
	border: none !important
}
</style>
