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
import router from '../router'
import { useFuncionarioStore } from '../stores/funcionarioStore'

export default {
  name: 'Login',
  data() {
    return {
      input: {
        matricula: "",
        data_nascimento: "",
        data_ponto: "",
      },
    }
  },
  methods: {
    login() {
      const currentTime = new Date();

      this.input.data_ponto = currentTime;

      if (this.input.matricula != "" || this.input.data_nascimento != "" || this.input.data_ponto != "") {
        this.$http.post("http://localhost:8000/api/login", this.input)
          .then((response) => {
            if (response.data) {
              if (response.data.length) {
                console.log("User: ", response.data);
                console.log("Current Time: ", currentTime.toLocaleTimeString());
                console.log("Current Date", currentTime.toLocaleDateString());

              } else {
                alert("Matrícula ou Data de Nascimento errada");
              }
            }
          })
          .catch(function (err) {
            console.log(err);
          });
      } else {
        console.log("Complete os campos de obrigatórios")
      }
    },



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
