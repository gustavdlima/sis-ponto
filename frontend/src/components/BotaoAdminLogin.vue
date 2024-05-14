<template>
	<div class="fixed top-1 right-1">
		<Button class="border-2 bg-transparent h-8 w-16 md:w-20 lg:w-24 lg:h-10 text-xs md:text-sm lg:text-lg" label="Admin" severity="info" raised @click="loginComoAdministrador()" />
	</div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import Button from 'primevue/button';


const router = useRouter();

function loginComoAdministrador() {
	router.push({ name: 'Login' });
}

</script>

<style scoped>
button {
	background-color: transparent !important;
	border: 2px solid rgb(228, 228, 228) !important;
	border-radius: 5px !important;
	color: aliceblue !important;
}
</style>
