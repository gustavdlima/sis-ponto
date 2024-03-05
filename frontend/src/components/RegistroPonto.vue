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

		<v-dialog v-model="pontoAdiantado" max-width="500">
			<v-card>
				<v-card-title class="headline font-weight-bold">Erro</v-card-title>
				<v-card-text class="text-center font-weight-bold">
					{{ errorMessage }}
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="primary" text @click="pontoAdiantado = false">Fechar</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<v-dialog v-model="pontoBatido" max-width="500">
			<v-card>
				<v-card-title class="headline font-weight-bold">Ponto batido com sucesso!</v-card-title>
				<v-card-text class="text-center">
					{{ errorMessage }}
				</v-card-text>
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
var store = useFuncionarioStore();

function registrar() {
	if (input.matricula != "") {
		axios.post("http://localhost:8000/api/ponto", input)
			.then(response => {
				mensagem = JSON.stringify(response.data);
				if (mensagem.indexOf("15 minutos") !== -1) {
					pontoAdiantado.value = true
					errorMessage.value = response.data
					limparFormulario();
					return;
				} else if (mensagem.indexOf("Funcionário") !== -1) {
					errorMessage.value = "Matrícula incorreta"
					matriculaErrada.value = true
					return;
				}
				const timestamp = response.data.terceiro_ponto.split(" ");
				const data = timestamp[0].split("-");
				const hora = timestamp[1].split(":");
				const timestampFormatada = data[2] + "/" + data[1] + "/" + data[0] + " às " + hora[0] + ":" + hora[1];
				errorMessage.value = timestampFormatada.toString();
				pontoBatido.value = true
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
