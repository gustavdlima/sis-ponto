<template>
	<h1>Bater Ponto</h1>
	<button @click="handleClick">Entrar</button><br>
	<button @click="handleClick">Ida almoço</button><br>
	<button @click="handleClick">Volta almoço</button><br>
	<button @click="handleClick">Sair</button><br>
</template>

<script>

export default {
	name: "BaterPonto",
	methods: {
		handleClick() {
			const currentTime = new Date();
			console.log("O horário que você bateu ponto foi:", currentTime.toLocaleTimeString(),"\nNa data de", currentTime.toLocaleDateString())
		}
	},
}
</script>
