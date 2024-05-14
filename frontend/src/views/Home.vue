<template>
	<div class="h-full w-full grid grid-rows-6">
		<BotaoAdminLogin />
		<div class="text-white overflow-hidden grid justify-center content-center row-span-5">
			<RegistrarPonto />
		</div>
		<div class="row-span-1">
			<LogoGovernoPbFooter />
		</div>
	</div>
</template>

<script setup>
import BotaoAdminLogin from "../components/BotaoAdminLogin.vue"
import RegistrarPonto from "../components/RegistrarPonto.vue"
import LogoGovernoPbFooter from "../components/LogoGovernoPbFooter.vue"

</script>
