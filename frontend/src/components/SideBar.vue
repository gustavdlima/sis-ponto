<template>
	<div class="bg-secondary d-flex flex-column p-0">
		<div class="mt-2 d-flex justify-content-start">
			<h1>ePonto</h1>
		</div>
		<div class="">
			<ul class="list-group mt-1">
				<li class="list-group-item m-1" role="button" @click="redirectToCadastro">Cadastrar Funcionário</li>
				<li class="list-group-item m-1" role="button" @click="redirectToListarFuncionariosOnClick">Listar
					Funcionários</li>
			</ul>
		</div>
	</div>
</template>

<script>

export default {
	name: "SideBar",
	methods: {
		redirectToListarFuncionariosOnClick() {
			this.$router.push({ path: '/listarfuncionarios' });
		},

		redirectToCadastro() {
			this.$router.push({ path: '/cadastro' });
		}
	}
}

</script>

<style scoped>
h1 {
	color: aliceblue !important;
	font-weight: bold;
}
</style>
