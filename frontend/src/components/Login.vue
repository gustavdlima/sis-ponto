<template>
  <div class="container d-flex justify-content-center">
    <form name="login-form">
      <div class="row">
        <div class="row-md-1 row-sm-12 d-flex justify-content-center">
          <input type="text" id="email" placeholder="email" class="w-50 mt-2 text-white border-white form-control"
            style="background-color: rgba(255, 255, 255, 0);" v-model="user.email" />
        </div>
        <div class="row-md-1 row-sm-12 d-flex justify-content-center">
          <input type="password" id="password" class="w-50 mt-3 text-white border-white form-control" placeholder="senha"
            style="background-color: rgba(255, 255, 255, 0);" v-model="user.password" />
        </div>
      </div>
      <div class="row-md-1 row-sm-12 d-flex justify-content-center">
        <button type="submit"
          class="row-4 row-sm-2 row-md-2 btn m-3 d-flex justify-content-center text-white border-white font-weight-bold"
          v-on:click.prevent="authStore.login(user)">Entrar como Administrador
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore';
import { onMounted, ref } from 'vue';

const authStore = useAuthStore();

const user = ref({
  email: "",
  password: "",
});

</script>

<style scoped>
input[type="text"],::-webkit-input-placeholder {
  color: rgba(231, 228, 228, 0.836);
}

button:hover {
  background-color: rgb(0, 140, 255);
}
</style>
