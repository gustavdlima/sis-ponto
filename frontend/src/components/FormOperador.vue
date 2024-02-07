<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-6">
						<label for="name" class="form-label text-black font-weight-bold">Nome</label>
						<input type="text" v-model="formData.name" name="name"
							class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-6">
						<label for="email" class="form-label text-black font-weight-bold">Email</label>
						<input type="email" v-model="formData.email" name="email"
							class="text-black border-white form-control mb-2" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="password" class="form-label text-black font-weight-bold">Senha</label>
						<input type="password" v-model="formData.password" name="password"
							class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-6">
						<label for="password" class="form-label text-black font-weight-bold">Confirmar senha</label>
						<input type="password" v-model="formData.confirmPassword" name="password"
							class="text-black border-white form-control mb-2" />
					</div>
				</div>


				<div class="row">
					<div class="col-md-3">
						<label for="level" class="form-label text-black font-weight-bold">Nível</label>
						<select v-model="formData.level" name="level" class=" border-white form-control mb-1">
							<option disabled value=""></option>"
							<option value="1">Nível 1 [Administrador]</option>
							<option value="2">Nível 2 [Operador]</option>
						</select><br>
					</div>
				</div>

				<div class="row-md-3 d-flex justify-content-center">
					<button type="submit" @onClick="sendForm"
						class="btn d-flex justify-content-center text-white border-white">Cadastrar</button>
				</div>

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

				<v-dialog v-model="senhaIncorreta" max-width="300">
					<v-card>
						<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
						<v-card-text class="text-center">
							{{ errorMessage }}
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="primary" text @click="senhaIncorreta = false">Fechar</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>

				<v-dialog v-model="senhaCurta" max-width="300">
					<v-card>
						<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
						<v-card-text class="text-center">
							{{ errorMessage }}
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="primary" text @click="senhaCurta = false">Fechar</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>

				<v-dialog v-model="senhaCurta" max-width="300">
					<v-card>
						<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
						<v-card-text class="text-center">
							{{ errorMessage }}
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="primary" text @click="senhaCurta = false">Fechar</v-btn>
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
			</form>
		</div>
	</div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore';
import { ref } from 'vue';
import axios from 'axios';

const authStore = useAuthStore();

const cadastroSucesso = ref(false);
const senhaIncorreta = ref(false);
const senhaCurta = ref(false);
const campoVazio = ref(false);
const erroSistema = ref(false);
const errorMessage = ref("");

const formData = {
	name: "",
	email: "",
	password: "",
	confirmPassword: "",
	level: "",
}

const sendForm = async () => {
	if (formData.name != "" || formData.email != "" || formData.password != "") {
		if (formData.password != formData.confirmPassword) {
			senhaIncorreta.value = true;
			errorMessage.value = "As senhas devem ser iguais";
			return;
		}
		if (formData.password.length < 8) {
			senhaCurta.value = true;
			errorMessage.value = "A senha deve conter pelo menos 8 caracteres";
			return;
		}
		try {
			console.log(authStore.userToken)
			axios.defaults.headers.common = {
				'Authorization': 'Bearer ' + authStore.userToken
			}
			await axios
				.post('http://localhost:8000/api/users', formData)
				.then((response) => {
					const responseData = JSON.stringify(response.data);
					if (responseData.indexOf("criado") !== -1) {
						cadastroSucesso.value = true;
						errorMessage.value = "Funcionário cadastrado com sucesso";
						clearForm();
					} else if (responseData.indexOf("existente") !== -1) {
						senhaIncorreta.value = true;
						errorMessage.value = "Funcionário já existe";
					} else {

					}
				})
		} catch (error) {
			erroSistema.value = true;
			errorMessage.value = error;
		}
	} else {
		campoVazio.value = true;
		errorMessage.value = "Preencha todos os campos";
	}

	function clearForm() {
		formData.name = "";
		formData.email = "";
		formData.password = "";
		formData.confirmPassword = "";
		formData.level = "";
	}
}



</script>
