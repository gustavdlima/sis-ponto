<template>
	<div class="container bg-warning d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div class="row bg-dark h-75 w-100">
			<div class="col-md-3 bg-danger">
				<div class="row">
					<SideBar></SideBar>
				</div>
			</div>
			<div class="col bg-info">
				<FormCadastro :cargos="cargos"></FormCadastro>
			</div>
		</div>
	</div>
</template>

<script>
import SideBar from '../components/SideBar.vue';
import FormCadastro from '../components/FormCadastro.vue';

export default {
	components: {
		SideBar,
		FormCadastro
	},
	props: {
		cargos: Array,
	},
	data() {
		return {
			cargos: []
		}
	},
	methods: {
		getCargos() {
			this.$http.get("http://localhost:8000/api/cargos")
				.then(response => {
					this.cargos = response.data;
					console.log(this.cargos);
				})
				.catch(error => {
					console.log(error);
				});
		}
	},
	mounted() {
		this.getCargos();
	}
}
</script>
