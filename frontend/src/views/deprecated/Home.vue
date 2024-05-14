<template>
	<div class="position-absolute top-0 end-0">
		<button type="submit"
			class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white font-weight-bold"
			v-on:click="loginComoAdministrador()">Login</button>
	</div>
	<div class="container h-100 d-flex justify-content-center align-items-center">
		<div class="col">
			<div class="row">
				<div class="row">
					<div class="col d-flex justify-content-center">
						<img src="../assets/logo-funad-sem-nome.png" class="img-fluid col" style="max-width: 15vh;"
							alt="logo">
					</div>
				</div>
				<div class="row">
					<div class="col d-flex justify-content-center h-50">
						<h1>ePonto</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<HoraEData class="d-flex justify-content-center"></HoraEData>
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

<script setup>
import HoraEData from "../components/HoraEData.vue"
import RegistroPonto from "../components/RegistroPonto.vue"
import { useRouter } from 'vue-router';
import router from '../router';

function loginComoAdministrador() {
	router.push({ name: 'Login' });
}

</script>

<style scoped>
h1 {
	color: aliceblue !important;
	font-weight: bold;
}
</style>
