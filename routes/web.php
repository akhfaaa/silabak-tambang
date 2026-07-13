<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KmeansController;
use App\Http\Controllers\LogistikTambangController;
use App\Http\Controllers\TransaksiLogistikController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/analitik/means', [KmeansController::class, 'index'])->name('kmeans.index');

Route::resource('transaksi', TransaksiLogistikController::class);

Route::resource('logistik', LogistikTambangController::class);
