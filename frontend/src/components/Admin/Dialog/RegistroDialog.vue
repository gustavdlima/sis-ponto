<template>
	<Dialog v-model:visible="dialogRegistroIsVisible" modal :closable="true" :resizable="false" :baseZIndex="10000"
		@update:visible="fecharDialogRegistro" :style="{ width: '88vw' }">
		<template #header>
			<div class="grid h-full w-full overflow-hidden">
				<div class="grid grid-cols-2">
					<div class="col-span-1">
						<div class="grid justify-start h-full w-full gap-2">
							<div class="row-span-1">
								<div class="grid grid-rows-2">
									<div class="row-span-1">
										<span class="text-blue-950 text-2xl font-semibold ">
											Registro de Ponto
										</span>
									</div>
									<div class="row-span-1">
										<div class="mt-1">
											<Button label="Gerar Relatório Mensal"
												class="p-button-info h-10 w-60 lg:h-10 text-md md:text-lg"
												@click="abrirDialogRelatorioMensal()" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</template>
		<div class="grid p-4">

			<TabelaRegistroGeral :registro="propsObject.registroFuncionarioSelecionado" />
		</div>

		<template #footer>
			<div class="grid h-full w-full justify-center">
				<Button label="Fechar" class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-md md:text-lg"
					@click="fecharDialogRegistro" />
			</div>
		</template>

		<!-- COMPONETIZAR ISSO  -->
		<div id="imprimirRelatorio" hidden>
			<div class="row-span-1 bg-blue-200">
				<div class="grid grid-cols-5">
					<div class="col-span-1 grid justify-center bg-red-200">
						<LogoFunadComNome />
					</div>
					<div class="col-span-4 grid justify-start content-end">
						<label class="text-black text-3xl md:text-4xl lg:text-5xl font-semibold">
							Relatório de Ponto
						</label>
					</div>
				</div>
			</div>
			<div class="row-span-2 bg-blue-400 p-2">
				<div class="grid grid-cols-2">
					<div class="col-span-1">
						<div class="grid grid-rows-2">
							<div class="row-span-1">
								Nome: {{ funcionario.nome }}
							</div>
							<div class="row-span-1">
								Matricula: {{ funcionario.matricula }}
							</div>
						</div>
					</div>
					<div class="col-span-1">
						<div class="grid grid-rows-2 justify-start">
							<div class="row-span-1">
								Setor: {{ funcionario.setor }}
							</div>
							<div class="row-span-1">
								Carga Horária: {{ funcionario.carga_horaria }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-span-3 bg-blue-600 p-2">
				<TabelaImpressaoRegistro :is-visible="tabelaImpressaoisVisible" :registro="relatorioRef" />
			</div>
		</div>
	</Dialog>


	<RelatorioMensalDialog :is-visible="dialogRelatorioMensalIsVisible"
		@fecharDialogRelatorioMensal="fecharDialogRelatorioMensal" @dataSelecionada="gerarRelatorio" />

</template>

<script setup>
import { ref, watch } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import TabelaRegistroGeral from '../Tabelas/TabelaRegistroGeral.vue';
import RelatorioMensalDialog from './RelatorioMensalDialog.vue';
import useListarService from '../../../services/ListarService';
import TabelaImpressaoRegistro from '../Tabelas/TabelaImpressaoRegistro.vue';
import LogoFunadComNome from '../../LogoFunadComNome.vue';
import TabelaHorarioSemanalFuncionario from '../Tabelas/Listar/TabelaHorarioSemanalFuncionario..vue';

const emit = defineEmits(['atualizarDialogRegistroBool']);
const props = defineProps({
	propsObject: Object
});
const funcionario = ref();
const dialogRegistroIsVisible = ref(false);
const dialogRelatorioMensalIsVisible = ref(false);
const tabelaImpressaoisVisible = ref(false);
const relatorioRef = ref();

const fecharDialogRegistro = () => {
	dialogRegistroIsVisible.value = false;
	emit('atualizarDialogRegistroBool', dialogRegistroIsVisible.value);
}

const fecharDialogRelatorioMensal = (value) => {
	dialogRelatorioMensalIsVisible.value = value;
}

const abrirDialogRelatorioMensal = async () => {
	dialogRelatorioMensalIsVisible.value = true;
}

const gerarRelatorio = async (value) => {
	console.log(value);
	const response = [
		await useListarService.relatorioMensal({
			id_funcionario: funcionario.value.id,
			mes: value.code
		})
	]
	handleData(response);
}

const handleData = async (response) => {

	relatorioRef.value = response[0].data.relatorio;
	tabelaImpressaoisVisible.value = true;
	console.log(relatorioRef.value);
	setTimeout(() => {
		const print = document.getElementById('imprimirRelatorio').innerHTML;

		let stylesHtml = '';
		for (const node of [...document.querySelectorAll('link[rel="stylesheet"], style')]) {
			stylesHtml += node.outerHTML;
		}
		var win = window.open();
		win.document.write(`<!DOCTYPE html>
			<html>
				<head>
					${stylesHtml}
				</head>
				<body>
					${print}
				</body>
			</html>`);
		win.document.close();
		win.focus();
		win.print();
	}, 500);
}

watch(props, (newValue) => {
	dialogRegistroIsVisible.value = newValue.propsObject.dialogRegistroIsVisible;
	funcionario.value =
		newValue.propsObject.funcionarioSelecionado
});

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important
}

@media print {

	#imprimirRelatorio {
		display: block;
		color: black;

	}

	@page {
		size: A4;
		margin: 0;
	}

}
</style>
