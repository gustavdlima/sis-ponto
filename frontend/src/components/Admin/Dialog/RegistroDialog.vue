<template>
	<Dialog v-model:visible="dialogRegistroIsVisible" modal :closable="true" :resizable="false" :baseZIndex="10000" @update:visible="fecharDialogRegistro"
		:style="{ width: '88vw' }">
		<template #header>
			<div class="grid h-full w-full p-4">
					<div class="grid w-full h-full">
						<div class="row-span-1">
							<div class="grid justify-start">
								<Button label="Relatório Mensal"
									class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-sm md:text-md"
									@click="abrirDialogRelatorioMensal()" />
							</div>
						</div>
					</div>
			</div>
		</template>
		<div class="grid p-4">
			<TabelaRegistroGeral :registro="propsObject.registroFuncionarioSelecionado" />
		</div>

		<template #footer>
			<div class="grid justify-center p-4">
				<Button label="Fechar" class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-sm md:text-md"
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
				<TabelaImpressaoRegistro :is-visible="tabelaImpressaoisVisible" :registro="relatorioRef"/>
			</div>
		</div>
	</Dialog>


	<RelatorioMensalDialog :is-visible="dialogRelatorioMensalIsVisible"
		@fecharDialogRelatorioMensal="fecharDialogRelatorioMensal" @dataSelecionada="gerarRelatorio" />

</template>

<script setup>
import { ref, watch, onUnmounted } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import TabelaRegistroGeral from '../Tabelas/TabelaRegistroGeral.vue';
import RelatorioMensalDialog from './RelatorioMensalDialog.vue';
import useListarService from '../../../services/ListarService';
import TabelaImpressaoRegistro from '../Tabelas/TabelaImpressaoRegistro.vue';
import useUtils from '../../../services/Utils';
import LogoFunadComNome from '../../LogoFunadComNome.vue';

const emit = defineEmits(['updateDialogRegistroBool']);
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
	emit('updateDialogRegistroBool', dialogRegistroIsVisible.value);
}

const fecharDialogRelatorioMensal = (value) => {
	dialogRelatorioMensalIsVisible.value = value;
}

const abrirDialogRelatorioMensal = async () => {
	dialogRelatorioMensalIsVisible.value = true;
}

const gerarRelatorio = async (value) => {
	const response = [
		await useListarService.relatorioMensal({
			matricula: funcionario.value.matricula,
			data: value.code
		})
	]
	handleData(response);
}

const handleData = async (response) => {
	var relatorio = [];
	response = response[0].data
	for (var i = 0; i < response.length; i++) {
		var dia = response[i].dia;
		var registroDoDia = response[i].registroDoDia;
		if (Array.isArray(registroDoDia)) {
			registroDoDia = registroDoDia[0];
		}
		var justificativa = response[i].justificativa;
		if (registroDoDia == null) {
			registroDoDia = {
				primeiro_ponto: "Sem Registro",
				segundo_ponto: "Sem Registro",
				terceiro_ponto: "Sem Registro",
				quarto_ponto: "Sem Registro"
			}
		}
		if (registroDoDia != null && justificativa != null) {
			relatorio[i] = {
				dia: dia,
				primeiro_ponto: registroDoDia.primeiro_ponto,
				segundo_ponto: registroDoDia.segundo_ponto,
				terceiro_ponto: registroDoDia.terceiro_ponto,
				quarto_ponto: registroDoDia.quarto_ponto,
				justificativa: justificativa
			}
		}
		if (registroDoDia != null && justificativa == null) {
			relatorio[i] = {
				dia: dia,
				primeiro_ponto: registroDoDia.primeiro_ponto,
				segundo_ponto: registroDoDia.segundo_ponto,
				terceiro_ponto: registroDoDia.terceiro_ponto,
				quarto_ponto: registroDoDia.quarto_ponto,
				justificativa: "-"
			}
		}
	}
	relatorioRef.value = relatorio;
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
	dialogRegistroIsVisible.value =  newValue.propsObject.dialogRegistroIsVisible;
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
