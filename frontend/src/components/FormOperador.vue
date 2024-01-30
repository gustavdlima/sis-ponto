<template>
	<div class="container d-flex justify-content-center">
		<form @submit.prevent="sendForm">
			<div class="row mb-2">
				<div class="d-flex justify-content-start p-0 ">
					<h1>Cadastro de Operador</h1>
				</div>
			</div>

			<div class="">
				<label for="name" class="">Nome: </label>
				<input type="text" v-model="formData.name" name="name" class="" />
			</div>

			<div class="">
				<label for="email" class="">Email: </label>
				<input type="email" v-model="formData.email" name="email" class="" />
			</div>

			<div class="" >
				<label for="password" class="">Senha: </label>
				<input type="password" v-model="formData.password" name="password" class="" />
			</div>

			<div class="" >
				<label for="password" class="">Confirme sua senha: </label>
				<input type="password" v-model="formData.confirmPassword" name="password" class="" />
			</div>

			<div class="row">
				<button type="submit" @onClick="sendForm" class="btn btn-primary w-100">Cadastrar</button>
			</div>

		</form>
	</div>
</template>

<script setup>

const formData = {
	name: "",
	email: "",
	password: "",
	confirmPassword: "",
	level: "",
}

const sendForm = () => {
	if (formData.password !== formData.confirmPassword) {
		alert("As senhas precisam ser iguais");
	}
	// enviar form para o backend
	console.log(formData);
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
			if (this.data.setor == "" || this.data.matricula == "" || this.data.dataNascimento == "" || this.data.nome == "" || this.data.id_horario == "" || this.data.id_cargo == "" || this.data.nivel == "" || this.data.cep == "" || this.data.rua == "" || this.data.bairro == "" || this.data.cidade == "" || this.data.uf == "" || this.data.cpf == "" || this.data.rg == "" || this.data.email == "" || this.data.celular == "" || this.data.mae == ""|| this.data.pis_pasep == "" || this.data.titulo_eleitor == "" || this.data.cartao_sus == "" || this.data.estado_civil == "") {
				alert("Preencha todos os campos");
			} else {
				this.$http.post("http://localhost:8000/api/cadastro", this.data)
					.then(function (response) {
						console.log(response.data);
					})
					.catch(function (error) {
						console.log(error.response.data);
					});
			}
		},

	},
}
</script> -->

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
