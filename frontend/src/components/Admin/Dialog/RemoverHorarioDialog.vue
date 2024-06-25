<template>
	<Dialog v-model:visible="dialogRemoverHorarioIsVisible" header="Tem certeza que deseja excluir o horário?"
		@update:visible="fecharRemoverHorarioDialog" :modal="true" :closable="true" :style="{ width: '53vh' }">
		<div class="grid h-full w-full p-2">
			<div class="grid grid-rows-1">
				<div class="row-span-1">
					<div class="grid grid-rows-2 gap-3 lg:gap-0 lg:grid-cols-2 lg:grid-rows-1">
						<div class="row-span-1 lg:col-span-1">
							<Button label="Excluir"
								class="p-button-info h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="excluirHorario()" />
						</div>
						<div class="row-span-1 lg:col-span-1">
							<Button label="Cancelar"
								class="p-button-danger h-10 w-36 md:w-40 lg:w-32 lg:h-10 text-md md:text-lg"
								@click="fecharRemoverHorarioDialog()" />
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
	horario: Object
});
const emit = defineEmits(['atualizarDialogRemoverHorarioBool']);
const dialogRemoverHorarioIsVisible = ref();
const horarioExcluido = ref();
const dialogMensagem = ref();
const dialogVisivel = ref();

const fecharRemoverHorarioDialog = () => {
	dialogRemoverHorarioIsVisible.value = false;
	emit('atualizarDialogRemoverHorarioBool', false);
}

const excluirHorario = async () => {
	const response = await useExcluirService.excluirHorario(horarioExcluido.value);
	handleResponse(response);
	fecharRemoverHorarioDialog();
}

const handleResponse = (response) => {
	switch (response.status) {
		case 200:
			dialogMensagem.value = "Horário excluído com sucesso!";
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
	dialogRemoverHorarioIsVisible.value = props.isVisible;
	horarioExcluido.value = props.horario;
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important;
}
</style>
