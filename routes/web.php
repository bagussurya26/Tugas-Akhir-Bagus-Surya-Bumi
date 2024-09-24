<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MusimController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UkuranController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\NotaBeliController;
use App\Http\Controllers\NotaJualController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeramalanController;
use App\Http\Controllers\KategoriKainController;
use App\Http\Controllers\KategoriProdukController;

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

// Login Logout ================================================================================================================
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
// Route::get('registration', [AuthController::class, 'registration'])->name('register');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
// Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard ===================================================================================================================
Route::get('/', [DashboardController::class, 'getRevenue'])->name('dashboard')->middleware('auth');

// Master ======================================================================================================================
// Kain
Route::resource('kain', KainController::class)->middleware('auth');

// Musim
Route::resource('musim', MusimController::class)->middleware('auth')->except('edit');
Route::put('musimdetail/edit/{id}', [MusimController::class, 'editdetail'])->name('musimdetail.update')->middleware('auth');
Route::post('musimdetail/create', [MusimController::class, 'insertdetail'])->name('musimdetail.create')->middleware('auth');

// Produk
Route::resource('produk', ProdukController::class)->middleware('auth')->except('edit', 'update');
Route::get('getUkuran/{kategori}', [ProdukController::class, 'getUkuran'])->name('produk.ukuran')->middleware('auth');
Route::get('getUkuranEdit/{kategori}/{id}', [ProdukController::class, 'getUkuranEdit'])->name('produk.ukuranedit')->middleware('auth');
Route::put('produk/keterangan/{id}', [ProdukController::class, 'updateKeterangan'])->name('produk.update.keterangan')->middleware('auth');
Route::put('produk/info/{id}', [ProdukController::class, 'updateInfoDasarProduk'])->name('produk.update.info')->middleware('auth');
Route::put('produk/update/warna/{id}', [ProdukController::class, 'updateWarnaProduk'])->name('produk.update.warna')->middleware('auth');
Route::put('produk/insert/warna/{id}', [ProdukController::class, 'tambahWarnaProduk'])->name('produk.insert.warna')->middleware('auth');
Route::put('produk/harga/{id}', [ProdukController::class, 'updateHargaProduk'])->name('produk.update.harga')->middleware('auth');

// Produksi
Route::resource('produksi', ProduksiController::class)->middleware('auth');
// Route::put('produksi/notapotong/{id}', [ProduksiController::class, 'updateNotaPotong'])->name('produksi.update.notapotong')->middleware('auth');
Route::put('produksi/keterangan/{id}', [ProduksiController::class, 'updateKeterangan'])->name('produksi.update.keterangan')->middleware('auth');
Route::put('produksi/target/{id}', [ProduksiController::class, 'updateTargetProduk'])->name('produksi.update.target')->middleware('auth');
Route::get('produksi/kain/{filter}', [ProduksiController::class, 'getProduksiKain'])->name('produksi.kain')->middleware('auth');
Route::get('produksi/produk/{filter}', [ProduksiController::class, 'getProduksiProduk'])->name('produksi.produk')->middleware('auth');
Route::get('getWarnaProduk/{id}', [ProduksiController::class, 'getWarnaProduk'])->name('getWarnaProduk')->middleware('auth');
Route::get('getUkuranProduk/{id}', [ProduksiController::class, 'getUkuranProduk'])->name('getUkuranProduk')->middleware('auth');
Route::get('getAvgQty/{produk_ukuran_id}', [ProduksiController::class, 'getAvgQty'])->name('getAvgQty')->middleware('auth');

// Supplier
Route::resource('supplier', SupplierController::class)->middleware('role:Pemilik');

// Kategori Kain
Route::resource('kategorikain', KategoriKainController::class)->except(['show'])->middleware('auth');

// Kategori Produk
Route::resource('kategoriproduk', KategoriProdukController::class)->except(['show'])->middleware('auth');

// Rak
Route::resource('rak', RakController::class)->except(['show'])->middleware('auth');

// Ukuran
Route::resource('ukuran', UkuranController::class)->except(['show'])->middleware('auth');

// Transaksi ================================================================================================================== 
// Nota Beli
Route::resource('notabeli', NotaBeliController::class)->middleware('role:Pemilik')->except('edit', 'update', 'destroy');
Route::put('notabeli/keterangan/{id}', [NotaBeliController::class, 'updateKeterangan'])->name('notabeli.update.keterangan')->middleware('role:Pemilik');
Route::put('notabeli/foto/{id}', [NotaBeliController::class, 'updateFoto'])->name('notabeli.update.foto')->middleware('role:Pemilik');
Route::get('notabeli/kain/{filter}', [NotaBeliController::class, 'getPembelianKain'])->name('notabeli.kain')->middleware('role:Pemilik');
Route::get('notabeli/supplier/{filter}', [NotaBeliController::class, 'getPembelianSupplier'])->name('notabeli.supplier')->middleware('role:Pemilik');

// Nota Jual
Route::resource('notajual', NotaJualController::class)->except(['edit', 'update', 'destroy'])->middleware('auth');
Route::get('notajual/produk/{filter}', [NotaJualController::class, 'getPenjualanProduk'])->name('notajual.produk')->middleware('auth');
Route::get('getProdukWarnaJual/{id}', [NotaJualController::class, 'getProdukWarna'])->name('getProdukWarna')->middleware('auth');
Route::get('getUkuranProdukJual/{id}', [NotaJualController::class, 'getUkuranProduk'])->name('getUkuranProduk')->middleware('auth');
Route::get('getHargaProduk/{idwarna}/{idukuran}', [NotaJualController::class, 'getHargaProduk'])->name('getHargaProduk')->middleware('auth');
Route::get('getKategori', [NotaJualController::class, 'getKategori'])->name('getKategori')->middleware('auth');
Route::get('getInfoProduk/{warna_id}/{ukuran_id}', [NotaJualController::class, 'getInfoProduk'])->name('getInfoProduk')->middleware('auth');


// HRD ======================================================================================================================== 
// User
Route::resource('user', UserController::class)->middleware('role:Pemilik');

// Karyawan
Route::resource('karyawan', KaryawanController::class)->except(['show'])->middleware('auth');


// Laporan =====================================================================================================================
Route::get('laporan/stokkain', [KainController::class, 'laporanstok'])->name('laporan.stokkain')->middleware('auth');
Route::get('laporan/pembeliankain', [NotaBeliController::class, 'laporanpembeliankain'])->name('laporan.pembeliankain')->middleware('role:Pemilik');
Route::get('laporan/produksi', [ProduksiController::class, 'laporanproduksi'])->name('laporan.produksi')->middleware('auth');
Route::get('laporan/penggunaankain', [ProduksiController::class, 'laporanpenggunaankain'])->name('laporan.penggunaankain')->middleware('auth');

// Peramalan ===================================================================================================================
Route::controller(PeramalanController::class)->group(function () {
    Route::get('peramalan/musiman', 'musiman')->name('peramalan.musiman')->middleware('auth');
    Route::post('peramalan/musiman', 'musimanproses')->name('musiman.proses')->middleware('auth');
    // Route::get('getYear/{target_tahun}', 'getYear')->name('getYear')->middleware('auth');

    Route::get('peramalan/tahunan', 'tahunan')->name('peramalan.tahunan')->middleware('auth');
    Route::post('peramalan/tahunan', 'tahunanproses')->name('tahunan.proses')->middleware('auth');
    Route::get('getYear/{target_tahun}', 'getYear')->name('getYear')->middleware('auth');

    Route::get('peramalan/bulanan', 'bulanan')->name('peramalan.bulanan')->middleware('auth');
    Route::post('peramalan/bulanan', 'bulananproses')->name('bulanan.proses')->middleware('auth');
    Route::get('getBulan/{target_bulan}', 'getBulan')->name('getBulan')->middleware('auth');

    Route::get('peramalan/bulankhusus', 'bulankhusus')->name('peramalan.bulankhusus')->middleware('auth');
    Route::post('peramalan/bulankhusus', 'bulankhususproses')->name('bulankhusus.proses')->middleware('auth');
    Route::get('getTahun/{target_bulan}', 'getTahun')->name('getTahun')->middleware('auth');
});

// Konfirmasi Aktivitas ========================================================================================================
Route::get('/konfirmasiaktivitas', function () {
    return view('konfirmasiaktivitas.index');
})->name('konfirmasiaktivitas.index')->middleware('role:Pemilik');

// Estimasi ===============================================================================================================
Route::get('estimasi', [PeramalanController::class, 'estimasi'])->name('estimasi.index')->middleware('auth');

// Log Aktivitas ===============================================================================================================
// Route::get('logaktivitas', [AuthController::class, 'log'])->name('logaktivitas.index')->middleware('role:Pemilik');

// Auth::routes();

