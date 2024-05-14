<template>
	<Dialog  v-model:visible="dialogBool"
	modal
	:pt="{
        root: 'border-none',
        mask: {
            style: 'backdrop-filter: blur(2px)'
        }
    }"
	:style="{ width: '50rem', height: '40rem' }"
	:breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
	<template #container>
		<div class="grid justify-center mt-4">
			<div class="grid justify-center">
				<video :srcObject="stream" autoplay></video>
			</div>
		</div>
	</template>
	</Dialog>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Dialog from 'primevue/dialog';

const dialogBool = ref(true);
const stream = ref(null);
 
async function iniciarCamera() {
	const constrains = {
		video: {
			width: 1280,
			height: 720,
		},
		audio: false,
	};
	try {
		stream.value = await navigator.mediaDevices.getUserMedia(constrains);
	} catch (error) {
		console.error(error);
	}
};

onMounted(() => iniciarCamera());
</script>
