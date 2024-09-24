<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusimDetail extends Model
{
    use HasFactory;

    protected $table = 'musim_detail';

    protected $fillable = [
        'musim_id',
        'tahun',
        'bulan_awal',
        'bulan_akhir',
    ];

    public $timestamps = false;

    public function musim()
    {
        return $this->belongsTo(Musim::class);
    }
}
