<script>
  export default {
    name: 'Login',
    data(){
      return {
        input: {
          matricula: "",
          dataNascimento: ""
        }
      }
    },
    methods: {
      login() {
        if (this.input.matricula != "" || this.input.dataNascimento != "") {
          console.log("Autenticado")
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
      <input type="text" id="matricula" v-model="input.matricula"/>
    </div>
    <div class="mb-3">
      <label for="dataNascimento">Data de Nascimento</label>
      <input type="date" id="dataNascimento" v-model="input.dataNascimento"/>
    </div>
    <button type="submit" v-on:click.prevent="login()">
      Login
    </button>
    <p>Matricula is: {{input.matricula}}</p>
    <p>Data de Nascimento is: {{input.dataNascimento}}</p>
  </form>
</template>
