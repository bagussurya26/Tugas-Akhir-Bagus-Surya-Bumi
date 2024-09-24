<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\UkuranProduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukUkuranSeeder extends Seeder
{
    public function run()
    {
        $hargabatik = rand(85000, 160000);
        $hargamotif = rand(65000, 130000);
        $hargapolos = rand(45000, 110000);
        $hargataqwo = rand(45000, 85000);

        // Batik
        for ($j = 1; $j <= 2; $j++) {
            for ($a = 1; $a <= 3; $a++) {
                UkuranProduk::insert([
                    'produk_warna_id' => $j,
                    'ukuran_id' => $a,
                    'harga' => $hargabatik,
                    'stok' => 0,
                    'incoming_stok' => 0,
                ]);
            }
        }

        // Motif
        for ($j = 3; $j <= 4; $j++) {
            for ($a = 1; $a <= 3; $a++) {
                UkuranProduk::insert([
                    'produk_warna_id' => $j,
                    'ukuran_id' => $a,
                    'harga' => $hargamotif,
                    'stok' => 0,
                    'incoming_stok' => 0,
                ]);
            }
        }

        // Polos
        for ($j = 5; $j <= 6; $j++) {
            for ($a = 1; $a <= 3; $a++) {
                UkuranProduk::insert([
                    'produk_warna_id' => $j,
                    'ukuran_id' => $a,
                    'harga' => $hargapolos,
                    'stok' => 0,
                    'incoming_stok' => 0,
                ]);
            }
        }

        // Taqwo
        for ($a = 1; $a <= 3; $a++) {
            UkuranProduk::insert([
                'produk_warna_id' => 7,
                'ukuran_id' => $a,
                'harga' => $hargataqwo,
                'stok' => 0,
                'incoming_stok' => 0,
            ]);
        }
    }
}
