<template>
	<div class="grid h-full w-full m-auto">
		<div class="grid grid-rows-12 p-2">
			<div class="row-span-1 md:row-span-2">
				<AdminNavBar />
			</div>
			<div class="row-span-11 md:row-span-10 p-1">
				<FormCadastroFuncionario />
				<!-- <FormFuncionarioDeprecated /> -->
			</div>
		</div>
	</div>
</template>

<script setup>
import AdminNavBar from '../../../components/AdminNavBar.vue';
import FormCadastroFuncionario from '../../../components/FormCadastroFuncionario.vue';
import FormFuncionarioDeprecated from '../../components/deprecated/FormFuncionarioDeprecated.vue';

</script>
