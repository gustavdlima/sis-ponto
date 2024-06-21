<template>
	<Dialog v-model:visible="dialogEditarFuncionarioIsVisible"  @update:visible="fecharEditarFuncionarioDialog" :modal="true" :closable="true" :style="{ width: '95vw' }">
		<div class="grid h-full w-full">
		<form class="">
			<div class="grid h-full w-full grid-rows-4 xl:py-20 xl:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid md:grid-cols-2 h-full w-full gap-1">
						<div class="grid md:col-span-1">
							<div class="grid xl:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div class="">
												<span>Setor</span>
											</div>
											<div>
												<Dropdown v-model="funcionario.setor" filter showClear :options="setores"
													optionLabel="name" placeholder="Setor"
													class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" />
											</div>
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Matrícula</span>
											</div>
											<InputText type="text" v-model="funcionario.matricula"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="Matrícula" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Carga Horária</span>
											</div>
											<Dropdown v-model="funcionario.carga_horaria" showClear :options="cargaHoraria"
												optionLabel="name" placeholder="Carga Horária"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Nome</span>
											</div>
											<InputText type="text" v-model="funcionario.nome"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="Nome" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span-1">
							<div class="grid xl:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Horário</span>
											</div>
											<Dropdown v-model="funcionario.id_horario" showClear :options="horario"
												optionLabel="name" optionValue="code" placeholder="Horário"
												panelClass="2xl:w-[22rem]"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>RG</span>
											</div>
											<InputText type="text" v-model="funcionario.rg"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" placeholder="RG" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Cargo</span>
											</div>
											<Dropdown v-model="funcionario.id_cargo" showClear :options="cargos"
												optionLabel="name" optionValue="code" placeholder="Cargo"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Título de Eleitor</span>
											</div>
											<InputText type="text" v-model="funcionario.titulo_eleitor"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
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
							<div class="grid xl:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>CPF</span>
											</div>
											<InputText type="text" v-model="funcionario.cpf"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" placeholder="CPF" />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Mãe</span>
											</div>
											<InputText type="text" v-model="funcionario.mae"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" placeholder="Mãe" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Estado Civil</span>
											</div>
											<Dropdown v-model="funcionario.estado_civil" showClear :options="estadoCivil"
												optionLabel="name" optionValue="code" placeholder="Estado Civil"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Pai</span>
											</div>
											<InputText type="text" v-model="funcionario.pai"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" placeholder="Pai" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span-1">
							<div class="grid xl:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Email</span>
											</div>
											<InputText type="text" v-model="funcionario.email"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="Email" />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Rua</span>
											</div>
											<InputText type="text" v-model="funcionario.rua"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" placeholder="Rua" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Celular</span>
											</div>
											<InputText type="text" v-model="funcionario.celular"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="Celular" />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Bairro</span>
											</div>
											<InputText type="text" v-model="funcionario.bairro"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
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
							<div class="grid xl:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Número</span>
											</div>
											<InputText type="text" v-model="funcionario.numero"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="Número" />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>SUS</span>
											</div>
											<InputText type="text" v-model="funcionario.cartao_sus"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="Cartão SUS" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>CEP</span>
											</div>
											<InputText type="text" v-model="funcionario.cep"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" placeholder="CEP" />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>PIS/PASEP</span>
											</div>
											<InputText type="text" v-model="funcionario.pis_pasep"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="PIS/PASEP" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="grid md:col-span-1">
							<div class="grid xl:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>UF</span>
											</div>
											<InputText type="text" v-model="funcionario.uf"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" placeholder="UF" />
										</div>
										<div class="row-span-1 p-1">
											<div>
												<span>Data Nascimento</span>
											</div>
											<Calendar v-model="funcionario.data_nascimento"
												placeholder="Data de Nascimento" dateFormat="dd/mm/yy"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]" modelValue="Date" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<div>
												<span>Cidade</span>
											</div>
											<InputText type="text" v-model="funcionario.cidade"
												class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
												placeholder="Cidade" />
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
						class="border-2 bg-transparent h-8 w-32 md:w-36 xl:w-40 xl:h-10 text-xs md:text-sm xl:text-lg button mt-2"
						label="Editar" severity="info" raised @click="enviarFormularioDeEdicaoDeFuncionario()" />
				</div>
			</div>
		</form>
	</div>
	</Dialog>

	<DialogAlerta :conteudoPropsDialog="{ dialogMensagem: dialogMensagem, dialogVisivel: dialogVisivel }" />
</template>

<script setup>
import { ref, watch, onMounted} from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import useCadastroService from '../../../services/CadastroService'
import useEditarService from '../../../services/EditarService'
import DialogAlerta from '../../DialogAlerta.vue';

const props = defineProps({
	isVisible: Boolean,
	funcionario: Object
});
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
const cargaHoraria = ref([
	{ name: '20h', code: '20h' },
	{ name: '40h', code: '40h' }
])
const estadoCivil = ref([
	{ name: 'Solteiro(a)', code: 'Solteiro(a)' },
	{ name: 'Casado(a)', code: 'Casado(a)' },
])
const cargos = ref([]);
const horario = ref([]);
const dialogEditarFuncionarioIsVisible = ref();
const funcionarioEditado = ref();
const dialogMensagem = ref();
const dialogVisivel = ref();
const emit = defineEmits(['atualizarDialogEditarFuncionarioBool']);

const enviarFormularioDeEdicaoDeFuncionario = async () => {

	const response = await useEditarService.editarFuncionario(funcionarioEditado.value)
	handleResponse(response.data);
	fecharEditarFuncionarioDialog();
};

const handleResponse = (response) => {
	switch (response.status) {
		case 200:

			return ;
			break ;
	}
}

const tratarFormData = () => {
	funcionarioEditado.value.data_nascimento = useUtils.formatarData(funcionarioEditado.value.data_nascimento)
}

const fecharEditarFuncionarioDialog = () => {
	dialogEditarFuncionarioIsVisible.value = false;
	emit('atualizarDialogEditarFuncionarioBool', false);
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

watch(props, () => {
	dialogEditarFuncionarioIsVisible.value = props.isVisible;
	funcionarioEditado.value = props.funcionario;
});

onMounted(() => {
	getCargos();
	getHorarios();
})


</script>

<style scoped>
button {
	background-color: #1F2937 !important;
	border: none !important
}
</style>
