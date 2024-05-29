<template>
	<div class="grid h-full w-full">
		<form>
			<div class="grid h-full w-full grid-rows-1 py-20 lg:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid grid-rows-2 gap-1">
						<div class="grid content-center row-span-1">
							<div class="grid content-center md:grid-cols-2 gap-1">
								<div class="md:col-span-1 p-1">
									<InputText v-model="formData.name" name="nome" class="w-full lg:w-[16.6rem] h-[2.5rem] " placeholder="Nome" />
								</div>
								<div class="md:col-span-1 p-1">
									<InputText v-model="formData.email" name="email" class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Email" />
								</div>
							</div>
						</div>
						<div class="row-span-1">
							<div class="grid content-center md:grid-cols-2 gap-1">
								<div class="md:col-span-1 p-1">
										<Password class="" v-model="formData.password"
										:feedback="false" placeholder="password" />
								</div>
								<div class="md:col-span-1 p-1">
									<Password class="" v-model="formData.password2"
										:feedback="false"
										medium-label="true"
										placeholder="password" />
								</div>
							</div>
						</div>
					</div>
					<div class="grid grid-rows-2 gap-1 mt-1.5">
						<div class="row-span-1">
							<div class="grid grid-rows-1 md:grid-cols-2 gap-1">
								<div class="row-span-1 md:col-span-1 p-1">
									<Dropdown v-model="formData.level" showClear :options="niveis" optionLabel="name"
										placeholder="Nível"
										class="w-full lg:w-[16.6rem] h-[2.5rem] "/>
								</div>
							</div>
						</div>
					</div>
					<div class="grid grid-rows-1 justify-center">
						<Button
						class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-2"
						label="Cadastrar" severity="info" raised @click="enviarFormularioDeCadastroDeOperador()" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
</template>

<script setup>
import { ref } from 'vue';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import DialogAlerta from './DialogAlerta.vue';
import Password from 'primevue/password';
import useCadastroService from '../services/CadastroService';
import useUtils from '../services/Utils';


const formData = ref({
	name: '',
	email: '',
	level: '',
	password: '',
	password2: '',
});
const niveis = ref([
	{ name: 'Administrador', code:' 1' },
	{ name: 'Operador', code: '2' },
]);
const dialogMensagem = ref('');
const dialogVisivel = ref(false);

const verificarSenhaENivel = async () => {
	if (formData.value.password !== formData.value.password2) {
		dialogMensagem.value = 'As senhas não coincidem.';
		dialogVisivel.value = true;
		await useUtils.sleep(500);
		dialogVisivel.value = false;
		return null;
	}
	if (formData.value.password.length < 8) {
		dialogMensagem.value = 'A senha deve ter no mínimo 8 caracteres.';
		dialogVisivel.value = true;
		await useUtils.sleep(500);
		dialogVisivel.value = false;
		return null;
	}
	if (formData.value.level === '') {
		dialogMensagem.value = 'Selecione um nível.';
		dialogVisivel.value = true;
		await useUtils.sleep(500);
		dialogVisivel.value = false;
		return null;
	}
	return 1;
};

const enviarFormularioDeCadastroDeOperador = async () => {
	if (await verificarSenhaENivel() == null) {
		return;
	}
	tratarFormData();
	console.log(formData.value);
	const response = await useCadastroService.cadastrarOperador(formData.value);
	console.log(response);
	handleResponse(response);
};

const handleResponse = async (response) => {
	if (response.status === 201) {
		dialogMensagem.value = 'Operador cadastrado com sucesso.';
		dialogVisivel.value = true;
		await useUtils.sleep(500);
		dialogVisivel.value = false;
	} else {
		dialogMensagem.value = 'Erro ao cadastrar operador.';
		dialogVisivel.value = true;
		await useUtils.sleep(500);
		dialogVisivel.value = false;
	}
};

const tratarFormData = () => {
	formData.value.level = formData.value.level.code;
};

</script>
