<template>
	<div class="container h-100 d-flex justify-content-center align-items-center">
		<div class="col">
			<div class="row">
				<div class="row">
					<div class="col d-flex justify-content-center">
						<img src="../assets/logo-funad-sem-nome.png" class="img-fluid col" style="max-width: 15vh;" alt="logo">
					</div>
				</div>
				<div class="row">
					<div class="col d-flex justify-content-center h-50">
						<h1>ePonto</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<RealTimeClock class="d-flex justify-content-center" ></RealTimeClock>
			</div>
			<div class="row">
				<RegistroPonto></RegistroPonto>
			</div>
			<div class="row d-flex justify-content-center fixed-bottom">
				<img src="../assets/LogoGoverno.png" class="col img-fluid" style="max-width: 30vh;" alt="logo">
			</div>
		</div>
	</div>
</template>

<script>
import RealTimeClock from "../components/RealTimeClock.vue"
import RegistroPonto from "../components/RegistroPonto.vue"

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
		RegistroPonto: RegistroPonto
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
