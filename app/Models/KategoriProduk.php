<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $table = 'kategori_pakaians';

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
