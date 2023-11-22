<template>
	<h1>Home</h1>
	<router-link to="/login"></router-link>
	<RealTimeClock></RealTimeClock>
</template>

<script>
	import RealTimeClock from "../components/RealTimeClock.vue"

	export default {
		name: "Home",
		components: {
			RealTimeClock: RealTimeClock
		}
	}
</script>
