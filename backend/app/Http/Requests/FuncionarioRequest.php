<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'setor' => 'required|string',
            'matricula' => 'required|string',
            'data_nascimento' => 'required|date',
            'rg' => 'required|string',
            'cpf' => 'required|string',
            'pis_pasep' => 'required|string',
            'titulo_eleitor' => 'required|string',
            'mae' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'sexo' => 'required|string|max:255',
            'deficiente' => 'required|string|max:255',
            'carga_horaria' => 'required|string|max:255',
            'id_cargo' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'setor.required' => 'O campo setor é obrigatório.',
            'matricula.required' => 'O campo matrícula é obrigatório.',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'rg.required' => 'O campo RG é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'pis_pasep.required' => 'O campo PIS/PASEP é obrigatório.',
            'titulo_eleitor.required' => 'O campo título de eleitor é obrigatório.',
            'mae.required' => 'O campo mãe é obrigatório.',
            'bairro.required' => 'O campo bairro é obrigatório.',
            'rua.required' => 'O campo rua é obrigatório.',
            'numero.required' => 'O campo número é obrigatório.',
            'cidade.required' => 'O campo cidade é obrigatório.',
            'uf.required' => 'O campo UF é obrigatório.',
            'cep.required' => 'O campo CEP é obrigatório.',
            'estado_civil.required' => 'O campo estado civil é obrigatório.',
            'celular.required' => 'O campo celular é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'sexo.required' => 'O campo sexo é obrigatório.',
            'deficiente.required' => 'O campo deficiente é obrigatório.',
        ];
    }
}
