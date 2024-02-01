<template>
	<div class="container bg-warning d-flex justify-content-center align-items-center" style="height: 100vh">
		<div class="row bg-dark h-75 w-100">
			<div class="h-80 row-sm col-md-3 bg-danger">
					<SideBar></SideBar>
			</div>
			<div class="row-sm col-md bg-info">

			</div>
		</div>
	</div>
</template>

<script>
import SideBar from '../components/SideBar.vue';

export default {
	name: "AdminPanel",
	components: {
		SideBar: SideBar,
	},
	data() {
		return {

		}
	},
	methods: {

	},
	mounted() {

	}
}

</script>

<style>

</style>
