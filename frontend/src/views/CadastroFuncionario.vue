<template>
	<div class="row h-100 w-100 d-flex ">
			<div class="col-md-2 h-100">
					<SideBar></SideBar>
			</div>
			<div class="col-md-8 w-75 h-100 ml-15 d-flex">
				<FormFuncionario></FormFuncionario>
			</div>
	</div>
</template>

<script setup>
import SideBar from '../components/SideBar.vue';
import FormFuncionario from '../components/FormFuncionario.vue';

</script>
