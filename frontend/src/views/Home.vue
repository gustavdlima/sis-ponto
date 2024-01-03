<template>
	<div class="container">
		<div class="row-md-4 row-sm-12 d-flex justify-content-center">
			<img src="../assets/logo-funad-sem-nome.png" class="img-fluid col" style="max-width: 15vh;" alt="logo">
		</div>
		<div class="row-md-4 row-sm-12 d-flex justify-content-center">
			<h1 style="color:aliceblue">e</h1>
			<h1 style="color:aliceblue">Ponto</h1>
		</div>
		<div class="row-sm-12">
			<RealTimeClock class="d-flex justify-content-center" ></RealTimeClock>
		</div>
		<div class="row-sm-12 d-flex justify-content-center">
			<Login></Login>
		</div>
		<!-- <div class="row d-flex justify-content-center">
			<router-link to="/cadastro" tag="button" class="col-4 col-sm-2 col-md-2 btn border-white m-2 d-flex justify-content-center text-white" >Cadastro</router-link>
		</div> -->
		<div class="row d-flex justify-content-center fixed-bottom">
			<img src="../assets/LogoGoverno.png" class="col img-fluid" style="max-width: 30vh;" alt="logo">
		</div>
	</div>
</template>

<script>
import RealTimeClock from "../components/RealTimeClock.vue"
import Login from "../components/Login.vue"

export default {
	name: "Home",
	data() {
		return {
			funcionarios: ''
		}
	},
	methods: {
		// async getFuncionarios(resource) {
		// 	const response = await this.$http.get('http://localhost:8000/api/funcionario');
		// 	this.funcionarios = response.data;
		// 	console.log(this.funcionarios);
		// }
	},
	components: {
		RealTimeClock: RealTimeClock,
		Login: Login
	},
	created() {
		// this.getFuncionarios();
	}
}

</script>

<style scoped>
h1 {
	color: aliceblue !important;
	font-weight: bold;
}

</style>
