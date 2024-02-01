<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-6">
						<label for="name" class="form-label text-black font-weight-bold">Nome</label>
						<input type="text" v-model="formData.name" name="name" class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-6">
						<label for="email" class="form-label text-black font-weight-bold">Email</label>
						<input type="email" v-model="formData.email" name="email" class="text-black border-white form-control mb-2" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" >
						<label for="password" class="form-label text-black font-weight-bold">Senha</label>
						<input type="password" v-model="formData.password" name="password" class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-6" >
						<label for="password" class="form-label text-black font-weight-bold">Confirmar senha</label>
						<input type="password" v-model="formData.confirmPassword" name="password" class="text-black border-white form-control mb-2" />
					</div>
				</div>


				<div class="row">
					<div class="col-md-3">
						<label for="level" class="form-label text-black font-weight-bold">Nível</label>
						<select v-model="formData.level" name="level" class=" border-white form-control mb-1">
							<option disabled value=""></option>"
							<option value="1">Nível 1 [Administrador]</option>
							<option value="2">Nível 2 [Operador]</option>
						</select><br>
					</div>
				</div>

				<div class="row-md-3 d-flex justify-content-center">
					<button type="submit" @onClick="sendForm" class="btn d-flex justify-content-center text-white border-white">Cadastrar</button>
				</div>

			</form>
		</div>
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
