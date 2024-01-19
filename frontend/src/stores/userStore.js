import { defineStore } from 'pinia'

export const useUserStore = defineStore('users', {
	// state
	state: () => ({
		level: Number,
		name: String,
		email: String,
		remember_token: String,
	}),

	// actions
	actions: {
		setUser(user) {
			this.user = user
		},

		setUserLevel(Level) {
			this.user[0].Level = Level;
			console.log(this.user);
		},

		setUserName(name) {
			this.user[0].name = name;
			console.log(this.user);
		},

		setUserEmail(email) {
			this.user[0].email = email;
			console.log(this.user);
		},

		setUserRememberToken(remember_token) {
			this.user[0].remember_token = remember_token;
			console.log(this.user);
		}
	},

	// getters
	getters: {
		getUser() {
			return this.user
		},

		getUserLevel() {
			return this.user[0].level
		},

		getUserName() {
			return this.user[0].name
		},

		getUserEmail() {
			return this.user[0].email
		},

		getUserRememberToken() {
			return this.user[0].remember_token
		},
	},

})
