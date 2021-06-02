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
Route::middleware(['auth', 'checkRole:0,1', 'verified'])->group(function () {
    // START: Dashboard
    Route::get('/dashboard', [UsersController::class, 'view_dashboard'])->name('dashboard');
    // END: Dashboard

    // START: Profile
    Route::get('/profile/{users}', [UsersController::class, 'view_profile'])->name('profile');
    Route::post('/store-profile/{users}', [UsersController::class, 'storeProfile'])->name('store-profile');
    Route::get('/destroy-foto-profile/{users}', [UsersController::class, 'destroyFotoProfile'])->name('destroy-foto-profile');
    Route::get('/ganti-password/{users}', [UsersController::class, 'view_gantiPassword'])->name('ganti-password');
    Route::post('/store-ganti-password/{users}', [UsersController::class, 'storeGantiPassword'])->name('store-ganti-password');
    Route::get('/ubah-email/{users}', [UsersController::class, 'view_ubahEmail'])->name('ubah-email');
    Route::post('/store-ubah-email/{users}', [UsersController::class, 'storeUbahEmail'])->name('store-ubah-email');
    // END: Profile

    // START: Laporan
    Route::get('/laporan-barang/ruangan', [UsersController::class, 'view_laporanBarangPeruangan'])->name('laporan-barang-peruangan');
    Route::get('/cetak-laporan-barang/ruangan/{ruangan}', [UsersController::class, 'view_cetakLaporanBarangPeruangan'])->name('cetak-laporan-barang-peruangan');
    Route::get('/print-laporan-barang/ruangan/{ruangan}', [UsersController::class, 'printLaporanBarangPeruangan'])->name('print-laporan-barang-peruangan');

    Route::get('/laporan-barang/angkatan', [UsersController::class, 'view_laporanBarangPerangkatan'])->name('laporan-barang-perangkatan');

    Route::get('/cetak-laporan-barang/angkatan/vii', [UsersController::class, 'view_cetakLaporanBarangAngkatanVII'])->name('cetak-laporan-barang-angkatan-vii');
    Route::get('/cetak-laporan-barang/angkatan/viii', [UsersController::class, 'view_cetakLaporanBarangAngkatanVIII'])->name('cetak-laporan-barang-angkatan-viii');
    Route::get('/cetak-laporan-barang/angkatan/ix', [UsersController::class, 'view_cetakLaporanBarangAngkatanIX'])->name('cetak-laporan-barang-angkatan-ix');

    Route::get('/print-laporan-barang/angkatan/vii', [UsersController::class, 'printLaporanBarangAngkatanVII'])->name('print-laporan-barang-angkatan-vii');
    Route::get('/print-laporan-barang/angkatan/viii', [UsersController::class, 'printLaporanBarangAngkatanVIII'])->name('print-laporan-barang-angkatan-viii');
    Route::get('/print-laporan-barang/angkatan/ix', [UsersController::class, 'printLaporanBarangAngkatanIX'])->name('print-laporan-barang-angkatan-ix');

    Route::get('/laporan-barang/semua-ruangan', [UsersController::class, 'view_laporanBarangSemuaRuangan'])->name('laporan-barang-semua-ruangan');
    Route::get('/print-laporan-barang/semua-ruangan', [UsersController::class, 'printLaporanBarangSemuaRuangan'])->name('print-laporan-barang-semua-ruangan');
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
Route::middleware(['auth', 'checkRole:0', 'verified'])->group(function () {
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
Route::middleware(['auth', 'checkRole:1', 'verified'])->group(function () {
    // START: Kelola Ruangan
    Route::get('/tambah-ruangan', [UsersController::class, 'view_tambahRuangan'])->name('tambah-ruangan');
    Route::post('/store-ruangan', [UsersController::class, 'storeRuangan'])->name('store-ruangan');
    Route::get('/destroy-ruangan/{ruangan}', [UsersController::class, 'destroyRuangan'])->name('destroy-ruangan');
    Route::get('/destroy-foto-ruangan/{ruangan}', [UsersController::class, 'destroyFotoRuangan'])->name('destroy-foto-ruangan');
    Route::get('/destroy-semua-ruangan', [UsersController::class, 'destroySemuaRuangan'])->name('destroy-semua-ruangan');
    Route::get('/edit-ruangan/{ruangan}', [UsersController::class, 'view_editRuangan'])->name('edit-ruangan');
    Route::post('/store-edit-ruangan/{ruangan}', [UsersController::class, 'storeEditRuangan'])->name('store-edit-ruangan');
    Route::get('/ubah-penanggung-jawab-ruangan/{ruangan}', [UsersController::class, 'view_ubahPenanggungJawabRuangan'])->name('ubah-penanggung-jawab-ruangan');
    Route::post('/store-ubah-penanggung-jawab-ruangan/{ruangan}', [UsersController::class, 'storeUbahPenanggungJawabRuangan'])->name('store-ubah-penanggung-jawab-ruangan');
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

    // START: Data Guru
    Route::get('/kelola-guru', [UsersController::class, 'view_kelolaGuru'])->name('kelola-guru');
    Route::get('/destroy-guru/{guru}', [UsersController::class, 'destroyGuru'])->name('destroy-guru');
    Route::get('/destroy-semua-guru', [UsersController::class, 'destroySemuaGuru'])->name('destroy-semua-guru');
    Route::get('/tambah-guru', [UsersController::class, 'view_tambahGuru'])->name('tambah-guru');
    Route::post('/store-guru', [UsersController::class, 'storeGuru'])->name('store-guru');
    Route::get('/edit-guru/{guru}', [UsersController::class, 'view_editGuru'])->name('edit-guru');
    Route::post('/store-edit-guru/{guru}', [UsersController::class, 'storeEditGuru'])->name('store-edit-guru');
    Route::get('/tong-sampah/guru', [UsersController::class, 'view_tongSampahGuru'])->name('tong-sampah-guru');
    Route::get('/pulihkan-guru/{id?}', [UsersController::class, 'pulihkanGuru'])->name('pulihkan-guru');
    Route::get('/hapus-permanen-guru/{id?}', [UsersController::class, 'hapusPermanenGuru'])->name('hapus-permanen-guru');
    // END: Data Guru

    // START: Export Excel
    Route::get('/export-barang-excel/{ruangan}', [UsersController::class, 'exportBarangExcel'])->name('export-barang-excel');
    // END: Export Excel

    // START: QR Code
    Route::get('/qrcode/{ruangan}', [UsersController::class, 'view_QRCode'])->name('qrcode');
    Route::get('/print-qrcode/{ruangan}', [UsersController::class, 'view_printQRCode'])->name('print-qrcode');
    // END: QR Code
});
// END: Route Operator

Auth::routes(['verify' => true]);
