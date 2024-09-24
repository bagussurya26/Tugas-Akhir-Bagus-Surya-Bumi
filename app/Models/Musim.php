<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musim extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public $timestamps = false;

    public function musim_detail()
    {
        return $this->hasMany(MusimDetail::class);
    }
}
