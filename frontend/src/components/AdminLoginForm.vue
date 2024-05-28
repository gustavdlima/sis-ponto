<template>
	<div class="grid justify-center grid-rows-2 ">
		<div class="grid justify-center content-end row-span-1">
			<LogoFunad />
			<div class="grid justify-center text-white p-1">
				<Eponto />
			</div>
		</div>
		<div class="grid justify-center content-center row-span-1 ">
			<div class="grid p-1">
				<div class="grid justify-center mb-2">
					<LoginInputs @atualizarCredenciais="credenciaisAtualizadas" />
				</div>
				<div class="grid justify-center mt-1">
					<Button
						class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-2"
						label="Entrar" severity="info" raised @click="efetuarLogin()" />
				</div>
			</div>
		</div>
	</div>

	<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import Button from 'primevue/button';
import LoginInputs from '../components/LoginInputs.vue';
import Eponto from '../components/Eponto.vue';
import LogoFunad from '../components/LogoFunadSemNome.vue';
import DialogAlerta from '../components/DialogAlerta.vue';
import AdminLoginService from '../services/AdminLoginService.js';

const credenciais = ref({ email: '', password: '' });
const dialogMensagem = ref('');
const dialogVisivel = ref(false);
const useAdminLoginService = AdminLoginService;
const router = useRouter();

const credenciaisAtualizadas = async ({ email, password }) => {
	credenciais.value.email = email;
	credenciais.value.password = password;
}

const efetuarLogin = async () => {
	if (!verificarSeTemAlgumCampoVazio()) {
		limparInputs();
		return null;
	}
	const response = await useAdminLoginService.login(credenciais.value)
	handleResponse(response);
}

const handleResponse = (response) => {
	if (response.status == 200) {
		dialogMensagem.value = 'Login efetuado com sucesso!';
		dialogVisivel.value = true;
		router.push('/admin');
	} else {
		dialogMensagem.value = 'Credenciais inválidas';
		dialogVisivel.value = true;
	}
}

function verificarSeTemAlgumCampoVazio() {
	if (credenciais.value.email == '' && credenciais.value.password == '') {
		dialogMensagem.value = 'Preencha todos os campos!';
		dialogVisivel.value = true;
		return null;
	}
	if (credenciais.value.email != '' && credenciais.value.password == '') {
		dialogMensagem.value = 'Preencha o campo de senha!';
		dialogVisivel.value = true;
		return null;
	}
	if (credenciais.value.email == '' && credenciais.value.password != '') {
		dialogMensagem.value = 'Preencha o campo de email!';
		dialogVisivel.value = true;
		return null;
	}
	return "ok";
}

function limparInputs() {
	credenciais.value.email = '';
	credenciais.value.password = '';
}

</script>

<style scoped>
button {
	background-color: transparent !important;
	color: aliceblue !important;
	border-color: aliceblue !important;
}

button:hover {
	border-color: #1F2937 !important;
}

</style>
