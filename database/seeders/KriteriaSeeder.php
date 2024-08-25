<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            ['nama' => 'Aksesibilitas', 'bobot' => 0.25, 'jenis' => 'Benefit'],
            ['nama' => 'Infrastuktur', 'bobot' => 0.2, 'jenis' => 'Benefit'],
            ['nama' => 'Potensi Bencana', 'bobot' => 0.25, 'jenis' => 'Cost'],
            ['nama' => 'Biaya Hidup', 'bobot' => 0.2, 'jenis' => 'Cost'],
            ['nama' => 'Zonasi Sekolah', 'bobot' => 0.1, 'jenis' => 'Benefit'],
        ];

        foreach ($kriteria as $data) {
            Kriteria::create([
                'nama' => $data['nama'],
                'bobot' => $data['bobot'],
                'jenis' => $data['jenis'],
            ]);
        }
    }
}
