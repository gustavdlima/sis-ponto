<template>
	<div class="container">
		<ul class="list-group mt-1">
			<li class="list-group-item m-1" role="button" @click="redirectToCadastro">Cadastrar Funcionário</li>
			<li class="list-group-item m-1" role="button" @click="redirectToListarFuncionariosOnClick" >Listar Funcionários</li>
		</ul>
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
