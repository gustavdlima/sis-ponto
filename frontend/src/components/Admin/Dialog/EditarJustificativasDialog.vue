<template>
	<Dialog v-model:visible="dialogEditarJustificativaIsVisible" header="Editar Justificativa"
		@update:visible="fecharEditarJustificativaDialog" :modal="true" :closable="true" :style="{ width: '25vw' }">
		<div class="grid h-full w-full">
			<form>
			<div class="grid h-full w-full grid-rows-1 py-20 lg:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid content-center grid-cols-1">
						<div class="col-span-1 p-1">
							<InputText v-model="justificativa.justificativa" class="w-full lg:w-[16.6rem] h-[2.5rem]"
								placeholder="Justificativa" />
						</div>
					</div>
					<div class="grid grid-rows-1 justify-center mt-8">
						<Button
							class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-5"
							label="Cadastrar" severity="info" raised
							@click="enviarFormularioDeEdicaoDeJustificativa()" />
					</div>
				</div>
			</div>
		</form>
		</div>
	</Dialog>

	<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
</template>

<script setup>
import { ref, watch } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import useEditarService from '../../../services/EditarService'
import useUtils from '../../../services/Utils'
import DialogAlerta from '../../DialogAlerta.vue';

const props = defineProps({
	isVisible: Boolean,
	justificativa: Object
});

const dialogEditarJustificativaIsVisible = ref();
const justificativaEditado = ref();
const dialogMensagem = ref();
const dialogVisivel = ref();
const emit = defineEmits(['atualizarDialogEditarJustificativaBool']);

const enviarFormularioDeEdicaoDeJustificativa = async () => {
	if (!justificativaEditado.value.justificativa) {
		dialogMensagem.value = 'Preencha todos os campos!';
		dialogVisivel.value = true;
		useUtils.sleep(2000).then(() => {
			dialogVisivel.value = false;
		})
		return;
	}
	const response = await useEditarService.editarJustificativa(justificativaEditado.value)
	handleResponse(response);
	fecharEditarJustificativaDialog();
};

const handleResponse = (response) => {
	switch (response.status) {
		case 200:
			dialogMensagem.value = response.data.message;
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			})
			return;
			break;
		default:
			dialogMensagem.value = response.data.message;
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			})
			return;
			break;
	}
}

const fecharEditarJustificativaDialog = () => {
	dialogEditarJustificativaIsVisible.value = false;
	emit('atualizarDialogEditarJustificativaBool', false);
}

watch(props, () => {
	dialogEditarJustificativaIsVisible.value = props.isVisible;
	justificativaEditado.value = props.justificativa;
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important
}
</style>
