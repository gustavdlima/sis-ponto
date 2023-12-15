<template>
	<div class="container">
		<div class="row-md-4 row-sm-12 d-flex justify-content-center">
			<img src="../assets/logo-funad-removebg-preview.png" class="img-fluid" style="max-width: 25vh;" alt="logo">
		</div>
		<div class="row-md-4 row-sm-12 d-flex justify-content-center">
			<h1 style="color:aliceblue">e</h1>
			<h1 style="color:aliceblue">Ponto</h1>
		</div>
		<div class="row-sm-12">
			<RealTimeClock class="d-flex justify-content-center" ></RealTimeClock>
		</div>

		<div class="row d-flex justify-content-center">
			<router-link to="/login" tag="button" class="col-5 col-sm-2 col-md-2 btn btn-primary m-2 d-flex justify-content-center text-white" >Login</router-link>
			<router-link to="/cadastro" tag="button" class="col-5 col-sm-2 col-md-2 btn btn-warning m-2 d-flex justify-content-center" >Cadastro</router-link>
		</div>
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

<style scoped>
h1 {
	color: aliceblue;
	font-weight: bold;
}

h {
	color: aliceblue;
	font-weight: bold;
}

</style>
