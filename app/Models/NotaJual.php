<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaJual extends Model
{
    use HasFactory;

    protected $table = 'nota_juals';

    protected $fillable = [
        'kode_nota_jual',
    ];

    public function jualdetails()
    {
        return $this->hasMany(JualDetail::class);
    }
}
