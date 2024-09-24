<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'created_by',
        'updated_by',
    ];

    public function notabelis()
    {
        return $this->hasMany(NotaBeli::class);
    }

    public function produksis()
    {
        return $this->hasMany(Produksi::class);
    }



}
