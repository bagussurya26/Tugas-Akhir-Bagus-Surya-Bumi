<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_hp',
        'keterangan',
        'no_rek'
    ];

    public function notabelis()
    {
        return $this->hasMany(NotaBeli::class);
    }
}
