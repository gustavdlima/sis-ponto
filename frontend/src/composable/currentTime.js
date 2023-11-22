import { ref, onBeforeUnmount } from "vue";

export const useCurrentTime = () => {
	console.log("Data: ", Date());
	// const currentTime = ref(new Date());

	// const updateCurrentTime = () => {
	// 	currentTime.value = new Date();
	// };

	// const updateTimeInverval = setInterval(updateCurrentTime, 1000);
	// onBeforeUnmount(() => {
	// 	clearInterval(updateTimeInterval);
	// })

	// return {
	// 	currentTime,
	// }
}
