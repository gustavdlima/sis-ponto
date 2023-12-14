<template>
	<div class="mb-3 row w-25 p-3 bg-gradient m-1 d-flex align-items-center justify-content-center">
		<div class="row w-75  d-flex align-items-center justify-content-center">
			<img src="../assets/logo-funad-removebg-preview.png" class="img-fluid" alt="logo">
		</div>
		<div class = "row d-flex align-items-center justify-content-center w-100 m-1" >
			<RealTimeClock></RealTimeClock>
		</div>
		<div class="row w-100 p-3">
			<router-link to="/login" tag="button" class="col btn btn-warning ">Login</router-link>
			<router-link to="/cadastro" tag="button" class="btn btn-primary" m>Cadastro</router-link>
		</div>
		<!-- <div v-for="funcionario in this.funcionarios">
			{{ funcionario }}
		</div> -->
	</div>
</template>

<script>
import RealTimeClock from "../components/RealTimeClock.vue"

export default {
	name: "Home",
	data() {
		return {
			funcionarios: ''
		}
	},
	methods: {
		async getFuncionarios(resource) {
			const response = await this.$http.get('http://localhost:8000/api/funcionario');
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
