<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'kategori_produk_id',
        'rak_id',
        'nama',
        'tipe_fit',
        'tipe_lengan',
        'foto',
        'stok',
        'incoming_stok',
        'keterangan',
        'created_by',
        'updated_by',
    ];

    public function raks()
    {
        return $this->belongsTo(Rak::class, 'rak_id');
    }

    public function kategori_produks()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id');
    }

    public function produk_warna()
    {
        return $this->hasMany(WarnaProduk::class, 'produk_id');
    }

    
}
