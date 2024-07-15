<template>
	<div class="grid grid-rows-5 min-w-96 max-w-96 min-h-96  mt-20">
		<div class="row-span-3 grid justify-center content-end ">
			<div class="grid justify-center content-end">
				<div class="grid justify-center overflow-hidden">
					<LogoFunadSemNome />
				</div>
				<div class="grid justify-center content-end">
					<div class="grid justify-center content-center overflow-hidden">
						<div class="grid justify-center">
							<Eponto />
						</div>
						<div class="grid justify-center mt-2">
							<HoraEData />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row-span-2 grid justify-center overflow-hidden">
			<div class="grid grid-rows-4 justify-center w-96">
				<div class="row-span-1 grid justify-center mt-2">
					<InputText class="w-60 h-10 md:w-68 lg:w-72 lg:h-12 border-2 text-sm md:text-lg lg:text-xl"
						v-model="matriculaObjeto.matricula" aria-describedby="matricula-input" placeholder="Matrícula"
						size="small" />
				</div>
				<div class="grid row-span-3 justify-center mt-3 mr-1 min-w-96">
					<div class="grid justify-start grid-cols-2 gap-7">
						<div class="col-span-1">
							<Button v-if="baterPontoBotaoVisivel"
								class="border-2 bg-transparent h-8 w-36 md:w-40 lg:w-44 lg:h-10 text-md md:text-lg lg:text-xl"
								label="Ver Registro" severity="info" raised @click="pegarRegistroDoDia()" />
						</div>
						<div class="col-span-1">
							<Button v-if="baterPontoBotaoVisivel"
								class="border-2 bg-transparent h-8 w-36 md:w-40 lg:w-44 lg:h-10 text-md md:text-lg lg:text-xl"
								label="Bater Ponto" severity="info" raised @click="registrarPonto()" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Matricula vazia Dialog -->
	<Dialog v-model:visible="dialogVisivel" modal :style="{ width: '20rem', height: '10rem' }">
		<div class="grid justify-center text-xl">
			{{ dialogMensagem }}
		</div>
	</Dialog>

	<!-- Camera Componente -->
	<div v-if="cameraDialogVisivel" class="fixed inset-0 flex items-center justify-center bg-opacity-50">
		<CameraDialog />
	</div>

	<!-- Tabela de Registro Dialog -->
	<div v-if="tabelaRegistroVisivel">
		<TabelaRegistroDialog :registro="registroPonto" />
	</div>

</template>

<script setup>
import { ref } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import HoraEData from "../components/HoraEData.vue"
import CameraDialog from '../components/CameraDialog.vue';
import Eponto from '../components/Eponto.vue';
import TabelaRegistroDialog from '../components/TabelaRegistroDialog.vue';
import LogoFunadSemNome from "./LogoFunadSemNome.vue";
import RegistroPontoService from '../services/RegistroPontoService.js';
import useUtils from '../services/Utils';

const useRegistroPontoService = RegistroPontoService;
const dialogMensagem = ref('');
const dialogVisivel = ref(false);
const cameraDialogVisivel = ref(false);
const matriculaObjeto = {
	matricula: ''
};
const tempoRestante = ref('');
const baterPontoBotaoVisivel = ref(true);
const tabelaRegistroVisivel = ref(false);
const registroPonto = ref();

const registrarPonto = async () => {
	baterPontoBotaoVisivel.value = false;
	if (!matriculaObjeto.matricula)
		return matriculaVaziaDialog();
	try {
		const response = await useRegistroPontoService.registrarPonto(matriculaObjeto);
		await handleResponse(response);
		await startCountdown();
		tabelaRegistroVisivel.value = false;
	} catch (error) {
		limparInput();
		baterPontoBotaoVisivel.value = true;
		return abrirDialogErro(error.response);
	}
}

const handleResponse = async (response) => {
	switch (response.status) {
		case 201:
			pegarRegistroDoDia();
			baterPontoBotaoVisivel.value = true;
			tabelaRegistroVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				tabelaRegistroVisivel.value = false;
			});
			limparInput();
			return;
			break;
		default:
			baterPontoBotaoVisivel.value = true;
			limparInput();
			return abrirDialogErro(response.message);
			break;
	}
};

const pegarRegistroDoDia = async () => {
	if (!matriculaObjeto.matricula)
		return matriculaVaziaDialog();
	try {
		const response = await useRegistroPontoService.getPontoDoDia(matriculaObjeto);
		if (response.status === 200) {
			registroPonto.value = [
				response.data
			];
			tabelaRegistroVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				tabelaRegistroVisivel.value = false;
			});
		} else {
			return abrirDialogErro(response.message);
		}
	} catch (error) {
		return abrirDialogErro(error);
	}
};

const startCountdown = async () => {
	for (let i = 2; i >= 0; i--) {
		tempoRestante.value = i;
		await sleep(1000);
	}
};

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

function limparInput() {
	matriculaObjeto.matricula = '';
}

function matriculaVaziaDialog() {
	dialogVisivel.value = true;
	dialogMensagem.value = 'Digite sua matrícula';
	baterPontoBotaoVisivel.value = true;
}


function abrirDialogPontoJaBatido() {
	dialogVisivel.value = true;
	dialogMensagem.value = useRegistroPontoService.getPontoDoDia();

}

function abrirDialogErro(message) {
	dialogVisivel.value = true;
	dialogMensagem.value = message;
}


</script>

<style scoped>
*:focus {
	box-shadow: none !important;
}

::placeholder {
	color: black !important;
	opacity: 75% !important;
}

button {
	background-color: transparent !important;
	color: aliceblue !important;
	border-color: aliceblue !important;
}

.p-dialog {
	background-color: #707070 !important;
}

input:hover {
	border-color: #1F2937 !important;
}

input:focus {
	border-color: #1F2937 !important;
}

button:hover {
	border-color: #1F2937 !important;
}
</style>
