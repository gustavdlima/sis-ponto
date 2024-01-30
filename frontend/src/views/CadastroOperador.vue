<template>
	<div class="container bg-warning d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div class="row bg-dark h-75 w-100">
			<div class="col-md-3 bg-danger">
				<div class="row">
					<SideBar></SideBar>
				</div>
			</div>
			<div class="col bg-info">
				<FormOperador></FormOperador>
			</div>
		</div>
	</div>
</template>

<script setup>
import SideBar from '../components/SideBar.vue';
import FormOperador from '../components/FormOperador.vue';

</script>
