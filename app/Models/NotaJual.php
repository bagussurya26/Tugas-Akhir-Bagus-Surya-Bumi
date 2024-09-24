<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaJual extends Model
{
    use HasFactory;

    protected $table = 'nota_juals';

    protected $fillable = [
        'kode_nota',
        'tgl_pesan',
        'total_qty',
        'grand_total',
        'created_by',
        'updated_by',
    ];

    public function produk_ukuran()
    {
        return $this->belongsToMany(UkuranProduk::class, 'nota_jual_details', 'produk_ukuran_id')->withPivot('qty_produk', 'harga', 'subtotal');
    }

    
}
