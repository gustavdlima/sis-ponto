<template>
	<Dialog v-model:visible="dialogRemoverJustificativaIsVisible"
		header="Tem certeza que deseja excluir a justificativa?" @update:visible="fecharRemoverJustificativaDialog"
		:modal="true" :closable="true" :style="{ width: '53vh' }">
		<div class="grid h-full w-full p-2">
			<div class="grid grid-rows-1">
				<div class="row-span-1">
					<div class="grid grid-rows-2 gap-3 lg:gap-0 lg:grid-cols-2 lg:grid-rows-1">
						<div class="row-span-1 lg:col-span-1">
							<Button label="Excluir"
								class="p-button-info h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="excluirJustificativa()" />
						</div>
						<div class="row-span-1 lg:col-span-1">
							<Button label="Cancelar"
								class="p-button-danger h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="fecharRemoverJustificativaDialog()" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</Dialog>

	<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
</template>

<script setup>
import { ref, watch } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import DialogAlerta from '../../DialogAlerta.vue';
import useExcluirService from '../../../services/ExcluirService'
import useUtils from '../../../services/Utils';

const props = defineProps({
	isVisible: Boolean,
	justificativa: Object
});
const emit = defineEmits(['atualizarDialogRemoverJustificativaBool']);
const dialogRemoverJustificativaIsVisible = ref();
const justificativaExcluida = ref();
const dialogMensagem = ref();
const dialogVisivel = ref();

const fecharRemoverJustificativaDialog = () => {
	dialogRemoverJustificativaIsVisible.value = false;
	emit('atualizarDialogRemoverJustificativaBool', false);
}

const excluirJustificativa = async () => {
	console.log("Excluido");
	const response = await useExcluirService.excluirJustificativa(justificativaExcluida.value);
	console.log(response);
	handleResponse(response);
	fecharRemoverJustificativaDialog();
}

const handleResponse = (response) => {
	switch (response.status) {
		case 200:
			dialogMensagem.value = "Justificativa excluída com sucesso!";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			return;
			break;
		default:
			dialogMensagem.value = "Contate um administrador"
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			return;
			break;
	}
}

watch(props, () => {
	dialogRemoverJustificativaIsVisible.value = props.isVisible;
	justificativaExcluida.value = props.justificativa;
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important;
}
</style>
