<template>
  <div class="container d-flex justify-content-center">
    <form name="login-form">
      <div class="row">
        <div class="row-md-1 row-sm-12 d-flex justify-content-center">
          <input type="text" id="email" placeholder="email" class="w-50 mt-2 text-white border-white form-control"
            style="background-color: rgba(255, 255, 255, 0);" v-model="input.email" />
        </div>
        <div class="row-md-1 row-sm-12 d-flex justify-content-center">
          <input type="text" id="password" class="w-50 mt-3 text-white border-white form-control" placeholder="senha"
            style="background-color: rgba(255, 255, 255, 0);" v-model="input.password" />
        </div>
      </div>
      <div class="row-md-1 row-sm-12 d-flex justify-content-center">
        <button type="submit"
          class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white"
          v-on:click.prevent="login()">Entrar como Administrador</button>
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
        email: "",
        password: "",
      },
    }
  },
  methods: {
    login() {
      if (this.input.email != "" || this.input.password != "") {
        this.$http.post('http://localhost:8000/api/login', this.input).then((response)=> {
          this.$router.push({ path: '/admin' });
        })
      } else {
        console.log("Complete os campos de obrigatórios")
      }
    },

    addFuncionarioToStore() {
      console.log(funcionarioStore);
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
