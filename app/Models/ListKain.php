<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListKain extends Pivot
{
    use HasFactory;

    protected $table = 'list_kains';
    
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'nota_produksi_id',
        'kain_id',
        'qty_kain_total',
    ];

    public function produksis()
    {
        return $this->belongsTo(Produksi::class, 'nota_produksi_id');
    }

    public function kains()
    {
        return $this->belongsTo(Kain::class, 'kain_id');
    }

    public function produk_ukuran()
    {
        return $this->belongsToMany(UkuranProduk::class, 'komposisi', 'list_kain_id')->withPivot('qty_kain', 'qty_produk');
    }

    
}
