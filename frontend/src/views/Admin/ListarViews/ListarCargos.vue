<template>
	<div class="row h-100 w-100">
		<div class="col-md-2 h-100">
			<AdminSideBar></AdminSideBar>
		</div>
		<div class="container w-75 p-5">
			<div class="flex align-items-center justify-content-center">
				<div class="col-md-6 mt-8">
					<label class="form-label text-black font-weight-bold">Cargos Cadastrados</label>
					<select name="cargo" class="form-select border-white form-control mb-2">
						<option disabled value=""></option>
						<option v-for="cargo in cargos" v-bind:value="cargo.id">
							{{ cargo.cargo }} </option>
					</select><br>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import AdminSideBar from '../components/AdminSideBar.vue';
import { useAuthStore } from '../stores/authStore';
import { ref } from 'vue';
import axios from 'axios';

const authStore = useAuthStore();
const cargos = ref([]);

function getcargos() {
	axios.defaults.headers.common = {
		'Authorization': 'Bearer ' + authStore.userToken
	}
	axios.get("http://localhost:8000/api/cargos")
		.then(response => {
			cargos.value = response.data;
		})
		.catch(error => {
			console.log(error);
		});
}

getcargos();
</script>../../stores/authStore
