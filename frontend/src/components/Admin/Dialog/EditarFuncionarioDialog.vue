<template>
	<Dialog v-model="dialogEditarFuncionarioIsVisible" header="Editar Funcionário" :visible="dialogEditarFuncionarioIsVisible" :modal="true" :closable="true" :style="{ width: '95vw' }">
		<div class="grid h-full w-full">
		<form class="">
			<div class="grid h-full w-full grid-rows-4 lg:py-20 lg:px-3 justify-center">
				<div class="row-span-1">
					<div class="grid md:grid-cols-2 h-full w-full gap-1">
						<div class="grid md:col-span-1">
							<div class="grid lg:grid-cols-2">
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="funcionario.setor" filter showClear :options="setores"
												optionLabel="name" placeholder="Setor"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.matricula"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Matrícula" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="funcionario.carga_horaria" showClear :options="cargaHoraria"
												optionLabel="name" placeholder="Carga Horária"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.nome"
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
											<Dropdown v-model="funcionario.id_horario" showClear :options="horario"
												optionLabel="name" optionValue="code" placeholder="Horário"
												panelClass="xl:w-[22rem]"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.rg"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="RG" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="funcionario.id_cargo" showClear :options="cargos"
												optionLabel="name" optionValue="code" placeholder="Cargo"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.titulo_eleitor"
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
											<InputText type="text" v-model="funcionario.cpf"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="CPF" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.mae"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="Mãe" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<Dropdown v-model="funcionario.estado_civil" showClear :options="estadoCivil"
												optionLabel="name" optionValue="code" placeholder="Estado Civil"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem] " />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.pai"
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
											<InputText type="text" v-model="funcionario.email"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Email" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.rua"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="Rua" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.celular"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Celular" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.bairro"
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
											<InputText type="text" v-model="funcionario.numero"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Número" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.cartao_sus"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
												placeholder="Cartão SUS" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.cep"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="CEP" />
										</div>
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.pis_pasep"
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
											<InputText type="text" v-model="funcionario.uf"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" placeholder="UF" />
										</div>
										<div class="row-span-1 p-1">
											<Calendar v-model="funcionario.data_nascimento"
												placeholder="Data de Nascimento" dateFormat="dd/mm/yy"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]" modelValue="Date" />
										</div>
									</div>
								</div>
								<div class="col-span-1">
									<div class="grid grid-rows-2 h-full w-full">
										<div class="row-span-1 p-1">
											<InputText type="text" v-model="funcionario.cidade"
												class="w-full lg:w-[14rem] xl:w-[18rem] h-[2.5rem]"
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
				<!-- <div class="row-span-1 grid justify-center mt-4">
					<Button
						class="border-2 bg-transparent h-8 w-32 md:w-36 lg:w-40 lg:h-10 text-xs md:text-sm lg:text-lg button mt-2"
						label="Cadastrar" severity="info" raised @click="enviarFormularioDeCadastroDeFuncionario()" />
				</div> -->
			</div>
		</form>
	</div>
	</Dialog>
</template>

<script setup>
import { ref, watch } from 'vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';

const props = defineProps({
	isVisible: Boolean,
	funcionario: Object
});
const emit = defineEmits(['update:isVisible']);
const dialogEditarFuncionarioIsVisible = ref();

watch(props, () => {
	dialogEditarFuncionarioIsVisible.value = props.isVisible;
	console.log(props.funcionario);
	console.log(dialogEditarFuncionarioIsVisible.value);
});




</script>
