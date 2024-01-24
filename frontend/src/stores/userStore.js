import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
	// state
	state: () => ({
		level: "",
		name: "",
		email: "",
		token: "",
	}),

	// actions
	actions: {
		async setUserLevel(Level) {
			this.level = Level;
		},

		async setUserName(name) {
			this.name = name;
		},

		async setUserEmail(email) {
			this.email = email;
		},

		async setUserToken(userToken) {
			this.token = userToken;
		}
	},

	// getters
	getters: {
		getUser() {
			const user = [
				this.level,
				this.name,
				this.email,
				this.token
			];

			return user
		},

		getUserLevel() {
			return this.level
		},

		getUserName() {
			return this.name
		},

		getUserEmail() {
			return this.email
		},

		getUserToken() {
			return this.token
		}
	},

})
