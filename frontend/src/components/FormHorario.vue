<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3" ref="´inputForm´">
				<div class="row">
					<div class="col-md-6">
						<label for="primeiro_horario" class="form-label text- font-weight-bold">Primeiro Horário</label>
						<input type="time" step="1" v-model="formData.primeiro_horario" name="primeiro_horario"
							class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-6">
						<label for="segundo_horario" class="form-label text- font-weight-bold">Segundo Horário</label>
						<input type="time" step="1" v-model="formData.segundo_horario" name="segundo_horario"
							class="text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="terceiro_horario" class="form-label text- font-weight-bold">Terceiro Horário</label>
						<input type="time" step="1" v-model="formData.terceiro_horario" name="terceiro_horario"
							class="text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-6">
						<label for="quarto_horario" class="form-label text- font-weight-bold">Quarto Horário</label>
						<input type="time" step="1" v-model="formData.quarto_horario" name="quarto_horario"
							class="text-black border-white form-control mb-2" />
					</div>

				</div>

				<div class="row-md-3 d-flex justify-content-center">
					<button type="submit" @onClick="sendForm"
						class="btn d-flex justify-content-center text-white border-white m-3">Cadastrar</button>
				</div>

			</form>

			<v-dialog v-model="horarioExistente" max-width="500">
				<v-card>
					<v-card-title class="headline font-weight-bold">Erro</v-card-title>
					<v-card-text class="text-center font-weight-bold">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="horarioExistente = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="horarioCriado" max-width="500">
				<v-card>
					<v-card-title class="headline font-weight-bold">Sucesso!</v-card-title>
					<v-card-text class="text-center font-weight-bold">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="horarioCriado = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>



		</div>
	</div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/authStore';
import axios from 'axios';


const authStore = useAuthStore();

var horarioExistente = ref(false);
var horarioCriado = ref(false);
var errorMessage = ref("");
var mensagem = ref("");

var formData = {
	primeiro_horario: "",
	segundo_horario: "",
	terceiro_horario: "",
	quarto_horario: "",
}

const sendForm = () => {
	if (formData.primeiro_horario != "" || formData.segundo_horario != "") {
		axios
			.post("http://localhost:8000/api/horarios/", formData)
			.then((response) => {
				console.log(response);
				mensagem.value = JSON.stringify(response.data);
				console.log(mensagem.value);
				if (mensagem.value.indexOf("existente") !== -1) {
					horarioExistente.value = true
					errorMessage.value = response.data;
					return;
				} else {
					horarioCriado.value = true
					errorMessage.value = "Horário criado com sucesso!"
					clearForm()
				}
			})
			.catch((error) => {
				console.log(error);
			});
	}
}

const clearForm = () => {
	formData.primeiro_horario = ""
	formData.segundo_horario = ""
	formData.terceiro_horario = ""
	formData.quarto_horario = ""
}

</script>
