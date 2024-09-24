<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranPakaian extends Model
{
    use HasFactory;

    protected $table = 'ukuran_pakaians';

    public $timestamps = false;

    protected $fillable = [
        'pakaians_id',
        'ukurans_id',
        'qty',
    ];

}
