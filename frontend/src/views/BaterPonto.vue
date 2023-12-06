<template>
	<div>
		<h1>Bater Ponto</h1>
		<a> {{ this.funcionario }}</a>
		<WebCam />
	</div>
</template>

<script>
import { useFuncionarioStore } from '../stores/funcionarioStore';
import { ref } from 'vue';
import WebCam from '../components/WebCam.vue';

export default {
	name: 'BaterPonto',
	components: {
		WebCam
	},
	data() {
		return {
			funcionario: ""
		}
	},
	methods: {

	},
	setup() {
		const store = useFuncionarioStore();
		const funcionario = ref(store.getFuncionarios);
		return {
			funcionario
		}
	}
}
</script>
