<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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

// START: Login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/store-login', [AuthController::class, 'storeLogin'])->name('store-login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// END: Login

// START: Scan QR Code untuk melihat data barang di setiap ruangan
Route::get('/scan-qrcode/{ruangan}', [UsersController::class, 'view_scanQRCode'])->name('scan-qrcode');
// END: Scan QR Code untuk melihat data barang di setiap ruangan

// START: Route Admin && Operator
Route::middleware(['auth', 'checkRole:0,1'])->group(function () {
    // START: Dashboard
    Route::get('/dashboard', [UsersController::class, 'view_dashboard'])->name('dashboard');
    // END: Dashboard

    // START: Profile
    Route::get('/profile/{users}', [UsersController::class, 'view_profile'])->name('profile');
    Route::post('/store-profile/{users}', [UsersController::class, 'storeProfile'])->name('store-profile');
    Route::get('/destroy-foto-profile/{users}', [UsersController::class, 'destroyFotoProfile'])->name('destroy-foto-profile');
    Route::get('/ganti-password/{users}', [UsersController::class, 'view_gantiPassword'])->name('ganti-password');
    Route::post('/store-ganti-password/{users}', [UsersController::class, 'storeGantiPassword'])->name('store-ganti-password');
    // END: Profile

    // START: Laporan
    Route::get('/laporan-barang/{ruangan}', [UsersController::class, 'view_laporanBarang'])->name('laporan-barang');
    Route::get('/print/{ruangan}', [UsersController::class, 'print'])->name('print');
    // END: Laporan

    // START: Kelola ruangan
    Route::get('/kelola-ruangan', [UsersController::class, 'view_kelolaRuangan'])->name('kelola-ruangan');
    // END: Kelola ruangan

    // START: Kelola barang
    Route::get('/kelola-barang/{ruangan}', [UsersController::class, 'view_kelolaBarang'])->name('kelola-barang');
    // END: Kelola barang
});
// END: Route Admin && Operator

// START: Route Admin
Route::middleware(['auth', 'checkRole:0'])->group(function () {
    // START: Manajemen pengguna
    Route::get('/pengguna', [UsersController::class, 'view_pengguna'])->name('pengguna');
    Route::get('/tambah-pengguna', [UsersController::class, 'view_tambahPengguna'])->name('tambah-pengguna');
    Route::post('/store-pengguna', [UsersController::class, 'storePengguna'])->name('store-pengguna');
    Route::get('/destroy-pengguna/{users}', [UsersController::class, 'destroyPengguna'])->name('destroy-pengguna');
    Route::get('/destroy-semua-pengguna', [UsersController::class, 'destroySemuaPengguna'])->name('destroy-semua-pengguna');
    Route::get('/tong-sampah/pengguna', [UsersController::class, 'view_tongSampahPengguna'])->name('tong-sampah-pengguna');
    Route::get('/pulihkan-pengguna/{id?}/{img?}', [UsersController::class, 'pulihkanPengguna'])->name('pulihkan-pengguna');
    Route::get('/hapus-permanen-pengguna/{id?}/{img?}', [UsersController::class, 'hapusPermanenPengguna'])->name('hapus-permanen-pengguna');
    // END: Manajemen pengguna
});
// END: Route Admin

// START: Route Operator
Route::middleware(['auth', 'checkRole:1'])->group(function () {
    // START: Kelola Ruangan
    Route::get('/tambah-ruangan', [UsersController::class, 'view_tambahRuangan'])->name('tambah-ruangan');
    Route::post('/store-ruangan', [UsersController::class, 'storeRuangan'])->name('store-ruangan');
    Route::get('/destroy-ruangan/{ruangan}', [UsersController::class, 'destroyRuangan'])->name('destroy-ruangan');
    Route::get('/destroy-foto-ruangan/{ruangan}', [UsersController::class, 'destroyFotoRuangan'])->name('destroy-foto-ruangan');
    Route::get('/destroy-semua-ruangan', [UsersController::class, 'destroySemuaRuangan'])->name('destroy-semua-ruangan');
    Route::get('/edit-ruangan/{ruangan}', [UsersController::class, 'view_editRuangan'])->name('edit-ruangan');
    Route::post('/store-edit-ruangan/{ruangan}', [UsersController::class, 'storeEditRuangan'])->name('store-edit-ruangan');
    Route::get('/tong-sampah/ruangan', [UsersController::class, 'view_tongSampahRuangan'])->name('tong-sampah-ruangan');
    Route::get('/pulihkan-ruangan/{id?}/{img?}', [UsersController::class, 'pulihkanRuangan'])->name('pulihkan-ruangan');
    Route::get('/hapus-permanen-ruangan/{id?}/{img?}', [UsersController::class, 'hapusPermanenRuangan'])->name('hapus-permanen-ruangan');
    // END: Kelola Ruangan

    // START: Kelola Barang
    Route::get('/kelola-barang/{ruangan}/{barang}', [UsersController::class, 'view_editBarang'])->name('edit-barang');
    Route::post('/store-edit-barang/{ruangan}/{barang}', [UsersController::class, 'storeEditBarang'])->name(('store-edit-barang'));
    Route::get('/tambah-barang/{ruangan}', [UsersController::class, 'view_tambahBarang'])->name('tambah-barang');
    Route::post('/store-barang/{ruangan}', [UsersController::class, 'storeBarang'])->name('store-barang');
    Route::get('/destroy-barang/{ruangan}/{barang}', [UsersController::class, 'destroyBarang'])->name('destroy-barang');
    Route::get('/destroy-foto-barang/{ruangan}/{barang}', [UsersController::class, 'destroyFotoBarang'])->name('destroy-foto-barang');
    Route::get('/destroy-semua-barang/{ruangan}', [UsersController::class, 'destroySemuaBarang'])->name('destroy-semua-barang');
    Route::get('/tong-sampah/barang/{ruangan}', [UsersController::class, 'view_tongSampahBarang'])->name('tong-sampah-barang');
    Route::get('/pulihkan-barang/{ruangan}/{id?}/{img?}', [UsersController::class, 'pulihkanBarang'])->name('pulihkan-barang');
    Route::get('/hapus-permanen-barang/{ruangan}/{id?}/{img?}', [UsersController::class, 'hapusPermanenBarang'])->name('hapus-permanen-barang');
    // END: Kelola Barang

    // START: Kelola Sumber Dana
    Route::get('/kelola-sumber-dana', [UsersController::class, 'view_kelolaSumberDana'])->name('kelola-sumber-dana');
    Route::get('/destroy-sumber-dana/{sumberDana}', [UsersController::class, 'destroySumberDana'])->name('destroy-sumber-dana');
    Route::get('/destroy-semua-sumber-dana', [UsersController::class, 'destroySemuaSumberDana'])->name('destroy-semua-sumber-dana');
    Route::post('/store-sumber-dana', [UsersController::class, 'storeSumberDana'])->name('store-sumber-dana');
    Route::get('/edit-sumber-dana/{sumberDana}', [UsersController::class, 'view_editSumberDana'])->name('edit-sumber-dana');
    Route::post('/store-edit-sumber-dana/{sumberDana}', [UsersController::class, 'storeEditSumberDana'])->name('store-edit-sumber-dana');
    Route::get('/tong-sampah/sumber-dana', [UsersController::class, 'view_tongSampahSumberDana'])->name('tong-sampah-sumber-dana');
    Route::get('/pulihkan-sumber-dana/{id?}', [UsersController::class, 'pulihkanSumberDana'])->name('pulihkan-sumber-dana');
    Route::get('/hapus-permanen-sumber-dana/{id?}', [UsersController::class, 'hapusPermanenSumberDana'])->name('hapus-permanen-sumber-dana');
    // END: Kelola Sumber Dana

    // START: Export Excel
    Route::get('/export-barang-excel/{ruangan}', [UsersController::class, 'exportBarangExcel'])->name('export-barang-excel');
    // END: Export Excel

    // START: QR Code
    Route::get('/qrcode/{ruangan}', [UsersController::class, 'view_QRCode'])->name('qrcode');
    Route::get('/print-qrcode/{ruangan}', [UsersController::class, 'view_printQRCode'])->name('print-qrcode');
    // END: QR Code
});
// END: Route Operator

Auth::routes();
