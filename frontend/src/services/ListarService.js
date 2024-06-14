import axios from "axios";
import { useAuthStore } from "../stores/authStore";

const authStore = useAuthStore();

class ListarService {
  constructor() {
    this.listarFuncionarioURL = "http://localhost:8000/api/funcionarios";
    this.registroFuncionarioURL =
      "http://localhost:8000/api/registroFuncionario";
    this.relatorioMensalURL = "http://localhost:8000/api/relatorio";
    this.listarOperadorURL = "http://localhost:8000/api/users";
    this.listarHorarioURL = "http://localhost:8000/api/horarios";
    this.listarCargoURL = "http://localhost:8000/api/cargos";
    this.listarJustificativaURL = "http://localhost:8000/api/justificativas";
    this.horarioURL = "http://localhost:8000/api/horarios";
    this.cargoURL = "http://localhost:8000/api/cargos";
    this.justificarFaltaURL = "http://localhost:8000/api/faltas";
  }

  async listarFuncionarios() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.listarFuncionarioURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async listarOperadores() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.listarOperadorURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async listarHorarios() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.listarHorarioURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async listarCargos() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.listarCargoURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async listarJustificativas() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.listarJustificativaURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async registroFuncionario(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.post(this.registroFuncionarioURL, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async relatorioMensal(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.post(this.relatorioMensalURL, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }

  async justificativas() {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.get(this.listarJustificativaURL);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }
  async registrarFalta(data) {
    try {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${authStore.token}`;
      const response = await axios.post(this.justificarFaltaURL, data);
      return response;
    } catch (error) {
      const errorResponse = JSON.parse(JSON.stringify(error.response));
      return errorResponse;
    }
  }
}

export default new ListarService();
