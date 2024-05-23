<template>
	<div class="container">
		<div class="grid grid-cols-2 justify-between mr-3">
			<div class="col-span-1">
				<div class="grid justify-center">
					<span class="text-xl lg:text-2xl ">{{ currentTime.toLocaleTimeString('pt-BR') }}</span>
				</div>
			</div>
			<div class="col-span-1">
				<div class="grid justify-center">
					<span class="text-xl lg:text-2xl"> {{ currentTime.toLocaleDateString() }}</span>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { useCurrentTime } from "../composable/currentTime.js";

export default {
	name: "CurrentTimeNow",
	setup() {
		const { currentTime } = useCurrentTime();
		return { currentTime };
	}
}
</script>

<style scoped>

span {
	color: aliceblue;
	font-weight: bold;
}

</style>
