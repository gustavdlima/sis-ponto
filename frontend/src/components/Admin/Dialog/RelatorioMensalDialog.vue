<template>
	<Dialog
		v-model:visible="dialogRelatorioMensalIsVisible"
		@update:visible="fecharDialogRelatorioMensal"
		:modal="true"
		:closable="true"
		:resizable="false"
		:style="{ width: '53vh' }"
	>
		<template #header>
			<div class="grid justify-start w-full">
				<span class="text-blue-950 text-lg font-semibold">Escolha o mês e o ano</span>
			</div>
		</template>

		<div class="grid justify-center h-full w-full p-2 gap-4">
			<Dropdown
				v-model="mesSelecionado"
				:options="meses"
				optionLabel="name"
				placeholder="Selecione o mês"
				class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
			/>
			<Dropdown
				v-model="anoSelecionado"
				:options="anos"
				optionLabel="name"
				placeholder="Selecione o ano"
				class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
			/>
		</div>

		<template #footer>
			<div class="grid justify-center h-full w-full">
				<Button
					label="Gerar Relatório"
					class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-md md:text-lg"
					@click="gerarRelatorio"
				/>
			</div>
		</template>
	</Dialog>
</template>

<script setup>
import { ref, watch } from 'vue';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
	isVisible: Boolean,
});

const emit = defineEmits(['fecharDialogRelatorioMensal', 'dataSelecionada']);

const dialogRelatorioMensalIsVisible = ref(false);
const mesSelecionado = ref(null);
const anoSelecionado = ref(null);

// Meses disponíveis
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

const anoAtual = new Date().getFullYear();
const anos = [
	{ name: `${anoAtual - 1}`, code: anoAtual - 1 },
	{ name: `${anoAtual}`, code: anoAtual },
	{ name: `${anoAtual + 1}`, code: anoAtual + 1 },
];

const gerarRelatorio = () => {
	if (!mesSelecionado.value || !anoSelecionado.value) {
		alert('Por favor, selecione o mês e o ano!');
		return;
	}
	emit('dataSelecionada', {
		mes: mesSelecionado.value.code,
		ano: anoSelecionado.value.code,
	});
	limparSelecoes();
	fecharDialogRelatorioMensal();
};

const limparSelecoes = () => {
	mesSelecionado.value = null;
	anoSelecionado.value = null;
};

watch(
	() => props.isVisible,
	(newValue) => {
		dialogRelatorioMensalIsVisible.value = newValue;
	}
);

const fecharDialogRelatorioMensal = () => {
	emit('fecharDialogRelatorioMensal', false);
};
</script>

<style scoped>
button {
	border: none !important;
	background-color: #1F2937 !important;
}

.grid.gap-4 > * {
	margin-top: 10px;
}
</style>
