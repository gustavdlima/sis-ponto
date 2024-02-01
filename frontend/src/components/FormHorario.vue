<template>
	<div class="container w-75 p-5">
		<div class="row">
			<form @submit.prevent="sendForm" class="row g-3">
				<div class="row">
					<div class="col-md-6">
						<label for="horario_entrada" class="form-label text- font-weight-bold">Horário Entrada</label>
						<input type="text" v-model="formData.horario_entrada" name="horario_entrada"
							class="text-black border-white form-control mb-2" />
					</div>
					<div class="col-md-6">
						<label for="horario_ida_intervalo" class="form-label text- font-weight-bold">Horário Ida
							Intervalo</label>
						<input type="text" v-model="formData.horario_ida_intervalo" name="horario_ida_intervalo"
							class="text-black border-white form-control mb-2" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="horario_volta_intervalo" class="form-label text- font-weight-bold">Horário Volta
							Intervalo</label>
						<input type="text" v-model="formData.horario_volta_intervalo" name="horario_volta_intervalo"
							class="text-black border-white form-control mb-2" />
					</div>

					<div class="col-md-6">
						<label for="horaroio_saida" class="form-label text- font-weight-bold">Horário Saida</label>
						<input type="text" v-model="formData.horario_saida" name="horario_saida"
							class="text-black border-white form-control mb-2" />
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
	horario_entrada: "",
	horario_ida_intervalo: "",
	horario_volta_intervalo: "",
	horario_saida: "",
}

const sendForm = () => {
	if (formData.horario_entrada != "" || formData.horario_ida_intervalo != "" || formData.horario_volta_intervalo != "" || formData.horario_saida != "") {
		const res = authStore.cadastroHorario(formData);
		console.log(res);
	}
}

</script>
