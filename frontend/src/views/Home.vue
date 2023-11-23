<template>
	<h1>Home</h1>
	<RealTimeClock></RealTimeClock>
	<Login />
</template>

<script>
	import RealTimeClock from "../components/RealTimeClock.vue"
	import Login from "../components/Login.vue"
	export default {
		name: "Home",
		components: {
			RealTimeClock: RealTimeClock,
			Login: Login,
		}
	}
</script>
