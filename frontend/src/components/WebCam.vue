<template>
	<h1>WebCam Component</h1>
	<div>
		<video ref="video" autoplay playsinline webkit-playsinline muted hidden></video>
		<canvas ref="canvas" width="480" height="320"></canvas>

		<div>
			<button @click="TakePicture()">Tirar foto</button>
		</div>
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

	//The requestAnimationFrame() method tells the browser to call an animation function and repeat it very fast, forever.
	requestAnimationFrame(Draw);
}

function Draw() {
	ctx.value.drawImage(video.value, 0, 0, canvas.value.width, canvas.value.height);

	requestAnimationFrame(Draw);
}

function TakePicture() {
	var link = document.createElement('a');
	link.download = 'foto.png';
	link.href = canvas.value.toDataURL();
	link.click();
	console.log("TIRAMO FOTO");
}
</script>
