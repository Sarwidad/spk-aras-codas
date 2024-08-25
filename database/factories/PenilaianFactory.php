<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penilaian>
 */
class PenilaianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alternatif_id' => $this->faker->numberBetween(1, 29),
            'kriteria_id' => $this->faker->numberBetween(1, 5), 
            'nilai' => $this->faker->numberBetween(1, 5),

        ];
    }
}
