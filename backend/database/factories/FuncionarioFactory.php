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
            'id_horario' => $this->faker->numberBetween(1 , 10),

        ];
    }
}
