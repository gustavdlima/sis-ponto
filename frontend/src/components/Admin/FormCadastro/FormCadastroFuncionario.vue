<template>
	<div class="grid h-full w-full">
		<form class="">
			<div class="grid h-full w-full grid-rows-5 lg:py-20 lg:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid md:grid-cols-2 h-full w-full gap-1">
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="formData.id_cargo" showClear :options="cargos"
												optionLabel="name" optionValue="code" placeholder="Cargo"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.matricula"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Matrícula" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="formData.carga_horaria" showClear :options="cargaHoraria"
												optionLabel="name" optionValue="code" placeholder="Carga Horária"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.nome"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Nome" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="formData.setor" filter showClear :options="setores"
												optionLabel="name" optionValue="code" placeholder="Setor"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.rg"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="RG" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Calendar v-model="formData.data_nascimento"
												placeholder="Data de Nascimento" dateFormat="dd/mm/yy"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" modelValue="Date" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.titulo_eleitor"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Título Eleitor" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-span-1">
					<div class="grid md:grid-cols-2 h-full w-full gap-1">
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.cpf"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="CPF" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.mae"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="Mãe" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="formData.estado_civil" showClear :options="estadoCivil"
												optionLabel="name" optionValue="code" placeholder="Estado Civil"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.pai"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="Pai" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.email"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Email" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.rua"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="Rua" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.celular"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Celular" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.bairro"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Bairro" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-span-1">
					<div class="grid md:grid-cols-2 h-full w-full gap-1">
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.numero"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Número" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.cartao_sus"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Cartão SUS" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.cep"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="CEP" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.pis_pasep"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="PIS/PASEP" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.uf"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="UF" />
										</div>
										<div class="row-span-1 p-1">
											<Dropdown v-model="formData.sexo" showClear :options="sexos"
												optionLabel="name" optionValue="code" placeholder="Sexo"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="formData.cidade"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Cidade" />
										</div>
										<div class="row-span-1 p-1 overflow-hidden">
											<Dropdown v-model="formData.deficiente" showClear :options="deficiente"
												optionLabel="name" optionValue="code" placeholder="Deficiente"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-span-1 grid">
					<div class="grid md:grid-cols-2 h-full w-full gap-1">
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="diasDaSemana.segunda" showClear :options="horario"
												optionLabel="name" optionValue="code" placeholder="Segunda-Feira"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">
											<Dropdown v-model="diasDaSemana.terca" showClear :options="horario"
												optionLabel="name" optionValue="code" placeholder="Terça-Feira"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="diasDaSemana.quarta" showClear :options="horario"
												optionLabel="name" optionValue="code" placeholder="Quarta-Feira"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">
											<Dropdown v-model="diasDaSemana.quinta" showClear :options="horario"
												optionLabel="name" optionValue="code" placeholder="Quinta-Feira"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="diasDaSemana.sexta" showClear :options="horario"
												optionLabel="name" optionValue="code" placeholder="Sexta-Feira"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">

										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
										</div>
										<div class="row-span-1 p-1 overflow-hidden">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-span-1 grid justify-center mt-4">
					<Button
						class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-2"
						label="Cadastrar" severity="info" raised @click="enviarFormularioDeCadastroDeFuncionario()" />
				</div>
			</div>
		</form>
	</div>

	<div>
		<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import useUtils from '../../../services/Utils.js';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Calendar from 'primevue/calendar';
import useCadastroService from '../../../services/CadastroService.js';
import DialogAlerta from '../../DialogAlerta.vue';

const setores = ref([
	{ name: 'AEE', code: 'AEE' },
	{ name: 'AJU', code: 'AJU' },
	{ name: 'ALMOXARIFADO', code: 'ALMOXARIFADO' },
	{ name: 'ASCOM', code: 'ASCOM' },
	{ name: 'CAD', code: 'CAD' },
	{ name: 'CAP', code: 'CAP' },
	{ name: 'CAS', code: 'CAS' },
	{ name: 'CIL', code: 'CIL' },
	{ name: 'CODAFI', code: 'CODAFI' },
	{ name: 'CODAM', code: 'CODAM' },
	{ name: 'CODAPA', code: 'CODAPA' },
	{ name: 'CODAVI', code: 'CODAVI' },
	{ name: 'CODEI', code: 'CODEI' },
	{ name: 'COMAP', code: 'COMAP' },
	{ name: 'CORAD', code: 'CORAD' },
	{ name: 'CORDI', code: 'CORDI' },
	{ name: 'CORFIN', code: 'CORFIN' },
	{ name: 'CORSIN', code: 'CORSIN' },
	{ name: 'CREM', code: 'CREM' },
	{ name: 'CRH', code: 'CRH' },
	{ name: 'DE', code: 'DE' },
	{ name: 'DT', code: 'DT' },
	{ name: 'EAP', code: 'EAP' },
	{ name: 'GABINETE', code: 'GABINETE' },
	{ name: 'NAAS', code: 'NAAS' },
	{ name: 'NED', code: 'NED' },
	{ name: 'NVA', code: 'NVA' },
	{ name: 'PASSE-LIVRE', code: 'PASSE-LIVRE' },
	{ name: 'PATRIMONIO', code: 'PATRIMONIO' },
	{ name: 'PROTOCOLO', code: 'PROTOCOLO' },
	{ name: 'REFEITORIO', code: 'REFEITORIO' },
	{ name: 'SUS', code: 'SUS' },
	{ name: 'USPLAN', code: 'USPLAN' }
])
const formData = ref({
	nome: "",
	setor: "",
	matricula: "",
	data_nascimento: "",
	rg: "",
	cpf: "",
	pis_pasep: "",
	titulo_eleitor: "",
	cartao_sus: "",
	mae: "",
	pai: "",
	celular: "",
	email: "",
	estado_civil: "",
	rua: "",
	bairro: "",
	cep: "",
	numero: "",
	cidade: "",
	uf: "",
	id_cargo: "",
	id_horario: "",
	id_dia_da_semana: 0,
	carga_horaria: "",
	sexo: "",
	deficiente: "",
});
const cargaHoraria = ref([
	{ name: '20h', code: '20h' },
	{ name: '40h', code: '40h' }
])
const estadoCivil = ref([
	{ name: 'Solteiro(a)', code: 'Solteiro(a)' },
	{ name: 'Casado(a)', code: 'Casado(a)' },
])
const sexos = ref([
	{ name: 'Masculino', code: 'M' },
	{ name: 'Feminino', code: 'F' },
])
const deficiente = ref([
	{ name: 'Sim', code: 'True' },
	{ name: 'Não', code: 'False' },
])
const cargos = ref([]);
const horario = ref([]);
const dialogMensagem = ref('');
const dialogVisivel = ref(false);
const diasDaSemana = ref({
	segunda: "",
	terca: "",
	quarta: "",
	quinta: "",
	sexta: "",
})

const criarTabelaDiaDaSemana = async () => {
	tratarDiasDaSemana();
	const response = await useCadastroService.cadastrarDiasDaSemana(diasDaSemana.value);
	return handleDiasDaSemanaResponse(response);
}

const enviarFormularioDeCadastroDeFuncionario = async () => {
	if (formData.value.matricula == "") {
		dialogMensagem.value = 'Preencha a Matricula!';
		dialogVisivel.value = true;
		await useUtils.sleep(2000);
		dialogVisivel.value = false;
		return;
	}
	formData.value.id_dia_da_semana = await criarTabelaDiaDaSemana();
	tratarFormData();
	const response = await useCadastroService.cadastrarFuncionario(formData.value);
	handleResponse(response);
}

const handleResponse = async (response) => {
	switch (response.status) {
		case 201:
			dialogMensagem.value = 'Funcionário cadastrado com sucesso!';
			dialogVisivel.value = true;
			await useUtils.sleep(1000);
			dialogVisivel.value = false;
			break;
		case 500:
			dialogMensagem.value = 'Funcionário já cadastrado!';
			dialogVisivel.value = true;
			await useUtils.sleep(2000);
			dialogVisivel.value = false;
			break;
		default:
			dialogMensagem.value = 'Erro ao cadastrar o funcionário! Entre em contato com o administrador';
			dialogVisivel.value = true;
			await useUtils.sleep(2000);
			dialogVisivel.value = false;
	}
}

const handleDiasDaSemanaResponse = async (response) => {
	switch (response.status) {
		case 200:
			return response.data.diasDaSemana.id;
			break;
		case 201:
			return response.data.diasDaSemana.id;
			break;
		case 500:
			return response.data.diasDaSemana.id;
			break;
		default:
			dialogMensagem.value = 'Erro ao cadastrar o horário semanal do funcionário! Entre em contato com o administrador';
			dialogVisivel.value = true;
			await useUtils.sleep(2000);
			dialogVisivel.value = false;
	}
}

const tratarFormData = () => {
	formData.value.data_nascimento = useUtils.formatarData(formData.value.data_nascimento);
}

const tratarDiasDaSemana = () => {
	if (diasDaSemana.value.segunda != "") {
		diasDaSemana.value.segunda = diasDaSemana.value.segunda.code;
	}
	if (diasDaSemana.value.terca != "") {
		diasDaSemana.value.terca = diasDaSemana.value.terca.code;
	}
	if (diasDaSemana.value.quarta != "") {
		diasDaSemana.value.quarta = diasDaSemana.value.quarta.code;
	}
	if (diasDaSemana.value.quinta != "") {
		diasDaSemana.value.quinta = diasDaSemana.value.quinta.code;
	}
	if (diasDaSemana.value.sexta != "") {
		diasDaSemana.value.sexta = diasDaSemana.value.sexta.code;
	}
}

const getCargos = async () => {
	const response = await useCadastroService.getCargos();
	for (let i = 0; i < response.data.length; i++) {
		cargos.value.push({
			name: response.data[i].cargo,
			code: response.data[i].id
		})
	}
}

const getHorarios = async () => {
	const response = await useCadastroService.getHorarios();
	for (let i = 0; i < response.data.length; i++) {
		if (response.data[i].terceiro_horario == null) {
			var horarioString = response.data[i].primeiro_horario + " - " + response.data[i].segundo_horario;
		} else {
			var horarioString = response.data[i].primeiro_horario + " - " + response.data[i].segundo_horario + " - " + response.data[i].terceiro_horario + " - " + response.data[i].quarto_horario;
		}
		horario.value.push({
			name: horarioString,
			code: response.data[i].id
		})
	}
}

function fillFormData() {
	formData.value.nome = "b"
	formData.value.setor = "b"
	formData.value.matricula = "b"
	formData.value.data_nascimento = "05-21-1994"
	formData.value.rg = "b"
	formData.value.cpf = "b"
	formData.value.pis_pasep = "b"
	formData.value.titulo_eleitor = "b"
	formData.value.cartao_sus = "b"
	formData.value.mae = "b"
	formData.value.pai = "b"
	formData.value.celular = "b"
	formData.value.email = "b@gmail.com"
	formData.value.estado_civil = "b"
	formData.value.rua = "b"
	formData.value.bairro = "b"
	formData.value.cep = "b"
	formData.value.numero = "b"
	formData.value.cidade = "b"
	formData.value.uf = "b"
	formData.value.id_cargo = "1"
	formData.value.id_horario = "2"
	formData.value.carga_horaria = "20h"
	formData.value.sexo = "M"
	formData.value.deficiente = "False"
}

onMounted(() => {
	getCargos();
	getHorarios();
})
</script>
