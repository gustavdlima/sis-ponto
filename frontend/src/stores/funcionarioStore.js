import { defineStore } from 'pinia'

export const useFuncionarioStore = defineStore('funcionarios', {
	// state
	state: () => {
		return {
			funcionario: [{
				nivel: Number,
			}]
		}
	},

	// actions
	actions: {
		addFuncionarioNivel(nivel) {
			this.funcionario[0].nivel = nivel;
			console.log(this.funcionario);
		}
	},

	// getters
	getters: {
		getFuncionarios() {
			return this.funcionario
		},
	},
})
