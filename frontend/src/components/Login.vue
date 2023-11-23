<script>
  export default {
    name: 'Login',
    data(){
      return {
        input: {
          registration: "",
          birthDate: ""
        }
      }
    },
    methods: {
      login() {
        if (this.input.registration != "" || this.input.birthDate != "") {
          console.log("Autenticado")
        } else {
          console.log("Complete os campos de obrigatórios")
        }
      }
    }
}
</script>

<template>
  <form name="login-form">
    <div class="mb-3">
      <label for="registration" ></label>
      <input type="text" id="registration" placeholder="Matrícula" v-model="input.registration"/>
    </div>
    <div class="mb-3">
      <label for="birthDate"></label>
      <input type="birthDate" id="birthDate" placeholder="Data de Nascimento" v-model="input.birthDate"/>
    </div>
    <button type="submit" v-on:click.prevent="login()">
      Registrar
    </button>
  </form>
</template>
