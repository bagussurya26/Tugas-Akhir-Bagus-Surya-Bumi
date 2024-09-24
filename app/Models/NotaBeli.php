<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaBeli extends Model
{
    use HasFactory;

    protected $table = 'nota_belis';
    // protected $keyType = 'string';
    // public $incrementing = false;

    protected $fillable = [
        'kode_nota_beli',
        'suppliers_id',
        'karyawans_id',
        'tipe_pembayaran',
        'status',
        'tgl_pesan',
        'tgl_datang',
        'tgl_bayar',
        'status_bayar',
        'keterangan',
        'grand_total',
        'total_qty',
    ];


    public function suppliers()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function belidetails()
    {
        return $this->hasMany(BeliDetail::class);
    }
}
