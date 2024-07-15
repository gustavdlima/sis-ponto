import axios from "axios";

class RegistroPonto {
  constructor() {
    this.registrarPontoURL = "http://localhost:8000/api/ponto";
    this.getPontoDoDiaURL = "http://localhost:8000/api/registroDoDia";
  }

  async registrarPonto(matricula) {
    try {
      const response = await axios.post(this.registrarPontoURL, matricula);
      return response;
    } catch (error) {
      return error.response.data;
    }
  }

  async getPontoDoDia(matricula) {
    try {
      const response = await axios.post(this.getPontoDoDiaURL, matricula);
      return response;
    } catch (error) {
      return error.response.data;
    }
  }
}

export default new RegistroPonto();
