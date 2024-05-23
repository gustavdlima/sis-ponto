<template>
	<div class="grid justify-center grid-rows-2 w-64 h-20 md:w-72 md:h-24 lg:w-80 lg:h-28 ">
		<div class="grid content-center row-span-1">
			<InputText class="w-60 h-8 md:w-68 md:h-10 lg:w-72 lg:h-12 text-sm md:text-lg lg:text-xl grid"
				v-model="email" placeholder="Email" type="text" />
		</div>
		<div class="grid content-center row-span-1 mt-1">
			<Password class="w-60 h-8 md:w-68 md:h-10 lg:w-72 lg:h-12 text-sm md:text-lg lg:text-xl" v-model="password"
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
