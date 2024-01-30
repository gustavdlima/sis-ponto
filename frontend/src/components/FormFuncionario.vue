<template>
	<div class="container d-flex justify-content-center">
		<form @submit.prevent="sendForm">
			<div class="row mb-2">
				<div class="d-flex justify-content-start p-0 ">
					<h1>Cadastro de Funcionário</h1>
				</div>
			</div>
			<div class="row">
				<div class="d-flex justify-content-start p-0">
					<label>Setor</label>
				</div>
				<select v-model="data.setor" name="setor" class="border-white form-control mb-1 w-50">
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
			<div class="row">
				<label for="nome" class="d-flex justify-content-start p-0">Nome</label>
				<input type="text" v-model="data.nome" name="nome" class=" text-white border-white form-control mb-1" />
			</div>

			<div class="row">
				<label for="matricula" class="d-flex justify-content-start p-0 ">Matricula</label>
				<input type="text" v-model="data.matricula" name="matricula"
					class=" text-white border-white form-control mb-1 w-50" />
			</div>

			<div class="row">
				<label for="rg" class="d-flex justify-content-start p-0">Rg</label>
				<input type="text" v-model="data.rg" name="rg" class=" text-white border-white form-control mb-1" />

				<label for="cpf" class="d-flex justify-content-start p-0">Cpf</label>
				<input type="text" v-model="data.cpf" name="cpf" class=" text-white border-white form-control mb-1" />
			</div>

			<div class="row">
				<label for="pis_pasep" class="d-flex justify-content-start p-0">Pis/Pasep</label>
				<input type="pis_pasep" v-model="data.pis_pasep" name="pis_pasep"
					class=" text-white border-white form-control mb-1 w-50" />

				<label for="titulo_eleitor" class="d-flex justify-content-start p-0">Titulo Eleitor</label>
				<input type="text" v-model="data.titulo_eleitor" name="titulo_eleitor"
					class=" text-white border-white form-control mb-1 w-50" />
			</div>

			<div class="row">
				<label for="cartao_sus" class="d-flex justify-content-start p-0">Cartão SUS</label>
				<input type="text" v-model="data.cartao_sus" name="cartao_sus"
					class=" text-white border-white form-control mb-1 w-50" />

				<label for="estado_civil" class="d-flex justify-content-start p-0">Estado Civil</label>
				<select v-model="data.estado_civil" name="estado_civil" class=" border-white form-control mb-1 w-50">
					<option disabled value=""></option>"
					<option value="solteiro">Solteiro(a)</option>
					<option value="casado">Casado(a)</option>
				</select><br>
			</div>

			<div class="row">
				<label for="mae" class="d-flex justify-content-start p-0 ">Mãe</label>
				<input type="text" v-model="data.mae" name="mae" class=" text-white border-white form-control mb-1 w-50" />
			</div>

			<div class="row">
				<label for="pai" class="d-flex justify-content-start p-0 ">Pai</label>
				<input type="text" v-model="data.pai" name="pai" class=" text-white border-white form-control mb-1 w-50" />
			</div>

			<div class="row">
				<label for="email" class="d-flex justify-content-start p-0 ">Email</label>
				<input type="email" v-model="data.email" name="email"
					class=" text-white border-white form-control mb-1 w-50" />

				<label for="celular" class="d-flex justify-content-start p-0 ">Celular</label>
				<input type="text" v-model="data.celular" name="celular"
					class=" text-white border-white form-control mb-1 w-50" />
			</div>

			<div class="row">
				<label for="rua" class="d-flex justify-content-start p-0 ">Rua</label>
				<input type="text" v-model="data.rua" name="rua" class=" text-white border-white form-control mb-1 w-50" />

				<label for="numero" class="d-flex justify-content-start p-0 ">Numero</label>
				<input type="text" v-model="data.numero" name="numero"
					class=" text-white border-white form-control mb-1 w-50" />

				<label for="cep" class="d-flex justify-content-start p-0 ">CEP</label>
				<input type="text" v-model="data.cep" name="cep" class=" text-white border-white form-control mb-1 w-50" />
			</div>

			<div class=row>
				<label for="bairro" class="d-flex justify-content-start p-0 ">Bairro</label>
				<input type="text" v-model="data.bairro" name="bairro"
					class=" text-white border-white form-control mb-1 w-50" />

				<label for="cidade" class="d-flex justify-content-start p-0 ">Cidade</label>
				<input type="text" v-model="data.cidade" name="cidade"
					class=" text-white border-white form-control mb-1 w-50" />

				<label for="uf" class="d-flex justify-content-start p-0 ">UF</label>
				<input type="text" v-model="data.uf" name="uf" class=" text-white border-white form-control mb-1 w-50" />
			</div>
			<div class="row">
				<label for="nivel" class="d-flex justify-content-start p-0 ">Nível</label>
				<select v-model="data.nivel" name="nivel" class=" border-white form-control mb-1 w-50">
					<option disabled value=""></option>"
					<option value="1">Nível 1 [Administrador]</option>
					<option value="2">Nível 2 [Servidor]</option>
					<option value="3">Nível 3 [Funcionário]</option>
				</select><br>
			</div>
			<div class="row">
				<label for="dataNascimento" class="d-flex justify-content-start p-0">Data de Nascimento</label>
				<input type="date" v-model="data.data_nascimento" name="dataNascimento"
					class="border-white form-control mb-1 w-50" />
			</div>
			<div class="row">
				<div class="d-flex justify-content-start p-0">
					<label>Horário</label>
				</div>
				<select name="id_horario" v-model="data.id_horario" class="border-white form-control mb-1">
					<option disabled value=""></option>
					<option v-for="horario in horarios" v-bind:value="horario.id">
						{{ horario.horario_entrada }} - {{ horario.horario_ida_intervalo }} - {{
							horario.horario_volta_intervalo }} - {{ horario.horario_saida }}</option>
				</select><br>
			</div>
			<div class="row">
				<div class=" d-flex justify-content-start p-0">
					<label>Cargo</label>
				</div>
				<select name="id_cargo" v-model="data.id_cargo" class="border-white form-control mb-1">
					<option disabled value=""></option>
					<option v-for="cargo in cargos" v-bind:value="cargo.id">
						{{ cargo.cargo }}</option>
				</select>
			</div>
			<div class="row d-flex justify-content-center">
				<button type="submit" @onClick="sendForm"
					class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white w-50">Cadastrar</button>
			</div>
		</form>
	</div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore.js';

const authStore = useAuthStore();

const props = defineProps({
	cargos: Array,
	horarios: Array
});

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
}

const sendForm = () => {
			if (data.setor == "" || data.matricula == "" || data.dataNascimento == "" || data.nome == "" || data.id_horario == "" || data.id_cargo == "" || data.nivel == "" || data.cep == "" || data.rua == "" || data.bairro == "" || data.cidade == "" || data.uf == "" || data.cpf == "" || data.rg == "" || data.email == "" || data.celular == "" || data.mae == "" || data.pis_pasep == "" || data.titulo_eleitor == "" || data.estado_civil == "") {
				alert("Preencha todos os campos");
			} else {
				const res = authStore.cadastroFuncionario(data);
			}
}

</script>



<!-- <script>

export default {
	name: "FormFuncionario",
	data() {
		return {
			data: {
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
			}
		}
	},
	props: {
		cargos: Array,
		horarios: Array
	},
	methods: {
		sendForm() {
			if (this.data.setor == "" || this.data.matricula == "" || this.data.dataNascimento == "" || this.data.nome == "" || this.data.id_horario == "" || this.data.id_cargo == "" || this.data.nivel == "" || this.data.cep == "" || this.data.rua == "" || this.data.bairro == "" || this.data.cidade == "" || this.data.uf == "" || this.data.cpf == "" || this.data.rg == "" || this.data.email == "" || this.data.celular == "" || this.data.mae == "" || this.data.pis_pasep == "" || this.data.titulo_eleitor == "" || this.data.estado_civil == "") {
				alert("Preencha todos os campos");
			} else {
				useAuthStore
			}
		},

	},
}
</script> -->
