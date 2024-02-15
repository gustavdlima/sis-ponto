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

			<v-dialog v-model="dialogRegistro" max-width="920px">
				<v-card flat title="Registro">
					<div class="d-flex justify-content-center gap-3">
						<v-btn @click="converterRegistroJsonParaExcel(item)"
							class="btn btn-light btn-sm border-black">excel</v-btn>
						<v-btn @click="imprimirRegistro()" class="btn btn-light btn-sm border-black">imprimir</v-btn>
					</div>
					<template v-slot:text>
						<v-text-field v-model="search" label="Pesquisa" prepend-inner-icon="mdi-magnify" single-line
							variant="outlined" hide-details></v-text-field>
					</template>
					<v-card-text>
						<v-data-table id="imprimirTabela" :items="registroFuncionarioSelecionado" :items-perpage="5"
							:headers="registroHeaders" :search="search">
						</v-data-table>
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
import { utils, writeFileXLSX } from 'xlsx';

const authStore = useAuthStore();
var funcionarios = ref([]);

var search = ref('');
var dialogRegistro = ref(false);
var funcionarioSelecionado = ref(null);
var registroFuncionarioSelecionado = ref([]);

const headers = ref([
	{ title: 'Nome', align: 'start', key: 'nome' },
	{ title: 'Matrícula', key: 'matricula', align: 'start' },
	{ title: 'Setor', key: 'setor', align: 'start' },
	{ value: '', sortable: false },
	{ value: 'action', sortable: false },
]);

const registroHeaders = ref([
	{ title: 'Data', key: 'data' },
	{ title: 'Primeiro Horario', key: 'primeiro_ponto' },
	{ title: 'Segundo Horario', key: 'segundo_ponto' },
	{ title: 'Terceiro Horario', key: 'terceiro_ponto' },
	{ title: 'Quarto Horario', key: 'quarto_ponto' },
	{ value: 'action', sortable: false },
])

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

function abrirRegistro(funcionario) {
	dialogRegistro.value = true;
	funcionarioSelecionado.value = funcionario;
	try {
		const bearerToken = 'Bearer ' + authStore.userToken;
		axios.defaults.headers.common = {
			'Authorization': bearerToken
		}
		axios.post('http://localhost:8000/api/registroFuncionario', { id_funcionario: funcionario.id }).then(response => {
			registroFuncionarioSelecionado.value = tratarOsDadosDoRegistro(response.data);
		})
			.catch(error => {
				console.log(error);
			});
	} catch (error) {
		console.log(error);
	}
}

function tratarOsDadosDoRegistro(registroObject) {
	for (var i = 0; i < registroObject.length; i++) {
		if (registroObject[i].data == null)
			registroObject[i].data = registroObject[i].created_at.split('T')[0];
		if (registroObject[i].primeiro_ponto != null)
			registroObject[i].primeiro_ponto = registroObject[i].primeiro_ponto.split(' ')[1];
		if (registroObject[i].segundo_ponto != null)
			registroObject[i].segundo_ponto = registroObject[i].segundo_ponto.split(' ')[1];
		if (registroObject[i].terceiro_ponto != null)
			registroObject[i].terceiro_ponto = registroObject[i].terceiro_ponto.split(' ')[1];
		if (registroObject[i].quarto_ponto != null)
			registroObject[i].quarto_ponto = registroObject[i].quarto_ponto.split(' ')[1];
	}
	return registroObject
}

function converterRegistroJsonParaExcel() {
	var registro = registroFuncionarioSelecionado.value;
	for (var i = 0; i < registro.length; i++) {
		delete registro[i].created_at;
		delete registro[i].updated_at;
		delete registro[i].id_horario;
	}
	const ws = utils.json_to_sheet(registro);
	const wb = utils.book_new();
	utils.book_append_sheet(wb, ws, 'Registros');
	writeFileXLSX(wb, 'registros-' + funcionarioSelecionado.value.nome + '.xlsx');
}

function imprimirRegistro() {
	const print = document.getElementById('imprimirTabela');
	const printContent = print.innerHTML;
	var win = window.open();
	win.document.write(printContent);
	win.print();
	win.close();
}

getFuncionarios();
</script>

<style>
@media print {
	#imprimirTabela {}

}
</style>
