<?php

namespace Database\Seeders;

use App\Models\Musim;
use App\Models\MusimDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusimSeeder extends Seeder
{

    public function run()
    {
        Musim::create([
            'nama' => 'Idul Fitri',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2016',
            'bulan_awal' => 'June 2016',
            'bulan_akhir' => 'July 2016',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2017',
            'bulan_awal' => 'May 2017',
            'bulan_akhir' => 'June 2017',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2018',
            'bulan_awal' => 'May 2018',
            'bulan_akhir' => 'June 2018',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2019',
            'bulan_awal' => 'May 2019',
            'bulan_akhir' => 'June 2019',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2020',
            'bulan_awal' => 'April 2020',
            'bulan_akhir' => 'May 2020',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2021',
            'bulan_awal' => 'April 2021',
            'bulan_akhir' => 'May 2021',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2022',
            'bulan_awal' => 'April 2022',
            'bulan_akhir' => 'May 2022',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2023',
            'bulan_awal' => 'March 2023',
            'bulan_akhir' => 'April 2023',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2024',
            'bulan_awal' => 'March 2024',
            'bulan_akhir' => 'April 2024',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MusimDetail::create([
            'musim_id' => 1,
            'tahun' => '2025',
            'bulan_awal' => 'March 2025',
            'bulan_akhir' => 'April 2025',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // }
    }
}
