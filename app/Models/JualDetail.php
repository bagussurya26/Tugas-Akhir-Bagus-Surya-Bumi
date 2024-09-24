<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JualDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nota_jual_details';

    protected $fillable = [
        'nota_juals_id',
        'ukuran_pakaians_pakaians_id',
        'ukuran_pakaians_ukurans_id',
        'qty_pakaian',
    ];

    public function notajuals()
    {
        return $this->belongsTo(NotaJual::class);
    }

    public function ukuranpakaians()
    {
        return $this->belongsTo(UkuranPakaian::class);
    }
}
