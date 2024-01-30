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
				<label for="password" class="">Confirmar senha: </label>
				<input type="password" v-model="formData.confirmPassword" name="password" class="" />
			</div>

			<div class="">
				<label for="level" class="">Nível</label>
				<select v-model="formData.level" name="level" class=" border-white form-control mb-1 w-50">
					<option disabled value=""></option>"
					<option value="1">Nível 1 [Administrador]</option>
					<option value="2">Nível 2 [Operador]</option>
				</select><br>
			</div>

			<div class="row">
				<button type="submit" @onClick="sendForm" class="btn btn-primary w-100">Cadastrar</button>
			</div>

		</form>
	</div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore';

const authStore = useAuthStore();

const formData = {
	name: "",
	email: "",
	password: "",
	confirmPassword: "",
	level: "",
}

const sendForm = async () => {
	if (formData.name != "" || formData.email != "" || formData.password != "") {
		if (formData.password != formData.confirmPassword) {
			alert("As senhas precisam ser iguais");
			return ;
		}
		if (formData.password.length < 8) {
			alert("Senha muito curta, precisa ter pelo menos 8 caracteres");
			return ;
		}
		const res = authStore.cadastroOperador(formData);
		console.log (res);
	}
	console.log(formData);
}

</script>
