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

Route::get('/', function () {
    return view('landing');
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
});

require __DIR__.'/auth.php';
