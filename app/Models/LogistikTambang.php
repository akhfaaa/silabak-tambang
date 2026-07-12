<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogistikTambang extends Model
{
    //
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'harga_beli',
        'stok_aktual',
        'stok_minimum'
    ];
}
