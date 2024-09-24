<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komposisi extends Pivot
{
    use HasFactory;

    protected $table = 'komposisi';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'list_kain_id',
        'produk_ukuran_id',
        'qty_kain',
        'qty_produk',
    ];

}
