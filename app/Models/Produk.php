<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'pakaians';
    // protected $keyType = 'string';
    // public $incrementing = false;

    protected $fillable = [
        'kode_pakaian',
        'kategori_pakaians_id',
        'raks_id',
        'nama',
        'tipe_fit',
        'tipe_lengan',
        'total_qty',
        'harga',
        'keterangan'
    ];

    public function raks()
    {
        return $this->belongsTo(Rak::class);
    }

    public function produkfotos()
    {
        return $this->hasMany(ProdukFoto::class);
    }

    public function kategoris()
    {
        return $this->belongsTo(KategoriProduk::class);
    }
}
