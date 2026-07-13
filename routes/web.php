<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KmeansController;
use App\Http\Controllers\LogistikTambangController;
use App\Http\Controllers\TransaksiLogistikController;

Route::get('/', function () {
    return redirect('/logistik');
});
Route::get('/kmeans', [KmeansController::class, 'index'])->name('kmeans.index');

Route::resource('transaksi', TransaksiLogistikController::class);

Route::resource('logistik', LogistikTambangController::class);
