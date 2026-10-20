<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/login', [DashboardController::class, 'login']);
Route::get('/mitra-perawatan', [DashboardController::class, 'mitraPerawatan']);
Route::get('/lokasi', [DashboardController::class, 'lokasi']);
Route::get('/kontak', [DashboardController::class, 'kontak']);
Route::get('/jenis-layanan', [DashboardController::class, 'jenisLayanan']);

Route::post('/simpan-akun', [DashboardController::class, 'store']);
Route::get('/hapus/{id}', [DashboardController::class, 'destroy']);