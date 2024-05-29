import axios, { formToJSON } from "axios";
import { useAuthStore } from "../stores/authStore";

const authStore = useAuthStore();

class CadastroService {
  constructor() {
    this.cadastroFuncionarioURL = "http://localhost:8000/api/funcionarios";
    this.cadastroOperadorURL = "http://localhost:8000/api/users";
    this.horarioURL = "http://localhost:8000/api/horarios";
    this.cargoURL = "http://localhost:8000/api/cargos";
  }

  async cadastrarFuncionario(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.post(this.cadastroFuncionarioURL, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async cadastrarOperador(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.post(this.cadastroOperadorURL, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async getHorarios() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.horarioURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async getCargos() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.cargoURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }
}

export default new CadastroService();
