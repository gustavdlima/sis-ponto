<template>
	<div class="row h-100 w-100 d-flex" style="height: 100vh;">
		<div class="col-md-2 h-100">
			<SideBar></SideBar>
		</div>
		<div class="col-md-8 w-75 h-100 ml-15 d-flex">
			<v-data-table :items="funcionarios" :items-per-page="5" :headers="headers">
				<template v-slot:item.action="{ item }">
					<v-btn @click="abrirRegistro(item)" color="teal">Registro</v-btn>
				</template>
			</v-data-table>

			<v-dialog v-model="dialogRegistro" max-width="500px">
				<v-card>
					<v-card-title>
						Registro de {{ funcionarioSelecionado.nome }}
					</v-card-title>
					<v-card-text>
						<p> {{ registroFuncionarioSelecionado }} </p>
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="blue darken-1" text @click="dialogRegistro = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>
		</div>
	</div>
</template>

<script setup>
import SideBar from '../components/SideBar.vue';
import { useAuthStore } from '../stores/authStore';
import { ref } from 'vue';
import axios from 'axios';

const authStore = useAuthStore();
const funcionarios = ref([]);

const dialogRegistro = ref(false);
const funcionarioSelecionado = ref(null);
const registroFuncionarioSelecionado = ref(null);

const headers = ref([
	{ title: 'Nome', align: 'start', key: 'nome' },
	{ title: 'Matrícula', key: 'matricula', align: 'start' },
	{ title: 'Setor', key: 'setor', align: 'start' },
	{ value: '', sortable: false },
	{ value: 'action', sortable: false },
]);

function abrirRegistro(funcionario) {
	funcionarioSelecionado.value = funcionario;
	dialogRegistro.value = true;
}

function getFuncionarios() {
	const bearerToken = 'Bearer ' + authStore.userToken;
	axios.defaults.headers.common = {
		'Authorization': bearerToken
	}
	const response = axios.get('http://localhost:8000/api/funcionarios').then(response => {
		funcionarios.value = response.data;
		return funcionarios.value;
	})
		.catch(error => {
			console.log(error);
		});
}

function getRegistros() {
	axios.post('http://localhost:8000/api/registroFuncionario', funcionarioSelecionado.id).then(response => {
		registroFuncionarioSelecionado.value = response.data;
		console.log(registroFuncionarioSelecionado);
	})
		.catch(error => {
			console.log(error);
		});
}

getFuncionarios();
getRegistros();

</script>
