<template>
  <router-link to="/">Home</router-link>
  <form name="login-form">
    <div class="mb-3">
      <label for="matricula">Matricula</label>
      <input type="text" id="matricula" v-model="input.matricula" />
    </div>
    <div class="mb-3">
      <label for="dataNascimento">Data de Nascimento</label>
      <input type="text" id="dataNascimento" v-model="input.data_nascimento" />
    </div>
    <button type="submit" v-on:click.prevent="login()">
      Login
    </button>
  </form>
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
            if(response.data.length) {
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

