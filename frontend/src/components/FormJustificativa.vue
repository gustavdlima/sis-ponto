<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-6 mt-8">
						<label for="justificativa" class="form-label text- font-weight-bold">Justificativa: </label>
						<input type="text" v-model="formData.justificativa" name="justificativa"
							class="text-black border-white form-control mb-2" />
					</div>
				</div>
				<div class="row-md-3 d-flex justify-content-center">
					<button type="submit" @onClick="sendForm"
						class="btn d-flex justify-content-center text-white border-white m-3">Cadastrar</button>
				</div>
			</form>

			<v-dialog v-model="cadastroSucesso" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Sucesso!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="cadastroSucesso = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="justificativaExistente" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Sucesso!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="justificativaExistente = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="campoVazio" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="campoVazio = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="erroSistema" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="erroSistema = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

		</div>
	</div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore';
import { ref } from 'vue';
import axios from 'axios';

const authStore = useAuthStore();

var campoVazio = ref(false);
var justificativaExistente = ref(false);
var cadastroSucesso = ref(false);
var erroSistema = ref(false);
var errorMessage = ref("");

const formData = {
	justificativa: "",
}

const sendForm = () => {
	if (formData.justificativa != "") {
		try {
			const bearerToken = 'Bearer ' + authStore.userToken;
			axios.defaults.headers.common = {
				'Authorization': bearerToken
			}
			axios
				.post('http://localhost:8000/api/justificativas', formData)
				.then((response) => {
					const responseData = JSON.stringify(response.data);
					if (responseData.indexOf("existente") !== -1) {
						campoVazio.value = true
						errorMessage.value = "justificativa já existe"
					} else if (responseData.indexOf("criada") !== -1) {
						cadastroSucesso.value = true
						errorMessage.value = "justificativa cadastrado com sucesso"
						clearForm();
					} else {
						erroSistema.value = true
						errorMessage.value = ""
					}
				})
		} catch (error) {
			erroSistema.value = true
			errorMessage.value = error
		}
	} else {
		console.log(formData);
		campoVazio.value = true
		errorMessage.value = "Preencha o campo justificativa"
	}
	// enviar form para o backend
}

const clearForm = () => {
	formData.justificativa = "";
}

</script>
