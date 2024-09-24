<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kain extends Model
{
    use HasFactory;
    // protected $table = 'kains';

    // protected $keyType = 'string';
    // public $incrementing = false;

    protected $fillable = [
        'kode_kain',
        'kategori_kains_id',
        'raks_id',
        'jenis_kain',
        'stok',
        'foto',
        'keterangan',
        'warna'
    ];

    public function raks()
    {
        return $this->belongsTo(Rak::class);
    }

    public function kategoris()
    {
        return $this->belongsTo(KategoriKain::class);
    }

    public function belidetails()
    {
        return $this->hasMany(BeliDetail::class);
    }
}
