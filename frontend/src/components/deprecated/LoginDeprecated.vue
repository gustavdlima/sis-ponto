<template>
  <div class="container d-flex justify-content-center">
    <form name="login-form">
      <div class="row">
        <div class="row-md-1 row-sm-12 d-flex justify-content-center">
          <input  type="text" id="email" placeholder="email" class="w-50 mt-2 text-white border-white form-control"
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
          v-on:click.prevent="login()">Entrar como Administrador
        </button>
      </div>

      <v-dialog v-model="loginSucesso" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Sucesso!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="loginSucesso = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="campoVazio" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="campoVazio = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

      <v-dialog v-model="erroSistema" max-width="300">
				<v-card>
					<v-card-title class="headline font-weight-bold">Erro!</v-card-title>
					<v-card-text class="text-center">
						{{ errorMessage }}
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" text @click="erroSistema = false">Fechar</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>


    </form>
  </div>
</template>

<script setup>
import { useAuthStore } from '../stores/authStore';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';


const router = useRouter();
const authStore = useAuthStore();
var loginSucesso = ref(false);
var erroSistema = ref(false);
var campoVazio = ref(false);
var errorMessage = ref("");

const user = ref({
  email: "",
  password: "",
});

async function login() {
  try {
    if (user.value.email == "" || user.value.password == "") {
      campoVazio.value = true
      errorMessage.value = "Preencha todos os campos"
    } else {
      await axios
            .post('http://localhost:8000/api/login', user.value)
            .then((response) => {
              console.log(response.data);
              const responseData = JSON.stringify(response.data);
              if (responseData.indexOf("sucesso") !== -1) {
                authStore.setAuthUser(response.data.authUser);
                authStore.setUserToken(response.data.token);
                authStore.setUserLogged(true);
                loginSucesso.value = true
                errorMessage.value = "Login efetuado com sucesso"
                router.push({ name: 'Admin' });
                clearForm();
              } else {
                erroSistema.value = true
                errorMessage.value = "Dados de login inválidos"
              }
            }).catch((error) => {
              erroSistema.value = true
              errorMessage.value = "Erro ao efetuar login"
            })
          }
        } catch (error) {
          erroSistema.value = true
          errorMessage.value = "Erro ao efetuar login"
  }
}

function clearForm() {
  user.value.email = "";
  user.value.password = "";
}

</script>

<style scoped>
input[type="text"],
::-webkit-input-placeholder {
  color: rgba(231, 228, 228, 0.836);
}

button:hover {
  background-color: rgb(0, 140, 255);
}
</style>
