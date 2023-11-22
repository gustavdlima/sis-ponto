<script>
  export default {
    name: 'Login',
    data(){
      return {
        input: {
          username: "",
          password: ""
        }
      }
    },
    methods: {
      login() {
        if (this.input.username != "" || this.input.password != "") {
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
      <label for="username">Username</label>
      <input type="text" id="username" v-model="input.username"/>
    </div>
    <div class="mb-3">
      <label for="password">Password</label>
      <input type="password" id="password" v-model="input.password"/>
    </div>
    <button type="submit" v-on:click.prevent="login()">
      Login
    </button>
    <p>Username is: {{input.username}}</p>
    <p>Password is: {{input.password}}</p>
  </form>
</template>
