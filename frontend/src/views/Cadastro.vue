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
		<div>
			<label for="nome">Nome</label>
			<input type="text" v-model="data.nome" name="nome" />
		</div>
		<div>
			<label for="matricula">Matricula</label>
			<input type="text" v-model="data.matricula" name="matricula" />
		</div>
		<div>
			<label for="dataNascimento">Data de Nascimento</label>
			<input type="date" v-model="data.data_nascimento" name="dataNascimento" />
		</div>
		<div>
			Horário
			<select v-model="data.horario" name="horario">
				<option disabled value=""></option>"
				<option value="horario1">07h - 11h - 12h - 16h</option>
				<option value="horario2">07:30h - 11:30h - 12:30h - 16:30h</option>
				<option value="horario3">8h - 12h - 13h - 17h</option>
			</select><br>
		</div>

		<button type="submit">Cadastrar</button>
	</form>
</template>

<script>

export default {
	name: "Cadastrar",
	data() {
		return {
			data: {
				nome: "",
				setor: "",
				matricula: "",
				data_nascimento: "",
				id_horario: "",
			}
		}
	},
	created() {
	},
	methods: {
		sendForm() {
			if (this.data.setor == "" || this.data.matricula == "" || this.data.dataNascimento == "" || this.data.nome == "" || this.data.horario == "") {
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
