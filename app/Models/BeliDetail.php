<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeliDetail extends Model
{
    use HasFactory;

    protected $table = 'nota_beli_details';
    // protected $keyType = 'string';
    // public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'nota_belis_id',
        'kains_id',
        'harga_satuan',
        'qty_roll',
        'yard',
        'subtotal',
    ];

    public function notabelis()
    {
        return $this->belongsTo(NotaBeli::class);
    }

    public function kains()
    {
        return $this->belongsTo(Kain::class);
    }
}
