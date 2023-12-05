<script>
export default {
  name: 'Login',
  data() {
    return {
      input: {
        matricula: "",
        data_nascimento: ""
      }
    }
  },
  methods: {
    login() {
      if (this.input.matricula != "" || this.input.data_nascimento != "") {
        console.log("Autenticado")
        console.log(this.input.matricula)
        console.log(this.input.data_nascimento)
        this.$http.post("http://localhost:8000/api/login", this.input)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error.response.data);
          });
      } else {
        console.log("Complete os campos de obrigatórios")
      }
    }
  }
}
</script>

<template>
  <router-link to="/">Home</router-link>
  <form name="login-form">
    <div class="mb-3">
      <label for="matricula">Matricula</label>
      <input type="text" id="matricula" v-model="input.matricula" />
    </div>
    <div class="mb-3">
      <label for="dataNascimento">Data de Nascimento</label>
      <input type="date" id="dataNascimento" v-model="input.data_nascimento" />
    </div>
    <button type="submit" v-on:click.prevent="login()">
      Login
    </button>
    <p>Matricula is: {{ input.matricula }}</p>
    <p>Data de Nascimento is: {{ input.data_nascimento }}</p>
  </form>
</template>
