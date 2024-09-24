<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Kain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KainSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET foreign_key_checks=0;');
        Kain::truncate();
        DB::statement('SET foreign_key_checks=1;');

        // Batik
        Kain::insert([
            'kode_kain' => '233830A',
            'kategori_kain_id' => 1,
            'rak_id' => 11,
            'nama' => 'KATUN BATIK',
            'lebar' => 1.5,
            'incoming_stok' => 0,
            'stok' => 0,
            'warna' => 'COKLAT',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kain::insert([
            'kode_kain' => '233830B',
            'kategori_kain_id' => 1,
            'rak_id' => 11,
            'nama' => 'KATUN BATIK',
            'lebar' => 1.5,
            'incoming_stok' => 0,
            'stok' => 0,
            'warna' => 'HIJAU',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Motif
        Kain::insert([
            'kode_kain' => '456231A',
            'kategori_kain_id' => 2,
            'rak_id' => 12,
            'nama' => 'KATUN PRINTING 30S',
            'lebar' => 1.15,
            'incoming_stok' => 0,
            'stok' => 0,
            'warna' => 'HITAM',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kain::insert([
            'kode_kain' => '456231B',
            'kategori_kain_id' => 2,
            'rak_id' => 12,
            'nama' => 'KATUN PRINTING 30S',
            'lebar' => 1.15,
            'incoming_stok' => 0,
            'stok' => 0,
            'warna' => 'BIRU',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Polos
        Kain::insert([
            'kode_kain' => 'BT89023',
            'kategori_kain_id' => 3,
            'rak_id' => 13,
            'nama' => 'KATUN BT',
            'lebar' => 1.5,
            'incoming_stok' => 0,
            'stok' => 0,
            'warna' => 'HITAM',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kain::insert([
            'kode_kain' => 'BT89431',
            'kategori_kain_id' => 3,
            'rak_id' => 13,
            'nama' => 'KATUN BT',
            'lebar' => 1.5,
            'incoming_stok' => 0,
            'stok' => 0,
            'warna' => 'ABU GELAP',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Taqwo
        Kain::insert([
            'kode_kain' => '24563A',
            'kategori_kain_id' => 4,
            'rak_id' => 14,
            'nama' => 'BSW DOBY',
            'lebar' => 1.15,
            'incoming_stok' => 0,
            'stok' => 0,
            'warna' => 'PUTIH',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
