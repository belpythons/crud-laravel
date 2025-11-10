<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard → redirect ke mahasiswa (opsional)
Route::get('/dashboard', function () {
    return redirect()->route('mahasiswa.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua route yang butuh login
Route::middleware('auth')->group(function () {

    // ROUTE MAHASISWA (CRUD)
    Route::resource('mahasiswa', MahasiswaController::class);

    // EXPORT PDF
    Route::get('/mahasiswa-pdf', [MahasiswaController::class, 'cetakPDF'])
        ->name('mahasiswa.cetakPDF');

    // EXPORT EXCEL
    Route::get('/mahasiswa-excel', [MahasiswaController::class, 'exportExcel'])
        ->name('mahasiswa.exportExcel');

    // PROFILE (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
