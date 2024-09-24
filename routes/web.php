<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KainController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\NotaBeliController;
use App\Http\Controllers\NotaJualController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PeramalanController;

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
    return view('dashboard.analytics');
})->name('home');

// Dashboard ===========================================
Route::get('dasboard/analytics', function () {
    return view('dashboard.analytics');
})->name('dashboard.analytics');

Route::get('dasboard/sales', function () {
    return view('dashboard.sales');
})->name('dashboard.sales');

// Master ===========================================
Route::resources([
    'kain' => KainController::class,
    'produk' => ProdukController::class,
    'produksi' => ProduksiController::class,
    'supplier' => SupplierController::class,
    'notabeli' => NotaBeliController::class,
    'notajual' => NotaJualController::class,
    'karyawan' => KaryawanController::class,
]);

// Route::controller(KainController::class)->group(function () {
//     Route::get('kain-deleted', 'softDelete')->name('kain.delete');
//     Route::get('kain/{id}/restore', 'restore')->name('kain.restore');
    
// });

// Route::controller(ProdukController::class)->group(function () {
//     Route::get('produk-deleted', 'softDelete')->name('produk.delete');
//     Route::get('produk/{id}/restore', 'restore')->name('produk.restore');

// });

// Route::controller(ProduksiController::class)->group(function () {
//     Route::get('produksi-deleted', 'softDelete')->name('produksi.delete');
//     Route::get('produksi/{id}/restore', 'restore')->name('produksi.restore');

// });

// Route::controller(SupplierController::class)->group(function () {
//     Route::get('supplier-deleted', 'softDelete')->name('supplier.delete');
//     Route::get('supplier/{id}/restore', 'restore')->name('supplier.restore');

// });

// Route::controller(BuyOrderController::class)->group(function () {
//     Route::get('buyorder-deleted', 'softDelete')->name('buyorder.delete');
//     Route::get('buyorder/{id}/restore', 'restore')->name('buyorder.restore');

// });



// Laporan ===========================================
Route::get('laporan/stokkain', [KainController::class, 'laporanstok'])->name('laporan.stokkain');

Route::get('laporan/pembeliankain', [PembelianController::class, 'laporanpembeliankain'])->name('laporan.pembeliankain');

Route::get('laporan/produksi', [ProduksiController::class, 'laporanproduksi'])->name('laporan.produksi');

// HRD ===========================================
// Route::get('hrd/users', function () {
//     return view('hrd.daftaruser');
// })->name('hrd.daftaruser');

// Route::get('hrd/users/1', function () {
//     return view('hrd.detailuser');
// })->name('hrd.detailuser');

// Route::get('hrd/users/1/settings', function () {
//     return view('hrd.settinguser');
// })->name('hrd.settinguser');

// Peramalan ===========================================
// Route::get('peramalan/tahunan', function () {
//     return view('peramalan.tahunan');
// })->name('peramalan.tahunan');

Route::controller(PeramalanController::class)->group(function () {
    Route::get('peramalan/tahunan', 'tahunan')->name('peramalan.tahunan');

    Route::get('peramalan/bulanan', 'bulanan')->name('peramalan.bulanan');
    Route::post('peramalan/bulanan', 'bulananproses')->name('bulanan.proses');

    Route::get('peramalan/bulankhusus', 'bulankhusus')->name('peramalan.bulankhusus');
    Route::post('peramalan/bulankhusus', 'submitBulanKhusus')->name('peramalan.inputbulankhusus');

});


// Route::get('peramalan/bulanan', function () {
//     return view('peramalan.bulanan');
// })->name('peramalan.bulanan');

// Route::get('peramalan/bulankhusus', function () {
//     return view('peramalan.bulankhusus');
// })->name('peramalan.bulankhusus');

// Konfirmasi Aktivitas ===========================================
Route::get('/konfirmasiaktivitas', function () {
    return view('konfirmasiaktivitas.index');
})->name('konfirmasiaktivitas.index');

// Log Aktivitas ===========================================
Route::get('/logaktivitas', function () {
    return view('logaktivitas.index');
})->name('logaktivitas.index');

