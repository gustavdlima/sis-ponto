<template>
	<Dialog v-model:visible="dialogVisivel" modal header=" " :style="{ width: '20rem', height: '10rem' }">
		<div class="grid justify-center text-xl">
			{{ conteudoPropsDialog.dialogMensagem }}
		</div>
	</Dialog>
</template>

<script setup>
import { defineProps, ref, watch } from 'vue';
import Dialog from 'primevue/dialog';

const props = defineProps({
	conteudoPropsDialog: Object
});

const dialogVisivel = ref(false);

watch(props, (newValue) => {
	dialogVisivel.value = newValue.conteudoPropsDialog.dialogVisivel;
});
</script>
