<template>
	<div class="grid justify-center content-center h-full w-full">
		<div class="w-[45vh] h-[70vh] md:w-[65vh] md:h-[75vh] lg:w-[90vh] lg:h-[80vh] xl:w-[130vh] xl:h-[90vh] bg-blue-200">
			<div class="grid grid-rows-12">
				<div class="row-span-2 bg-blue-400">
					<AdminMenu />
				</div>
				<div class="row-span-10 bg-blue-700">

				</div>
			</div>
		</div>
	</div>

</template>

<script setup>
import AdminMenu from '../components/AdminMenu.vue';

</script>

<style></style>
