<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogistikTambangController;

Route::get('/', function () {
    return view('logistik');
});

Route::resource('logistik', LogistikTambangController::class);
