<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriKain extends Model
{
    use HasFactory;

    protected $table = 'kategori_kains';

    protected $fillable = [
        'nama',
        'created_by',
        'updated_by',
    ];

    public function kains()
    {
        return $this->hasMany(Kain::class);
    }

}
