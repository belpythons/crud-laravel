<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('mahasiswa/pdf', [MahasiswaController::class, 'generatePDF'])->name('mahasiswa.pdf');
Route::get('mahasiswa/export', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.export');
Route::resource('mahasiswa', MahasiswaController::class);
