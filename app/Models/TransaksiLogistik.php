<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiLogistik extends Model
{
    //
    protected $fillable = [
        'logistik_tambang_id', 'jenis_transaksi', 'kuantitas', 'tanggal_transaksi', 'keterangan'
    ];

    // Memberitahu Laravel bahwa transaksi ini milik suatu barang logistik
    public function logistik()
    {
        return $this->belongsTo(LogistikTambang::class, 'logistik_tambang_id');
    }
}
