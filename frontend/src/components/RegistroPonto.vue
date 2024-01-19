<template>
	<div class="container d-flex justify-content-center">
	  <form name="login-form">
		  <div class="row">
			<div class="row-md-1 row-sm-12 d-flex justify-content-center">
			  <input type="text" id="matricula" placeholder="Matricula" class="w-50 mt-2 text-white border-white form-control" style="background-color: rgba(255, 255, 255, 0);" v-model="input.matricula" />
			</div>
			<div class="row-md-1 row-sm-12 d-flex justify-content-center">
			  <input type="text" id="dataNascimento" placeholder="Dt Nascimento Ex. 31/08/1994" class="w-50 mt-3 text-white border-white form-control" style="background-color: rgba(255, 255, 255, 0);"
			  v-model="input.data_nascimento" />
			</div>
		  </div>
		<div class="row-md-1 row-sm-12 d-flex justify-content-center">
		  <button type="submit"
			class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white"
			v-on:click.prevent="login()">Bater Ponto</button>
		</div>
	  </form>
	</div>
  </template>

  <script>
  import { useFuncionarioStore } from '../stores/funcionarioStore';

  const funcionarioStore = useFuncionarioStore();

  export default {
	name: 'Login',
	data() {
	  return {
		input: {
		  matricula: "",
		  data_nascimento: "",
		},
	  }
	},
	methods: {
	  login() {

		if (this.input.matricula != "" || this.input.data_nascimento != "") {

		} else {
		  console.log("Complete os campos de obrigatórios")
		}
	  },

	  addFuncionarioToStore() {
		console.log(funcionarioStore);
	  },

	  onClick() {
		alert("Ponto batido!");
	  }


	},
  }
  </script>

  <style scoped>

  input[type="text"]::-webkit-input-placeholder {
	color: rgba(255, 255, 255, 0.648);
  }

  button:hover {
	background-color: rgb(0, 140, 255);
  }
  </style>
