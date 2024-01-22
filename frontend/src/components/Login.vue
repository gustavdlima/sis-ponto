<template>
  <div class="container d-flex justify-content-center">
    <form name="login-form">
      <div class="row">
        <div class="row-md-1 row-sm-12 d-flex justify-content-center">
          <input type="text" id="email" placeholder="email" class="w-50 mt-2 text-white border-white form-control"
            style="background-color: rgba(255, 255, 255, 0);" v-model="user.email" />
        </div>
        <div class="row-md-1 row-sm-12 d-flex justify-content-center">
          <input type="text" id="password" class="w-50 mt-3 text-white border-white form-control" placeholder="senha"
            style="background-color: rgba(255, 255, 255, 0);" v-model="user.password" />
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

<script setup>
import { useUserStore } from '../stores/userStore';
import { ref } from 'vue';
import axios from 'axios';

const user = ref(
  {
    email: "",
    password: "",
  }
);

const teste = ref('');
// const password = ref('');
const userStore = useUserStore();

async function login() {
  if (user.value.email != "" || user.value.password != "") {
      await axios.post('http://localhost:8000/api/login', user.value).then((response) => {
            userStore.setUserEmail(response.data.user.email);
            userStore.setUserLevel(response.data.user.level);
            userStore.setUserToken(response.data.token);
            userStore.setUserName(response.data.user.name);
            // axios.get('http://localhost:8000/api/users', {headers: { Authorization: `Bearer ${userStore.getUserToken}`, Accept: 'application/json'} }).then((response) => {
            //   console.log(response.data);
            // });

          // this.$router.push({ path: '/admin' });
      })
  } else {
    console.log("Complete os campos de obrigatórios")
  }
}

</script>

<!--
<script>
import { useUserStore } from '../stores/userStore';
import { mapActions } from 'pinia';

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
    ...mapActions(useUserStore, ['setUser']),
    ...mapActions(useUserStore, ['getUser']),

    login() {
      if (this.input.email != "" || this.input.password != "") {
        this.$http.post('http://localhost:8000/api/login', this.input).then((response)=> {
            userStore.setUser(response.data.user);
            console.log(getUser());
          // this.$router.push({ path: '/admin' });
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
</script> -->

<style scoped>
input[type="text"]::-webkit-input-placeholder {
  color: rgba(255, 255, 255, 0.648);
}

button:hover {
  background-color: rgb(0, 140, 255);
}
</style>
