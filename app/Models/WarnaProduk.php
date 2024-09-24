<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarnaProduk extends Model
{
    use HasFactory;

    protected $table = 'produk_warna';

    public $timestamps = false;

    protected $fillable = [
        'produk_id',
        'warna',
        'foto',
    ];

    public function produks()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function produk_ukuran()
    {
        return $this->hasMany(UkuranProduk::class, 'produk_warna_id');
    }

    public function kains()
    {
        return $this->belongsToMany(Kain::class, 'reseps', 'produk_warna_id')->withPivot('tipe');
    }
}
