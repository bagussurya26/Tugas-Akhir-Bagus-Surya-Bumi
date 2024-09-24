<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JualDetail extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nota_jual_details';

    protected $fillable = [
        'nota_jual_id',
        'produk_ukuran_id',
        'qty_produk',
        'harga',
        'subtotal',
    ];

}
