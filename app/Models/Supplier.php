<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'alamat',
        'keterangan',
        'created_by',
        'updated_by',
    ];

    public function notabelis()
    {
        return $this->hasMany(NotaBeli::class);
    }

}
