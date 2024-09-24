<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kain;
use App\Models\BuyOrder;
use App\Models\NotaKain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;


class PeramalanController extends Controller
{
    public function bulanan()
    {
        $kain = Kain::all();

        $currDate = Carbon::now();
        $currDate2 = Carbon::now();

        // $date = Carbon::parse('2023-12-15');

        // $date = Carbon::now();

        // $nextMonth = $date->addMonth()->format('F Y');

        // $nextMonth = Carbon::now()->addYear();

        $targetbulan = [];
        $databulan = [];

        for ($i = 0; $i < 1; $i++) {

            $bulan = $currDate;

            $array = $bulan->addMonth();

            $value = $array->format('Y-m');
            $bulan = $array->format('F');
            $tahun = $array->format('Y');

            $targetbulan[] = [
                'value' => $value,
                'bulan' => $bulan,
                'tahun' => $tahun,
            ];
        }

        for ($i = 0; $i < 5; $i++) {

            $bulan = $currDate2;

            $array = $bulan->subMonth();

            $value = $array->format('Y-m');
            $bulan = $array->format('F');
            $tahun = $array->format('Y');

            $databulan[] = [
                'value' => $value,
                'bulan' => $bulan,
                'tahun' => $tahun,
            ];
        }

        // dd($databulan, $datatahun);

        return view('peramalan.bulanan', compact('databulan', 'targetbulan', 'kain'));
    }

    public function bulananproses(Request $request)
    {
        $input = [];
        $output = [];

        $idkain = $request->input('id-kain');
        $targetBulan = Carbon::createFromTimestamp(strtotime($request->input('target-bulan')));
        $dataAwal = Carbon::createFromTimestamp(strtotime($request->input('data-bulan')));

        $monthsDifference = $dataAwal->diffInMonths($targetBulan);

        for ($i = 0; $i < $monthsDifference; $i++) {
            $dataAwal = $dataAwal->subMonth();
        }

        $monthsDifference2 = $dataAwal->diffInMonths($targetBulan);

        $targetBulan = $targetBulan->format('m-Y');
        $newDataAwal = $dataAwal->format('m-Y');


        $newDataAwalCarbon = Carbon::createFromFormat('m-Y', $newDataAwal);

        for ($i = 0; $i <= $monthsDifference2; $i++) {

            $bulan = $newDataAwalCarbon->format('F');
            $tahun = $newDataAwalCarbon->format('Y');

            $qty = NotaKain::join('rincian_kains', 'rincian_kains.nota_kains_id', '=', 'nota_kains.id')
                ->select(DB::raw('SUM(rincian_kains.qty_kain) as total_qty'))
                ->where('rincian_kains.kains_id', $idkain)
                ->whereYear('nota_kains.tgl_mulai', $newDataAwalCarbon->year)
                ->whereMonth('nota_kains.tgl_mulai', $newDataAwalCarbon->month)
                ->value('total_qty');

            $input[] = [
                'id_kain' => $idkain,
                'bobot' => $i + 1,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'qty_kain' => $qty,
            ];

            $newDataAwalCarbon->addMonth();
        }

        // dd($input);

        

        // foreach ($input as $data){

            $targetBulan = Carbon::createFromTimestamp(strtotime($request->input('target-bulan')));
            $dataAwal = Carbon::createFromTimestamp(strtotime($request->input('data-bulan')));
            // $newDataAwal = $dataAwal->format('F-Y');

            // $datawalFromArray = $data['bulan']. '-' . $data['tahun'];


        // Cari indeks data target
            $targetIndex = array_search([$targetBulan->format('F'), $targetBulan->year], array_column([$input['bulan'], $input['tahun']]));

            // Cari indeks data awal
            $dataAwalIndex = array_search([$dataAwal->format('F'), $dataAwal->year], array_column([$input['bulan'], $input['tahun']]));

            // Validasi indeks
            if ($targetIndex === false || $dataAwalIndex === false) {
                return response()->json(['error' => 'Data target atau data awal tidak ditemukan.']);
            }

            // Hitung WMA dan MAPE berdasarkan selisih bulan
            $selisihBulan = $targetBulan->diffInMonths($dataAwal);

            // Hitung WMA dan MAPE dari data awal hingga data target
            for ($i = $dataAwalIndex; $i <= $targetIndex; $i++) {
                $bobotTotal = 0;
                $forecastTotal = 0;
                $errorTotal = 0;

                $periode = $selisihBulan; // Menggunakan selisih bulan sebagai periode

                // Ambil data sesuai periode
                $periodeData = array_slice($input, $i, $periode);

                foreach ($periodeData as $data) {
                    // Hitung bobot sesuai dengan formula WMA
                    $bobot = $data['bobot'];
                    $bobotTotal += $bobot;

                    // Hitung forecast sesuai dengan formula WMA
                    $forecastTotal += $bobot * $data['qty_kain'];

                    // Hitung error
                    $errorTotal += abs($data['qty_kain'] - $forecastTotal);
                }

                // Hitung nilai forecast, error, dan MAPE
                $forecast = $bobotTotal > 0 ? $forecastTotal / $bobotTotal : 0;
                $error = end($periodeData)['qty_kain'] - $forecast; // Menggunakan data terakhir dalam periode sebagai data aktual
                $mape = $bobotTotal > 0 ? ($errorTotal / $bobotTotal) * 100 : 0;

                // Tambahkan data ke array output
                $output[] = [
                    'id_kain' => end($periodeData)['id_kain'],
                    'bobot' => end($periodeData)['bobot'],
                    'bulan' => end($periodeData)['bulan'],
                    'tahun' => end($periodeData)['tahun'],
                    'qty_kain' => end($periodeData)['qty_kain'],
                    'forecast' => $forecast,
                    'error' => $error,
                    'mape' => $mape,
                ];
            }


            // $output[] = [
            //     'id_kain' => $data['id_kain'],
            //     'bobot' => $data['bobot'],
            //     'bulan' => $data['bulan'],
            //     'tahun' => $data['tahun'],
            //     'qty_kain' => $data['qty_kain'],
            //     'forecast' => $forecast,
            //     'error' => $error,
            //     'mape' => $mape,
            // ];
        // }
        // dd($newDataAwal, $datawalFromArray);

        dd($output);

        

        // $kain = Kain::where('id','=', $idkain)->first();

        return view('peramalan.bulanan', compact('databulan', 'targetbulan', 'kain', 'input'));
    }

    public function bulankhusus()
    {
        $kain = Kain::all();

        $currDate = Carbon::now();
        $currDate2 = Carbon::now();

        $targetbulan = [];
        $datatahun = [];

        for ($i = 0; $i < 5; $i++) {

            $bulan = $currDate;

            $array = $bulan->addMonth();

            $array2 = $array->format('F Y');

            array_push($targetbulan, $array2);
        }

        for ($i = 0; $i < 5; $i++) {

            $tahun = $currDate2;

            $array = $tahun->subYear();

            $array2 = $array->format('Y');

            array_push($datatahun, $array2);
        }

        $chart = LarapexChart::setType('bar');
        $id = "";
        $mulaithn = "";
        $targetbln = "";

        return view('peramalan.bulankhusus', compact('chart', 'datatahun', 'targetbulan', 'kain', 'id', 'mulaithn', 'targetbln'));
    }

    public function submitBulanKhusus(Request $request)
    {
        $kain = Kain::all();

        $currDate = Carbon::now();
        $currDate2 = Carbon::now();

        $targetbulan = [];
        $datatahun = [];

        for ($i = 0; $i < 5; $i++) {

            $bulan = $currDate;

            $array = $bulan->addMonth();

            $array2 = $array->format('F Y');

            array_push($targetbulan, $array2);
        }

        for ($i = 0; $i < 5; $i++) {

            $tahun = $currDate2;

            $array = $tahun->subYear();

            $array2 = $array->format('Y');

            array_push($datatahun, $array2);
        }

        $id = $request->input('id');
        $mulaithn = $request->input('mulaitahun'); //2020
        $targetbln = $request->input('targetbulan'); // String: Desember 2024
        $trgtbln = Carbon::createFromFormat('F Y', $targetbln); // Parsing to Datetime
        $formatted_date = $trgtbln->format('Y'); // 2024

        $selisih = $formatted_date - $mulaithn; // 4

        for ($i = 0; $i < $selisih; $i++) {

            $tahun = $currDate2;

            $array = $tahun->subYear();

            $array2 = $array->format('Y');

            array_push($datatahun, $array2);
        }

        $jenisKain = Kain::select('jenis_kain')->where('id', $id)->get();
        $kains = $jenisKain->value('jenis_kain');

        dd($selisih);

        // $marks = 70;
        // $grade_point = Grade::where('from', '<=', $marks)->where('to', '>=', $marks);
        // return (int) $grade_point->value('point');


        // $queryModel = BuyOrder::join('nota_beli_details', 'kains.id', '=', 'nota_beli_details.kains_id')
        //     ->select('nota_belis.*', 'nota_beli_details.*')
        //     ->where('nota_belis.tgl_pesan', 'desc')
        //     ->get();



        $chart = LarapexChart::setType('bar')
            ->setTitle('Peramalan ' . $id . ' - ' . $kains . ' - ' . 'Bulan Khusus ' . $targetbln)
            ->setLabels(['Aktual', 'WMA', 'MAPE'])
            ->setSubtitle('Hasil peramalan (WMA) sebesar 850.000 Yard dengan tingkat akurasi peramalan (MAPE) sebesar 8% sehingga peramalan dinyatakan Sangat Baik')
            ->setXAxis([
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni'
            ])
            ->setDataset([
                [
                    'name' => 'Aktual',
                    'data' => [250, 700, 1200, 1500, 1300]
                ],
                [
                    'name' => 'WMA',
                    'data' => [280, 700, 1200, 1500, 1300, 1450]
                ],
                [
                    'name' => 'MAPE',
                    'data' => [20, 50, 21, 15, 17, 29]
                ],
            ]);

        return view('peramalan.bulankhusus', compact('chart', 'datatahun', 'targetbulan', 'kain', 'id', 'mulaithn', 'targetbln'));
    }

    public function tahunan()
    {
        $kain = Kain::all();

        $currDate = Carbon::now();
        $currDate2 = Carbon::now();

        $targettahun = [];
        $datatahun = [];

        for ($i = 0; $i < 5; $i++) {

            $bulan = $currDate;

            $array = $bulan->addYear();

            $array2 = $array->format('Y');

            array_push($targettahun, $array2);
        }

        for ($i = 0; $i < 5; $i++) {

            $tahun = $currDate2;

            $array = $tahun->subYear();

            $array2 = $array->format('Y');

            array_push($datatahun, $array2);
        }

        return view('peramalan.tahunan', compact('datatahun', 'targettahun', 'kain'));
    }
}
