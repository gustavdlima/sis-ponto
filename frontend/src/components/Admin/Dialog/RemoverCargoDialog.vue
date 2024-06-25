<template>
	<Dialog v-model:visible="dialogRemoverCargoIsVisible" header="Tem certeza que deseja excluir o cargo?"
		@update:visible="fecharRemoverCargoDialog" :modal="true" :closable="true" :style="{ width: '53vh' }">
		<div class="grid h-full w-full p-2">
			<div class="grid grid-rows-1">
				<div class="row-span-1">
					<div class="grid grid-rows-2 gap-3 lg:gap-0 lg:grid-cols-2 lg:grid-rows-1">
						<div class="row-span-1 lg:col-span-1">
							<Button label="Excluir"
								class="p-button-info h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="excluirCargo()" />
						</div>
						<div class="row-span-1 lg:col-span-1">
							<Button label="Cancelar"
								class="p-button-danger h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="fecharRemoverCargoDialog()" />
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
import useExcluirService from '../../../services/ExcluirService';
import useUtils from '../../../services/Utils';
import DialogAlerta from '../../DialogAlerta.vue';

const props = defineProps({
	isVisible: Boolean,
	cargo: Object
});
const emit = defineEmits(['atualizarDialogRemoverCargoBool']);
const dialogRemoverCargoIsVisible = ref();
const cargoExcluido = ref();
const dialogMensagem = ref();
const dialogVisivel = ref();

const fecharRemoverCargoDialog = () => {
	dialogRemoverCargoIsVisible.value = false;
	emit('atualizarDialogRemoverCargoBool', false);
}

const excluirCargo = async () => {
	const response = await useExcluirService.excluirCargo(cargoExcluido.value);
	console.log(response);
	handleResponse(response);
	fecharRemoverCargoDialog();
}

const handleResponse = (response) => {
	switch (response.status) {
		case 200:
			dialogMensagem.value = "Cargo excluído com sucesso!";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			break;
		case 400:
			dialogMensagem.value = "Erro ao excluir funcionário!";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			break;
	}
}

watch(props, () => {
	dialogRemoverCargoIsVisible.value = props.isVisible;
	cargoExcluido.value = props.cargo;
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important;
}
</style>
