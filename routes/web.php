<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('mahasiswa/pdf', [MahasiswaController::class, 'generatePDF'])->name('mahasiswa.pdf');
Route::resource('mahasiswa', MahasiswaController::class);
