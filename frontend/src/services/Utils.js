

class Utils {
	async startCountdown(tempoRestante) {
		for (let i = 2; i >= 0; i--) {
			tempoRestante = i;
			await this.sleep(1000);
		}
	};

	sleep(ms) {
		return new Promise(resolve => setTimeout(resolve, ms));
	}

	formatarData(data) {
		const dataFormatada = new Date(data);
		const dia = dataFormatada.getDate().toString().padStart(2, '0');
		const mes = (dataFormatada.getMonth() + 1).toString().padStart(2, '0');
		const ano = dataFormatada.getFullYear();
		const dataFinal = `${mes}-${dia}-${ano}`;
		return dataFinal;
	}
}

export default new Utils();
