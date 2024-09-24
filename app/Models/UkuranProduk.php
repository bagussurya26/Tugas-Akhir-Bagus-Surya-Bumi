<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UkuranProduk extends Model
{
    use HasFactory;

    protected $table = 'produk_ukuran';

    public $timestamps = false;

    protected $fillable = [
        'produk_warna_id',
        'ukuran_id',
        'harga',
        'stok',
        'incoming_stok',
    ];

    public function nota_juals()
    {
        return $this->belongsToMany(NotaJual::class, 'nota_jual_details', 'produk_ukuran_id')->withPivot('qty_produk', 'harga', 'subtotal');
    }

    public function produk_warna()
    {
        return $this->belongsTo(WarnaProduk::class, 'produk_warna_id');
    }

    public function ukurans()
    {
        return $this->belongsTo(Ukuran::class, 'ukuran_id');
    }

    public function list_kain()
    {
        return $this->belongsToMany(ListKain::class, 'komposisi', 'produk_ukuran_id')->withPivot('qty_kain', 'qty_produk');
    }

    
}
