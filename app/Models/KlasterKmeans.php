<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlasterKmeans extends Model
{
    //
    protected $fillable = [
        'LogistikTambang_id',
        'label_klaster',
        'velocity_score'
    ];
}
