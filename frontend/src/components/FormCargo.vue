<template>
	<div class="container d-flex justify-content-center">
		<form @submit.prevent="sendForm">
			<div class="row mb-2">
				<div class="d-flex justify-content-start p-0 ">
					<h1>Cadastro de Cargo</h1>
				</div>
			</div>

			<div class="">
				<label for="cargo" class="">Cargo / Função: </label>
				<input type="text" v-model="formData.cargo" name="cargo" class="" />
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
	cargo: "",
}

const sendForm = () => {
	if (formData.cargo != "") {
		const res = authStore.cadastroCargo(formData);
		console.log (res);
	}
	// enviar form para o backend
	console.log(formData);
}

</script>
