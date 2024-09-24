<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Musim;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\JualDetail;
use App\Models\WarnaProduk;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class PeramalanController extends Controller
{
    public function musiman()
    {
        $produks = Produk::all();

        $musims = Musim::all();

        $produkwarnas = WarnaProduk::all();

        $produkukurans = WarnaProduk::join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->get();

        $tahuntarget = [];

        $tahuntarget[] = now()->format('Y');
        $tahuntarget[] = now()->addYears(1)->format('Y');

        return view('peramalan.musiman', compact('tahuntarget', 'produks', 'produkwarnas', 'produkukurans', 'musims'));
    }

    public function musimanproses(Request $request)
    {
        $musiman = [];

        $produk = $request->input('produk');

        $musim = $request->input('musim');
        $target_tahun = $request->input('target_tahun');
        $data_tahun = $request->input('data_tahun');

        $list_musim_perhitungan = [];
        $list_musim_display = [];

        $targettahun = Carbon::createFromFormat('Y', $target_tahun);
        $targettahun2 = Carbon::createFromFormat('Y', $target_tahun);

        for ($i = 0; $i < ($data_tahun * 2) + 1; $i++) {

            $musims = Musim::join('musim_detail', 'musims.id', '=', 'musim_detail.musim_id')
                ->where('musim_id', $musim)
                ->where('tahun', $targettahun->format('Y'))
                ->first();

            $list_musim_perhitungan[] = [
                'musim' => $musims->nama . ' ' . $musims->tahun,
                'bulan_awal' => $musims->bulan_awal,
                'bulan_akhir' => $musims->bulan_akhir
            ];

            $targettahun->subYears(1);
        }

        for ($i = 0; $i <= $data_tahun; $i++) {

            $musims = Musim::join('musim_detail', 'musims.id', '=', 'musim_detail.musim_id')
                ->where('musim_id', $musim)
                ->where('tahun', $targettahun2->format('Y'))
                ->first();

            $list_musim_display[] = [
                'musim' => $musims->nama . ' ' . $musims->tahun,
                'bulan_awal' => $musims->bulan_awal,
                'bulan_akhir' => $musims->bulan_akhir
            ];

            $targettahun2->subYears(1);
        }

        // dd($list_musim_display);

        if ($produk != null) {

            $ukuran = $request->input('ukuran');
            $warna = $request->input('warna');

            if ($warna == 'Semua' && $ukuran == 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $produkukurans = UkuranProduk::where('produk_warna_id', $value['id'])->get();

                    foreach ($produkukurans as $value2) {

                        $arrAktualHitungan = [];
                        $arrBobot = [];
                        $arrWaktuHitungan = [];

                        // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                        for ($i = 0; $i < count($list_musim_perhitungan); $i++) {

                            $bulanawal = Carbon::parse($list_musim_perhitungan[$i]['bulan_awal']);
                            $bulanakhir = Carbon::parse($list_musim_perhitungan[$i]['bulan_akhir']);

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->where('produk_ukuran.id', $value2['id'])
                                ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualHitungan[] = (int) $aktual;
                            $arrBobot[] = $i+1;
                            $arrWaktuHitungan[] = $list_musim_perhitungan[$i]['musim'] . ' ( ' . $list_musim_perhitungan[$i]['bulan_awal'] . ' - ' . $list_musim_perhitungan[$i]['bulan_akhir'] . ' )';
                        }

                        $arrBobot = array_reverse($arrBobot);

                        $arrAktualDisplay = [];
                        $arrWaktuDisplay = [];

                        for ($i = 0; $i < count($list_musim_display); $i++) {

                            $bulanawal = Carbon::parse($list_musim_display[$i]['bulan_awal']);
                            $bulanakhir = Carbon::parse($list_musim_display[$i]['bulan_akhir']);

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->where('produk_ukuran.id', $value2['id'])
                                ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualDisplay[] = (int) $aktual;
                            $arrWaktuDisplay[] = $list_musim_display[$i]['musim'] . ' ( ' . $list_musim_display[$i]['bulan_awal'] . ' - ' . $list_musim_display[$i]['bulan_akhir'] . ' )';
                        }

                        $arrWMA = [];

                        foreach ($arrWaktuHitungan as $idx => $data) {

                            $index = $idx + 1;
                            $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                            $jumlahBobot = 0; // Jumlah Bobot

                            if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                                for ($i = 0; $i < $data_tahun; $i++) {
                                    $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                    $jumlahBobot += $arrBobot[$index];
                                    $index++;
                                }

                                $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                            }
                        }

                        $arrMAPE = [];



                        foreach ($arrWMA as $idx => $data) {
                            if ($idx == 0) {
                                $arrMAPE[] = 0;
                            } else {
                                $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                                if ($arrAktualHitungan[$idx] != 0) {
                                    $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                                } else {
                                    $mapee = abs($error / 1) * 100;
                                }

                                $arrMAPE[] = round($mapee, 2);
                            }
                        }


                        $arrMAPE2 = [];

                        foreach ($arrMAPE as $idx => $data) {
                            if ($idx != 0) {
                                $arrMAPE2[] = $data;
                            }
                        }

                        $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                        $arrMAPE[0] = round($mape, 2);

                        if ($arrMAPE[0] <= 10) {
                            $akurasi = 'Sangat Baik';
                        } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                            $akurasi = 'Baik';
                        } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                            $akurasi = 'Cukup Baik';
                        } else {
                            $akurasi = 'Kurang Baik';
                        }

                        // dd($arrWMA, $arrMAPE, $arrMAPE2);

                        $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                            ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                            ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                            ->where('produk_ukuran.id', $value2['id'])
                            ->first();

                        $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                        $arrAktualDisplay = array_reverse($arrAktualDisplay);
                        $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                        $arrWMA = array_reverse($arrWMA);
                        $arrMAPE = array_reverse($arrMAPE);

                        $musiman[$index] = [
                            'id' => $value['id'] . '-' . $value2['id'],
                            'jenis' => 'produk',
                            'arrAktualHitungan' => $arrAktualHitungan,
                            'dataAktualDisplay' => $arrAktualDisplay,
                            'waktuDisplay' => $arrWaktuDisplay,
                            'dataWMA' => $arrWMA,
                            'dataMAPE' => $arrMAPE,
                            'akurasi' => $akurasi,
                        ];
                    }
                }               

            } elseif ($warna == 'Semua' && $ukuran != 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                    for ($i = 0; $i < count($list_musim_perhitungan); $i++) {

                        $bulanawal = Carbon::parse($list_musim_perhitungan[$i]['bulan_awal']);
                        $bulanakhir = Carbon::parse($list_musim_perhitungan[$i]['bulan_akhir']);

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_warna.id', $value['id'])
                            ->where('ukurans.id', $ukuran)
                            ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i + 1;
                        $arrWaktuHitungan[] = $list_musim_perhitungan[$i]['musim'] . ' ( ' . $list_musim_perhitungan[$i]['bulan_awal'] . ' - ' . $list_musim_perhitungan[$i]['bulan_akhir'] . ' )';
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i < count($list_musim_display); $i++) {

                        $bulanawal = Carbon::parse($list_musim_display[$i]['bulan_awal']);
                        $bulanakhir = Carbon::parse($list_musim_display[$i]['bulan_akhir']);

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_warna.id', $value['id'])
                            ->where('ukurans.id', $ukuran)
                            ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $list_musim_display[$i]['musim'] . ' ( ' . $list_musim_display[$i]['bulan_awal'] . ' - ' . $list_musim_display[$i]['bulan_akhir'] . ' )';
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $data_tahun; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);
                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }
                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    // dd($arrWMA, $arrMAPE, $arrMAPE2);

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_warna.id', $value['id'])
                        ->where('ukurans.id', $ukuran)
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $musiman[$index] = [
                        'id' => $value['id'] . '-' . $ukuran,
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            } elseif ($warna != 'Semua' && $ukuran == 'Semua') {
                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)->get();

                foreach ($produkukurans as $value) {

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                    for ($i = 0; $i < count($list_musim_perhitungan); $i++) {

                        $bulanawal = Carbon::parse($list_musim_perhitungan[$i]['bulan_awal']);
                        $bulanakhir = Carbon::parse($list_musim_perhitungan[$i]['bulan_akhir']);

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i + 1;
                        $arrWaktuHitungan[] = $list_musim_perhitungan[$i]['musim'] . ' ( ' . $list_musim_perhitungan[$i]['bulan_awal'] . ' - ' . $list_musim_perhitungan[$i]['bulan_akhir'] . ' )';
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i < count($list_musim_display); $i++) {

                        $bulanawal = Carbon::parse($list_musim_display[$i]['bulan_awal']);
                        $bulanakhir = Carbon::parse($list_musim_display[$i]['bulan_akhir']);

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $list_musim_display[$i]['musim'] . ' ( ' . $list_musim_display[$i]['bulan_awal'] . ' - ' . $list_musim_display[$i]['bulan_akhir'] . ' )';
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $data_tahun; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $musiman[$index] = [
                        'id' => $warna . '-' . $value['id'],
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            } else {
                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)
                ->where('ukuran_id', $ukuran)
                ->get();

                foreach ($produkukurans as $value) {

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                    for ($i = 0; $i < count($list_musim_perhitungan); $i++) {

                        $bulanawal = Carbon::parse($list_musim_perhitungan[$i]['bulan_awal']);
                        $bulanakhir = Carbon::parse($list_musim_perhitungan[$i]['bulan_akhir']);

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i + 1;
                        $arrWaktuHitungan[] = $list_musim_perhitungan[$i]['musim'] . ' ( ' . $list_musim_perhitungan[$i]['bulan_awal'] . ' - ' . $list_musim_perhitungan[$i]['bulan_akhir'] . ' )';
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i < count($list_musim_display); $i++) {

                        $bulanawal = Carbon::parse($list_musim_display[$i]['bulan_awal']);
                        $bulanakhir = Carbon::parse($list_musim_display[$i]['bulan_akhir']);

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $list_musim_display[$i]['musim'] . ' ( ' . $list_musim_display[$i]['bulan_awal'] . ' - ' . $list_musim_display[$i]['bulan_akhir'] . ' )';
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $data_tahun; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $musiman[$index] = [
                        'id' => $warna . '-' . $value['id'],
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            }
        } else {
            $kategoris = KategoriProduk::all();

            foreach ($kategoris as $item) {

                $arrAktualHitungan = [];
                $arrBobot = [];
                $arrWaktuHitungan = [];

                for ($i = 0; $i < count($list_musim_perhitungan); $i++) {

                    $bulanawal = Carbon::parse($list_musim_perhitungan[$i]['bulan_awal']);
                    $bulanakhir = Carbon::parse($list_musim_perhitungan[$i]['bulan_akhir']);

                    $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                        ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                        ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                        ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                        ->where('kategori_produks.nama', $item->nama)
                        ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                        ->sum('nota_jual_details.qty_produk');

                    $arrAktualHitungan[] = (int) $aktual;
                    $arrBobot[] = $i + 1;
                    $arrWaktuHitungan[] = $list_musim_perhitungan[$i]['musim'] . ' ( ' . $list_musim_perhitungan[$i]['bulan_awal'] . ' - ' . $list_musim_perhitungan[$i]['bulan_akhir'] . ' )';
                }

                $arrBobot = array_reverse($arrBobot);

                $arrWaktuDisplay = [];
                $arrAktualDisplay = [];

                for ($i = 0; $i < count($list_musim_display); $i++) {

                    $bulanawal = Carbon::parse($list_musim_display[$i]['bulan_awal']);
                    $bulanakhir = Carbon::parse($list_musim_display[$i]['bulan_akhir']);

                    $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                        ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                        ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                        ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                        ->where('kategori_produks.nama', $item->nama)
                        ->whereBetween(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), [$bulanawal->format('Y-m'), $bulanakhir->format('Y-m')])
                        ->sum('nota_jual_details.qty_produk');

                    $arrAktualDisplay[] = (int) $aktual;
                    $arrWaktuDisplay[] = $list_musim_display[$i]['musim'] . ' ( ' . $list_musim_display[$i]['bulan_awal'] . ' - ' . $list_musim_display[$i]['bulan_akhir'] . ' )';
                }

                $arrWMA = [];

                foreach ($arrWaktuHitungan as $idx => $data) {

                    $index = $idx + 1;
                    $wmaatas = 0;
                    $jumlahBobot = 0;

                    if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                        for ($i = 0; $i < $data_tahun; $i++) {
                            $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                            $jumlahBobot += $arrBobot[$index];
                            $index++;
                        }

                        $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                    }
                }

                $arrMAPE = [];

                foreach ($arrWMA as $idx => $data) {
                    if ($idx == 0) {
                        $arrMAPE[] = 0;
                    } else {
                        $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                        if ($arrAktualHitungan[$idx] != 0) {
                            $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                        } else {
                            $mapee = abs($error / 1) * 100;
                        }

                        $arrMAPE[] = round($mapee, 2);
                    }
                }

                $arrMAPE2 = [];

                foreach ($arrMAPE as $idx => $data) {
                    if ($idx != 0) {
                        $arrMAPE2[] = $data;
                    }
                }

                $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                $arrMAPE[0] = round($mape, 2);

                if ($arrMAPE[0] <= 10) {
                    $akurasi = 'Sangat Baik';
                } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                    $akurasi = 'Baik';
                } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                    $akurasi = 'Cukup Baik';
                } else {
                    $akurasi = 'Kurang Baik';
                }

                $arrAktualDisplay = array_reverse($arrAktualDisplay);
                $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                $arrWMA = array_reverse($arrWMA);
                $arrMAPE = array_reverse($arrMAPE);

                $musiman[$item->nama] = [
                    'id' => $item->id,
                    'jenis' => 'kategori',
                    'arrAktualHitungan' => $arrAktualHitungan,
                    'dataAktualDisplay' => $arrAktualDisplay,
                    'waktuDisplay' => $arrWaktuDisplay,
                    'dataWMA' => $arrWMA,
                    'dataMAPE' => $arrMAPE,
                    'akurasi' => $akurasi,
                ];
            }
        }

        // dd($musiman);

        Session::flash('musiman', $musiman);

        return redirect()->route('peramalan.musiman')->withInput();
    }

    public function bulanan()
    {
        $produks = Produk::all();

        $produkwarnas = WarnaProduk::all();

        $produkukurans = WarnaProduk::join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->get();

        $bulantarget = [];

        $bulantarget[] = Carbon::now()->format('F Y');
        $bulantarget[] = Carbon::now()->addMonths(1)->format('F Y');

        return view('peramalan.bulanan', compact('bulantarget', 'produks', 'produkwarnas', 'produkukurans'));
    }

    public function getBulan($target_bulan)
    {
        $databulan = [];
        $currentTarget = Carbon::parse($target_bulan);

        // for ($i = 0; $i < 3; $i++) {

            $bulan = $currentTarget->subMonths(3)->format('F Y');
            $databulan[] = $bulan;
        // }

        return response()->json($databulan);
    }

    public function bulananproses(Request $request)
    {
        $bulanan = [];

        $produk = $request->input('produk');

        $target_bulan = $request->input('target_bulan');
        $data_bulan = $request->input('data_bulan');

        if ($produk != null) {

            $ukuran = $request->input('ukuran');
            $warna = $request->input('warna');

            if ($warna == 'Semua' && $ukuran == 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $produkukurans = UkuranProduk::where('produk_warna_id', $value['id'])->get();

                    foreach ($produkukurans as $value2) {

                        $targetbulan1 = Carbon::parse($target_bulan);
                        $targetbulan2 = Carbon::parse($target_bulan);
                        $databulan = Carbon::parse($data_bulan);

                        $selisihBulan = $targetbulan1->diffInMonths($databulan);

                        $arrAktualHitungan = [];
                        $arrBobot = [];
                        $arrWaktuHitungan = [];

                        // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                        for ($i = 1; $i <= ($selisihBulan * 2) + 1; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->where('produk_ukuran.id', $value2['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualHitungan[] = (int) $aktual;
                            $arrBobot[] = $i;
                            $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                            $targetbulan1->subMonths(1);
                        }

                        $arrBobot = array_reverse($arrBobot);

                        $arrAktualDisplay = [];
                        $arrWaktuDisplay = [];

                        for ($i = 0; $i <= $selisihBulan; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->where('produk_ukuran.id', $value2['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualDisplay[] = (int) $aktual;
                            $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                            $targetbulan2->subMonths(1);
                        }

                        $arrWMA = [];

                        foreach ($arrWaktuHitungan as $idx => $data) {

                            $index = $idx + 1;
                            $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                            $jumlahBobot = 0; // Jumlah Bobot

                            if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                                for ($i = 0; $i < $selisihBulan; $i++) {
                                    $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                    $jumlahBobot += $arrBobot[$index];
                                    $index++;
                                }

                                $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                            }
                        }

                        $arrMAPE = [];



                        foreach ($arrWMA as $idx => $data) {
                            if ($idx == 0) {
                                $arrMAPE[] = 0;
                            } else {
                                $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                                if ($arrAktualHitungan[$idx] != 0) {
                                    $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                                } else {
                                    $mapee = abs($error / 1) * 100;
                                }

                                $arrMAPE[] = round($mapee, 2);
                            }
                        }


                        $arrMAPE2 = [];

                        foreach ($arrMAPE as $idx => $data) {
                            if ($idx != 0) {
                                $arrMAPE2[] = $data;
                            }
                        }

                        $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                        $arrMAPE[0] = round($mape, 2);

                        if ($arrMAPE[0] <= 10) {
                            $akurasi = 'Sangat Baik';
                        } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                            $akurasi = 'Baik';
                        } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                            $akurasi = 'Cukup Baik';
                        } else {
                            $akurasi = 'Kurang Baik';
                        }

                        // dd($arrWMA, $arrMAPE, $arrMAPE2);

                        $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                            ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                            ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                            ->where('produk_ukuran.id', $value2['id'])
                            ->first();

                        $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                        $arrAktualDisplay = array_reverse($arrAktualDisplay);
                        $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                        $arrWMA = array_reverse($arrWMA);
                        $arrMAPE = array_reverse($arrMAPE);

                        $bulanan[$index] = [
                            'id' => $value['id'] . '-' . $value2['id'],
                            'jenis' => 'produk',
                            'arrAktualHitungan' => $arrAktualHitungan,
                            'dataAktualDisplay' => $arrAktualDisplay,
                            'waktuDisplay' => $arrWaktuDisplay,
                            'dataWMA' => $arrWMA,
                            'dataMAPE' => $arrMAPE,
                            'akurasi' => $akurasi,
                        ];
                    }
                }

            } elseif ($warna == 'Semua' && $ukuran != 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $targetbulan1 = Carbon::parse($target_bulan);
                    $targetbulan2 = Carbon::parse($target_bulan);
                    $databulan = Carbon::parse($data_bulan);

                    $selisihBulan = $targetbulan1->diffInMonths($databulan);

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                    for ($i = 1; $i <= ($selisihBulan * 2) + 1; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_warna.id', $value['id'])
                            ->where('ukurans.id', $ukuran)
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i;
                        $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                        $targetbulan1->subMonths(1);
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i <= $selisihBulan; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_warna.id', $value['id'])
                            ->where('ukurans.id', $ukuran)
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                        $targetbulan2->subMonths(1);
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $selisihBulan; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);
                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }
                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    // dd($arrWMA, $arrMAPE, $arrMAPE2);

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_warna.id', $value['id'])
                        ->where('ukurans.id', $ukuran)
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $bulanan[$index] = [
                        'id' => $value['id'] . '-' . $ukuran,
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            } elseif ($warna != 'Semua' && $ukuran == 'Semua') {
                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)->get();

                foreach ($produkukurans as $value) {

                    $targetbulan1 = Carbon::parse($target_bulan);
                    $targetbulan2 = Carbon::parse($target_bulan);
                    $databulan = Carbon::parse($data_bulan);

                    $selisihBulan = $targetbulan1->diffInMonths($databulan);

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                    for ($i = 1; $i <= ($selisihBulan * 2) + 1; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i;
                        $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                        $targetbulan1->subMonths(1);
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i <= $selisihBulan; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                        $targetbulan2->subMonths(1);
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $selisihBulan; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $bulanan[$index] = [
                        'id' => $warna . '-' . $value['id'],
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            } else {
                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)
                ->where('ukuran_id', $ukuran)
                ->get();

                foreach ($produkukurans as $value) {

                    $targetbulan1 = Carbon::parse($target_bulan);
                    $targetbulan2 = Carbon::parse($target_bulan);
                    $databulan = Carbon::parse($data_bulan);

                    $selisihBulan = $targetbulan1->diffInMonths($databulan);

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                    for ($i = 1; $i <= ($selisihBulan * 2) + 1; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i;
                        $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                        $targetbulan1->subMonths(1);
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i <= $selisihBulan; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                        $targetbulan2->subMonths(1);
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $selisihBulan; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $bulanan[$index] = [
                        'id' => $warna . '-' . $value['id'],
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            }
        } else {
            $kategoris = KategoriProduk::all();

            foreach ($kategoris as $item) {

                $targetbulan1 = Carbon::parse($target_bulan);
                $targetbulan2 = Carbon::parse($target_bulan);
                $databulan = Carbon::parse($data_bulan);

                $selisihBulan = $targetbulan1->diffInMonths($databulan);

                $arrAktualHitungan = [];
                $arrBobot = [];
                $arrWaktuHitungan = [];

                for ($i = 1; $i <= ($selisihBulan * 2) + 1; $i++) {

                    $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                        ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                        ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                        ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                        ->where('kategori_produks.nama', $item->nama)
                        ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                        ->sum('nota_jual_details.qty_produk');

                    $arrAktualHitungan[] = (int) $aktual;
                    $arrBobot[] = $i;
                    $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                    $targetbulan1->subMonths(1);
                }

                $arrBobot = array_reverse($arrBobot);



                $arrWaktuDisplay = [];
                $arrAktualDisplay = [];

                for ($i = 0; $i <= $selisihBulan; $i++) {

                    $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                        ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                        ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                        ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                        ->where('kategori_produks.nama', $item->nama)
                        ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                        ->sum('nota_jual_details.qty_produk');

                    $arrAktualDisplay[] = (int) $aktual;
                    $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                    $targetbulan2->subMonths(1);
                }

                $arrWMA = [];

                foreach ($arrWaktuHitungan as $idx => $data) {

                    $index = $idx + 1;
                    $wmaatas = 0;
                    $jumlahBobot = 0;

                    if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                        for ($i = 0; $i < $selisihBulan; $i++) {
                            $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                            $jumlahBobot += $arrBobot[$index];
                            $index++;
                        }

                        $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                    }
                }

                $arrMAPE = [];

                foreach ($arrWMA as $idx => $data) {
                    if ($idx == 0) {
                        $arrMAPE[] = 0;
                    } else {
                        $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                        if ($arrAktualHitungan[$idx] != 0) {
                            $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                        } else {
                            $mapee = abs($error / 1) * 100;
                        }

                        $arrMAPE[] = round($mapee, 2);
                    }
                }

                $arrMAPE2 = [];

                foreach ($arrMAPE as $idx => $data) {
                    if ($idx != 0) {
                        $arrMAPE2[] = $data;
                    }
                }

                $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                $arrMAPE[0] = round($mape, 2);

                if ($arrMAPE[0] <= 10) {
                    $akurasi = 'Sangat Baik';
                } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                    $akurasi = 'Baik';
                } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                    $akurasi = 'Cukup Baik';
                } else {
                    $akurasi = 'Kurang Baik';
                }

                $arrAktualDisplay = array_reverse($arrAktualDisplay);
                $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                $arrWMA = array_reverse($arrWMA);
                $arrMAPE = array_reverse($arrMAPE);

                $bulanan[$item->nama] = [
                    'id' => $item->id,
                    'jenis' => 'kategori',
                    'arrAktualHitungan' => $arrAktualHitungan,
                    'dataAktualDisplay' => $arrAktualDisplay,
                    'waktuDisplay' => $arrWaktuDisplay,
                    'dataWMA' => $arrWMA,
                    'dataMAPE' => $arrMAPE,
                    'akurasi' => $akurasi,
                ];
            }
        }

        Session::flash('bulanan', $bulanan);

        return redirect()->route('peramalan.bulanan')->withInput();
    }

    public function bulankhusus()
    {
        $produks = Produk::all();

        $produkwarnas = WarnaProduk::all();

        $produkukurans = WarnaProduk::join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->get();

        $datatahun = [];
        $bulantarget = [];

        $bulanTahunTarget = Carbon::now()->addMonths(1);

        for ($i = 1; $i <= 12; $i++) {

            // $bulantarget[] = $bulanTahunTarget->format('F Y');
            array_push($bulantarget, ["value" => $i, "name" => $bulanTahunTarget->format('F Y')]);
            $bulanTahunTarget = $bulanTahunTarget->addMonths(1);
        }

        return view('peramalan.bulankhusus', compact('bulantarget', 'produks', 'produkwarnas', 'produkukurans'));
    }

    public function getTahun($target_bulan)
    {
        $datatahun = [];
        $currentTarget = Carbon::parse($target_bulan);

        // for ($i = 0; $i < 3; $i++) {

            $tahun = $currentTarget->subYears(3)->format('F Y');
            $datatahun[] = $tahun;
        // }

        // dd($target_bulan, $currentTarget, $datatahun);

        return response()->json($datatahun);
    }

    public function bulankhususproses(Request $request)
    {
        $bulankhusus = [];

        $produk = $request->input('produk');

        $data_tahun = $request->input('data_tahun');
        $target_bulan = $request->input('users-list-tags');
        $arr_target_bulan = json_decode($target_bulan);

        // dd($data_tahun, $target_bulan, $arr_target_bulan);

        if ($produk != null) {

            $ukuran = $request->input('ukuran');
            $warna = $request->input('warna');

            if ($warna == 'Semua' && $ukuran == 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $produkukurans = UkuranProduk::where('produk_warna_id', $value['id'])->get();

                    foreach ($produkukurans as $value2) {

                        $valueArr = [];

                        foreach ($arr_target_bulan as $value3) {

                            $targetbulan1 = Carbon::parse($value3->name);
                            $targetbulan2 = Carbon::parse($value3->name);

                            $arrAktualHitungan = [];
                            $arrBobot = [];
                            $arrWaktuHitungan = [];

                            // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                            for ($i = 1; $i <= ($data_tahun * 2) + 1; $i++) {

                                $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                    ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                    ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                    ->where('produk_ukuran.id', $value2['id'])
                                    ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                                    ->sum('nota_jual_details.qty_produk');

                                $arrAktualHitungan[] = (int) $aktual;
                                $arrBobot[] = $i;
                                $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                                $targetbulan1->subYears(1);
                            }

                            // dd($arrAktualHitungan);

                            $arrBobot = array_reverse($arrBobot);

                            $arrAktualDisplay = [];
                            $arrWaktuDisplay = [];

                            for ($i = 0; $i <= $data_tahun; $i++) {

                                $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                    ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                    ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                    ->where('produk_ukuran.id', $value2['id'])
                                    ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                                    ->sum('nota_jual_details.qty_produk');

                                $arrAktualDisplay[] = (int) $aktual;
                                $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                                $targetbulan2->subYears(1);
                            }

                            $arrWMA = [];

                            foreach ($arrWaktuHitungan as $idx => $data) {

                                $index = $idx + 1;
                                $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                                $jumlahBobot = 0; // Jumlah Bobot

                                if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                                    for ($i = 0; $i < $data_tahun; $i++) {
                                        $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                        $jumlahBobot += $arrBobot[$index];
                                        $index++;
                                    }

                                    $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                                }
                            }

                            $arrMAPE = [];

                            foreach ($arrWMA as $idx => $data) {
                                if ($idx == 0) {
                                    $arrMAPE[] = 0;
                                } else {
                                    $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                                    if ($arrAktualHitungan[$idx] != 0) {
                                        $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                                    } else {
                                        $mapee = abs($error / 1) * 100;
                                    }

                                    $arrMAPE[] = round($mapee, 2);
                                }
                            }

                            $arrMAPE2 = [];

                            foreach ($arrMAPE as $idx => $data) {
                                if ($idx != 0) {
                                    $arrMAPE2[] = $data;
                                }
                            }

                            $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                            $arrMAPE[0] = round($mape, 2);

                            if ($arrMAPE[0] <= 10) {
                                $akurasi = 'Sangat Baik';
                            } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                                $akurasi = 'Baik';
                            } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                                $akurasi = 'Cukup Baik';
                            } else {
                                $akurasi = 'Kurang Baik';
                            }

                            $arrAktualDisplay = array_reverse($arrAktualDisplay);
                            $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                            $arrWMA = array_reverse($arrWMA);
                            $arrMAPE = array_reverse($arrMAPE);

                            $valueArr[] = [
                                'id' => $value['id'] . '-' . $value2['id'] . '-' . $value3->value,
                                'arrAktualHitungan' => $arrAktualHitungan,
                                'dataAktualDisplay' => $arrAktualDisplay,
                                'waktuDisplay' => $arrWaktuDisplay,
                                'dataWMA' => $arrWMA,
                                'dataMAPE' => $arrMAPE,
                                'akurasi' => $akurasi
                            ];
                        }

                        $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                            ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                            ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                            ->where('produk_ukuran.id', $value2['id'])
                            ->first();

                        $key = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;
                        $index = $produks->kode_produk . '-' . $produks->warna . '-' . $produks->nama;

                        $bulankhusus[] = [
                            "key" => $key,
                            "id" => $index,
                            "jenis" => 'produk',
                            "value" => $valueArr
                        ];

                    }
                }

                // dd($bulankhusus);

            } elseif ($warna == 'Semua' && $ukuran != 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $valueArr = [];

                    foreach ($arr_target_bulan as $value3) {

                        $targetbulan1 = Carbon::parse($value3->name);
                        $targetbulan2 = Carbon::parse($value3->name);

                        $arrAktualHitungan = [];
                        $arrBobot = [];
                        $arrWaktuHitungan = [];

                        // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                        for ($i = 1; $i <= ($data_tahun * 2) + 1; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                                ->where('produk_warna.id', $value['id'])
                                ->where('ukurans.id', $ukuran)
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualHitungan[] = (int) $aktual;
                            $arrBobot[] = $i;
                            $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                            $targetbulan1->subYears(1);
                        }

                        $arrBobot = array_reverse($arrBobot);

                        $arrAktualDisplay = [];
                        $arrWaktuDisplay = [];

                        for ($i = 0; $i <= $data_tahun; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                                ->where('produk_warna.id', $value['id'])
                                ->where('ukurans.id', $ukuran)
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualDisplay[] = (int) $aktual;
                            $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                            $targetbulan2->subYears(1);
                        }

                        $arrWMA = [];

                        foreach ($arrWaktuHitungan as $idx => $data) {

                            $index = $idx + 1;
                            $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                            $jumlahBobot = 0; // Jumlah Bobot

                            if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                                for ($i = 0; $i < $data_tahun; $i++) {
                                    $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                    $jumlahBobot += $arrBobot[$index];
                                    $index++;
                                }

                                $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                            }
                        }

                        $arrMAPE = [];

                        foreach ($arrWMA as $idx => $data) {
                            if ($idx == 0) {
                                $arrMAPE[] = 0;
                            } else {
                                $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);
                                if ($arrAktualHitungan[$idx] != 0) {
                                    $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                                } else {
                                    $mapee = abs($error / 1) * 100;
                                }
                                $arrMAPE[] = round($mapee, 2);
                            }
                        }

                        $arrMAPE2 = [];

                        foreach ($arrMAPE as $idx => $data) {
                            if ($idx != 0) {
                                $arrMAPE2[] = $data;
                            }
                        }

                        $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                        $arrMAPE[0] = round($mape, 2);

                        if ($arrMAPE[0] <= 10) {
                            $akurasi = 'Sangat Baik';
                        } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                            $akurasi = 'Baik';
                        } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                            $akurasi = 'Cukup Baik';
                        } else {
                            $akurasi = 'Kurang Baik';
                        }

                        $arrAktualDisplay = array_reverse($arrAktualDisplay);
                        $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                        $arrWMA = array_reverse($arrWMA);
                        $arrMAPE = array_reverse($arrMAPE);

                        $valueArr[] = [
                            'id' => $value['id'] . '-' . $ukuran . '-' . $value3->value,
                            'arrAktualHitungan' => $arrAktualHitungan,
                            'dataAktualDisplay' => $arrAktualDisplay,
                            'waktuDisplay' => $arrWaktuDisplay,
                            'dataWMA' => $arrWMA,
                            'dataMAPE' => $arrMAPE,
                            'akurasi' => $akurasi
                        ];
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_warna.id', $value['id'])
                        ->where('ukurans.id', $ukuran)
                        ->first();

                    $key = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;
                    $index = $produks->kode_produk . '-' . $produks->warna . '-' . $produks->nama;

                    $bulankhusus[] = [
                        "key" => $key,
                        "id" => $index,
                        "jenis" => 'produk',
                        "value" => $valueArr
                    ];
                }
            } elseif ($warna != 'Semua' && $ukuran == 'Semua') {
                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)->get();

                foreach ($produkukurans as $value) {

                    $valueArr = [];

                    foreach ($arr_target_bulan as $value3) {

                        $targetbulan1 = Carbon::parse($value3->name);
                        $targetbulan2 = Carbon::parse($value3->name);

                        $arrAktualHitungan = [];
                        $arrBobot = [];
                        $arrWaktuHitungan = [];

                        // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                        for ($i = 1; $i <= ($data_tahun * 2) + 1; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                                ->where('produk_ukuran.id', $value['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualHitungan[] = (int) $aktual;
                            $arrBobot[] = $i;
                            $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                            $targetbulan1->subYears(1);
                        }

                        $arrBobot = array_reverse($arrBobot);

                        $arrAktualDisplay = [];
                        $arrWaktuDisplay = [];

                        for ($i = 0; $i <= $data_tahun; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                                ->where('produk_ukuran.id', $value['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualDisplay[] = (int) $aktual;
                            $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                            $targetbulan2->subYears(1);
                        }

                        $arrWMA = [];

                        foreach ($arrWaktuHitungan as $idx => $data) {

                            $index = $idx + 1;
                            $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                            $jumlahBobot = 0; // Jumlah Bobot

                            if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                                for ($i = 0; $i < $data_tahun; $i++) {
                                    $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                    $jumlahBobot += $arrBobot[$index];
                                    $index++;
                                }

                                $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                            }
                        }

                        $arrMAPE = [];

                        foreach ($arrWMA as $idx => $data) {
                            if ($idx == 0) {
                                $arrMAPE[] = 0;
                            } else {
                                $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                                if ($arrAktualHitungan[$idx] != 0) {
                                    $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                                } else {
                                    $mapee = abs($error / 1) * 100;
                                }

                                $arrMAPE[] = round($mapee, 2);
                            }
                        }

                        $arrMAPE2 = [];

                        foreach ($arrMAPE as $idx => $data) {
                            if ($idx != 0) {
                                $arrMAPE2[] = $data;
                            }
                        }

                        $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                        $arrMAPE[0] = round($mape, 2);

                        if ($arrMAPE[0] <= 10) {
                            $akurasi = 'Sangat Baik';
                        } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                            $akurasi = 'Baik';
                        } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                            $akurasi = 'Cukup Baik';
                        } else {
                            $akurasi = 'Kurang Baik';
                        }

                        $arrAktualDisplay = array_reverse($arrAktualDisplay);
                        $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                        $arrWMA = array_reverse($arrWMA);
                        $arrMAPE = array_reverse($arrMAPE);

                        $valueArr[] = [
                            'id' => $warna . '-' . $value['id'] . '-' . $value3->value,
                            'arrAktualHitungan' => $arrAktualHitungan,
                            'dataAktualDisplay' => $arrAktualDisplay,
                            'waktuDisplay' => $arrWaktuDisplay,
                            'dataWMA' => $arrWMA,
                            'dataMAPE' => $arrMAPE,
                            'akurasi' => $akurasi
                        ];

                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $key = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;
                    $index = $produks->kode_produk . '-' . $produks->warna . '-' . $produks->nama;

                    $bulankhusus[] = [
                        "key" => $key,
                        "id" => $index,
                        "jenis" => 'produk',
                        "value" => $valueArr
                    ];
                }
            } else {
                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)
                ->where('ukuran_id', $ukuran)
                ->get();

                foreach ($produkukurans as $value) {

                    $valueArr = [];

                    foreach ($arr_target_bulan as $value3) {

                        $targetbulan1 = Carbon::parse($value3->name);
                        $targetbulan2 = Carbon::parse($value3->name);

                        $arrAktualHitungan = [];
                        $arrBobot = [];
                        $arrWaktuHitungan = [];

                        // Buat dapetin data aktual dengan 2x data bulan acuan hitung + 1 data sebagai tujuan
                        for ($i = 1; $i <= ($data_tahun * 2) + 1; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->where('produk_ukuran.id', $value['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualHitungan[] = (int) $aktual;
                            $arrBobot[] = $i;
                            $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                            $targetbulan1->subYears(1);
                        }

                        $arrBobot = array_reverse($arrBobot);

                        $arrAktualDisplay = [];
                        $arrWaktuDisplay = [];

                        for ($i = 0; $i <= $data_tahun; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->where('produk_ukuran.id', $value['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualDisplay[] = (int) $aktual;
                            $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                            $targetbulan2->subYears(1);
                        }

                        $arrWMA = [];

                        foreach ($arrWaktuHitungan as $idx => $data) {

                            $index = $idx + 1;
                            $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                            $jumlahBobot = 0; // Jumlah Bobot

                            if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                                for ($i = 0; $i < $data_tahun; $i++) {
                                    $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                    $jumlahBobot += $arrBobot[$index];
                                    $index++;
                                }

                                $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                            }
                        }

                        $arrMAPE = [];

                        foreach ($arrWMA as $idx => $data) {
                            if ($idx == 0) {
                                $arrMAPE[] = 0;
                            } else {
                                $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                                if ($arrAktualHitungan[$idx] != 0) {
                                    $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                                } else {
                                    $mapee = abs($error / 1) * 100;
                                }

                                $arrMAPE[] = round($mapee, 2);
                            }
                        }

                        $arrMAPE2 = [];

                        foreach ($arrMAPE as $idx => $data) {
                            if ($idx != 0) {
                                $arrMAPE2[] = $data;
                            }
                        }

                        $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                        $arrMAPE[0] = round($mape, 2);

                        if ($arrMAPE[0] <= 10) {
                            $akurasi = 'Sangat Baik';
                        } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                            $akurasi = 'Baik';
                        } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                            $akurasi = 'Cukup Baik';
                        } else {
                            $akurasi = 'Kurang Baik';
                        }

                        $arrAktualDisplay = array_reverse($arrAktualDisplay);
                        $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                        $arrWMA = array_reverse($arrWMA);
                        $arrMAPE = array_reverse($arrMAPE);

                        $valueArr[] = [
                            'id' => $warna . '-' . $value['id'] . '-' . $value3->value,
                            'arrAktualHitungan' => $arrAktualHitungan,
                            'dataAktualDisplay' => $arrAktualDisplay,
                            'waktuDisplay' => $arrWaktuDisplay,
                            'dataWMA' => $arrWMA,
                            'dataMAPE' => $arrMAPE,
                            'akurasi' => $akurasi
                        ];

                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $key = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;
                    $index = $produks->kode_produk . '-' . $produks->warna . '-' . $produks->nama;

                    $bulankhusus[] = [
                        "key" => $key,
                        "id" => $index,
                        "jenis" => 'produk',
                        "value" => $valueArr
                    ];
                }
            }

        } else {
            $kategoris = KategoriProduk::all();

            foreach ($kategoris as $item) {

                $valueArr = [];

                foreach ($arr_target_bulan as $value) {

                    $targetbulan1 = Carbon::parse($value->name);
                    $targetbulan2 = Carbon::parse($value->name);

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    for ($i = 1; $i <= ($data_tahun * 2) + 1; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                            ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                            ->where('kategori_produks.nama', $item->nama)
                            ->where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $targetbulan1->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i;
                        $arrWaktuHitungan[] = $targetbulan1->format('F Y');
                        $targetbulan1->subYears(1);
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i <= $data_tahun; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                            ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                            ->where('kategori_produks.nama', $item->nama)
                            ->where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $targetbulan2->format('Y-m'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $targetbulan2->format('F Y');
                        $targetbulan2->subYears(1);
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $data_tahun; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $valueArr[] = [
                        'id' => $item->nama . '-' . $value->value,
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi
                    ];

                }

                $bulankhusus[] = [
                    "key" => $item->nama,
                    "id" => $item->id,
                    "jenis" => 'kategori',
                    "value" => $valueArr
                ];
            }
        }

        Session::flash('bulankhusus', $bulankhusus);

        return redirect()->route('peramalan.bulankhusus')->withInput();
    }

    public function tahunan()
    {
        $produks = Produk::all();

        $produkwarnas = WarnaProduk::all();

        $produkukurans = WarnaProduk::join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->get();

        $tahuntarget = [];

        $tahuntarget[] = Carbon::now()->format('Y-m');
        $tahuntarget[] = Carbon::now()->addYears(1)->format('Y-m');

        return view('peramalan.tahunan', compact('tahuntarget', 'produks', 'produkwarnas', 'produkukurans'));
    }

    public function getYear($target_tahun)
    {
        $datatahun = [];
        $currentTarget = Carbon::parse($target_tahun);

        // for ($i = 0; $i < 3; $i++) {

            $tahun = $currentTarget->subYears(3)->format('Y-m');
            $datatahun[] = $tahun;
        // }

        return response()->json($datatahun);
    }

    public function tahunanproses(Request $request)
    {
        $tahunan = [];

        $produk = $request->input('produk');

        $target_tahun = $request->input('target_tahun');
        $data_tahun = $request->input('data_tahun');

        if ($produk != null) {

            $ukuran = $request->input('ukuran');
            $warna = $request->input('warna');

            if ($warna == 'Semua' && $ukuran == 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $produkukurans = UkuranProduk::where('produk_warna_id', $value['id'])->get();

                    foreach ($produkukurans as $value2) {

                        $targettahun1 = Carbon::parse($target_tahun);
                        $targettahun2 = Carbon::parse($target_tahun);
                        $datatahun = Carbon::parse($data_tahun);

                        $selisihTahun = $targettahun1->diffInYears($datatahun);

                        $arrAktualHitungan = [];
                        $arrBobot = [];
                        $arrWaktuHitungan = [];

                        // Buat dapetin data aktual dengan 2x data tahun acuan hitung + 1 data sebagai tujuan
                        for ($i = 1; $i <= ($selisihTahun * 2) + 1; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->where('produk_ukuran.id', $value2['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun1->format('Y'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualHitungan[] = (int) $aktual;
                            $arrBobot[] = $i;
                            $arrWaktuHitungan[] = $targettahun1->format('Y');
                            $targettahun1->subYears(1);
                        }

                        $arrBobot = array_reverse($arrBobot);

                        $arrAktualDisplay = [];
                        $arrWaktuDisplay = [];

                        for ($i = 0; $i <= $selisihTahun; $i++) {

                            $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                                ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                                ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                                ->where('produk_ukuran.id', $value2['id'])
                                ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun2->format('Y'))
                                ->sum('nota_jual_details.qty_produk');

                            $arrAktualDisplay[] = (int) $aktual;
                            $arrWaktuDisplay[] = $targettahun2->format('Y');
                            $targettahun2->subYears(1);
                        }

                        $arrWMA = [];

                        foreach ($arrWaktuHitungan as $idx => $data) {

                            $index = $idx + 1;
                            $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                            $jumlahBobot = 0; // Jumlah Bobot

                            if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                                for ($i = 0; $i < $selisihTahun; $i++) {
                                    $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                    $jumlahBobot += $arrBobot[$index];
                                    $index++;
                                }

                                $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                            }
                        }

                        $arrMAPE = [];

                        foreach ($arrWMA as $idx => $data) {
                            if ($idx == 0) {
                                $arrMAPE[] = 0;
                            } else {
                                $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                                if ($arrAktualHitungan[$idx] != 0) {
                                    $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                                } else {
                                    $mapee = abs($error / 1) * 100;
                                }

                                $arrMAPE[] = round($mapee, 2);
                            }
                        }

                        $arrMAPE2 = [];

                        foreach ($arrMAPE as $idx => $data) {
                            if ($idx != 0) {
                                $arrMAPE2[] = $data;
                            }
                        }

                        $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                        $arrMAPE[0] = round($mape, 2);

                        if ($arrMAPE[0] <= 10) {
                            $akurasi = 'Sangat Baik';
                        } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                            $akurasi = 'Baik';
                        } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                            $akurasi = 'Cukup Baik';
                        } else {
                            $akurasi = 'Kurang Baik';
                        }

                        $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                            ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                            ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                            ->where('produk_ukuran.id', $value2['id'])
                            ->first();

                        $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                        $arrAktualDisplay = array_reverse($arrAktualDisplay);
                        $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                        $arrWMA = array_reverse($arrWMA);
                        $arrMAPE = array_reverse($arrMAPE);

                        $tahunan[$index] = [
                            'id' => $value['id'] . '-' . $value2['id'],
                            'jenis' => 'produk',
                            'arrAktualHitungan' => $arrAktualHitungan,
                            'dataAktualDisplay' => $arrAktualDisplay,
                            'waktuDisplay' => $arrWaktuDisplay,
                            'dataWMA' => $arrWMA,
                            'dataMAPE' => $arrMAPE,
                            'akurasi' => $akurasi,
                        ];
                    }
                }

            } elseif ($warna == 'Semua' && $ukuran != 'Semua') {

                $produkwarnas = WarnaProduk::where('produk_id', $produk)->get();

                foreach ($produkwarnas as $value) {

                    $targettahun1 = Carbon::parse($target_tahun);
                    $targettahun2 = Carbon::parse($target_tahun);
                    $datatahun = Carbon::parse($data_tahun);

                    $selisihTahun = $targettahun1->diffInYears($datatahun);

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data tahun acuan hitung + 1 data sebagai tujuan
                    for ($i = 1; $i <= ($selisihTahun * 2) + 1; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_warna.id', $value['id'])
                            ->where('ukurans.id', $ukuran)
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun1->format('Y'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i;
                        $arrWaktuHitungan[] = $targettahun1->format('Y');
                        $targettahun1->subYears(1);
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i <= $selisihTahun; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_warna.id', $value['id'])
                            ->where('ukurans.id', $ukuran)
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun2->format('Y'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $targettahun2->format('Y');
                        $targettahun2->subYears(1);
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $selisihTahun; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_warna.id', $value['id'])
                        ->where('ukurans.id', $ukuran)
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $tahunan[$index] = [
                        'id' => $value['id'] . '-' . $ukuran,
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            } elseif ($warna != 'Semua' && $ukuran == 'Semua') {

                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)->get();

                foreach ($produkukurans as $value) {

                    $targettahun1 = Carbon::parse($target_tahun);
                    $targettahun2 = Carbon::parse($target_tahun);
                    $datatahun = Carbon::parse($data_tahun);

                    $selisihTahun = $targettahun1->diffInYears($datatahun);

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data tahun acuan hitung + 1 data sebagai tujuan
                    for ($i = 1; $i <= ($selisihTahun * 2) + 1; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun1->format('Y'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i;
                        $arrWaktuHitungan[] = $targettahun1->format('Y');
                        $targettahun1->subYears(1);
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i <= $selisihTahun; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun2->format('Y'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $targettahun2->format('Y');
                        $targettahun2->subYears(1);
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $selisihTahun; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $tahunan[$index] = [
                        'id' => $value['id'] . '-' . $ukuran,
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            } else {
                $produkukurans = UkuranProduk::where('produk_warna_id', $warna)
                ->where('ukuran_id', $ukuran)
                ->get();

                foreach ($produkukurans as $value) {

                    $targettahun1 = Carbon::parse($target_tahun);
                    $targettahun2 = Carbon::parse($target_tahun);
                    $datatahun = Carbon::parse($data_tahun);

                    $selisihTahun = $targettahun1->diffInYears($datatahun);

                    $arrAktualHitungan = [];
                    $arrBobot = [];
                    $arrWaktuHitungan = [];

                    // Buat dapetin data aktual dengan 2x data tahun acuan hitung + 1 data sebagai tujuan
                    for ($i = 1; $i <= ($selisihTahun * 2) + 1; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun1->format('Y'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualHitungan[] = (int) $aktual;
                        $arrBobot[] = $i;
                        $arrWaktuHitungan[] = $targettahun1->format('Y');
                        $targettahun1->subYears(1);
                    }

                    $arrBobot = array_reverse($arrBobot);

                    $arrAktualDisplay = [];
                    $arrWaktuDisplay = [];

                    for ($i = 0; $i <= $selisihTahun; $i++) {

                        $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                            ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                            ->where('produk_ukuran.id', $value['id'])
                            ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun2->format('Y'))
                            ->sum('nota_jual_details.qty_produk');

                        $arrAktualDisplay[] = (int) $aktual;
                        $arrWaktuDisplay[] = $targettahun2->format('Y');
                        $targettahun2->subYears(1);
                    }

                    $arrWMA = [];

                    foreach ($arrWaktuHitungan as $idx => $data) {

                        $index = $idx + 1;
                        $wmaatas = 0; // Perhitungan WMA yang atas aktual x bobot
                        $jumlahBobot = 0; // Jumlah Bobot

                        if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                            for ($i = 0; $i < $selisihTahun; $i++) {
                                $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                                $jumlahBobot += $arrBobot[$index];
                                $index++;
                            }

                            $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                        }
                    }

                    $arrMAPE = [];

                    foreach ($arrWMA as $idx => $data) {
                        if ($idx == 0) {
                            $arrMAPE[] = 0;
                        } else {
                            $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                            if ($arrAktualHitungan[$idx] != 0) {
                                $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                            } else {
                                $mapee = abs($error / 1) * 100;
                            }

                            $arrMAPE[] = round($mapee, 2);
                        }
                    }

                    $arrMAPE2 = [];

                    foreach ($arrMAPE as $idx => $data) {
                        if ($idx != 0) {
                            $arrMAPE2[] = $data;
                        }
                    }

                    $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                    $arrMAPE[0] = round($mape, 2);

                    if ($arrMAPE[0] <= 10) {
                        $akurasi = 'Sangat Baik';
                    } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                        $akurasi = 'Baik';
                    } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                        $akurasi = 'Cukup Baik';
                    } else {
                        $akurasi = 'Kurang Baik';
                    }

                    $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                        ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                        ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna')
                        ->where('produk_ukuran.id', $value['id'])
                        ->first();

                    $index = $produks->kode_produk . ' / ' . $produks->warna . ' / ' . $produks->nama;

                    $arrAktualDisplay = array_reverse($arrAktualDisplay);
                    $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                    $arrWMA = array_reverse($arrWMA);
                    $arrMAPE = array_reverse($arrMAPE);

                    $tahunan[$index] = [
                        'id' => $warna . '-' . $value['id'],
                        'jenis' => 'produk',
                        'arrAktualHitungan' => $arrAktualHitungan,
                        'dataAktualDisplay' => $arrAktualDisplay,
                        'waktuDisplay' => $arrWaktuDisplay,
                        'dataWMA' => $arrWMA,
                        'dataMAPE' => $arrMAPE,
                        'akurasi' => $akurasi,
                    ];
                }
            }
        } else {
            $kategoris = KategoriProduk::all();

            foreach ($kategoris as $item) {

                $targettahun1 = Carbon::parse($target_tahun);
                $targettahun2 = Carbon::parse($target_tahun);
                $datatahun = Carbon::parse($data_tahun);

                $selisihTahun = $targettahun1->diffInYears($datatahun);

                $arrAktualHitungan = [];
                $arrBobot = [];
                $arrWaktuHitungan = [];

                for ($i = 1; $i <= ($selisihTahun * 2) + 1; $i++) {

                    $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                        ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                        ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                        ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                        ->where('kategori_produks.nama', $item->nama)
                        ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun1->format('Y'))
                        ->sum('nota_jual_details.qty_produk');

                    $arrAktualHitungan[] = (int) $aktual;
                    $arrBobot[] = $i;
                    $arrWaktuHitungan[] = $targettahun1->format('Y');
                    $targettahun1->subYears(1);
                }

                $arrBobot = array_reverse($arrBobot);

                $arrWaktuDisplay = [];
                $arrAktualDisplay = [];

                for ($i = 0; $i <= $selisihTahun; $i++) {

                    $aktual = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                        ->join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
                        ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
                        ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                        ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                        ->where('kategori_produks.nama', $item->nama)
                        ->where(DB::raw('DATE_FORMAT(nota_juals.tgl_pesan, "%Y")'), '=', $targettahun2->format('Y'))
                        ->sum('nota_jual_details.qty_produk');

                    $arrAktualDisplay[] = (int) $aktual;
                    $arrWaktuDisplay[] = $targettahun2->format('Y');
                    $targettahun2->subYears(1);
                }

                $arrWMA = [];

                foreach ($arrWaktuHitungan as $idx => $data) {

                    $index = $idx + 1;
                    $wmaatas = 0;
                    $jumlahBobot = 0;

                    if (isset($arrWaktuDisplay[$idx]) && $arrWaktuDisplay[$idx] == $data) {

                        for ($i = 0; $i < $selisihTahun; $i++) {
                            $wmaatas += $arrBobot[$index] * $arrAktualHitungan[$index];
                            $jumlahBobot += $arrBobot[$index];
                            $index++;
                        }

                        $arrWMA[] = ceil($wmaatas / $jumlahBobot);
                    }
                }

                $arrMAPE = [];

                foreach ($arrWMA as $idx => $data) {
                    if ($idx == 0) {
                        $arrMAPE[] = 0;
                    } else {
                        $error = abs($arrWMA[$idx] - $arrAktualHitungan[$idx]);

                        if ($arrAktualHitungan[$idx] != 0) {
                            $mapee = abs($error / $arrAktualHitungan[$idx]) * 100;
                        } else {
                            $mapee = abs($error / 1) * 100;
                        }

                        $arrMAPE[] = round($mapee, 2);
                    }
                }

                $arrMAPE2 = [];

                foreach ($arrMAPE as $idx => $data) {
                    if ($idx != 0) {
                        $arrMAPE2[] = $data;
                    }
                }

                $mape = array_sum($arrMAPE2) / count($arrMAPE2);
                $arrMAPE[0] = round($mape, 2);

                if ($arrMAPE[0] <= 10) {
                    $akurasi = 'Sangat Baik';
                } elseif ($arrMAPE[0] > 10 && $arrMAPE[0] <= 20) {
                    $akurasi = 'Baik';
                } elseif ($arrMAPE[0] > 20 && $arrMAPE[0] <= 50) {
                    $akurasi = 'Cukup Baik';
                } else {
                    $akurasi = 'Kurang Baik';
                }

                $arrAktualDisplay = array_reverse($arrAktualDisplay);
                $arrWaktuDisplay = array_reverse($arrWaktuDisplay);
                $arrWMA = array_reverse($arrWMA);
                $arrMAPE = array_reverse($arrMAPE);

                $tahunan[$item->nama] = [
                    'id' => $item->id,
                    'jenis' => 'kategori',
                    'arrAktualHitungan' => $arrAktualHitungan,
                    'dataAktualDisplay' => $arrAktualDisplay,
                    'waktuDisplay' => $arrWaktuDisplay,
                    'dataWMA' => $arrWMA,
                    'dataMAPE' => $arrMAPE,
                    'akurasi' => $akurasi,
                ];
            }
        }

        // dd($tahunan, $arrAktualHitungan);

        Session::flash('tahunan', $tahunan);

        return redirect()->route('peramalan.tahunan')->withInput();
    }

    public function estimasi()
    {
        $produks = Produk::all();
        $ukurans = Ukuran::all();

        return view('estimasi.index', compact('ukurans', 'produks'));
    }
}
