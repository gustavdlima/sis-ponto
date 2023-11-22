<template>
	<div>
		<!-- <p>{{ currentTime.toLocaleString() }}</p> -->
		<p> {{ currentTime.toLocaleDateString() }}</p>
		<p>{{ currentTime.toLocaleTimeString() }}</p>
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

