import axios from "axios";
import { useAuthStore } from "../stores/authStore";

const authStore = useAuthStore();

class AdminLoginService {
  constructor() {
    this.loginURL = "http://localhost:8000/api/login";
    this.logoutURL = "http://localhost:8000/api/logout";
  }

  async login(credenciais) {
    try {
      const response = await axios.post(this.loginURL, credenciais);
      if (response.status === 200) {
        authStore.setAuthUser(response.data.authUser);
        authStore.setUserToken(response.data.token);
        authStore.setUserLogged(true);
      }
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
	  return errorResponse;
    }
  }
}

export default new AdminLoginService();
