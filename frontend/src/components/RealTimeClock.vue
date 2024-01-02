<template>
	<div class="container">
		<div class="row d-flex justify-content-center">
			<span class="col">{{ currentTime.toLocaleTimeString('pt-BR') }}</span>
			<span class="col"> {{ currentTime.toLocaleDateString() }}</span>
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

@media screen and (max-width: 576px) {
  span {
	font-size: 4vw;
  }
}

@media screen and (min-width: 992px) {
  span {
	font-size: 1.8vw;
  }
}

@media screen and (min-width: 1200px) {
  span {
	font-size: 1.4vw;
  }
}

</style>
