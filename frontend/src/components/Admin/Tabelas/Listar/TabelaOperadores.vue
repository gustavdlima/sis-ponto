<template>
		<div class="grid h-full w-full m-auto p-2">
			<div class=" bg-white h-full w-full rounded-lg border-3 p-4">
				<DataTable :value="props.operadores"
				tableStyle="padding: 1rem;"
				paginator :rows="10"
				:rowsPerPageOptions="[10, 20, 30, 50]">
					<Column field="id" header="ID" sortable></Column>
					<Column field="name" header="Nome"></Column>
					<Column field="email" header="Email"></Column>
					<Column field="level" header="Nível"></Column>
				</DataTable>
			</div>
		</div>
</template>

<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const props = defineProps({
	operadores: {
		type: Array,
		required: true
	}
});

</script>
