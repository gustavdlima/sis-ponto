<template>
	<div class="p-0 h-100 w-100">
		<div class="flex-shrink-0 p-3 bg-white h-100 w-100">
			<a class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
				<span @click="redirectToAdmin" role="button" class="text-opacity-100 fs-2 fw-semibold gradientText"
				>ePonto</span>
			</a>
			<ul class="list-unstyled ps-0">
				<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed fs-4 gradientText" data-bs-toggle="collapse"
						data-bs-target="#home-collapse" aria-expanded="true">
						Cadastrar
					</button>
					<div class="collapse show t" id="home-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small list-group pl-6">
							<li @click="redirectToCadastroOperador"><a role="button"
									class="link-dark  rounded fs-6 list-group-item-action"
									v-if="authStore.user.level == 1">Operador</a></li>
							<li><a role="button" class="link-dark  rounded fs-6 list-group-item-action"
									@click="redirectToCadastroFuncionario"> Funcionário</a></li>

							<li><a role="button" class="link-dark  rounded fs-6 list-group-item-action"
									@click="redirectToCadastroHorario">
									Horário</a></li>

							<li><a role="button" class="link-dark  rounded fs-6 list-group-item-action"
									@click="redirectToCadastroCargo">Cargo</a>
							</li>
							<li><a role="button" class="link-dark  rounded fs-6 list-group-item-action"
									@click="redirectToCadastroJustificativa">Justificativa</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed fs-4 gradientText" data-bs-toggle="collapse"
						data-bs-target="#dashboard-collapse" aria-expanded="false">
						Listar
					</button>
					<div class="collapse" id="dashboard-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small pl-6 ">
							<li><a role="button" class="link-dark  rounded fs-6 list-group-item-action"
									@click="redirectToListarFuncionarios">
									Funcionários</a></li>
						</ul>
					</div>
				</li>
				<li class="border-top my-3"></li>
				<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed text-weight-bold text-primary gradientText"
						@click="logout()">
						Sair
					</button>
				</li>
			</ul>
		</div>
		<!-- <ul class="list-group mt-1">
				<li class="list-group-item m-1" role="button" @click="redirectToCadastroOperador" v-if="authStore.user.level == 1">Cadastrar Operador</li>

				<li class="list-group-item m-1" role="button" @click="redirectToCadastroFuncionario">Cadastrar Funcionário
				</li>

				<li class="list-group-item m-1" role="button" @click="redirectToCadastroHorario">Cadastrar Horário</li>

				<li class="list-group-item m-1" role="button" @click="redirectToCadastroCargo">Cadastrar Cargo</li>

				<li class="list-group-item m-1" role="button" @click="redirectToListarFuncionarios">Listar Funcionários</li>

				<li class="list-group-item m-1" role="button" @click="logout()">Logout</li>
			</ul> -->
	</div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore';
import { useRouter } from 'vue-router';

const router = useRouter();
const authStore = useAuthStore();

const logout = () => {
	authStore.logout();
};

const redirectToAdmin = () => {
	router.push({ path: '/admin' });
};

const redirectToCadastroFuncionario = () => {
	router.push({ path: '/cadastroFuncionario' });
};

const redirectToCadastroOperador = () => {
	router.push({ path: '/cadastroOperador' });
};

const redirectToCadastroHorario = () => {
	router.push({ path: '/cadastroHorario' });
};

const redirectToCadastroCargo = () => {
	router.push({ path: '/cadastroCargo' });
};

const redirectToListarFuncionarios = () => {
	router.push({ path: '/listarfuncionarios' });
};

const redirectToCadastroJustificativa = () => {
	router.push({ path: '/cadastroJustificativa' });
};

</script>

<style>
.gradientText {
	background-image: linear-gradient(173deg, rgba(247,190,13,1) 0%, rgba(7,90,167,1) 93%);;
	background-size: 100%;
	background-clip: text;
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
	-moz-background-clip: text;
	-moz-text-fill-color: transparent;
}

a {
	text-decoration: none;
}
</style>
