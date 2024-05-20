<template>
	<div class="grid grid-rows-5 min-w-64 max-w-64 min-h-96 md:min-w-80 mt-20">
		<div class="row-span-3 grid justify-center content-end ">
			<div class="grid justify-center content-end">
				<div class="grid justify-center overflow-hidden">
					<img src="../assets/logo-funad-sem-nome.png" class="img-fluid col" style="max-width: 19vh;"
						alt="logo">
				</div>
				<div class="grid justify-center content-end">
					<div class="grid justify-center content-center overflow-hidden">
						<div class="grid justify-center">
							<label class="text-3xl lg:text-5xl">
								ePonto
							</label>
						</div>
						<div class="grid justify-center mt-2">
							<HoraEData />
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row-span-2 grid content-startoverflow-hidden">
			<div class="grid-rows-4">
				<div class="row-span-2 grid justify-center mt-2 text-white ">
					<InputText id="username"
						class="w-60 h-8 md:w-68 lg:w-72 lg:h-10 bg-transparent .	placeholder-white matriculaInputText border-2 mt- text-sm md:text-lg lg:text-xl"
						v-model="matriculaObjeto.matricula" aria-describedby="matricula-input" placeholder="Matrícula"
						size="small" />
				</div>
				<div class="grid row-span-2 justify-center mt-3">
					<div class="grid grid-cols-2 gap-3">
						<div class="col-span-1">
							<Button v-if="baterPontoBotaoVisivel"
								class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg"
								label="Ver Registro" severity="info" raised @click="pegarRegistroDoDia()" />
						</div>
						<div class="col-span-1">
							<Button v-if="baterPontoBotaoVisivel"
								class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg"
								label="Bater Ponto" severity="info" raised @click="registrarPonto()" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Matricula vazia Dialog -->
	<Dialog v-model:visible="dialogVisivel" modal header=" " :style="{ width: '20rem', height: '10rem' }">
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
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import HoraEData from "../components/HoraEData.vue"
import CameraDialog from '../components/CameraDialog.vue';

import { ref } from 'vue';
import PontoService from '../services/PontoService.js';
import TabelaRegistroDialog from '../components/TabelaRegistroDialog.vue';

const usePontoService = PontoService;
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

const registrarPonto = async () =>{
	baterPontoBotaoVisivel.value = false;
	if (!matriculaObjeto.matricula)
		return matriculaVaziaDialog();
	try {
		const response = await usePontoService.registrarPonto(matriculaObjeto);
		if (response.status === '404') {
			baterPontoBotaoVisivel.value = true;
			return abrirDialogErro(response.message);
		}
		await handleResponse(response);
	} catch (error) {
		baterPontoBotaoVisivel.value = true;
		return abrirDialogErro(error.response);
	}
}

const handleResponse = async (response) => {
	switch (response.status) {
		case 200:
			if (response.data.message === 'Ponto já batido')
				return abrirDialogPontoJaBatido();
			cameraDialogVisivel.value = true;
			await startCountdown();
			cameraDialogVisivel.value = false;
			const pontoDoDiaResponse = await usePontoService.getPontoDoDia(matriculaObjeto);
			if (pontoDoDiaResponse.status === 200) {
				registroPonto.value = [
					pontoDoDiaResponse.data
				];
				baterPontoBotaoVisivel.value = true;
				tabelaRegistroVisivel.value = true;
				return;
			} else {
				baterPontoBotaoVisivel.value = true;
				return abrirDialogErro(pontoDoDiaResponse.message);
			}
			break;
		case 409:
			baterPontoBotaoVisivel.value = true;
			return abrirDialogErro(response.data.message);
			break;
		default:
			baterPontoBotaoVisivel.value = true;
			return abrirDialogErro(response.data.message);
			break;
	}
};

const pegarRegistroDoDia = async () => {
	if (!matriculaObjeto.matricula)
		return matriculaVaziaDialog();
	try {
		const response = await usePontoService.getPontoDoDia(matriculaObjeto);
		if (response.status === 200) {
			registroPonto.value = [
				response.data
			];
			tabelaRegistroVisivel.value = true;
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

function matriculaVaziaDialog() {
	dialogVisivel.value = true;
	dialogMensagem.value = 'Digite sua matrícula';
	baterPontoBotaoVisivel.value = true;
}

function abrirDialogMatriculaIncorreta() {
	dialogVisivel.value = true;
	dialogMensagem.value = 'Matrícula incorreta';
}

function abrirDialogPontoJaBatido() {
	dialogVisivel.value = true;
	dialogMensagem.value = usePontoService.getPontoDoDia();

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
	color: white !important;
	opacity: 75% !important;
}

button {
	background-color: transparent !important;
	border: 2px solid rgb(228, 228, 228) !important;
	color: aliceblue !important;
}

.p-dialog {
	background-color: #707070 !important;
}
</style>
