<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ukuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'created_by',
        'updated_by',
    ];

    public function produk_ukuran()
    {
        return $this->hasMany(UkuranProduk::class);
    }
}
