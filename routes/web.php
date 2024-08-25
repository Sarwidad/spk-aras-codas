<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\ArasController;
use App\Http\Controllers\CodasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UjiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('landing');
});

Route::get('/content', function () {
    return view('content');
})->middleware(['auth', 'verified'])->name('content');

Route::middleware('auth')->group(function () {
    // Route untuk Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboardAsli', function () {
        return view('dashboardAsli');
    })->name('dashboardAsli');

    // Route untuk Kriteria
    Route::get('/kriteria', function () {
        return view('kriteria');
    })->name('kriteria');

    // Route untuk Alternatif
    Route::get('/alternatif', function () {
        return view('alternatif');
    })->name('alternatif');

    // Route untuk Penilaian
    Route::get('/penilaian', function () {
        return view('penilaian');
    })->name('penilaian');

    // Route untuk ARAS
    Route::get('/aras', function () {
        return view('aras');
    })->name('aras');

    // Route untuk CODAS
    Route::get('/codas', function () {
        return view('codas');
    })->name('codas');

    // Route untuk Uji Sensitivitas
    Route::get('/uji', function () {
        return view('uji');
    })->name('uji');

    // // Route untuk profile
    // Route::get('/profile', function () {
    //     return view('profile');
    // })->name('profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::get('/aras', [ArasController::class, 'index'])->name('aras');
    Route::get('/codas', [CodasController::class, 'index'])->name('codas');
    Route::get('/uji', [UjiController::class, 'index'])->name('uji');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/uji', [UjiController::class, 'adjustAndNormalizeWeights'])->name('uji');
    // Route::get('/uji', [UjiController::class, 'ARAS'])->name('uji');
    // Route::get('/uji', [UjiController::class, 'CODAS'])->name('uji');
    // Route::get('/uji', [UjiController::class, 'calculateArasRanking'])->name('calculateArasRanking');
    // Route::get('/uji', [UjiController::class, 'calculateCodasRanking'])->name('calculateCodasRanking');
});

require __DIR__.'/auth.php';
