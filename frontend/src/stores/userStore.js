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

		setUserLevel(Level) {
			this.level = Level;
		},

		setUserName(name) {
			this.name = name;
		},

		setUserEmail(email) {
			this.email = email;
		},

		setUserToken(userToken) {
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

		getUserRememberToken() {
			return this.token
		},
	},

})
