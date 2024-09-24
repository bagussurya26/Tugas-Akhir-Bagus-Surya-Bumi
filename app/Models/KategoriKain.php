<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKain extends Model
{
    use HasFactory;

    protected $table = 'kategori_kains';

    public function kains()
    {
        return $this->hasMany(Kain::class);
    }
}
