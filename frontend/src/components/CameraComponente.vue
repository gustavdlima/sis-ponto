<template>
	<div class="d-flex justify-content-center">
		<div hidden>
			<video :srcObject="stream" width="330" height="250" autoplay></video>
		</div>
		<div class="m-1 mt-3">
			<img class="rounded-5" :src="capturedImage" alt="Captured Image" style="width: 330px; height: 250px;" />
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const stream = ref(null);
const capturedImage = ref(null);

const tirarFoto = async () => {
	if (stream.value) {
		const tracks = stream.value.getTracks();
		const imageCapture = new ImageCapture(tracks[0]);
		const capturedImageBlob = await imageCapture.takePhoto();
		capturedImage.value = URL.createObjectURL(capturedImageBlob);

		// Optional: Clean up tracks after capturing the image
		tracks.forEach(track => track.stop());
	} else {
		console.error('Câmera não disponível.');
	}
};

const iniciarCamera = async () => {
	const frontCamStream = await navigator.mediaDevices.getUserMedia({
		audio: false,
		video: {
			width: { min: 1024, ideal: 1280, max: 1920 },
			height: { min: 300, ideal: 720, max: 1080 },
			facingMode: 'environment',
		},
	});
	console.log('Streaming', frontCamStream);
	stream.value = frontCamStream;
	tirarFoto();
};

onMounted(() => iniciarCamera());
onBeforeUnmount(() => {
	if (stream.value) {
		stream.value.getTracks().forEach(track => track.stop());
	}
});
</script>
