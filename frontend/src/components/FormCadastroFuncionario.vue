<template>
	<div class="grid h-full w-full bg-blue-200">

		<form class="bg-red-200">
			<div class="grid h-full w-full grid-rows-3">
				<div class="row-span-1 bg-green-200">
					<div class="grid md:grid-cols-2 h-full w-full gap-1">
						<div class="grid md:col-span-1 bg-red-200 ">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 bg-blue-200 p-1">
											<Dropdown v-model="formData.setor" filter showClear :options="setores" optionLabel="name" placeholder="Setor" class="w-full lg:w-[14rem] h-[3rem]"/>
										</div>
										<div class="row-span-1 bg-blue-400 p-1">
											<InputText type="text" v-model="formData.matricula" class="w-full lg:w-[14rem] h-[3rem]" placeholder="Matrícula"/>
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 bg-green-200 p-1">
											<Dropdown v-model="formData.carga_horaria" showClear :options="cargaHoraria" optionLabel="name" placeholder="Carga Horária" class="w-full lg:w-[14rem] h-[3rem]"/>
										</div>
										<div class="row-span-1 bg-green-400 p-1">
											<InputText type="text" v-model="formData.nome" class="w-full lg:w-[14rem] h-[3rem]" placeholder="Nome"/>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span1 bg-red-400">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 bg-blue-200 p-1">
											<InputText type="text" v-model="formData.cpf" class="w-full lg:w-[14rem] h-[3rem]" placeholder="CPF"/>
										</div>
										<div class="row-span-1 bg-blue-400 p-1">
											<InputText type="text" v-model="formData.rg" class="w-full lg:w-[14rem] h-[3rem]" placeholder="RG"/>
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 bg-green-200 p-1">
											<InputText type="text" v-model="formData.pis_pasep" class="w-full lg:w-[14rem] h-[3rem]" placeholder="PIS/PASEP"/>
										</div>
										<div class="row-span-1 bg-green-400 p-1">
											<InputText type="text" v-model="formData.titulo_eleitor" class="w-full lg:w-[14rem] h-[3rem]" placeholder="Título Eleitor"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-span-1 bg-green-400">
					<div class="grid md:grid-cols-2 h-full w-full">
						<div class="md:col-span-1 bg-purple-400">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 bg-blue-200 p-1 overflow-hidden">
												<Calendar v-model="formData.data_nascimento" dateFormat="dd/mm/yy" class="w-full h-[3rem]" placeholder="Data de Nascimento" panel=""/>
										</div>
										<div class="row-span-1 bg-blue-400 p-1">
											<InputText type="text" v-model="formData.cartao_sus" class="w-full lg:w-[14rem] h-[3rem]" placeholder="Cartão SUS"/>
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 bg-green-200 p-1 ">
											<Dropdown v-model="formData.estado_civil" showClear :options="estadoCivil" optionLabel="name" placeholder="Estado Civil" class="w-full lg:w-[14rem] h-[3rem]"/>
										</div>
										<div class="row-span-1 bg-green-400 p-1">
											<Dropdown v-model="formData.cargo" showClear :options="cargos" optionLabel="name" placeholder="Cargo" class="w-full lg:w-[14rem] h-[3rem]"/>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="md:col-span1 bg-purple-200">

						</div>
					</div>
				</div>
				<div class="row-span-1 bg-green-600">
					<div class="grid lg:grid-cols-2 h-full w-full">
						<div class="lg:col-span-1 bg-blue-200">

						</div>
						<div class="lg:col-span1 bg-blue-400">

						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<script setup>
import { ref } from 'vue';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Calendar from 'primevue/calendar';
import useFormService from '../services/FormService.js';

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
	carga_horaria: ""
})

const cargaHoraria = ref([
	{ name: '20h', code: '20h' },
	{ name: '40h', code: '40h' }
])

const estadoCivil = ref([
	{ name: 'Solteiro(a)', code: 'Solteiro(a)' },
	{ name: 'Casado(a)', code: 'Casado(a)' },
])

const cargos = ref([]);

//fazer tratamento para os cargos e horarios ficar do jeito do que o primevue dropdown pede
const getCargos = async () => {
	const response = await useFormService.getCargos();
	cargo.value = response.data;
}


</script>


<!--
	SETOR - OPTION
	MATRICULA
	CARGA HORARIA - OPTION
	NOME
	CPF
	RG
	DATA DE NASCIMENTO - CALENDAR
	PIS/PASEP
	TITULO DE ELEITOR
	SUS
	ESTADO CIVIL - OPTION
	MÃE
	PAI
	EMAIL
	CELULAR
	RUA
	BAIRRO
	NUMERO
	CEP
	CIDADE
	UF
	HORÁRIO - OPTION
	CARGO - OPTION
 -->
