<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilProduk extends Model
{
    use HasFactory;

    protected $table = 'hasil_pakaians';

    public $timestamps = false;

    protected $fillable = [
        'nota_produksis_id',
        'ukuran_pakaians_pakaians_id',
        'ukuran_pakaians_ukurans_id',
        'qty_pakaian',
    ];

}
