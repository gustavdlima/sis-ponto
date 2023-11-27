<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Horario>
 */
class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'horario_entrada' => $this->faker->time,
            'horario_ida_intervalo' => $this->faker->time,
            'horario_volta_intervalo' => $this->faker->time,
            'horario_saida' => $this->faker->time
        ];
    }
}
