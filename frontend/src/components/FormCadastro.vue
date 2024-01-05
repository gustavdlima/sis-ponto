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
				<select v-model="data.horario" name="horario" class=" border-white form-control mb-1">
					<option disabled value=""></option>
					<option value="horario1">07h - 11h - 12h - 16h</option>
					<option value="horario2">07:30h - 11:30h - 12:30h - 16:30h</option>
					<option value="horario3">8h - 12h - 13h - 17h</option>
				</select><br>
			</div>
			<div class="row">
				<div class=" d-flex justify-content-start p-0">
					<label>Cargo</label>
				</div>
				<select class="border-white form-control mb-1" :required="true">
					<option disabled value=""></option>
					<option v-for="cargo in cargos" v-bind:value="cargo.id">
						{{ cargo }}</option>
				</select>
			</div>
			<div class="row d-flex justify-content-center">
				<button type="submit"
					class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white w-50">Cadastrar</button>
			</div>
		</form>
	</div>
</template>

<script>
import { ref } from "vue";

export default {
	name: "FormCadastro",
	data() {
		return {
			data: {
				nome: "",
				setor: "",
				nivel: "",
				horario: "",
				matricula: "",
				data_nascimento: "",
				id_horario: "",
			}
		}
	},
	props: {
		cargos: Array,
	},
	methods: {
		sendForm() {
			if (this.data.setor == "" || this.data.matricula == "" || this.data.dataNascimento == "" || this.data.nome == "" || this.data.horario == "" || this.data.nivel == "") {
				console.log(this.data)
				console.log("Preencha todos os campos");
			} else {
				console.log(this.data);
				this.$http.post("http://localhost:8000/api/cadastro", this.data)
					.then(function (response) {
						console.log(response);
					})
					.catch(function (error) {
						console.log(error.response.data);
					});
			}
		},

	},
}
</script>

<style scoped>
button:hover {
	background-color: rgb(0, 140, 255);
}

label {
	font-size: 2.5vh;
	color: black;
	font-weight: bold !important;
}

input,
select {
	font-size: 2.5vh;
	color: aliceblue !important;
	font-weight: bold !important;
	background-color: rgba(255, 255, 255, 0) !important;
}

option {
	color: black !important;
	font-weight: bold !important;
}
</style>
