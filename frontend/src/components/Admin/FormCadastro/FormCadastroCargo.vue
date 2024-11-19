<template>
	<div class="grid h-full w-full">
		<form>
			<div class="grid h-full w-full grid-rows-1 py-20 lg:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid content-center grid-cols-1">
						<div class="col-span-1 p-1">
							<InputText v-model="formData.cargo" class="w-full lg:w-[16.6rem] h-[2.5rem]"
								placeholder="Cargo / Função" />
						</div>
					</div>
					<div class="grid grid-rows-1 justify-center mt-8">
						<Button
							class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-2"
							label="Cadastrar" severity="info" raised @click="enviarFormularioDeCadastroDeCargo()" />
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
import DialogAlerta from '../../DialogAlerta.vue';
import useCadastroService from '../../../services/CadastroService';
import useUtils from '../../../services/Utils';

const formData = ref({
	cargo: "",
});
const dialogMensagem = ref("");
const dialogVisivel = ref(false);

const enviarFormularioDeCadastroDeCargo = async () => {
	if (formData.cargo === "") {
		dialogMensagem.value = "Campo vazio!";
		dialogVisivel.value = true;
		useUtils.sleep(2000).then(() => {
			dialogVisivel.value = false;
		});
	} else {
		useCadastroService.cadastrarCargo(formData.value).then((response) => {
			handleResponse(response);
			console.log(response)
		});
	}
};

const handleResponse = async (response) => {
	switch (response.status) {
		case 201:
			dialogMensagem.value = "Cargo cadastrado com sucesso!";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			limparForm();
			break;
		case 500:
			dialogMensagem.value = "Cargo já cadastrado!";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			limparForm();
			break;
		default:
			dialogMensagem.value = response.data.message;
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			limparForm();
			break;
	}
};

const limparForm = () => {
	formData.value.cargo = "";
};
</script>
