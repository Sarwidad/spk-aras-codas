<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama', 'bobot', 'jenis'
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'kriteria_id');
    }

    public function alternatifs()
    {
        return $this->belongsToMany(Alternatif::class, 'penilaians', 'kriteria_id', 'alternatif_id')
                    ->withPivot('nilai');
    }
}
