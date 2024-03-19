<template>
	<div class="row d-flex justify-content-center">
		<div class="row">
			<video :srcObject="stream" autoplay></video>
		</div>
		<!-- <div class="m-1 mt-3">
			<img class="rounded-5" :src="capturedImage" alt="Captured Image" style="width: 330px; height: 250px;" />
		</div> -->
		<div class="row">
						<div class="row-md-1 row-sm-12 d-flex justify-content-center">
				<button color="teal" type="submit"
					class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white font-weight-bold"
					v-on:click.prevent="tirarFoto()">Registrar Foto</button>
			</div>
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
};

onMounted(() => iniciarCamera());
onBeforeUnmount(() => {
});
</script>
