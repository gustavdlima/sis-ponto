<template>
	<Dialog v-model:visible="dialogEditarCargoIsVisible" header="Editar Cargo"
		@update:visible="fecharEditarCargoDialog" :modal="true" :closable="true" :style="{ width: '25vw' }">
		<div class="grid h-full w-full">
			<form>
			<div class="grid h-full w-full grid-rows-1 py-20 lg:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid content-center grid-cols-1">
						<div class="col-span-1 p-1">
							<InputText v-model="cargo.cargo" class="w-full lg:w-[16.6rem] h-[2.5rem]"
								placeholder="Cargo / Função" />
						</div>
					</div>
					<div class="grid grid-rows-1 justify-center mt-8">
						<Button
							class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-5"
							label="Editar" severity="info" raised @click="enviarFormularioDeEdicaoDeCargo()" />
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
	cargo: Object
});

const dialogEditarCargoIsVisible = ref();
const cargoEditado = ref();
const dialogMensagem = ref();
const dialogVisivel = ref();
const emit = defineEmits(['atualizarDialogEditarCargoBool']);

const enviarFormularioDeEdicaoDeCargo = async () => {
	if (cargoEditado.value.cargo === "") {
		dialogMensagem.value = "Campo vazio!";
		dialogVisivel.value = true;
		useUtils.sleep(1000).then(() => {
			dialogVisivel.value = false;
		});
		return;
	}
	const response = await useEditarService.editarCargo(cargoEditado.value)
	console.log(response.data);
	handleResponse(response);
	fecharEditarCargoDialog();
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

const fecharEditarCargoDialog = () => {
	dialogEditarCargoIsVisible.value = false;
	emit('atualizarDialogEditarCargoBool', false);
}

watch(props, () => {
	dialogEditarCargoIsVisible.value = props.isVisible;
	cargoEditado.value = props.cargo;
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important
}
</style>
