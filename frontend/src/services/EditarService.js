import axios from "axios";
import { useAuthStore } from "../stores/authStore";

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
      const response = await axios.get(this.operadorURL + data.id);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async editarFuncionario(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.put(this.funcionarioURL + data.id, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async editarHorario(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.put(this.horarioURL + data.id, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async editarCargo(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.put(this.cargoURL + data.id, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async editarJustificativa(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.put(this.justificativaURL + data.id, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

}

export default new EditarService();
