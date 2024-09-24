<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukFoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pakaian_images';
    

    public function produks()
    {
        return $this->belongsTo(Produk::class);
    }
}
