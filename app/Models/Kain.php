<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kain extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kain',
        'kategori_kain_id',
        'rak_id',
        'nama',
        'stok',
        'foto',
        'keterangan',
        'warna',
        'created_by',
        'updated_by',
    ];

    public function raks()
    {
        return $this->belongsTo(Rak::class, 'rak_id');
    }

    public function produk_warna()
    {
        return $this->belongsToMany(WarnaProduk::class, 'reseps', 'kain_id')->withPivot('tipe');
    }


    public function kategori_kains()
    {
        return $this->belongsTo(KategoriKain::class, 'kategori_kain_id');
    }

    public function nota_belis()
    {
        return $this->belongsToMany(NotaBeli::class, 'nota_beli_details', 'kain_id')->withPivot('qty_roll', 'panjang', 'total_panjang', 'harga', 'subtotal');
    }

    public function list_kains()
    {
        return $this->hasMany(ListKain::class, 'kain_id');
    }
    
}
