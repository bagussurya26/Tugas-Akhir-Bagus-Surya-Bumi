<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Ukuran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UkuranSeeder extends Seeder
{
    public function run()
    {
        Ukuran::insert([
            [
                'nama' => 'M',
                'kategori' => 'RS',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'L',
                'kategori' => 'RS',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'XL',
                'kategori' => 'RS',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => '2XL',
                'kategori' => 'BZ',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => '3XL',
                'kategori' => 'BZ',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => '4XL',
                'kategori' => 'BZ',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
