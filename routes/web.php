<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\WaliKelasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/pembayaran/invoice/{id}', [PembayaranController::class, 'showInvoice'])->name('pembayaran.invoice');
    Route::get('/penarikan/invoice/{id}', [PenarikanController::class, 'showInvoice'])->name('penarikan.invoice');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/siswa/history', [SiswaController::class, 'history'])->name('siswa.history');
    Route::get('/admin/history/siswa', [DashboardController::class, 'historyAllSiswa'])->name('siswa.historyallsiswa');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('pengguna', PenggunaController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('walas', WaliKelasController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('penarikan', PenarikanController::class);
});
