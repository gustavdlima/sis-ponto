<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registro>
 */
class RegistroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'primeiro_ponto' => $this->faker->date,
            'segundo_ponto' => $this->faker->date,
            'terceiro_ponto' => $this->faker->date,
            'quarto_ponto' => $this->faker->date
        ];
    }
}
