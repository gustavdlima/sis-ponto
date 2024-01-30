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
