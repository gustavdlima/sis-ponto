<template>
	<Dialog v-model:visible="dialogRemoverFuncionarioIsVisible" header="Tem certeza que deseja excluir o funcionário?"
		@update:visible="fecharRemoverFuncionarioDialog" :modal="true" :closable="true" :style="{ width: '53vh' }">
		<div class="grid h-full w-full p-2">
			<div class="grid grid-rows-1">
				<div class="row-span-1">
					<div class="grid grid-rows-2 gap-3 lg:gap-0 lg:grid-cols-2 lg:grid-rows-1">
						<div class="row-span-1 lg:col-span-1">
							<Button label="Excluir"
								class="p-button-info h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="excluirFuncionario()" />
						</div>
						<div class="row-span-1 lg:col-span-1">
							<Button label="Cancelar"
								class="p-button-danger h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="fecharRemoverFuncionarioDialog()" />
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
	funcionario: Object
});
const emit = defineEmits(['atualizarDialogRemoverFuncionarioBool']);
const dialogRemoverFuncionarioIsVisible = ref();
const funcionarioExcluido = ref();

const fecharRemoverFuncionarioDialog = () => {
	dialogRemoverFuncionarioIsVisible.value = false;
	emit('atualizarDialogRemoverFuncionarioBool', false);
}

const excluirFuncionario = async () => {
	const response = await useExcluirService.excluirFuncionario(funcionarioExcluido.value);
	handleResponse(response);
	fecharRemoverFuncionarioDialog();
}

const handleResponse = (response) => {
	switch (response.status) {
		case 200:
			dialogMensagem.value = "Funcionário excluído com sucesso!";
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
	dialogRemoverFuncionarioIsVisible.value = props.isVisible;
	funcionarioExcluido.value = props.funcionario;
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important;
}
</style>
