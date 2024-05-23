<template>
	<div class="h-full w-full grid grid-rows-6">
		<div class="grid justify-center content-center row-span-5 mt-24">
			<AdminLoginForm />
		</div>
		<div class="row-span-1">
			<LogoGovernoPbFooter />
		</div>
	</div>
</template>

<script setup>
import LogoGovernoPbFooter from "../components/LogoGovernoPbFooter.vue"
import AdminLoginForm from '../components/AdminLoginForm.vue';

</script>

