<template>
	<Dialog v-model:visible="dialogRelatorioMensalIsVisible" @update:visible="fecharDialogRelatorioMensal"
		header:="Escolha o mês" :modal="true" closable="true" :resizable="false" :style="{ width: '53vh' }">
		<template #header>
			<div class="grid justify-start w-full">
				<span class="text-blue-950 text-lg font-semibold">
					Escolha o mês
				</span>
			</div>
		</template>
		<div class="grid justify-center h-full w-full p-2">
			<Dropdown v-model="dataSelecionada" :options="meses" optionLabel="name" placeholder=""
				class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
		</div>
		<template #footer>
			<div class="grid justify-center h-full w-full">
				<Button label="Gerar Relatório"
					class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-md md:text-lg"
					@click="gerarRelatorio()" />
			</div>
		</template>


	</Dialog>
</template>

<script setup>
import { ref, watch, onUnmounted } from 'vue';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import useListarService from '../../../services/ListarService';

const props = defineProps({
	isVisible: Boolean,
});
const dialogRelatorioMensalIsVisible = ref(false);
const dataSelecionada = ref(null);
const meses = [
	{ name: 'Janeiro', code: 1 },
	{ name: 'Fevereiro', code: 2 },
	{ name: 'Março', code: 3 },
	{ name: 'Abril', code: 4 },
	{ name: 'Maio', code: 5 },
	{ name: 'Junho', code: 6 },
	{ name: 'Julho', code: 7 },
	{ name: 'Agosto', code: 8 },
	{ name: 'Setembro', code: 9 },
	{ name: 'Outubro', code: 10 },
	{ name: 'Novembro', code: 11 },
	{ name: 'Dezembro', code: 12 },
];
const emit = defineEmits(['fecharDialogRelatorioMensal', 'dataSelecionada']);

const gerarRelatorio = () => {
	emit('dataSelecionada', dataSelecionada.value)
	dataSelecionada.value = null;
	fecharDialogRelatorioMensal();
};

watch(props, async (newValue) => {
	dialogRelatorioMensalIsVisible.value = newValue.isVisible;
});


const fecharDialogRelatorioMensal = () => {
	emit('fecharDialogRelatorioMensal', false);
};

</script>

<style scoped>
button {
	border: none !important;
	background-color: #1F2937 !important;
}
</style>
