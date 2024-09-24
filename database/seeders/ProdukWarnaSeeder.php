<?php

namespace Database\Seeders;

use App\Models\WarnaProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukWarnaSeeder extends Seeder
{
    public function run()
    {
        // Batik
        WarnaProduk::insert([
            'produk_id' => 1,
            'warna' => 'COKLAT',
        ]);
        WarnaProduk::insert([
            'produk_id' => 1,
            'warna' => 'HIJAU',
        ]);


        // Motif
        WarnaProduk::insert([
            'produk_id' => 2,
            'warna' => 'HITAM',
        ]);
        WarnaProduk::insert([
            'produk_id' => 2,
            'warna' => 'BIRU',
        ]);

        // Polos
        WarnaProduk::insert([
            'produk_id' => 3,
            'warna' => 'HITAM',
        ]);
        WarnaProduk::insert([
            'produk_id' => 3,
            'warna' => 'BIRU',
        ]);

        // Taqwo
        WarnaProduk::insert([
            'produk_id' => 4,
            'warna' => 'PUTIH',
        ]);
    }
}
