<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
            'id_funcionario' => 'required|integer|exists:funcionarios,id',
            'id_horario' => 'nullable|integer|exists:horarios,id',
            'id_falta' => 'string|exists:faltas,id|nullable',
            'data' => 'required|string',
            'primeiro_ponto' => 'string|nullable',
            'segundo_ponto' => 'string|nullable',
            'terceiro_ponto' => 'string|nullable',
            'quarto_ponto' => 'string|nullable',
            'atrasou_primeiro_ponto' => 'string|nullable',
            'atrasou_segundo_ponto' => 'string|nullable',
            'atrasou_terceiro_ponto' => 'string|nullable',
            'atrasou_quarto_ponto' => 'string|nullable',
        ];
    }
}
