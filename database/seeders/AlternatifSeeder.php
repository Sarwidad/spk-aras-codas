<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternatif;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alternatifNames = [
            'Pal Lima', 'Sungai Belung', 'Sungai Jawi Dalam', 'Sungai Jawi Luar',
            'Darat Sekip', 'Mariana', 'Sungai Bangkong', 'Sungai Jawi Tengah',
            'Akcaya', 'Benua Melayu Darat', 'Benua Melayu Laut', 'Kota Baru',
            'Parit Tokaya', 'Bangka Belitung Darat', 'Bangka Belitung Laut',
            'Bansir Darat', 'Bansir Laut', 'Banjar Serasan', 'Dalambugis',
            'Parit Mayor', 'Saigon', 'Tambelan', 'Sampit', 'Tanjung Hulu',
            'Tanjung Hilir', 'Batulayang', 'Siantan Hilir', 'Siantan Hulu',
            'Siantan Tengah',
        ];

        foreach ($alternatifNames as $name) {
            Alternatif::create(['nama' => $name]);
        }
    }
}
