import axios from "axios";
import { useAuthStore } from "../stores/authStore";

const authStore = useAuthStore();

class ExcluirService {
	constructor() {
		this.funcionarioURL = "http://localhost:8000/api/funcionarios/";
		this.horarioURL = "http://localhost:8000/api/horarios/";
		this.cargoURL = "http://localhost:8000/api/cargos/";
		this.justificativaURL = "http://localhost:8000/api/justificativas/";
		this.operadorURL = "http://localhost:8000/api/users/";
	}

	async excluirOperador(data) {
		try {
			axios.defaults.headers.common[
				"Authorization"
			] = `Bearer ${authStore.token}`;
			const response = await axios.delete(this.operadorURL + data.id, {data: {id: data.id}});
			return response;
		} catch (error) {
			const errorResponse = JSON.parse(JSON.stringify(error.response));
			return errorResponse;
		}
	}

	async excluirFuncionario(data) {
		try {
			axios.defaults.headers.common[
				"Authorization"
			] = `Bearer ${authStore.token}`;
			const response = await axios.delete(this.funcionarioURL + data.id, {data: {id: data.id}});
			return response;
		} catch (error) {
			const errorResponse = JSON.parse(JSON.stringify(error.response));
			return errorResponse;
		}
	}

	async excluirHorario(data) {
		try {
			axios.defaults.headers.common[
				"Authorization"
			] = `Bearer ${authStore.token}`;
			const response = await axios.delete(this.horarioURL + data.id, {data: {id: data.id}});
			return response;
		} catch (error) {
			const errorResponse = JSON.parse(JSON.stringify(error.response));
			return errorResponse;
		}
	}

	async excluirCargo(data) {
		try {
			axios.defaults.headers.common[
				"Authorization"
			] = `Bearer ${authStore.token}`;
			const response = await axios.delete(this.cargoURL + data.id, {data: {id: data.id}});
			return response;
		} catch (error) {
			const errorResponse = JSON.parse(JSON.stringify(error.response));
			return errorResponse;
		}
	}

	async excluirJustificativa(data) {
		try {
			axios.defaults.headers.common[
				"Authorization"
			] = `Bearer ${authStore.token}`;
			const response = await axios.delete(this.justificativaURL + data.id, {data: {id: data.id}});
			return response;
		} catch (error) {
			const errorResponse = JSON.parse(JSON.stringify(error.response));
			return errorResponse;
		}
	}

}

export default new ExcluirService();
