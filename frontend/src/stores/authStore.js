import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
	state: () => ({
			authUser: null,
			token: null
	}),

	getters: {
		user: (state) => state.authUser
	},

	actions: {
		async getToken() {
			// axios.defaults.withCredentials = true;
			// axios.defaults.withXSRFToken = true;
			await axios.get('http://localhost:8000/sanctum/csrf-cookie');
		},

		async getUser() {
			axios.defaults.Authorization = 'Bearer ' + this.token;
			await axios.get('http://localhost:8000/api/user');
		},

		async getFuncionarios() {
			axios.defaults.Authorization = 'Bearer ' + this.token;
			axios.defaults.Accept = 'application/json';
			await axios.get('http://localhost:8000/api/funcionarios').then((response) => {
				console.log(response.data);
				return response.data;
			})
		},

		async login(data) {
			await axios
				.post('http://localhost:8000/api/login', data)
				.then((response) => {
					this.authUser = response.data.authUser;
					this.token = response.data.token;
					localStorage.setItem('Auth', true);
				}).catch((error) => {
					console.log(error)
				})
				this.$router.push({ path: '/admin' });
		},

		async logout() {
			axios.defaults.Authorization = 'Bearer ' + this.token;
			await axios
				.post('http://localhost:8000/api/logout')
				.then((response) => {
					localStorage.removeItem('Auth')
					this.$router.push({ name: 'Login' })
				})
		}


	},

})
