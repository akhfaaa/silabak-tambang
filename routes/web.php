<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogistikTambangController;

Route::get('/', function () {
    return redirect('/logistik');
});

Route::resource('logistik', LogistikTambangController::class);
