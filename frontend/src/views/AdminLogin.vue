<template>
	<div class="container h-100 d-flex justify-content-center align-items-center">
		<div class="col">
			<div class="row ">
				<div class="row">
					<div class="col d-flex justify-content-center">
						<img src="../assets/logo-funad-sem-nome.png" class="img-fluid" style="max-width: 15vh;" alt="logo">
					</div>
				</div>
				<div class="row">
					<div class="col d-flex justify-content-center h-50">
						<h1>ePonto</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<Login></Login>
			</div>
			<div class="row d-flex justify-content-center fixed-bottom">
				<img src="../assets/LogoGoverno.png" class="col img-fluid" style="max-width: 30vh;" alt="logo">
			</div>
		</div>
	</div>
</template>

<script>
import RealTimeClock from "../components/RealTimeClock.vue"
import Login from "../components/Login.vue"

export default {
	name: "AdminLogin",
	components: {
		RealTimeClock: RealTimeClock,
		Login: Login
	},
	setup() {

	}
}

</script>

<style scoped>
h1 {
	color: aliceblue !important;
	font-weight: bold;
}
</style>
