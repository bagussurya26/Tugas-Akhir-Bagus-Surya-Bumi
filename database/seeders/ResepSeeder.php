<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Resep;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResepSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET foreign_key_checks=0;');
        Resep::truncate();
        DB::statement('SET foreign_key_checks=1;');

        // Batik
        for ($i = 1; $i <= 2; $i++) {
            Resep::insert([
                'produk_warna_id' => $i,
                'kain_id' => $i,
                'tipe' => 'UTAMA',
            ]);
            // Resep::insert([
            //     'produk_warna_id' => $i,
            //     'kain_id' => 5,
            //     'tipe' => 'KOMBINASI',
            // ]);
        }

        // Motif
        for ($i = 3; $i <= 4; $i++) {
            Resep::insert([
                'produk_warna_id' => $i,
                'kain_id' => $i,
                'tipe' => 'UTAMA',
            ]);
            Resep::insert([
                'produk_warna_id' => $i,
                'kain_id' => 5,
                'tipe' => 'KOMBINASI',
            ]);
        }

        // Polos
        // for ($i = 5; $i <= 6; $i++) {
            Resep::insert([
                'produk_warna_id' => 5,
                'kain_id' => 5,
                'tipe' => 'UTAMA',
            ]);
            Resep::insert([
                'produk_warna_id' => 6,
                'kain_id' => 5,
                'tipe' => 'UTAMA',
            ]);
        Resep::insert([
            'produk_warna_id' => 6,
            'kain_id' => 6,
            'tipe' => 'KOMBINASI',
        ]);
        // }

        // Taqwo
            Resep::insert([
                'produk_warna_id' => 7,
                'kain_id' => 7,
                'tipe' => 'UTAMA',
            ]);
    }
}
