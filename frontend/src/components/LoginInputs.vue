<template>
	<div class="grid justify-center grid-rows-2 w-64 h-20 md:w-72 md:h-24 lg:w-80 lg:h-28">
		<div class="grid justify-center content-center row-span-1">
			<InputText class=""
				v-model="email" placeholder="Email" type="text" />
		</div>
		<div class="grid justify-center content-center row-span-1">
			<Password class="mt-3 md:mb-3 lg:mb-6" v-model="password"
				:feedback="false" placeholder="password" />
		</div>
	</div>
</template>

<script setup>
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import { ref } from 'vue';
import { onUpdated } from 'vue';

const email = ref('');
const password = ref('');
const emit = defineEmits(['atualizarCredenciais']);

const emitirCredenciais = async () => {
	emit('atualizarCredenciais', { email: email.value, password: password.value });
}

onUpdated(async () => {
	await emitirCredenciais();
});

</script>

<style setup>
*:focus {
	box-shadow: none !important;
}

input:hover {
	border: 2px solid #f7be0d !important;
	border-color: #1F2937 !important;
}

input:focus {
	border: 2px solid #f7be0d !important;
	border-color: #1F2937 !important;;
}


</style>
