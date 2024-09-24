<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Produksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotaProduksiSeeder extends Seeder
{
    public function run()
    {
        Produksi::create([
            [
                'kode_produksi' => 'ANR3004',
                'tgl_mulai' => now(),
                'tgl_selesai' => now()->addMonth(),
                'status' => 'Selesai',               
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
