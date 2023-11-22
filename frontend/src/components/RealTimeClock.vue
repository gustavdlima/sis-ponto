<template>
	<div>
		<p>{{ currentTime.toLocaleString() }}</p>
		<p>{{ currentTime.toLocaleTimeString() }}</p>
		<p> {{ currentTime.toLocaleDateString() }}</p>
	</div>
</template>

<script>
	import { useCurrentTime } from "../composable/currentTime.js";

	export default {
		name: "CurrentTimeNow",
		setup() {
			const { currentTime } = useCurrentTime();
			console.log(currentTime.value)
			return { currentTime };
		}
	}
</script>

