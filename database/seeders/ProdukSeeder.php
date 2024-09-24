<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Resep;
use App\Models\Produk;
use App\Models\WarnaProduk;
use App\Models\UkuranProduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET foreign_key_checks=0;');
        UkuranProduk::truncate();
        WarnaProduk::truncate();
        Produk::truncate();
        DB::statement('SET foreign_key_checks=1;');

        // Batik
        $nextIdProduk = Produk::max('id') + 1;
        $idNumber = str_pad($nextIdProduk, 3, '0', STR_PAD_LEFT);
        $kodeproduk = 'ANR3' . $idNumber;

        Produk::insert([
            'kode_produk' => $kodeproduk,
            'kategori_produk_id' => 1,
            'rak_id' => 1,
            'nama' => 'BATIK REGULAR PDK',
            'tipe_fit' => 'REGULAR',
            'tipe_lengan' => 'PENDEK',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        WarnaProduk::insert([
            'produk_id' => 1,
            'warna' => 'COKLAT',
        ]);
        WarnaProduk::insert([
            'produk_id' => 1,
            'warna' => 'HIJAU',
        ]);

        for ($j = 1; $j <= 2; $j++) {
            for ($a = 1; $a <= 3; $a++) {
                UkuranProduk::insert([
                    'produk_warna_id' => $j,
                    'ukuran_id' => $a,
                    'harga' => 160000,
                    'stok' => 500000,
                    'incoming_stok' => 0,
                ]);
            }
        }

        // Motif
        $nextIdProduk = Produk::max('id') + 1;
        $idNumber = str_pad($nextIdProduk, 3, '0', STR_PAD_LEFT);
        $kodeproduk = 'NR3' . $idNumber;

        Produk::insert([
            'kode_produk' => $kodeproduk,
            'kategori_produk_id' => 2,
            'rak_id' => 2,
            'nama' => 'KMJ MOTIF REGULAR PDK',
            'tipe_fit' => 'REGULAR',
            'tipe_lengan' => 'PENDEK',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        WarnaProduk::insert([
            'produk_id' => 2,
            'warna' => 'HITAM',
        ]);
        WarnaProduk::insert([
            'produk_id' => 2,
            'warna' => 'BIRU',
        ]);

        for ($j = 3; $j <= 4; $j++) {
            for ($a = 1; $a <= 3; $a++) {
                UkuranProduk::insert([
                    'produk_warna_id' => $j,
                    'ukuran_id' => $a,
                    'harga' => 130000,
                    'stok' => 500000,
                    'incoming_stok' => 0,
                ]);
            }
        }

        // Polos
        $nextIdProduk = Produk::max('id') + 1;
        $idNumber = str_pad($nextIdProduk, 3, '0', STR_PAD_LEFT);
        $kodeproduk = 'NR3' . $idNumber;

        Produk::insert([
            'kode_produk' => $kodeproduk,
            'kategori_produk_id' => 3,
            'rak_id' => 3,
            'nama' => 'KMJ POLOS PDK',
            'tipe_fit' => 'REGULAR',
            'tipe_lengan' => 'PENDEK',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        WarnaProduk::insert([
            'produk_id' => 3,
            'warna' => 'HITAM',
        ]);


        // for ($j = 5; $j <= 6; $j++) {
            for ($a = 1; $a <= 3; $a++) {
                UkuranProduk::insert([
                    'produk_warna_id' => 5,
                    'ukuran_id' => $a,
                    'harga' => 100000,
                    'stok' => 500000,
                    'incoming_stok' => 0,
                ]);
            }
        // }

        $nextIdProduk = Produk::max('id') + 1;
        $idNumber = str_pad($nextIdProduk, 3, '0', STR_PAD_LEFT);
        $kodeproduk = 'NS3' . $idNumber;

        Produk::insert([
            'kode_produk' => $kodeproduk,
            'kategori_produk_id' => 3,
            'rak_id' => 3,
            'nama' => 'KMJ POLOS KOMBINASI SLIM PDK',
            'tipe_fit' => 'SLIM',
            'tipe_lengan' => 'PENDEK',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        WarnaProduk::insert([
            'produk_id' => 4,
            'warna' => 'HITAM',
        ]);

        // for ($j = 5; $j <= 6; $j++) {
            for ($a = 1; $a <= 3; $a++) {
                UkuranProduk::insert([
                    'produk_warna_id' => 6,
                    'ukuran_id' => $a,
                    'harga' => 100000,
                    'stok' => 500000,
                    'incoming_stok' => 0,
                ]);
            }
        // }

        // Taqwo
        $nextIdProduk = Produk::max('id') + 1;
        $idNumber = str_pad($nextIdProduk, 3, '0', STR_PAD_LEFT);
        $kodeproduk = 'TR111' . $idNumber;

        Produk::insert([
            'kode_produk' => $kodeproduk,
            'kategori_produk_id' => 4,
            'rak_id' => 4,
            'nama' => 'AP 1 PJG',
            'tipe_fit' => 'REGULAR',
            'tipe_lengan' => 'PANJANG',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        WarnaProduk::insert([
            'produk_id' => 5,
            'warna' => 'PUTIH',
        ]);

        for ($a = 1; $a <= 3; $a++) {
            UkuranProduk::insert([
                'produk_warna_id' => 7,
                'ukuran_id' => $a,
                'harga' => 85000,
                'stok' => 500000,
                'incoming_stok' => 0,
            ]);
        }
    }
}
