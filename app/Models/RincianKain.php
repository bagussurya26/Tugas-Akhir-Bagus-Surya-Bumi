<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RincianKain extends Model
{
    use HasFactory;

    protected $table = 'rincian_kains';
    // protected $keyType = 'string';
    // public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'nota_kains_nota_produksis_id',
        'nota_kains_id',
        'kains_id',
        'qty_kain',
    ];
}
