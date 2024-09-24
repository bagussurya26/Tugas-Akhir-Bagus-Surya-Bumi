<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeliDetail extends Pivot
{
    use HasFactory;

    protected $table = 'nota_beli_details';

    public $timestamps = false;

    protected $fillable = [
        'nota_beli_id',
        'kain_id',
        'qty_roll',
        'panjang',
        'total_panjang',
        'harga',
        'subtotal',
    ];
}
