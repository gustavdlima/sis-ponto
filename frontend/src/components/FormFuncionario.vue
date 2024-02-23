<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-4">
						<label class="form-label text-black font-weight-bold">Setor</label>
						<select v-model="formData.setor" name="setor" class="form-select border-white form-control">
							<option disabled value=""></option>"
							<option value="AEE">AEE</option>
							<option value="AJU">AJU</option>
							<option value="ALMOXARIFADO">ALMOXARIFADO</option>
							<option value="ASCOM">ASCOM</option>
							<option value="CAD">CAD</option>
							<option value="CAP">CAP</option>
							<option value="CAS">CAS</option>
							<option value="CIL">CIL</option>
							<option value="CODAFI">CODAFI</option>
							<option value="CODAM">CODAM</option>
							<option value="CODAPA">CODAPA</option>
							<option value="CODAVI">CODAVI</option>
							<option value="CODEI">CODEI</option>
							<option value="COMAP">COMAP</option>
							<option value="CORAD">CORAD</option>
							<option value="CORDI">CORDI</option>
							<option value="CORFIN">CORFIN</option>
							<option value="CORSIN">CORSIN</option>
							<option value="CREM">CREM</option>
							<option value="CRH">CRH</option>
							<option value="DE">DE</option>
							<option value="DT">DT</option>
							<option value="EAP">EAP</option>
							<option value="GABINETE">GABINETE</option>
							<option value="NAAS">NAAS</option>
							<option value="NED">NED</option>
							<option value="NVA">NVA</option>
							<option value="PASSE-LIVRE">PASSE-LIVRE</option>
							<option value="PATRIMONIO">PATRIMÔNIO</option>
							<option value="PROTOCOLO">PROTOCOLO</option>
							<option value="REFEITORIO">REFEITÓRIO</option>
							<option value="SUS">SUS</option>
							<option value="USPLAN">USPLAN</option>
						</select><br>
					</div>
					<div class="col-md-4">
						<label for="matricula" class="form-label text-black font-weight-bold">Matrícula</label>
						<input type="text" v-model="formData.matricula" name="matricula"
							class="text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-4">
						<label for="carga_horaria" class="form-label text-black font-weight-bold">Carga Horária</label>
						<select v-model="formData.carga_horaria" name="setor" class="form-select border-white form-control">
							<option disabled value=""></option>"
							<option value="20h">20h</option>
							<option value="40h">40h</option>
						</select><br>
					</div>

				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="nome" class="form-label text-black font-weight-bold">Nome</label>
						<input type="text" v-model="formData.nome" name="nome"
							class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label for="cpf" class="form-label text-black font-weight-bold">CPF</label>
						<input type="text" v-model="formData.cpf" name="cpf"
							class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="rg" class="form-label text-black font-weight-bold">RG</label>
						<input type="text" v-model="formData.rg" name="rg" class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="dataNascimento" class="form-label text-black font-weight-bold">Data de
							Nascimento</label>
						<input type="date" v-model="formData.data_nascimento" name="dataNascimento"
							class="border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="pis_pasep" class="form-label text-black font-weight-bold">Pis/Pasep</label>
						<input type="pis_pasep" v-model="formData.pis_pasep" name="pis_pasep"
							class=" text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-4">
						<label for="titulo_eleitor" class="form-label text-black font-weight-bold">Titulo Eleitor</label>
						<input type="text" v-model="formData.titulo_eleitor" name="titulo_eleitor"
							class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="cartao_sus" class="form-label text-black font-weight-bold">Cartão SUS</label>
						<input type="text" v-model="formData.cartao_sus" name="cartao_sus"
							class=" text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-2">
						<label for="estado_civil" class="form-label text-black font-weight-bold">Estado Civil</label>
						<select v-model="formData.estado_civil" name="estado_civil" class=" border-white form-control mb-2">
							<option disabled value=""></option>"
							<option value="solteiro">Solteiro(a)</option>
							<option value="casado">Casado(a)</option>
						</select><br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="mae" class="form-label text-black font-weight-bold">Mãe</label>
						<input type="text" v-model="formData.mae" name="mae"
							class=" text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-6">
						<label for="pai" class="form-label text-black font-weight-bold">Pai</label>
						<input type="text" v-model="formData.pai" name="pai"
							class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="email" class="form-label text-black font-weight-bold">Email</label>
						<input type="email" v-model="formData.email" name="email"
							class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-4">
						<label for="celular" class="form-label text-black font-weight-bold">Celular</label>
						<input type="text" v-model="formData.celular" name="celular"
							class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="rua" class="form-label text-black font-weight-bold">Rua</label>
						<input type="text" v-model="formData.rua" name="rua"
							class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="bairro" class="form-label text-black font-weight-bold">Bairro</label>
						<input type="text" v-model="formData.bairro" name="bairro"
							class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-2">
						<label for="numero" class="form-label text-black font-weight-bold">Numero</label>
						<input type="text" v-model="formData.numero" name="numero"
							class=" text-black border-white form-control mb-2" />
					</div>

				</div>

				<div class=row>
					<div class="col-md-3">
						<label for="cep" class="form-label text-black font-weight-bold">CEP</label>
						<input type="text" v-model="formData.cep" name="cep"
							class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-5">
						<label for="cidade" class="form-label text-black font-weight-bold">Cidade</label>
						<input type="text" v-model="formData.cidade" name="cidade"
							class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="uf" class="form-label text-black font-weight-bold">UF</label>
						<input type="text" v-model="formData.uf" name="uf" class=" text-black border-white form-control mb-2" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label text-black font-weight-bold">Horário</label>
						<select name="id_horario" v-model="formData.id_horario" class="form-select border-white form-control mb-2">
							<option disabled value=""></option>
							<option v-for="horario in horarios" v-bind:value="horario.id">
								{{ horario.primeiro_horario }} - {{ horario.segundo_horario }} - {{
									horario.terceiro_horario }} - {{ horario.quarto_horario }}</option>
						</select><br>
					</div>
					<div class="col-md-6">
						<label class="form-label text-black font-weight-bold">Cargo</label>
						<select name="id_cargo" v-model="formData.id_cargo" class="form-select border-white form-control">
							<option disabled value=""></option>
							<option v-for="cargo in cargos" v-bind:value="cargo.id">
								{{ cargo.cargo }}</option>
						</select>
					</div>
					<div class="row-md-3 d-flex justify-content-center">
						<button type="submit" @onClick="sendForm"
							class="btn d-flex justify-content-center text-white border-white">Cadastrar</button>
					</div>
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
import { useAuthStore } from '../stores/authStore.js';
import { ref } from 'vue';
import axios from 'axios';

const authStore = useAuthStore();

var cadastroSucesso = ref(false);
var campoVazio = ref(false);
var erroSistema = ref(false);
var errorMessage = ref("");
var cargos = ref([]);
var horarios = ref([]);

const formData = {
	nome: "",
	setor: "",
	matricula: "",
	data_nascimento: "",
	rg: "",
	cpf: "",
	pis_pasep: "",
	titulo_eleitor: "",
	cartao_sus: "",
	mae: "",
	pai: "",
	celular: "",
	email: "",
	estado_civil: "",
	rua: "",
	bairro: "",
	cep: "",
	numero: "",
	cidade: "",
	uf: "",
	id_cargo: "",
	id_horario: "",
	carga_horaria: ""
}

function fillFormData() {
	formData.nome = "teste"
	formData.setor = "teste"
	formData.matricula = "teste"
	formData.data_nascimento = "1994-01-01"
	formData.rg = "teste"
	formData.cpf = "teste"
	formData.pis_pasep = "teste"
	formData.titulo_eleitor = "teste"
	formData.cartao_sus = "teste"
	formData.mae = "teste"
	formData.pai = "teste"
	formData.celular = "teste"
	formData.email = "teste@gmail.com"
	formData.estado_civil = "teste"
	formData.rua = "teste"
	formData.bairro = "teste"
	formData.cep = "teste"
	formData.numero = "teste"
	formData.cidade = "teste"
	formData.uf = "teste"
	formData.id_cargo = "1"
	formData.id_horario = "1"
	formData.carga_horaria = "20h"
}

const sendForm = async () => {
	// fillFormData();
	if (checkIfInputIsEmpty() == false) {
		try {
			axios.defaults.headers.common = {
				'Authorization': 'Bearer ' + authStore.userToken
			}
			await axios
				.post('http://localhost:8000/api/funcionarios', formData)
				.then((response) => {
					const responseData = JSON.stringify(response.data);
					if (responseData.indexOf("criado") !== -1) {
						cadastroSucesso.value = true;
						errorMessage.value = "Funcionário cadastrado com sucesso";
						clearForm();
					} else if (responseData.indexOf("existente") !== -1) {
						campoVazio.value = true;
						errorMessage.value = "Funcionário existente";
					} else {
						erroSistema.value = true;
						errorMessage.value = responseData;
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
}

function getCargos() {
	axios.defaults.headers.common = {
				'Authorization': 'Bearer ' + authStore.userToken
			}
	axios.get("http://localhost:8000/api/cargos")
		.then(response => {
			cargos.value = response.data;
		})
		.catch(error => {
			console.log(error);
		});
}

function getHorarios() {
	axios.defaults.headers.common = {
				'Authorization': 'Bearer ' + authStore.userToken
			}
	axios.get("http://localhost:8000/api/horarios")
		.then(response => {
			horarios.value = response.data;
		})
		.catch(error => {
			console.log(error);
		});
}

function checkIfInputIsEmpty() {
	if (formData.setor == "" || formData.matricula == "" || formData.carga_horaria == "" || formData.nome == "" || formData.cpf == "") {
		return true
	} else {
		return false
	}
}

function clearForm() {
	formData.nome = "";
	formData.setor = "";
	formData.matricula = "";
	formData.data_nascimento = "";
	formData.rg = "";
	formData.cpf = "";
	formData.pis_pasep = "";
	formData.titulo_eleitor = "";
	formData.cartao_sus = "";
	formData.mae = "";
	formData.pai = "";
	formData.celular = "";
	formData.email = "";
	formData.estado_civil = "";
	formData.rua = "";
	formData.bairro = "";
	formData.cep = "";
	formData.numero = "";
	formData.cidade = "";
	formData.uf = "";
	formData.id_cargo = "";
	formData.id_horario = "";
	formData.carga_horaria = "";
}

getCargos();
getHorarios();

</script>
