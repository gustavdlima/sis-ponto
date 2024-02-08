<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-6 mt-8">
						<label for="cargo" class="form-label text- font-weight-bold">Cargo / Função: </label>
						<input type="text" v-model="formData.cargo" name="cargo"
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


			<v-dialog v-model="cargoExistente" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Sucesso!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="cargoExistente = false">Fechar</v-btn>
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
var cargoExistente = ref(false);
var cadastroSucesso = ref(false);
var erroSistema = ref(false);
var errorMessage = ref("");

const formData = {
	cargo: "",
}

const sendForm = () => {
	if (formData.cargo != "") {
		try {
			const bearerToken = 'Bearer ' + authStore.userToken;
			axios.defaults.headers.common = {
				'Authorization': bearerToken
			}
			axios
				.post('http://localhost:8000/api/cargos', formData)
				.then((response) => {
					const responseData = JSON.stringify(response.data);
					if (responseData.indexOf("existente") !== -1) {
						campoVazio.value = true
						errorMessage.value = "Cargo já existe"
					} else if (responseData.indexOf("criado") !== -1) {
						cadastroSucesso.value = true
						errorMessage.value = "Cargo cadastrado com sucesso"
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
		errorMessage.value = "Preencha o campo cargo"
	}
	// enviar form para o backend
}

</script>
