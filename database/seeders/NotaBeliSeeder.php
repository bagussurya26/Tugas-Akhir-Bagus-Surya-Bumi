<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Kain;
use App\Models\NotaBeli;
use App\Models\BeliDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotaBeliSeeder extends Seeder
{
    public function run()
    {

        DB::statement('SET foreign_key_checks=0;');
        BeliDetail::truncate();
        NotaBeli::truncate();
        for ($i=1; $i <= 7; $i++) { 
            Kain::where('id', $i)->update([
                'stok' => 0
            ]);
        }
        DB::statement('SET foreign_key_checks=1;');

        // 2023
        for ($i = 1; $i <= 12; $i++) {

            for ($j = 1; $j <= rand(3, 7); $j++) {

                $day = rand(1, Carbon::now()->month($i)->daysInMonth);

                $tgl_pesan = Carbon::create(2023, $i, $day);

                $tgl_terima = $tgl_pesan->addDays(rand(5, 10));

                $nextInvoiceNumber = NotaBeli::max('id') + 1;

                $supplier_id = rand(1, 4);

                $notabeli = NotaBeli::create([
                    'kode_nota' => 'INVB' . $nextInvoiceNumber,
                    'supplier_id' => $supplier_id,
                    'karyawan_id' => rand(1, 2),
                    'tgl_pesan' => $tgl_pesan,
                    'tgl_terima' => $tgl_terima,
                    'satuan' => 'Meter',
                    'grand_total' => 0,
                    'total_qty_roll' => 0,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $totalroll = 0;
                $grandtotal = 0;

                for ($a = 1; $a <= rand(1, 10); $a++) {

                    if ($supplier_id == 1) {
                        $randkain = rand(1, 2);
                        $harga = 55000;
                    } elseif ($supplier_id == 2) {
                        $randkain = rand(3, 4);
                        $harga = 45000;
                    } elseif ($supplier_id == 3) {
                        $randkain = rand(5, 6);
                        $harga = 45000;
                    } else {
                        $randkain = 7;
                        $harga = 35000;
                    }

                    $panjang = rand(10, 120);

                    $cekkain = BeliDetail::where('nota_beli_id', $notabeli->id)
                        ->where('kain_id', $randkain)
                        ->where('panjang', $panjang)
                        ->first();

                    if ($cekkain == null) {
                        $qty_roll = rand(1, 15);
                        $total_panjang = $panjang * $qty_roll;
                        $subtotal = $harga * $total_panjang;

                        BeliDetail::create([
                            'nota_beli_id' => $notabeli->id,
                            'kain_id' => $randkain,
                            'qty_roll' => $qty_roll,
                            'panjang' => $panjang,
                            'total_panjang' => $total_panjang,
                            'harga' => $harga,
                            'subtotal' => $subtotal,
                        ]);

                        Kain::find($randkain)
                            ->increment('stok', $total_panjang);

                        $totalroll += $qty_roll;
                        $grandtotal += $subtotal;
                    }
                }

                $notabeli
                    ->update([
                            'tgl_pesan' => Carbon::create(2023, $i, $day),
                            'grand_total' => $grandtotal,
                            'total_qty_roll' => $totalroll,
                        ]);
            }

        }

        // 2024
        for ($i = 1; $i <= 12; $i++) {

            for ($j = 1; $j <= rand(3, 7); $j++) {

                $day = rand(1, Carbon::now()->month($i)->daysInMonth);

                $tgl_pesan = Carbon::create(2024, $i, $day);

                $tgl_terima = $tgl_pesan->addDays(rand(5, 10));

                $nextInvoiceNumber = NotaBeli::max('id') + 1;

                $supplier_id = rand(1, 4);

                $notabeli = NotaBeli::create([
                    'kode_nota' => 'INVB' . $nextInvoiceNumber,
                    'supplier_id' => $supplier_id,
                    'karyawan_id' => rand(1, 2),
                    'tgl_pesan' => $tgl_pesan,
                    'tgl_terima' => $tgl_terima,
                    'satuan' => 'Meter',
                    'grand_total' => 0,
                    'total_qty_roll' => 0,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $totalroll = 0;
                $grandtotal = 0;

                for ($a = 1; $a <= rand(1, 10); $a++) {

                    if ($supplier_id == 1) {
                        $randkain = rand(1, 2);
                        $harga = 55000;
                    } elseif ($supplier_id == 2) {
                        $randkain = rand(3, 4);
                        $harga = 45000;
                    } elseif ($supplier_id == 3) {
                        $randkain = rand(5, 6);
                        $harga = 45000;
                    } else {
                        $randkain = 7;
                        $harga = 35000;               
                    }

                    $panjang = rand(10, 120);

                    $cekkain = BeliDetail::where('nota_beli_id', $notabeli->id)
                        ->where('kain_id', $randkain)
                        ->where('panjang', $panjang)
                        ->first();

                    if ($cekkain == null) {
                        $qty_roll = rand(1, 15);
                        $total_panjang = $panjang * $qty_roll;
                        $subtotal = $harga * $total_panjang;

                        BeliDetail::create([
                            'nota_beli_id' => $notabeli->id,
                            'kain_id' => $randkain,
                            'qty_roll' => $qty_roll,
                            'panjang' => $panjang,
                            'total_panjang' => $total_panjang,
                            'harga' => $harga,
                            'subtotal' => $subtotal,
                        ]);

                        Kain::find($randkain)
                            ->increment('stok', $total_panjang);

                        $totalroll += $qty_roll;
                        $grandtotal += $subtotal;
                    }
                }

                $notabeli
                    ->update([
                            'tgl_pesan' => Carbon::create(2024, $i, $day),
                            'grand_total' => $grandtotal,
                            'total_qty_roll' => $totalroll,
                        ]);
            }

        }
    }
}
