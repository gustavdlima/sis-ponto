<template>
	<div class="container">
		<span class="row">{{ currentTime.toLocaleTimeString() }}</span>
		<span class="row"> {{ currentTime.toLocaleDateString() }}</span>
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
