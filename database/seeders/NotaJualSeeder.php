<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\NotaJual;
use App\Models\JualDetail;
use App\Models\UkuranProduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotaJualSeeder extends Seeder
{
    public function run()
    {

        DB::statement('SET foreign_key_checks=0;');
        JualDetail::truncate();
        NotaJual::truncate();
        for ($i = 1; $i <= 21; $i++) {
            UkuranProduk::where('id', $i)->update([
                'stok' => 0
            ]);
        }
        DB::statement('SET foreign_key_checks=1;');

        // 2018
        for ($i = 1; $i <= 12; $i++) {

            $totalHari = now()->month($i)->daysInMonth;

            for ($e = 1; $e <= $totalHari; $e++) {

                if ($i == 5 || $i == 6) {
                    $rndmdata = rand(5, 20);
                } else {
                    $rndmdata = rand(3, 5);
                }

                $tgl_pesan = Carbon::create(2018, $i, $e);

                for ($j = 1; $j <= $rndmdata; $j++) {

                    $month = $tgl_pesan->format('m');
                    $year = $tgl_pesan->format('y');
                    $nextInvoiceNumber = NotaJual::max('id') + 1;
                    $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
                    $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

                    $notajual = NotaJual::create([
                        'kode_nota' => $invoiceCode,
                        'tgl_pesan' => $tgl_pesan,
                        'total_qty' => 0,
                        'grand_total' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $grandtotal = 0;
                    $total_qty = 0;

                    for ($a = 1; $a <= rand(5, 10); $a++) {

                        if ($i == 5 || $i == 6) {
                            $randPercentage = rand(1, 100);

                            if ($randPercentage < 80) {
                                $randproduk = rand(19, 21);
                            } else {
                                $randproduk = rand(1, 18);
                            }
                        } else {
                            $randproduk = rand(1, 21);
                        }

                        $cekproduk = JualDetail::where('nota_jual_id', $notajual->id)
                            ->where('produk_ukuran_id', $randproduk)
                            ->first();

                        $harga = UkuranProduk::where('id', $randproduk)->value('harga');

                        if ($cekproduk == null) {
                            $qty = rand(5, 10);
                            $subtotal = $harga * $qty;

                            JualDetail::create([
                                'nota_jual_id' => $notajual->id,
                                'produk_ukuran_id' => $randproduk,
                                'qty_produk' => $qty,
                                'harga' => $harga,
                                'subtotal' => $subtotal,
                            ]);

                            $total_qty += $qty;
                            $grandtotal += $subtotal;
                        }
                    }

                    $notajual
                        ->update([
                            'tgl_pesan' => Carbon::create(2018, $i, $e),
                            'total_qty' => $total_qty,
                            'grand_total' => $grandtotal,
                        ]);
                }
            }
        }

        // 2019
        for ($i = 1; $i <= 12; $i++) {

            $totalHari = now()->month($i)->daysInMonth;

            for ($e = 1; $e <= $totalHari; $e++) {

                if ($i == 5 || $i == 6) {
                    $rndmdata = rand(5, 20);
                } else {
                    $rndmdata = rand(3, 5);
                }

                $tgl_pesan = Carbon::create(2019, $i, $e);

                for ($j = 1; $j <= $rndmdata; $j++) {

                    $month = $tgl_pesan->format('m');
                    $year = $tgl_pesan->format('y');
                    $nextInvoiceNumber = NotaJual::max('id') + 1;
                    $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
                    $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

                    $notajual = NotaJual::create([
                        'kode_nota' => $invoiceCode,
                        'tgl_pesan' => $tgl_pesan,
                        'total_qty' => 0,
                        'grand_total' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $grandtotal = 0;
                    $total_qty = 0;

                    for ($a = 1; $a <= rand(5, 10); $a++) {

                        if ($i == 5 || $i == 6) {
                            $randPercentage = rand(1, 100);

                            if ($randPercentage < 80) {
                                $randproduk = rand(19, 21);
                            } else {
                                $randproduk = rand(1, 18);
                            }
                        } else {
                            $randproduk = rand(1, 21);
                        }

                        $cekproduk = JualDetail::where('nota_jual_id', $notajual->id)
                            ->where('produk_ukuran_id', $randproduk)
                            ->first();

                        $harga = UkuranProduk::where('id', $randproduk)->value('harga');

                        if ($cekproduk == null) {
                            $qty = rand(5, 10);
                            $subtotal = $harga * $qty;

                            JualDetail::create([
                                'nota_jual_id' => $notajual->id,
                                'produk_ukuran_id' => $randproduk,
                                'qty_produk' => $qty,
                                'harga' => $harga,
                                'subtotal' => $subtotal,
                            ]);

                            $total_qty += $qty;
                            $grandtotal += $subtotal;
                        }
                    }

                    $notajual
                        ->update([
                            'tgl_pesan' => Carbon::create(2019, $i, $e),
                            'total_qty' => $total_qty,
                            'grand_total' => $grandtotal,
                        ]);
                }
            }
        }

        // 2020
        for ($i = 1; $i <= 12; $i++) {

            $totalHari = now()->month($i)->daysInMonth;

            for ($e = 1; $e <= $totalHari; $e++) {

                if ($i == 4 || $i == 5) {
                    $rndmdata = rand(5, 20);
                } else {
                    $rndmdata = rand(3, 5);
                }

                $tgl_pesan = Carbon::create(2020, $i, $e);

                for ($j = 1; $j <= $rndmdata; $j++) {

                    $month = $tgl_pesan->format('m');
                    $year = $tgl_pesan->format('y');
                    $nextInvoiceNumber = NotaJual::max('id') + 1;
                    $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
                    $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

                    $notajual = NotaJual::create([
                        'kode_nota' => $invoiceCode,
                        'tgl_pesan' => $tgl_pesan,
                        'total_qty' => 0,
                        'grand_total' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $grandtotal = 0;
                    $total_qty = 0;

                    for ($a = 1; $a <= rand(5, 10); $a++) {

                        if ($i == 4 || $i == 5) {
                            $randPercentage = rand(1, 100);

                            if ($randPercentage < 80) {
                                $randproduk = rand(19, 21);
                            } else {
                                $randproduk = rand(1, 18);
                            }
                        } else {
                            $randproduk = rand(1, 21);
                        }

                        $cekproduk = JualDetail::where('nota_jual_id', $notajual->id)
                            ->where('produk_ukuran_id', $randproduk)
                            ->first();

                        $harga = UkuranProduk::where('id', $randproduk)->value('harga');

                        if ($cekproduk == null) {
                            $qty = rand(5, 10);
                            $subtotal = $harga * $qty;

                            JualDetail::create([
                                'nota_jual_id' => $notajual->id,
                                'produk_ukuran_id' => $randproduk,
                                'qty_produk' => $qty,
                                'harga' => $harga,
                                'subtotal' => $subtotal,
                            ]);

                            $total_qty += $qty;
                            $grandtotal += $subtotal;
                        }
                    }

                    $notajual
                        ->update([
                            'tgl_pesan' => Carbon::create(2020, $i, $e),
                            'total_qty' => $total_qty,
                            'grand_total' => $grandtotal,
                        ]);
                }
            }
        }

        // 2021
        for ($i = 1; $i <= 12; $i++) {

            $totalHari = now()->month($i)->daysInMonth;

            for ($e = 1; $e <= $totalHari; $e++) {

                if ($i == 4 || $i == 5) {
                    $rndmdata = rand(5, 20);
                } else {
                    $rndmdata = rand(3, 5);
                }

                $tgl_pesan = Carbon::create(2021, $i, $e);

                for ($j = 1; $j <= $rndmdata; $j++) {

                    $month = $tgl_pesan->format('m');
                    $year = $tgl_pesan->format('y');
                    $nextInvoiceNumber = NotaJual::max('id') + 1;
                    $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
                    $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

                    $notajual = NotaJual::create([
                        'kode_nota' => $invoiceCode,
                        'tgl_pesan' => $tgl_pesan,
                        'total_qty' => 0,
                        'grand_total' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $grandtotal = 0;
                    $total_qty = 0;

                    for ($a = 1; $a <= rand(5, 10); $a++) {

                        if ($i == 4 || $i == 5) {
                            $randPercentage = rand(1, 100);

                            if ($randPercentage < 80) {
                                $randproduk = rand(19, 21);
                            } else {
                                $randproduk = rand(1, 18);
                            }
                        } else {
                            $randproduk = rand(1, 21);
                        }

                        $cekproduk = JualDetail::where('nota_jual_id', $notajual->id)
                            ->where('produk_ukuran_id', $randproduk)
                            ->first();

                        $harga = UkuranProduk::where('id', $randproduk)->value('harga');

                        if ($cekproduk == null) {
                            $qty = rand(5, 10);
                            $subtotal = $harga * $qty;

                            JualDetail::create([
                                'nota_jual_id' => $notajual->id,
                                'produk_ukuran_id' => $randproduk,
                                'qty_produk' => $qty,
                                'harga' => $harga,
                                'subtotal' => $subtotal,
                            ]);

                            $total_qty += $qty;
                            $grandtotal += $subtotal;
                        }
                    }

                    $notajual
                        ->update([
                            'tgl_pesan' => Carbon::create(2021, $i, $e),
                            'total_qty' => $total_qty,
                            'grand_total' => $grandtotal,
                        ]);
                }
            }
        }

        // 2022
        for ($i = 1; $i <= 12; $i++) {

            $totalHari = now()->month($i)->daysInMonth;

            for ($e = 1; $e <= $totalHari; $e++) {

                if ($i == 4 || $i == 5) {
                    $rndmdata = rand(5, 20);
                } else {
                    $rndmdata = rand(3, 5);
                }

                $tgl_pesan = Carbon::create(2022, $i, $e);

                for ($j = 1; $j <= $rndmdata; $j++) {

                    $month = $tgl_pesan->format('m');
                    $year = $tgl_pesan->format('y');
                    $nextInvoiceNumber = NotaJual::max('id') + 1;
                    $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
                    $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

                    $notajual = NotaJual::create([
                        'kode_nota' => $invoiceCode,
                        'tgl_pesan' => $tgl_pesan,
                        'total_qty' => 0,
                        'grand_total' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $grandtotal = 0;
                    $total_qty = 0;

                    for ($a = 1; $a <= rand(5, 10); $a++) {

                        if ($i == 4 || $i == 5) {
                            $randPercentage = rand(1, 100);

                            if ($randPercentage < 80) {
                                $randproduk = rand(19, 21);
                            } else {
                                $randproduk = rand(1, 18);
                            }
                        } else {
                            $randproduk = rand(1, 21);
                        }

                        $cekproduk = JualDetail::where('nota_jual_id', $notajual->id)
                            ->where('produk_ukuran_id', $randproduk)
                            ->first();

                        $harga = UkuranProduk::where('id', $randproduk)->value('harga');

                        if ($cekproduk == null) {
                            $qty = rand(5, 10);
                            $subtotal = $harga * $qty;

                            JualDetail::create([
                                'nota_jual_id' => $notajual->id,
                                'produk_ukuran_id' => $randproduk,
                                'qty_produk' => $qty,
                                'harga' => $harga,
                                'subtotal' => $subtotal,
                            ]);

                            $total_qty += $qty;
                            $grandtotal += $subtotal;
                        }
                    }

                    $notajual
                        ->update([
                            'tgl_pesan' => Carbon::create(2022, $i, $e),
                            'total_qty' => $total_qty,
                            'grand_total' => $grandtotal,
                        ]);
                }
            }
        }

        // 2023
        for ($i = 1; $i <= 12; $i++) {

            $totalHari = now()->month($i)->daysInMonth;

            for ($e = 1; $e <= $totalHari; $e++) {

                if ($i == 3 || $i == 4) {
                    $rndmdata = rand(5, 20);
                } else {
                    $rndmdata = rand(3, 5);
                }


                $tgl_pesan = Carbon::create(2023, $i, $e);

                for ($j = 1; $j <= $rndmdata; $j++) {

                    $month = $tgl_pesan->format('m');
                    $year = $tgl_pesan->format('y');
                    $nextInvoiceNumber = NotaJual::max('id') + 1;
                    $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
                    $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

                    $notajual = NotaJual::create([
                        'kode_nota' => $invoiceCode,
                        'tgl_pesan' => $tgl_pesan,
                        'total_qty' => 0,
                        'grand_total' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $grandtotal = 0;
                    $total_qty = 0;

                    for ($a = 1; $a <= rand(5, 10); $a++) {

                        if ($i == 3 || $i == 4) {
                            $randPercentage = rand(1, 100);

                            if ($randPercentage < 80) {
                                $randproduk = rand(19, 21);
                            } else {
                                $randproduk = rand(1, 18);
                            }
                        } else {
                            $randproduk = rand(1, 21);
                        }

                        $cekproduk = JualDetail::where('nota_jual_id', $notajual->id)
                            ->where('produk_ukuran_id', $randproduk)
                            ->first();

                        $harga = UkuranProduk::where('id', $randproduk)->value('harga');

                        if ($cekproduk == null) {
                            $qty = rand(5, 10);
                            $subtotal = $harga * $qty;

                            JualDetail::create([
                                'nota_jual_id' => $notajual->id,
                                'produk_ukuran_id' => $randproduk,
                                'qty_produk' => $qty,
                                'harga' => $harga,
                                'subtotal' => $subtotal,
                            ]);

                            $total_qty += $qty;
                            $grandtotal += $subtotal;
                        }
                    }

                    $notajual
                        ->update([
                            'tgl_pesan' => Carbon::create(2023, $i, $e),
                            'total_qty' => $total_qty,
                            'grand_total' => $grandtotal,
                        ]);
                }
            }
        }

        // 2024
        for ($i = 1; $i <= 4; $i++) {

            // $totalHari = now()->month($i)->daysInMonth;

            for ($e = 1; $e <= 20; $e++) {

                if ($i == 3 || $i == 4) {
                    $rndmdata = rand(5, 20);
                } else {
                    $rndmdata = rand(3, 5);
                }

                $tgl_pesan = Carbon::create(2024, $i, $e);

                for ($j = 1; $j <= $rndmdata; $j++) {

                    $month = $tgl_pesan->format('m');
                    $year = $tgl_pesan->format('y');
                    $nextInvoiceNumber = NotaJual::max('id') + 1;
                    $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
                    $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

                    $notajual = NotaJual::create([
                        'kode_nota' => $invoiceCode,
                        'tgl_pesan' => $tgl_pesan,
                        'total_qty' => 0,
                        'grand_total' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $grandtotal = 0;
                    $total_qty = 0;

                    for ($a = 1; $a <= rand(5, 10); $a++) {

                        if ($i == 3 || $i == 4) {
                            $randPercentage = rand(1, 100);

                            if ($randPercentage < 80) {
                                $randproduk = rand(19, 21);
                            } else {
                                $randproduk = rand(1, 18);
                            }
                        } else {
                            $randproduk = rand(1, 21);
                        }

                        $cekproduk = JualDetail::where('nota_jual_id', $notajual->id)
                            ->where('produk_ukuran_id', $randproduk)
                            ->first();

                        $harga = UkuranProduk::where('id', $randproduk)->value('harga');

                        if ($cekproduk == null) {
                            $qty = rand(5, 10);
                            $subtotal = $harga * $qty;

                            JualDetail::create([
                                'nota_jual_id' => $notajual->id,
                                'produk_ukuran_id' => $randproduk,
                                'qty_produk' => $qty,
                                'harga' => $harga,
                                'subtotal' => $subtotal,
                            ]);

                            $total_qty += $qty;
                            $grandtotal += $subtotal;
                        }
                    }

                    $notajual
                        ->update([
                            'tgl_pesan' => Carbon::create(2024, $i, $e),
                            'total_qty' => $total_qty,
                            'grand_total' => $grandtotal,
                        ]);
                }
            }
        }
    }
}
