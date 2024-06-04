import axios from "axios";
import { useAuthStore } from "../stores/authStore";

const authStore = useAuthStore();

class ListarService {
	constructor() {
		this.listarFuncionarioURL = "http://localhost:8000/api/funcionarios";
		this.listarOperadorURL = "http://localhost:8000/api/users";
		this.listarHorarioURL = "http://localhost:8000/api/horarios";
		this.listarCargoURL = "http://localhost:8000/api/cargos";
		this.listarJustificativaURL = "http://localhost:8000/api/justificativas";
		this.horarioURL = "http://localhost:8000/api/horarios";
		this.cargoURL = "http://localhost:8000/api/cargos";
	}

	async listarFuncionarios() {
		try {
			axios.defaults.headers.common
				["Authorization"] = `Bearer ${authStore.token}`;
			const response = await axios.get(this.listarFuncionarioURL);
			return response;
		} catch (error) {
			const errorResponse = JSON.parse(JSON.stringify(error.response));
			return errorResponse;
		}
	}
}


export default new ListarService();
