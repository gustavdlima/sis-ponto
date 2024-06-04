<template>
	<div class="grid">
		<div>
			<MegaMenu :model="items" :pt="{
				label: {
					class: ['text-blue-950']
				},
				icon: {
					class: ['text-blue-950']
				},
				submenuIcon: {
					class: ['text-blue-950']
				},
				submenuheader: {
					class: ['text-blue-950']
				},
				submenulabel: {
					class: ['text-blue-950']
				}
			}" style="font-size: 1.2rem">
				<template #start>
					<span class="text-3xl text-blue-950 p-2 font-semibold"> ePonto </span>
				</template>

				<template #end>
					<div class="mr-2 mt-2">
						<span class="pi pi-fw pi-sign-out  text-blue-950" style="font-size: 1.5rem" />
					</div>
				</template>
			</MegaMenu>

		</div>
	</div>
</template>

<script setup>
import MegaMenu from 'primevue/megamenu';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../stores/authStore';
import LogoFunadSemNome from '../components/LogoFunadSemNome.vue'

const router = useRouter();
const authStore = useAuthStore();

const items = ref([
	{
		label: 'Cadastro',
		icon: 'pi pi-fw pi-user',
		items: [
			[{
				items: [
					{
						label: 'Funcionário',
						command: () => rotasDeCadastro(1),
					},
				],
			},
			{
				items: [
					{
						label: 'Operador',
						command: () => rotasDeCadastro(2),
					},
				],
			},
			{
				items: [
					{
						label: 'Horário',
						command: () => rotasDeCadastro(3),
					},
				],
			},
			{
				items: [
					{
						label: 'Cargo',
						command: () => rotasDeCadastro(4),
					},
				],
			},
			{
				items: [
					{
						label: 'Justificativa',
						command: () => rotasDeCadastro(5),
					},
				],
			},
			],
		],
	},
	{
		label: 'Listar',
		icon: 'pi pi-fw pi-list',
		items: [
			[
				{
					items: [
						{
							label: 'Funcionário',
							command: () => rotasDeListagem(1),
						},
					],
				},
				{
					items: [
						{
							label: 'Operador',
							command: () => rotasDeListagem(2),
						},
					],
				},
				{
					items: [
						{
							label: 'Horário',
							command: () => rotasDeListagem(3),
						},
					],
				},
				{
					items: [
						{
							label: 'Cargo',
							command: () => rotasDeListagem(4),
						},
					],
				},
				{
					items: [
						{
							label: 'Justificativa',
							command: () => rotasDeListagem(5),
						},
					],
				},
			]
		]
	},
	{
		label: 'Editar',
		icon: 'pi pi-fw pi-pencil',
		items: [
			[
				{
					items: [
						{
							label: 'Funcionário',
							command: () => rotasDeEdicao(1),
						},
					],
				},
				{
					items: [
						{
							label: 'Operador',
							command: () => rotasDeEdicao(2),
						},
					],
				},
				{
					items: [
						{
							label: 'Horário',
							command: () => rotasDeEdicao(3),
						},
					],
				},
				{
					items: [
						{
							label: 'Cargo',
							command: () => rotasDeEdicao(4),
						},
					],
				},
				{
					items: [
						{
							label: 'Justificativa',
							command: () => rotasDeEdicao(5),
						},
					],
				},
			]
		]
	},
]);

const rotasDeCadastro = async (index) => {
	switch (index) {
		case 1:
			router.push('/admin/cadastroFuncionario');
			break;
		case 2:
			router.push('/admin/CadastroOperador');
			break;
		case 3:
			router.push('/admin/CadastroHorario');
			break;
		case 4:
			router.push('/admin/CadastroCargo');
			break;
		case 5:
			router.push('/admin/CadastroJustificativa');
			break;
	}
}

const rotasDeEdicao = async (index) => {
	switch (index) {
		case 1:
			router.push('/admin/EditarFuncionario');
			break;
		case 2:
			router.push('/admin/EditarOperador');
			break;
		case 3:
			router.push('/admin/EditarHorario');
			break;
		case 4:
			router.push('/admin/EditarCargo');
			break;
		case 5:
			router.push('/admin/EditarJustificativa');
			break;
	}
}

const rotasDeListagem = async (index) => {
	switch (index) {
		case 1:
			router.push('/admin/ListarFuncionarios');
			break;
		case 2:
			router.push('/admin/ListarOperador');
			break;
		case 3:
			router.push('/admin/ListarHorario');
			break;
		case 4:
			router.push('/admin/ListarCargo');
			break;
		case 5:
			router.push('/admin/ListarJustificativa');
			break;
	}
}

</script>

<style scoped></style>
