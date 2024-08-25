<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data users, kriteria, dan alternatif
        $jumlahUsers = User::count();
        $jumlahKriteria = Kriteria::count();
        $jumlahAlternatif = Alternatif::count();
        $jumlahPenilaian = Penilaian::count();

        // Mengirim data ke view dashboard
        return view('dashboard', [
            'jumlahUsers' => $jumlahUsers,
            'jumlahKriteria' => $jumlahKriteria,
            'jumlahAlternatif' => $jumlahAlternatif,
            'jumlahPenilaian' => $jumlahPenilaian,
        ]);
    }
}
