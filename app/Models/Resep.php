<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Resep extends Pivot
{
    public $timestamps = false;

    protected $table = 'reseps';

    protected $fillable = [
        'produk_warna_id',
        'kain_id',
        'tipe',
    ];
}
