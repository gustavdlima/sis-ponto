<template>
	<h1>WebCam</h1>
	<div>
		<video ref="video" autoplay playsinline webkit-playsinline muted hidden></video>

		<canvas ref="canvas" width="1280" height="720"></canvas>
	</div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
const canvas = ref(null);
const video = ref(null);
const ctx = ref(null);

const constraints = ref({
	audio: false,
	video: true
})

onMounted(async () => {
	if (video.value && canvas.value) {
		ctx.value = canvas.value.getContext('2d');
		await navigator.mediaDevices
			.getUserMedia(constraints.value)
			.then(SetStream)
			.catch(e => {
				console.error(e);
			})
	}
});

function SetStream (stream) {
	video.value.srcObject = stream;
	video.value.play();

	requestAnimationFrame(Draw);
}

function Draw() {
	ctx.value.drawImage(video.value, 0, 0, canvas.value.width, canvas.value.height);

	requestAnimationFrame(Draw);
}
</script>
