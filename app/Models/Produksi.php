<?php

namespace App\Models;

use App\Models\ListKain;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'nota_produksis';

    protected $fillable = [
        'karyawan_id',
        'kode_produksi',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'keterangan',
        'created_by',
        'updated_by',
    ];


    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function list_kains()
    {
        return $this->hasMany(ListKain::class, 'nota_produksi_id');
    }


}
