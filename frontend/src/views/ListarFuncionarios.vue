<template>
	<div class="row h-100 w-100 d-flex" style="height: 100vh;">
		<div class="col-md-2 h-100">
			<SideBar></SideBar>
		</div>
		<div class="col-md-8 w-75 h-100 ml-15 d-flex justify-content-center align-items-center">
			<div class="w-75">

				<v-card flat title="Funcionários">
					<div class="d-flex justify-content-center gap-3">
						<v-btn color="teal" @click="converterFuncionariosJsonParaExcel(item)"
							class="btn btn-light btn-sm">excel</v-btn>
					</div>
					<template v-slot:text>
						<v-text-field v-model="search" label="Pesquisa" single-line variant="outlined"
							hide-details></v-text-field>
					</template>
					<v-data-table class="elevation-1 p-3" :items="funcionarios" :items-per-page="5" :headers="headers"
						:search="search">
						<template v-slot:item.action="{ item }" width="100px">
							<v-btn @click="abrirRegistro(item)" type="button" color="teal" size="small"
								class="m-2">Registro</v-btn>
							<v-btn @click="justificarFalta(item)" type="button" color="teal" size="small"
								outlined="outlined" class="m-2">Registrar Falta</v-btn>
						</template>
					</v-data-table>
				</v-card>
			</div>

			<v-dialog v-model="dialogRegistro" max-width="1080px">
				<v-card flat title="Registro">
					<div class="d-flex justify-content-center gap-3">
						<v-btn color="teal" @click="converterRegistroJsonParaExcel(item)"
							class="btn btn-light btn-sm">excel</v-btn>
						<v-btn color="teal" @click="imprimirRegistro()" class="btn btn-light btn-sm">imprimir</v-btn>
						<v-btn color="teal" class="btn btn-light btn-sm" text
							@click="imprimirRelatorioMensal()">Relatório
							Mensal</v-btn>
					</div>
					<template v-slot:text>
						<v-text-field v-model="search" label="Pesquisa" single-line variant="outlined"
							hide-details></v-text-field>
					</template>
					<v-card-text>
						<div id="registroTabela">
							<div class="row no-gutters mb-2">
								<div class="col">
									<div class="border">
										<span>
											Nome: <b>{{ funcionarioSelecionado.nome }}</b>
										</span>
									</div>
									<div class="border">
										<span>
											CPF: {{ funcionarioSelecionado.cpf }}
										</span>
									</div>
									<div class="border">
										<span>
											<span>
												Matrícula: {{ funcionarioSelecionado.matricula }}
											</span>
										</span>
									</div>
								</div>
								<div class="col">
									<div class="border">
										Setor: {{ funcionarioSelecionado.setor }}
									</div>
									<div class="border">
										<span>
											Carga Horaria: {{ funcionarioSelecionado.carga_horaria }}
										</span>
									</div>
									<div class="border">
										<span>
											Horário: {{ horarioFuncionario }}
										</span>
									</div>
								</div>
							</div>
							<v-data-table id="registroTabela" class="elevation-1"
								:items="registroFuncionarioSelecionado" :items-per-page="30" :headers="registroHeaders"
								:search="search" density="compact">
								<template #bottom></template>
							</v-data-table>
						</div>
						<div id="imprimirRelatorio">
							<div class="row no-gutters mb-2 relatorioHeader">
								<div class="col">
									<div class="border">
										<span>
											Nome: <b>{{ funcionarioSelecionado.nome }}</b>
										</span>
									</div>
									<div class="border">
										<span>
											CPF: {{ funcionarioSelecionado.cpf }}
										</span>
									</div>
									<div class="border">
										<span>
											<span>
												Matrícula: {{ funcionarioSelecionado.matricula }}
											</span>
										</span>
									</div>
								</div>
								<div class="col">
									<div class="border">
										Setor: {{ funcionarioSelecionado.setor }}
									</div>
									<div class="border">
										<span>
											Carga Horaria: {{ funcionarioSelecionado.carga_horaria }}
										</span>
									</div>
									<div class="border">
										<span>
											Horário: {{ horarioFuncionario }}
										</span>
									</div>
								</div>
							</div>
							<v-data-table id="imprimirRelatorioTabela" class="elevation-1 relatorioBody"
								:items="relatorioRef" :items-per-page="30" :headers="relatorioHeaders" :search="search"
								density="compact">
								<template #bottom></template>
							</v-data-table>
						</div>
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="blue darken-1" text @click="dialogRegistro = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="dialogFalta" max-width="520px">
				<v-card flat class="flex justify-content-center align-items-center">
					<div class="col-md-6 mt-8 flex justify-content-center align-items-center" style="width: 500px;">
						<div class="flex justify-content-center align-items-center">
							<label class="form-label text-black font-weight-bold mb-2 ml-14">Data:</label>
							<div class="d-flex justify-content-center">
								<input type="date" class="form-control mb-2" v-model="faltaInput.data"
									style="width: 150px;" />
								<label class="ml-3 mr-3 mt-2">
									a
								</label>
								<input type="date" class="form-control mb-2" v-model="faltaInput.data2"
									style="width: 144px;" />
							</div>
						</div>
						<div class="">
							<label class="form-label text-black font-weight-bold ml-14 mt-2">Justificativa:</label>
							<div class="d-flex justify-content-center">
								<select name="id_horario" v-model="faltaInput.id_justificativa"
									class="form-select border-white form-control border border-info w-50">
									<option disabled selected value="">Selecione</option>
									<option v-for="justificativa in justificativas" v-bind:value="justificativa.id">
										{{ justificativa.justificativa }} </option>
								</select>
								<br>
							</div>
						</div>
					</div>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="teal" class="btn btn-light btn-sm mt-3" text
							@click="registrarFalta()">Cadastrar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="faltaRegistrada" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Sucesso!</v-card-title>
					<v-card-text class="text-center">
						{{ erroMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="faltaRegistrada = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="erroSistema" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
					<v-card-text class="text-center">
						{{ erroMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="erroSistema = false">Fechar</v-btn>
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
const justificativas = ref([]);
var faltaInput = ref({
	id_justificativa: "",
	id_funcionario: "",
	data: "",
	data2: "",
});

var relatorioRef = ref([]);

var faltaRegistrada = ref(false);
var erroSistema = ref(false);
var erroMessage = ref("");

var search = ref('');
var dialogRegistro = ref(false);
var dialogFalta = ref(false);
var funcionarioSelecionado = ref(null);
var registroFuncionarioSelecionado = ref([]);
var horarioFuncionario = ref([]);
var hidden = ref(true);

const headers = ref([
	{ title: 'Nome', align: 'start', key: 'nome', align: 'center' },
	{ title: 'Matrícula', key: 'matricula', align: 'start', align: 'center' },
	{ title: 'Setor', key: 'setor', align: 'start', align: 'center' },
	{ value: 'action', sortable: false, align: 'center' },
]);

const relatorioHeaders = ref([
	{ align: 'center', width: '0%', title: 'Data', key: 'dia' },
	{ align: 'center', width: '1%', title: 'Primeiro Horario', key: 'primeiro_ponto' },
	{ align: 'center', width: '1%', title: 'Segundo Horario', key: 'segundo_ponto' },
	{ align: 'center', width: '1%', title: 'Terceiro Horario', key: 'terceiro_ponto' },
	{ align: 'center', width: '1%', title: 'Quarto Horario', key: 'quarto_ponto' },
	{ align: 'center', width: '1%', title: 'Justificativa', key: 'justificativa' },
])

const registroHeaders = ref([
	{ align: 'center', width: '1%', title: 'Data', key: 'data', width: '1%' },
	{ align: 'center', width: '1%', title: 'Primeiro Horario', key: 'primeiro_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Atrasou', key: 'atrasou_primeiro_ponto', },
	{ align: 'center', width: '1%', title: 'Segundo Horario', key: 'segundo_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Atrasou', key: 'atrasou_segundo_ponto', },
	{ align: 'center', width: '1%', title: 'Terceiro Horario', key: 'terceiro_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Atrasou', key: 'atrasou_terceiro_ponto', },
	{ align: 'center', width: '1%', title: 'Quarto Horario', key: 'quarto_ponto', width: '1%' },
	{ align: 'center', width: '1%', title: 'Atrasou', key: 'atrasou_quarto_ponto' },
	// { align: 'center', width: '1%', title: 'Total Horas', key: 'horas_trabalhadas', },
])

// const relatorioHeaders

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
	this.getFaltas(funcionarioSelecionado.value);

	try {
		const bearerToken = 'Bearer ' + authStore.userToken;
		axios.defaults.headers.common = {
			'Authorization': bearerToken
		}

		axios.get('http://localhost:8000/api/horarios/' + funcionarioSelecionado.value.id_horario).then(response => {
			if (response.data.terceiro_horario == null) {
				horarioFuncionario.value = response.data.primeiro_horario + ' - ' + response.data.segundo_horario;
			} else {
				horarioFuncionario.value = response.data.primeiro_horario + ' - ' + response.data.segundo_horario + ' - ' + response.data.terceiro_horario + ' - ' + response.data.quarto_horario;
			}

		}).catch(error => {
			console.log(error);
		});

		axios.post('http://localhost:8000/api/registroFuncionario', { id_funcionario: funcionario.id }).then(response => {
			for (var i = 0; i < response.data.length; i++) {
				if (response.data[i].atrasou_primeiro_ponto == true) {
					response.data[i].atrasou_primeiro_ponto = "x";
				} else {
					response.data[i].atrasou_primeiro_ponto = "";
				}
				if (response.data[i].atrasou_segundo_ponto == true) {
					response.data[i].atrasou_segundo_ponto = "x";
				} else {
					response.data[i].atrasou_segundo_ponto = "";
				}
				if (response.data[i].atrasou_terceiro_ponto == true) {
					response.data[i].atrasou_terceiro_ponto = "x";
				} else {
					response.data[i].atrasou_terceiro_ponto = "";
				}
				if (response.data[i].atrasou_quarto_ponto == true) {
					response.data[i].atrasou_quarto_ponto = "x";
				} else {
					response.data[i].atrasou_quarto_ponto = "";
				}
			}
			registroFuncionarioSelecionado.value = response.data;
		})
			.catch(error => {
				console.log(error);
			});
	} catch (error) {
		console.log(error);
	}
}

function converterFuncionariosJsonParaExcel() {
	var registro = funcionarios.value;
	for (var i = 0; i < registro.length; i++) {
		delete registro[i].created_at;
		delete registro[i].updated_at;
		delete registro[i].id_horario;
	}
	const ws = utils.json_to_sheet(registro);
	const wb = utils.book_new();
	utils.book_append_sheet(wb, ws, 'Funcionários');
	writeFileXLSX(wb, 'funcionários.xlsx');
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
	hidden.value = false;
	const print = document.getElementById('registroTabela');
	console.log(print);
	const printContent = print.innerHTML;
	var win = window.open();
	win.document.write(printContent);
	win.print();
	hidden.value = true;
}

function imprimirRelatorioMensal() {
	try {
		const bearerToken = 'Bearer ' + authStore.userToken;
		axios.defaults.headers.common = {
			'Authorization': bearerToken
		}

		axios.post('http://localhost:8000/api/relatorio', { matricula: funcionarioSelecionado.value.matricula }).then(response => {
			console.log(response.data)
			var relatorio = [];
			for (var i = 0; i < response.data.length; i++) {
				var dia = response.data[i].dia;
				var registroDoDia = response.data[i].registroDoDia;
				if (Array.isArray(registroDoDia)) {
					registroDoDia = registroDoDia[0];
				}
				var justificativa = response.data[i].justificativa;
				if (registroDoDia == null) {
					registroDoDia = {
						primeiro_ponto: "Sem Registro",
						segundo_ponto: "Sem Registro",
						terceiro_ponto: "Sem Registro",
						quarto_ponto: "Sem Registro"
					}
				}
				if (registroDoDia != null && justificativa != null) {
					relatorio[i] = {
						dia: dia,
						primeiro_ponto: registroDoDia.primeiro_ponto,
						segundo_ponto: registroDoDia.segundo_ponto,
						terceiro_ponto: registroDoDia.terceiro_ponto,
						quarto_ponto: registroDoDia.quarto_ponto,
						justificativa: justificativa
					}
				}
				if (registroDoDia != null && justificativa == null) {
					relatorio[i] = {
						dia: dia,
						primeiro_ponto: registroDoDia.primeiro_ponto,
						segundo_ponto: registroDoDia.segundo_ponto,
						terceiro_ponto: registroDoDia.terceiro_ponto,
						quarto_ponto: registroDoDia.quarto_ponto,
						justificativa: "-"
					}
				}
			}
			relatorioRef.value = relatorio;
			console.log(relatorioRef.value)
			setTimeout(() => {
				const print = document.getElementById('imprimirRelatorio').innerHTML;

				let stylesHtml = '';
				for (const node of [...document.querySelectorAll('link[rel="stylesheet"], style')]) {
					stylesHtml += node.outerHTML;
				}
				var win = window.open();
				win.document.write(`<!DOCTYPE html>
			<html>
				<head>
					${stylesHtml}
				</head>
				<body>
					${print}
				</body>
			</html>`);
				win.document.close();
				win.focus();
				win.print();
			}, 500);
			// gerar pagina de impressao do relatorio
		})
			.catch(error => {
				console.log(error);
			});
	} catch (error) {
		console.log(error);
	}

}

function justificarFalta(funcionario) {
	funcionarioSelecionado.value = funcionario;
	dialogFalta.value = true;
	getJustificativa();
}

function getJustificativa() {
	try {
		const bearerToken = 'Bearer ' + authStore.userToken;
		axios.defaults.headers.common = {
			'Authorization': bearerToken
		}
		axios.get('http://localhost:8000/api/justificativas').then(response => {
			justificativas.value = response.data;
		})
			.catch(error => {
				console.log(error);
			});
	} catch (error) {
		console.log(error);
	}
}

function registrarFalta() {
	try {
		if (faltaInput.value.id_justificativa != "" && faltaInput.value.data != "") {
			faltaInput.value.id_funcionario = funcionarioSelecionado.value.id;
			const bearerToken = 'Bearer ' + authStore.userToken;
			axios.defaults.headers.common = {
				'Authorization': bearerToken
			}
			axios
				.post('http://localhost:8000/api/faltas', faltaInput.value)
				.then((response) => {
					const responseData = JSON.stringify(response.data);
					if (responseData.indexOf("registrada") !== -1) {
						faltaRegistrada.value = true;
						erroMessage.value = responseData;
						getFuncionarios();
					} else {
						erroMessage.value = error;
						erroSistema.value = true;
						console.log(responseData);
					}
				})
		}
	} catch (error) {
		erroMessage.value = error;
		erroSistema.value = true;
		console.log(error);
	}
	dialogFalta.value = false
}

function getFaltas(funcionario) {
	try {
		const bearerToken = 'Bearer ' + authStore.userToken;
		axios.defaults.headers.common = {
			'Authorization': bearerToken
		}
		axios.get('http://localhost:8000/api/faltas/' + funcionarioSelecionado.value.id).then(response => {
			console.log(response.data);
		})
			.catch(error => {
				console.log(error);
			});
	} catch (error) {
		console.log(error);
	}
}

// getFaltas();
getFuncionarios();
</script>

<style>
th,
td {
	border: 1px solid #ddd !important;
	text-align: left;
	padding: 8px;
}

#motivoTextarea {
	border: 1px solid #ddd !important;
	text-align: left;
	padding: 8px;
}

/* .relatorioBody {
		display: block;
		color: black;
		width: 700px;
		margin-left: 46px
	}
	.relatorioHeader {
		display: block;
		color: black;
		background-color: darkgray;
		margin: 10px 10px 10px 10px;
	} */


@media print {

	#imprimirRelatorio {
		display: block;
		color: black;

	}

	.relatorioBody {
		display: block;
		color: black;
		padding-left: 30px;
		padding-right: 30px;
		font-size: 13px;
	}

	.relatorioHeader {
		color: black;
		background-color: darkgray;
		padding-left: 30px;
		padding-right: 30px;
		padding-top: 40px;
		font-size: 13px;
	}

	@page {
		size: A4;
		margin: 0;
	}

}

.no-gutters {
	margin-right: 0;
	margin-left: 0;

	>.col,
	>[class*="col-"] {
		padding-right: 0;
		padding-left: 0;
	}
}
</style>
