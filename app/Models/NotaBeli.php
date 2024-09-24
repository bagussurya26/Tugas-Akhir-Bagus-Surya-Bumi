<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaBeli extends Model
{
    use HasFactory;

    protected $table = 'nota_belis';
    // protected $keyType = 'string';
    // public $incrementing = false;

    protected $fillable = [
        'kode_nota',
        'supplier_id',
        'karyawan_id',       
        'tgl_pesan',
        'tgl_terima',
        'tgl_bayar',
        'satuan',
        'foto',
        'grand_total',
        'total_qty_roll',
        'keterangan',
        'created_by',
        'updated_by',
    ];


    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function kains()
    {
        return $this->belongsToMany(Kain::class, 'nota_beli_details', 'nota_beli_id')->withPivot('qty_roll', 'panjang', 'total_panjang', 'harga', 'subtotal');
    }
}
