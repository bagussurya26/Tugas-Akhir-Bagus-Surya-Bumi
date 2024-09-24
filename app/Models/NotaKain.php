<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaKain extends Model
{
    use HasFactory;

    protected $table = 'nota_kains';
    // protected $keyType = 'string';
    // public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'nota_produksis_id',
        'karyawans_id',
        'jenis_kain',
        'id',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'keterangan',
    ];
}
