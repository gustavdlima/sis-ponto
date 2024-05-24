<template>
	<div class="grid">
		<div>
			<MegaMenu :model="items" :pt="{
				label: {
					class: ['text-blue-900']
				},
				icon: {
					class: ['text-blue-900']
				},
				submenuIcon: {
					class: ['text-blue-900']
				},
				submenuheader: {
					class: ['text-blue-900']
				},
			}" style="font-size: 1.2rem">
				<template #start>
					<span class="text-3xl text-blue-900 p-2 font-semibold"> ePonto </span>
				</template>

				<template #end>
					<div class="mr-2 mt-2">
						<span class="pi pi-fw pi-sign-out  text-blue-900" style="font-size: 1.5rem"  />
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
import LogoFunadSemNome from '../components/LogoFunadSemNome.vue'

const router = useRouter();

const items = ref([
	{
		label: 'Cadastro',
		icon: 'pi pi-fw pi-user',
		items: [
			[
				{
					label: 'Cadastro Funcionário',
				},
				{
					label: 'Cadastro Operador',
				},
				{
					label: 'Cadastro Horário',
				},
				{
					label: 'Cadastro Cargo',
				},
				{
					label: 'Cadastro Justificativa',
				},
			],
		]
	},
	{
		label: 'Editar',
		icon: 'pi pi-fw pi-pencil',
		items: [
			[
				{
					label: 'Cadastro Operador',
					icon: 'pi pi-fw pi-user-edit',
				}
			],
		]
	},
	{
		label: 'Listar',
		icon: 'pi pi-fw pi-list',
		items: [
			[
				{
					label: 'Listar Funcionários',
					icon: 'pi pi-fw pi-users',
				},
			],
		]
	},
]);

</script>

<style scoped></style>
