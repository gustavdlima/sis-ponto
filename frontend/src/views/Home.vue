<template>
	<h1>Home</h1>
	<router-link to="/login">Login</router-link><br>
	<router-link to="/cadastro">Cadastro</router-link><br>
	<RealTimeClock></RealTimeClock>
	<div v-for="funcionario in this.funcionarios">
		{{funcionario}}
	</div>
</template>

<script>
import RealTimeClock from "../components/RealTimeClock.vue"

export default {
	name: "Home",
	data () {
		return {
		funcionarios: ''
		}
	},
	methods: {
		async getFuncionarios(resource) {
			const response = await this.$http.get('http://localhost:8000/funcionario');
			this.funcionarios = response.data;
			console.log(this.funcionarios);
		}
	},
	components: {
		RealTimeClock: RealTimeClock
	},
	created() {
		this.getFuncionarios();
	}
}


</script>
