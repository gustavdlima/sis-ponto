<template>
	<Dialog v-model:visible="dialogEditarHorarioIsVisible" @update:visible="fecharEditarHorarioDialog" :modal="true"
		:closable="true" :style="{ width: '42vw' }">
		<template #header>
			<div class="grid grid-cols-1 justify-center">
				<div class="col-span-1">
					<h2 class="text-2xl font-semibold text-center">Editar Horários</h2>
				</div>
			</div>
		</template>
		<div class="grid h-full w-full p-2">
			<form>
				<div class="grid justify-center">
					<div class="grid grid-rows-2 gap-1">
						<div class="grid content-center row-span-1">
							<div class="grid content-center xl:grid-cols-2 gap-1">
								<div class="xl:col-span-1 p-1">
									<div class="font-semibold">
										<span>Primeiro Horário</span>
									</div>
									<Calendar id="calendar-timeonly" v-model="horario.primeiro_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Primeiro Horário" />
								</div>
								<div class="xl:col-span-1 p-1">
									<div class="font-semibold">
										<span>Segundo Horário</span>
									</div>
									<Calendar id="calendar-timeonly" v-model="horario.segundo_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Segundo Horário" />
								</div>
							</div>
						</div>
						<div class="grid content-center row-span-1">
							<div class="grid content-center xl:grid-cols-2 gap-1">
								<div class="xl:col-span-1 p-1">
									<div class="font-semibold">
										<span>Terceiro Horário</span>
									</div>
									<Calendar id="calendar-timeonly" v-model="horario.terceiro_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Terceiro Horário" />
								</div>
								<div class="xl:col-span-1 p-1">
									<div class="font-semibold">
										<span>Quarto Horário</span>
									</div>
									<Calendar id="calendar-timeonly" v-model="horario.quarto_horario" timeOnly
										showSeconds class="w-full lg:w-[16.6rem] h-[2.5rem] "
										placeholder="Quarto Horário" />
								</div>
							</div>
						</div>
					</div>
					<div class="mt-5">
						<div class="grid grid-rows-1 justify-center">
							<Button
								class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button"
								label="Editar" severity="info" raised @click="enviarFormularioDeEdicaoDeHorario()" />
						</div>
					</div>
				</div>
			</form>
		</div>
	</Dialog>

	<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Calendar from 'primevue/inputtext';
import useEditarService from '../../../services/EditarService'
import useUtils from '../../../services/Utils'
import DialogAlerta from '../../DialogAlerta.vue';

const props = defineProps({
	isVisible: Boolean,
	horario: Object
});

const dialogEditarHorarioIsVisible = ref();
const horarioEditado = ref();
const dialogMensagem = ref();
const dialogVisivel = ref();
const emit = defineEmits(['atualizarDialogEditarHorarioBool']);

const enviarFormularioDeEdicaoDeHorario = async () => {
	if (!validarFormatoHorario())
		return;
	const response = await useEditarService.editarHorario(horarioEditado.value)
	handleResponse(response);
	fecharEditarHorarioDialog();
};

const handleResponse = (response) => {
	switch (response.status) {
		case 200:
			dialogMensagem.value = response.data.message;
			dialogVisivel.value = true;
			useUtils.sleep(1500).then(() => {
				dialogVisivel.value = false;
			})
			return;
			break;
		default:
			dialogMensagem.value = response.data.message;
			dialogVisivel.value = true;
			useUtils.sleep(1500).then(() => {
				dialogVisivel.value = false;
			})
			return;
			break;
	}
}

const validarFormatoHorario = () => {
	var horarios = [
		horarioEditado.value.primeiro_horario,
		horarioEditado.value.segundo_horario,
		horarioEditado.value.terceiro_horario,
		horarioEditado.value.quarto_horario
	];

	for (var horario of horarios) {
		if (horario == "" || horario == null)
			horario++;
		if (!validarFormatoHoraIndividual(horario)) {
			return false;
		}
	}
	return true;
}

const validarFormatoHoraIndividual = (horario) => {
	if (horario.length < 8 && horario.length != 0) {
		dialogMensagem.value = "O horário não está no formato correto! hora:minutos:segundos (08:00:00)";
		dialogVisivel.value = true;
		useUtils.sleep(3000).then(() => {
			dialogVisivel.value = false;
		})
		return false;
	}
	for (let i = 0; i < horario.length; i++) {
		if (i == 2 || i == 5) {
			if (horario[i] != ":") {
				dialogMensagem.value = "O primeiro horário não está no formato correto! Separe as horas, minutos e segundos com ':' (08:00:00)";
				dialogVisivel.value = true;
				useUtils.sleep(3000).then(() => {
					dialogVisivel.value = false;
				})
				return false;
			}
		} else {
			if (isNaN(horario[i])) {
				dialogMensagem.value = "O primeiro horário não está no formato correto! Use apenas números e ':' (08:00:00)";
				dialogVisivel.value = true;
				useUtils.sleep(3000).then(() => {
					dialogVisivel.value = false;
				})
				return false;
			}
		}
	}
	return true;
}

const fecharEditarHorarioDialog = () => {
	dialogEditarHorarioIsVisible.value = false;
	emit('atualizarDialogEditarHorarioBool', false);
}

watch(props, () => {
	dialogEditarHorarioIsVisible.value = props.isVisible;
	horarioEditado.value = props.horario;
});

onMounted(() => {

})

</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important
}
</style>
