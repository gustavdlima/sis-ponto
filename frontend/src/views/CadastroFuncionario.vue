<template>
	<div class="container bg-warning d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div class="row bg-dark h-75 w-100">
			<div class="col-md-3 bg-danger">
				<div class="row">
					<SideBar></SideBar>
				</div>
			</div>
			<div class="col bg-info">
				<FormCadastro :cargos="cargos" :horarios="horarios"></FormCadastro>
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
		horarios: Array
	},
	data() {
		return {
			cargos: [],
			horarios: []
		}
	},
	methods: {
		getCargos() {
			this.$http.get("http://localhost:8000/api/cargos")
				.then(response => {
					this.cargos = response.data;
				})
				.catch(error => {
					console.log(error);
				});
		},

		getHorarios() {
			this.$http.get("http://localhost:8000/api/horarios")
				.then(response => {
					this.horarios = response.data;
				})
				.catch(error => {
					console.log(error);
				});
		}
	},
	mounted() {
		this.getCargos();
		this.getHorarios();
	}
}
</script>
