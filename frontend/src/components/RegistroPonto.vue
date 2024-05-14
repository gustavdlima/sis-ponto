<template>
	<div class="container d-flex justify-content-center ">

		<form name="login-form">
			<div class="row">
				<div class="row-md-1 row-sm-12 d-flex justify-content-center">
					<input type="text" id="matricula" placeholder="Matricula"
						class="w-75 mt-2 text-white border-white form-control"
						style="background-color: rgba(255, 255, 255, 0);" v-model="input.matricula" />
				</div>
			</div>
			<div class="row-md-1 row-sm-12 d-flex justify-content-center">
				<button type="submit"
					class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white font-weight-bold"
					v-on:click.prevent="registrarPonto()">Bater Ponto</button>
			</div>
		</form>

		<v-dialog v-model="matriculaErrada" max-width="500">
			<v-card>
				<v-card-title class="headline font-weight-bold">Erro</v-card-title>
				<v-card-text class="text-center font-weight-bold">
					{{ errorMessage }}
				</v-card-text>

				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="primary" text @click="matriculaErrada = false">Fechar</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<v-dialog v-model="campoVazio" max-width="500">
			<v-card>
				<v-card-title class="headline font-weight-bold">Erro</v-card-title>
				<v-card-text class="text-center font-weight-bold">
					{{ errorMessage }}
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="primary" text @click="campoVazio = false">Fechar</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<v-dialog v-model="registrarFoto" max-width="720" max-height="600">
			<v-card class="">
				<v-card class="bg-dark">
					<div class="row d-flex justify-content-center mt-4 mr-1 ml-1">
						<div class="row d-flex align-items-center justify-content-center mb-4">
							<div class="d-flex justify-content-center text-white position-absolute">
								<h1>{{ tempoRestante }}</h1>
							</div>
							<video :srcObject="stream" autoplay></video>
						</div>
						<!-- <div class="m-1 mt-3">
							<img class="rounded-5" :src="capturedImage" alt="Captured Image" style="width: 330px; height: 250px;" />
						</div> -->
					</div>
				</v-card>
			</v-card>
		</v-dialog>


		<v-dialog v-model="pontoBatido" max-width="720" max-height="600">
			<v-card class="">
				<v-card flat title="Ponto batido com Sucesso!" class="">
					<v-data-table :headers="registroHeaders" :items="registroTemp.value">
						<template #bottom></template>
					</v-data-table>
				</v-card>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="primary" text @click="pontoBatido = false">Fechar</v-btn>
				</v-card-actions>

			</v-card>
		</v-dialog>

	</div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const input = {
	matricula: "",
};
var matriculaErrada = ref(false);
var errorMessage = ref("");
var campoVazio = ref(false);
var pontoAdiantado = ref(false);
var pontoBatido = ref(false);
const registroAtual = ref([]);
const registroTemp = ref([]);
var registrarFoto = ref(false);
const stream = ref(null);
const capturedImage = ref(null);
const tempoRestante = ref(5);

const getInitialRegistro = () => {
	registroAtual.value = [];
};

const registroHeaders = ref([
	{ align: 'center', width: '1%', title: 'Data', key: 'data', width: '1%' },
	{ align: 'center', width: '1%', title: 'Primeiro Horario', key: 'primeiro_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Segundo Horario', key: 'segundo_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Terceiro Horario', key: 'terceiro_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Quarto Horario', key: 'quarto_ponto', width: '1%' },
])

const startCountdown = async () => {
	for (let i = 3; i >= 0; i--) {
		tempoRestante.value = i;
		await sleep(1000);
	}
};

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

function registrarPonto() {
	let responseString;
	if (input.matricula != "") {
		console.log("INPUT:");
		console.log(input);
		console.log("############################")
		axios.post("http://localhost:8000/api/ponto", input)
			.then(async response => {nm
				responseString = JSON.stringify(response.data);
				if (responseString.indexOf("Funcionário") !== -1) {
					errorMessage.value = "Matrícula incorreta"
					matriculaErrada.value = true
					return;
				}
				else {
					if (responseString.indexOf("Todos os pontos") !== -1) {
						axios.post("http://localhost:8000/api/registroDoDia", input).then(async response => {
							const dataArray = Array.isArray(response.data) ? response.data : [response.data];
							registroAtual.value = tratarOsDadosDoRegistro(dataArray);
							registroTemp.value = registroAtual;
							Object.assign(registroAtual.value, null);
							pontoBatido.value = true;
						}).catch(error => {
								console.log(error);
							});
						return;
					}
					axios.post("http://localhost:8000/api/registroDoDia", input).then(async response => {
							registrarFoto.value = true;
							await startCountdown();
							const dataArray = Array.isArray(response.data) ? response.data : [response.data];
							registroAtual.value = tratarOsDadosDoRegistro(dataArray);
							registroTemp.value = registroAtual;
							Object.assign(registroAtual.value, null);
							registrarFoto.value = false;
							pontoBatido.value = true;
						}).catch(error => {
								console.log(error);
							});
				}
				limparFormulario();
			})
			.catch(error => {
				console.log(error);
			});
	} else {
		errorMessage.value = "Preencha todos os campos"
		campoVazio.value = true
	}
}

function tratarOsDadosDoRegistro(registroObj) {

	for (var i = 0; i < registroObj.length; i++) {
		registroObj[i].data = registroObj[i].data == null ? registroObj[i].created_at.split('T')[0] : registroObj[i].data;
		const dia = registroObj[i].data.split('-')[2];
		const mes = registroObj[i].data.split('-')[1];
		const ano = registroObj[i].data.split('-')[0];
		registroObj[i].data = dia + '/' + mes + '/' + ano;

		if (registroObj[i].primeiro_ponto != null && registroObj[i].primeiro_ponto.indexOf("FALTA") === -1)
			registroObj[i].primeiro_ponto = registroObj[i].primeiro_ponto != null ? registroObj[i].primeiro_ponto.split(' ')[1] : null;
		if (registroObj[i].segundo_ponto != null && registroObj[i].segundo_ponto.indexOf("FALTA") === -1)
			registroObj[i].segundo_ponto = registroObj[i].segundo_ponto != null ? registroObj[i].segundo_ponto.split(' ')[1] : null;
		if (registroObj[i].terceiro_ponto != null && registroObj[i].terceiro_ponto.indexOf("FALTA") === -1)
			registroObj[i].terceiro_ponto = registroObj[i].terceiro_ponto != null ? registroObj[i].terceiro_ponto.split(' ')[1] : null;
		if (registroObj[i].quarto_ponto != null && registroObj[i].quarto_ponto.indexOf("FALTA") === -1)
			registroObj[i].quarto_ponto = registroObj[i].quarto_ponto != null ? registroObj[i].quarto_ponto.split(' ')[1] : null;

		registroObj[i].atrasou_primeiro_ponto = registroObj[i].atrasou_primeiro_ponto != false ? registroObj[i].atrasou_primeiro_ponto = "x" : " ";
		registroObj[i].atrasou_segundo_ponto = registroObj[i].atrasou_segundo_ponto != false ? "x" : " ";
		registroObj[i].atrasou_terceiro_ponto = registroObj[i].atrasou_terceiro_ponto != false ? "x" : " ";
		registroObj[i].atrasou_quarto_ponto = registroObj[i].atrasou_quarto_ponto != false ? "x" : " ";
	}
	return registroObj;
}

const limparFormulario = () => {
	input.matricula = "";
}

const tirarFoto = async () => {
	if (stream.value) {
		const tracks = stream.value.getTracks();
		const imageCapture = new ImageCapture(tracks[0]);
		const capturedImageBlob = await imageCapture.takePhoto();
		capturedImage.value = URL.createObjectURL(capturedImageBlob);

		// Optional: Clean up tracks after capturing the image
		tracks.forEach(track => track.stop());
	} else {
		console.error('Câmera não disponível.');
	}
};

const iniciarCamera = async () => {
	const frontCamStream = await navigator.mediaDevices.getUserMedia({
		audio: false,
		video: {
			width: { min: 1024, ideal: 1280, max: 1920 },
			height: { min: 300, ideal: 720, max: 1080 },
			facingMode: 'environment',
		},
	});
	console.log('Streaming', frontCamStream);
	stream.value = frontCamStream;
};

onMounted(() => iniciarCamera());

</script>

<style scoped>
input[type="text"]::-webkit-input-placeholder {
	color: rgba(255, 255, 255, 0.648);
}

button:hover {
	background-color: rgb(0, 140, 255);
}
</style>
