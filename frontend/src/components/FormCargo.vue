<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-6 mt-8">
						<label for="cargo" class="form-label text- font-weight-bold">Cargo / Função: </label>
						<input type="text" v-model="formData.cargo" name="cargo" class="text-black border-white form-control mb-2" />
					</div>
				</div>
				<div class="row-md-3 d-flex justify-content-center">
					<button type="submit" @onClick="sendForm"
						class="btn d-flex justify-content-center text-white border-white m-3">Cadastrar</button>
				</div>

			</form>
		</div>
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
