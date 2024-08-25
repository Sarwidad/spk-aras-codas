<?php

namespace Database\Factories;

use App\Models\Alternatif;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlternatifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar nama-nama kelurahan di Pontianak
        $kelurahan = [
            'Dalam Pagar',
            'Dipati Ukur',
            'Pahlawan',
            'Kapuas Dalam',
            'Tengah',
            'Siantan Tengah',
            'Siantan Hilir',
            'Siantan Hulu',
            'Siantan Timur',
            'Sungai Jawi',
            'Sungai Raya',
            'Sungai Bangkong',
            'Sungai Duri Utara',
            'Sungai Duri Selatan',
            'Sungai Kuning',
            'Sungai Pinang',
            'Sungai Antu',
            'Sungai Raya Dalam',
            'Sungai Siam',
            'Sungai Batu',
            'Sungai Arang',
            'Sungai Jawi Laut',
            'Sungai Nibung',
            'Sungai Bawang',
            'Sungai Kakap',
            'Sungai Petani',
            'Sungai Bunga',
            'Sungai Putri',
            'Sungai Bakau',
        ];

        return [
            'nama' => $this->faker->unique()->randomElement($kelurahan),
        ];
    }
}
