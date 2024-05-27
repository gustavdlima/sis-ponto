<template>
	<div class="row h-100 w-100 d-flex">
		<div class="col-md-2 h-100">
			<AdminSideBar></AdminSideBar>
		</div>
		<div class="col-md-8 w-75 h-100 ml-15 d-flex">
			<FormOperador></FormOperador>
		</div>
	</div>
</template>

<script setup>
import AdminSideBar from '../components/AdminSideBar.vue';
import FormOperador from '../components/FormOperador.vue';

</script>
