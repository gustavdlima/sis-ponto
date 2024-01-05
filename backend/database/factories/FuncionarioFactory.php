<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word,
            'setor' => $this->faker->word,
            'matricula' => $this->faker->word,
            'nivel' => $this->faker->numberBetween(1 , 3),
            'data_nascimento' => $this->faker->date,
            'rg' => $this->faker->word,
            'cpf' => $this->faker->word,
            'pis_pasep' => $this->faker->word,
            'titulo_eleitor' => $this->faker->word,
            'cartao_sus' => $this->faker->word,
            'mae' => $this->faker->word,
            'pai' => $this->faker->word,
            'celular' => $this->faker->word,
            'bairro' => $this->faker->word,
            'rua' => $this->faker->word,
            'numero' => $this->faker->word,
            'cidade' => $this->faker->word,
            'uf' => $this->faker->word,
            'cep' => $this->faker->word,
            'estado_civil' => $this->faker->word,
            'email' => $this->faker->word,
            'id_cargo' => $this->faker->numberBetween(1 , 10),
            'id_horario' => $this->faker->numberBetween(1 , 10),
        ];
    }
}
