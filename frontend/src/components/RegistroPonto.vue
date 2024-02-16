<template>
	<div class="container d-flex justify-content-center ">

		<form name="login-form">
			<div class="row">
				<div class="row-md-1 row-sm-12 d-flex justify-content-center">
					<input type="text" id="matricula" placeholder="Matricula"
						class="w-50 mt-2 text-white border-white form-control"
						style="background-color: rgba(255, 255, 255, 0);" v-model="input.matricula" />
				</div>
				<div class="row-md-1 row-sm-12 d-flex justify-content-center">
					<input type="date" id="dataNascimento" placeholder="Dt Nascimento Ex. 31/08/1994"
						class="w-50 mt-3 text-white border-white form-control"
						style="background-color: rgba(255, 255, 255, 0);" v-model="input.data_nascimento" />
				</div>
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
				<v-card-title class="headline font-weight-bold">Sucesso!</v-card-title>
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

<script>
import { useFuncionarioStore } from '../stores/funcionarioStore';
import axios from 'axios';

export default {
	name: 'RegistroPonto',
	data() {
		return {
			input: {
				matricula: "",
				data_nascimento: "",

			},
			mensagem: "",
			matriculaErrada: false,
			errorMessage: "",
			campoVazio: false,
			pontoAdiantado: false,
			pontoBatido: false,
		}
	},
	methods: {
		registrar() {
			if (this.input.matricula != "" && this.input.data_nascimento != "") {
				axios.post("http://localhost:8000/api/ponto", this.input)
					.then(response => {
						this.mensagem = JSON.stringify(response.data);
						if (this.mensagem.indexOf("15 minutos") !== -1) {
							this.pontoAdiantado = true
							this.errorMessage = response.data
							clearForm();
							return;
						} else if (this.mensagem.indexOf("Funcionário") !== -1) {
							this.matriculaErrada = true
							this.errorMessage = "Matrícula incorreta"
							return;
						}
						this.pontoBatido = true
						this.errorMessage = "Ponto batido com sucesso!"
						clearForm();
					})
					.catch(error => {
						console.log(error);
					});
			} else {
				this.campoVazio = true
				this.errorMessage = "Preencha todos os campos"
			}
		},

		clearForm() {
			this.input.matricula = "";
			this.input.data_nascimento = "";
		},

	},
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
