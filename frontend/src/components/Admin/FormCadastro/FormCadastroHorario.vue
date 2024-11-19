<template>
	<div class="grid h-full w-full">
		<form>
			<div class="grid h-full w-full grid-rows-1 py-20 lg:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid grid-rows-2 gap-1">
						<div class="grid content-center row-span-1">
							<div class="grid content-center md:grid-cols-2 gap-1">
								<div class="md:col-span-1 p-1">
									<Calendar id="calendar-timeonly" v-model="formData.primeiro_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Primeiro Horário" />
								</div>
								<div class="md:col-span-1 p-1">
									<Calendar id="calendar-timeonly" v-model="formData.segundo_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Segundo Horário" />
								</div>
							</div>
						</div>
						<div class="grid content-center row-span-1">
							<div class="grid content-center md:grid-cols-2 gap-1">
								<div class="md:col-span-1 p-1">
									<Calendar id="calendar-timeonly" v-model="formData.terceiro_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Terceiro Horário" />
								</div>
								<div class="md:col-span-1 p-1">
									<Calendar id="calendar-timeonly" v-model="formData.quarto_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Quarto Horário" />
								</div>
							</div>
						</div>
					</div>
					<div class="grid grid-rows-1 justify-center mt-8">
						<Button
							class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-2"
							label="Cadastrar" severity="info" raised @click="enviarFormularioDeCadastroDeHorario()" />
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
import Calendar from 'primevue/calendar';
import DialogAlerta from '../../DialogAlerta.vue';
import useCadastroService from '../../../services/CadastroService';
import useUtils from '../../../services/Utils';

const dialogMensagem = ref("");
const dialogVisivel = ref(false);
const formData = ref({
	primeiro_horario: "",
	segundo_horario: "",
	terceiro_horario: "",
	quarto_horario: "",
});

const enviarFormularioDeCadastroDeHorario = async () => {
	tratarFormData();
	const response = await useCadastroService.cadastrarHorario(formData.value);
	console.log(response);
	handleResponse(response);
};

const handleResponse = async (response) => {
	switch (response.status) {
		case 201:
			dialogMensagem.value = "Horário cadastrado com sucesso!";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			limparForm();
			break;
		case 500:
			dialogMensagem.value = "Horário já cadastrado";
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			break;
		default:
			dialogMensagem.value = response.data.message;
			dialogVisivel.value = true;
			useUtils.sleep(2000).then(() => {
				dialogVisivel.value = false;
			});
			break;
	}
};

const tratarFormData = () => {
	formData.value.primeiro_horario = useUtils.formatarHorario(formData.value.primeiro_horario);
	formData.value.segundo_horario = useUtils.formatarHorario(formData.value.segundo_horario);
	if (formData.value.terceiro_horario === "")
		formData.value.terceiro_horario = useUtils.formatarHorario(formData.value.terceiro_horario);

	if (formData.value.quarto_horario === "")
		formData.value.quarto_horario = useUtils.formatarHorario(formData.value.quarto_horario);
};

const limparForm = () => {
	formData.value.primeiro_horario = "";
	formData.value.segundo_horario = "";
	formData.value.terceiro_horario = "";
	formData.value.quarto_horario = "";
};
</script>
