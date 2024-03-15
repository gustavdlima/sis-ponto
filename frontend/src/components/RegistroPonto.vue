<template>
	<div class="container d-flex justify-content-center ">

		<form name="login-form">
			<div class="row">
				<div class="row-md-1 row-sm-12 d-flex justify-content-center">
					<input type="text" id="matricula" placeholder="Matricula"
						class="w-75 mt-2 text-white border-white form-control"
						style="background-color: rgba(255, 255, 255, 0);" v-model="input.matricula" />
				</div>
				<!-- <div class="row-md-1 row-sm-12 d-flex justify-content-center">
					<input type="date" id="dataNascimento" placeholder="Dt Nascimento Ex. 31/08/1994"
						class="w-50 mt-3 text-white border-white form-control"
						style="background-color: rgba(255, 255, 255, 0);" v-model="input.data_nascimento" />
				</div> -->
			</div>
			<div class="row-md-1 row-sm-12 d-flex justify-content-center">
				<button type="submit"
					class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white font-weight-bold"
					v-on:click.prevent="registrar()">Bater Ponto</button>
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

		<v-dialog v-model="pontoBatido" max-width="600" max-height="300">
				<v-card class="">
						<v-card flat title="Registro do dia">
							<v-data-table :headers="registroHeaders" :items="registroAtual">
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
import { useFuncionarioStore } from '../stores/funcionarioStore';
import { ref } from 'vue';
import axios from 'axios';

const input = {
	matricula: "",
	data_nascimento: "",
};
var mensagem = ref("");
var matriculaErrada = ref(false);
var errorMessage = ref("");
var campoVazio = ref(false);
var pontoAdiantado = ref(false);
var pontoBatido = ref(false);
const registroAtual = ref([]);

const registroHeaders = ref([
	{ align: 'center', width: '1%', title: 'Data', key: 'data', width: '1%' },
	{ align: 'center', width: '1%', title: 'Primeiro Horario', key: 'primeiro_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Segundo Horario', key: 'segundo_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Terceiro Horario', key: 'terceiro_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Quarto Horario', key: 'quarto_ponto', width: '1%' },
])

function registrar() {
	if (input.matricula != "") {
		axios.post("http://localhost:8000/api/ponto", input)
			.then(response => {
				mensagem = JSON.stringify(response.data);
				if (mensagem.indexOf("Funcionário") !== -1) {
					errorMessage.value = "Matrícula incorreta"
					matriculaErrada.value = true
					return;
				}
				else {
					const dataArray = Array.isArray(response.data) ? response.data : [response.data];
					registroAtual.value = tratarOsDadosDoRegistro(dataArray);
					// registroAtual.value = dataArray;
					pontoBatido.value = true
				}
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
		registroObj[i].primeiro_ponto = registroObj[i].primeiro_ponto != null ? registroObj[i].primeiro_ponto.split(' ')[1] : null;
		registroObj[i].segundo_ponto = registroObj[i].segundo_ponto != null ? registroObj[i].segundo_ponto.split(' ')[1] : null;
		registroObj[i].terceiro_ponto = registroObj[i].terceiro_ponto != null ? registroObj[i].terceiro_ponto.split(' ')[1] : null;
		registroObj[i].quarto_ponto = registroObj[i].quarto_ponto != null ? registroObj[i].quarto_ponto.split(' ')[1] : null;

		registroObj[i].atrasou_primeiro_ponto = registroObj[i].atrasou_primeiro_ponto != false ? registroObj[i].atrasou_primeiro_ponto = "x" : " ";
		registroObj[i].atrasou_segundo_ponto = registroObj[i].atrasou_segundo_ponto != false ? "x" : " ";
		registroObj[i].atrasou_terceiro_ponto = registroObj[i].atrasou_terceiro_ponto != false ? "x" : " ";
		registroObj[i].atrasou_quarto_ponto = registroObj[i].atrasou_quarto_ponto != false ? "x" : " ";
	}
	return registroObj;
}

const limparFormulario = () => {
	input.matricula = ""
	input.data_nascimento = ""
}

</script>

<style scoped>
input[type="text"]::-webkit-input-placeholder {
	color: rgba(255, 255, 255, 0.648);
}

button:hover {
	background-color: rgb(0, 140, 255);
}
</style>
