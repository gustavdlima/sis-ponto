import axios from "axios";
import { useAuthStore } from "../stores/AuthStore";

const authStore = useAuthStore();

class EditarService {
  constructor() {
    this.funcionarioURL = "http://localhost:8000/api/funcionarios/";
    this.horarioURL = "http://localhost:8000/api/horarios/";
    this.cargoURL = "http://localhost:8000/api/cargos/";
    this.justificativaURL = "http://localhost:8000/api/justificativas/";
    this.operadorURL = "http://localhost:8000/api/users/";
  }

  async editarOperador(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.listarFuncionarioURL + data.id);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }
}

export default new EditarService();