<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET foreign_key_checks=0;');
        Supplier::truncate();
        DB::statement('SET foreign_key_checks=1;');

        Supplier::insert([
            'nama' => 'CV MITRA TEXTILE',
            'no_hp' => '08123456780',
            'email' => 'mitratextile@gmail.com',
            'alamat' => 'Jl. Kapasan No. 88, Surabaya',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Supplier::insert([
            'nama' => 'CV BANDUNG JAYA TEXTILE',
            'no_hp' => '08123456789',
            'email' => 'bandungjaya@mail.com',
            'alamat' => 'Jl. Bandung No. 45, Bandung',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Supplier::insert([
            'nama' => 'CV PUTRA AGUNG',
            'no_hp' => '08123456781',
            'email' => 'putraagung@gmail.com',
            'alamat' => 'Jl. Tentara No. 11, Jakarta Barat',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Supplier::insert([
            'nama' => 'CITITEX',
            'no_hp' => '08123456781',
            'email' => 'cititex@gmail.com',
            'alamat' => 'Jl. Padjadjaran No. 11, Bandung',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
