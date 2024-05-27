import axios from "axios";
import { useAuthStore } from "../stores/authStore";

const authStore = useAuthStore();

class FormService {
	constructor() {
			this.horarioURL = "http://localhost:8000/api/horarios";
			this.cargoURL = "http://localhost:8000/api/cargos";
		}

		async getHorarios() {
			try {
				const response = await axios.get(this.horarioURL);
				return response;
			} catch (error) {
				const errorResponse = JSON.parse(JSON.stringify(error.response));
				return errorResponse;
			}
		}

		async getCargos() {
			try {
				const response = await axios.get(this.cargoURL);
				return response;
			} catch (error) {
				const errorResponse = JSON.parse(JSON.stringify(error.response));
				return errorResponse;
			}
		}
}

export default new FormService();
