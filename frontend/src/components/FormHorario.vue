<template>
	<div class="container d-flex justify-content-center">
		<form @submit.prevent="sendForm">
			<div class="row mb-2">
				<div class="d-flex justify-content-start p-0 ">
					<h1>Cadastro de Horários</h1>
				</div>
			</div>

			<div class="">
				<label for="horario_entrada" class="">Horário Entrada: </label>
				<input type="text" v-model="formData.horario_entrada" name="horario_entrada" class="" />
			</div>

			<div class="">
				<label for="horario_ida_intervalo" class="">Horário Ida Intervalo: </label>
				<input type="text" v-model="formData.horario_ida_intervalo" name="horario_ida_intervalo" class="" />
			</div>

			<div class="" >
				<label for="horario_volta_intervalo" class="">Horário Volta Intervalo: </label>
				<input type="text" v-model="formData.horario_volta_intervalo" name="horario_volta_intervalo" class="" />
			</div>

			<div class="" >
				<label for="horaroio_saida" class="">Horário Saida: </label>
				<input type="text" v-model="formData.horario_saida" name="horario_saida" class="" />
			</div>

			<div class="row">
				<button type="submit" @onClick="sendForm" class="btn btn-primary w-100">Cadastrar</button>
			</div>

		</form>
	</div>
</template>

<script setup>

const formData = {
	horario_entrada: "",
	horario_ida_intervalo: "",
	horario_volta_intervalo: "",
	horario_saida: "",
}

const sendForm = () => {
	// enviar form para o backend
	console.log(formData);
}

</script>
