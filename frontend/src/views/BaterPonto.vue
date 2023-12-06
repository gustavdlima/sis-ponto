<template>
	<div>
		<h1>Bater Ponto</h1>
		<a> {{ this.funcionario }}</a>
	</div>
</template>

<script>
import { useFuncionarioStore } from '../stores/funcionarioStore';
import { ref } from 'vue';

export default {
	name: 'BaterPonto',
	data() {
		return {
			funcionario: ""
		}
	},
	methods: {
		// mountFuncionario() {
		// 	const store = useFuncionarioStore();
		// 	this.funcionario = store.getFuncionarios;
		// }
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
