<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Bisa diakses siapapun tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/mitra-perawatan', [DashboardController::class, 'mitraPerawatan']);
Route::get('/lokasi', [DashboardController::class, 'lokasi']);
Route::get('/kontak', [DashboardController::class, 'kontak']);
Route::get('/jenis-layanan', [DashboardController::class, 'jenisLayanan']);

// Pendaftaran / Simpan Akun Pelanggan Baru
Route::post('/simpan-akun', [DashboardController::class, 'store']);


/*
|--------------------------------------------------------------------------
| 2. RUTE AUTENTIKASI (Khusus Tamu / Belum Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Form Login Pelanggan
    Route::get('/login', [DashboardController::class, 'login'])->name('login');
    
    // Form Login Owner
    Route::get('/login-owner', [DashboardController::class, 'loginOwner'])->name('login.owner');
    
    // Proses Autentikasi Form Submit
    Route::post('/login-process', [DashboardController::class, 'authenticate'])->name('login.process');
});


/*
|--------------------------------------------------------------------------
| 3. RUTE LOGOUT (Khusus Pengguna yang Sudah Login)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [DashboardController::class, 'logout'])->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| 4. RUTE KHUSUS OWNER (Diproteksi Login & Middleware Role Owner)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:owner'])->group(function () {
    // Hapus data pelanggan (hanya boleh dilakukan oleh Owner)
    Route::get('/hapus/{id}', [DashboardController::class, 'destroy'])->name('pelanggan.destroy');
});