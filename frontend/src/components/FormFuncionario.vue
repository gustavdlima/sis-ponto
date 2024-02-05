<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-4">
						<label class="form-label text-black font-weight-bold">Setor</label>
						<select v-model="data.setor" name="setor" class="border-white form-control">
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
						<input type="text" v-model="data.matricula" name="matricula"
							class="text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-4">
						<label for="carga_horaria" class="form-label text-black font-weight-bold">Carga Horária</label>
						<select v-model="data.carga_horaria" name="setor" class="border-white form-control">
							<option disabled value=""></option>"
							<option value="20h">20h</option>
							<option value="40h">40h</option>
						</select><br>
					</div>

				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="nome" class="form-label text-black font-weight-bold">Nome</label>
						<input type="text" v-model="data.nome" name="nome" class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label for="cpf" class="form-label text-black font-weight-bold">CPF</label>
						<input type="text" v-model="data.cpf" name="cpf"
							class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="rg" class="form-label text-black font-weight-bold">RG</label>
						<input type="text" v-model="data.rg" name="rg" class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="dataNascimento" class="form-label text-black font-weight-bold">Data de Nascimento</label>
						<input type="date" v-model="data.data_nascimento" name="dataNascimento"
							class="border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="pis_pasep" class="form-label text-black font-weight-bold">Pis/Pasep</label>
						<input type="pis_pasep" v-model="data.pis_pasep" name="pis_pasep"
							class=" text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-4">
						<label for="titulo_eleitor" class="form-label text-black font-weight-bold">Titulo Eleitor</label>
						<input type="text" v-model="data.titulo_eleitor" name="titulo_eleitor"
							class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="cartao_sus" class="form-label text-black font-weight-bold">Cartão SUS</label>
						<input type="text" v-model="data.cartao_sus" name="cartao_sus"
							class=" text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-2">
						<label for="estado_civil" class="form-label text-black font-weight-bold">Estado Civil</label>
						<select v-model="data.estado_civil" name="estado_civil" class=" border-white form-control mb-2">
							<option disabled value=""></option>"
							<option value="solteiro">Solteiro(a)</option>
							<option value="casado">Casado(a)</option>
						</select><br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="mae" class="form-label text-black font-weight-bold">Mãe</label>
						<input type="text" v-model="data.mae" name="mae" class=" text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-6">
						<label for="pai" class="form-label text-black font-weight-bold">Pai</label>
						<input type="text" v-model="data.pai" name="pai" class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="email" class="form-label text-black font-weight-bold">Email</label>
						<input type="email" v-model="data.email" name="email"
							class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-4">
						<label for="celular" class="form-label text-black font-weight-bold">Celular</label>
						<input type="text" v-model="data.celular" name="celular"
							class=" text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="rua" class="form-label text-black font-weight-bold">Rua</label>
						<input type="text" v-model="data.rua" name="rua" class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="bairro" class="form-label text-black font-weight-bold">Bairro</label>
						<input type="text" v-model="data.bairro" name="bairro"
						class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-2">
						<label for="numero" class="form-label text-black font-weight-bold">Numero</label>
						<input type="text" v-model="data.numero" name="numero"
						class=" text-black border-white form-control mb-2" />
					</div>

				</div>

				<div class=row>
					<div class="col-md-3">
						<label for="cep" class="form-label text-black font-weight-bold">CEP</label>
						<input type="text" v-model="data.cep" name="cep" class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-5">
						<label for="cidade" class="form-label text-black font-weight-bold">Cidade</label>
						<input type="text" v-model="data.cidade" name="cidade"
							class=" text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-3">
						<label for="uf" class="form-label text-black font-weight-bold">UF</label>
						<input type="text" v-model="data.uf" name="uf" class=" text-black border-white form-control mb-2" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label text-black font-weight-bold">Horário</label>
						<select name="id_horario" v-model="data.id_horario" class="border-white form-control mb-2">
							<option disabled value=""></option>
							<option v-for="horario in horarios" v-bind:value="horario.id">
								{{ horario.horario_entrada }} - {{ horario.horario_ida_intervalo }} - {{
									horario.horario_volta_intervalo }} - {{ horario.horario_saida }}</option>
						</select><br>
					</div>
					<div class="col-md-6">
						<label class="form-label text-black font-weight-bold">Cargo</label>
						<select name="id_cargo" v-model="data.id_cargo" class="border-white form-control">
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
		</div>
	</div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore.js';
import { ref } from 'vue';
import axios from 'axios';

const authStore = useAuthStore();

var cargos = ref([]);
var horarios = ref([]);

const data = {
	nome: "",
	setor: "",
	matricula: "",
	nivel: "",
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

const sendForm = () => {
	if (data.setor == "" || data.matricula == "" || data.dataNascimento == "" || data.nome == "" || data.id_horario == "" || data.id_cargo == "" || data.nivel == "" || data.cep == "" || data.rua == "" || data.bairro == "" || data.cidade == "" || data.uf == "" || data.cpf == "" || data.rg == "" || data.email == "" || data.celular == "" || data.mae == "" || data.pis_pasep == "" || data.titulo_eleitor == "" || data.estado_civil == "" || data.carga_horaria == "") {
		alert("Preencha todos os campos");
	} else {
		const res = authStore.cadastroFuncionario(data);
		console.log(res);
	}
}

function getCargos() {
	axios.get("http://localhost:8000/api/cargos")
		.then(response => {
			cargos.value = response.data;
			console.log(cargos);
		})
		.catch(error => {
			console.log(error);
		});
}

function getHorarios() {
	axios.get("http://localhost:8000/api/horarios")
		.then(response => {
			horarios.value = response.data;
			console.log(horarios);
		})
		.catch(error => {
			console.log(error);
		});
}

getCargos();
getHorarios();

</script>
