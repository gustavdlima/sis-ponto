import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
	state: () => ({
			authUser: null,
			token: null,
			isLogged: null,
	}),

	getters: {
		user: (state) => state.authUser,
		userToken: (state) => state.token,
		userLogged: (state) => state.isLogged
	},

	actions: {
		async getToken() {
			// axios.defaults.withCredentials = true;
			// axios.defaults.withXSRFToken = true;
			await axios.get('http://localhost:8000/sanctum/csrf-cookie');
		},

		async getUser() {
			const bearerToken = 'Bearer ' + this.userToken;
			axios.defaults.headers.common = {
				'Authorization': bearerToken
			}
			await axios.get('http://localhost:8000/api/user');
		},

		async login(data) {
			await axios
				.post('http://localhost:8000/api/login', data)
				.then((response) => {
					this.authUser = response.data.authUser;
					this.token = response.data.token;
					this.isLogged = true;
					console.log(response.data);
					localStorage.setItem('Auth', true);
				}).catch((error) => {
					console.log(error)
				})
				this.$router.push({ path: '/admin' });
		},

		async logout() {
			const bearerToken = 'Bearer ' + this.userToken;
			axios.defaults.headers.common = {
				'Authorization': bearerToken
			}
			await axios
				.post('http://localhost:8000/api/logout')
				.then((response) => {
					this.isLogged = false;
					this.$router.push({ name: 'Login' })
				})
		}

	},

})
