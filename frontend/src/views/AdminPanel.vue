<template>
	<div class="row h-100 w-100">
		<div class="">
				<div class="col-md-2 h-100">
						<SideBar></SideBar>
				</div>
				<div class="col-md-8" >

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
