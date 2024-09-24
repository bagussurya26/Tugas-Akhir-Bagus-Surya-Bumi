<?php

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
    return view('conquer.index');
})->name('dashboard');

Route::get('/master/kain', function () {
    return view('masters.kain');
})->name('kain');

Route::get('/master/kain', function () {
    return view('master.kain');
})->name('master.kain');

Route::get('/master/produk', function () {
    return view('master.produk');
})->name('master.produk');

Route::get('/master/produksi', function () {
    return view('master.produksi');
})->name('master.produksi');

Route::get('/master/supplier', function () {
    return view('master.supplier');
})->name('master.supplier');

Route::get('/modernize', function () {
    return view('modernize.index2');
})->name('modernize');

Route::post('/master/kain/showInfo',[ProductController::class,'showInfo'
])->name('products.showInfo');


