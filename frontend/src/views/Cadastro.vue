<template>
	<h1>Cadastro</h1>
	<form @submit.prevent="sendForm">
		<div>
			Escolha o seu setor
			<select v-model="data.setor" name="setor">
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
		<div>
			<label for="matricula">Matricula</label>
			<input type="text" v-model="data.matricula" name="matricula" />
		</div>
		<div>
			<label for="dataNascimento">Data de Nascimento</label>
			<input type="date" v-model="data.data_nascimento" name="dataNascimento" />
		</div>
		<button type="submit">Cadastrar</button>
	</form>
	<p>Matricula is: {{data.matricula}}</p>
	<p>Data de Nascimento is: {{data.data_nascimento}}</p>
</template>

<script>

export default {
	name: "Cadastrar",
	data() {
		return {
			data: {
				setor: "",
				matricula: "",
				data_nascimento: "",
			}
		}
	},
	created() {
	},
	methods: {
		sendForm() {
			if (this.data.setor == "" || this.data.matricula == "" || this.data.dataNascimento == "") {
				console.log(this.data)
				console.log("Preencha todos os campos");
			} else {
				this.$http.post("http://localhost:8000/api/cadastro", this.data)
				.then(function (response) {
					console.log(response);
				})
				.catch(function (error) {
					console.log(error.response.data);
				});
			}
		}
	},
}
</script>
