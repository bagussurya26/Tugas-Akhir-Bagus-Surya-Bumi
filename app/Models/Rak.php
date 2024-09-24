<?php

namespace App\Models;

use App\Models\Kain;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rak extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi',
        'created_by',
        'updated_by',
    ];

    public function kains()
    {
        return $this->hasMany(Kain::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
