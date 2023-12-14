<template>
	<div class="row mb-3 h-75 w-100 d-flex align-items-center justify-content-center text-white m-2">
		<span class="row d-flex align-items-center justify-content-center fs-1 fw-bold">{{ currentTime.toLocaleTimeString() }}</span>
		<span class="row d-flex align-items-center justify-content-center fs-5 fw-bold"> {{ currentTime.toLocaleDateString() }}</span>
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

<style>
</style>
