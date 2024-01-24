import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
	state: () => ({
			authUser: null
	}),

	getters: {
		user: (state) => state.authUser
	},

	actions: {
		async getToken() {
			await axios.get('http://localhost:8000/sanctum/csrf-cookie');
		},

		async getUser() {
			this.getToken();
			await axios.get('http://localhost:8000/api/user').then((response) => {
				this.authUser = response.data
			})
		},

		async login(data) {
			this.getToken();
			await axios
				.post('http://localhost:8000/api/login', data)
				.then((response) => {
					this.authUser = response.data
					localStorage.setItem('Auth', true)
					this.$router.push({ name: 'Admin' })
				}).catch((error) => {
					console.log(error)
				})
		},

		async logout() {
			await axios
				.post('http://localhost:8000/api/logout')
				.then((response) => {
					localStorage.removeItem('Auth')
					this.$router.push({ name: 'Login' })
				})
		}


	},

})
