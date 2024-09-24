<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'nota_produksis';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'users_id',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'keterangan',
    ];


}
