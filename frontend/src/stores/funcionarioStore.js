import { defineStore } from 'pinia'

export const useFuncionarioStore = defineStore('funcionarios', {
	// state
	state: () => {
		return {
			funcionarios: [],
		}
	},

	// actions
	actions: {
		setFuncionario(funcionario) {
			console.log("funcionario dentro do pinia: ", funcionario);
			this.funcionarios.push(funcionario)
		}
	},

	// getters
	getters: {
		getFuncionarios() {
			return this.funcionarios
		},
	},
})
