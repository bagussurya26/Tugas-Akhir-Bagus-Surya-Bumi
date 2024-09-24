<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rak extends Model
{
    use HasFactory;

    public function kains()
    {
        return $this->hasMany(Kain::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
