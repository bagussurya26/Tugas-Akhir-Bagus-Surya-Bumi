<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Karyawan;
use App\Models\NotaKain;
use App\Models\Produksi;
use App\Models\HasilProduk;
use App\Models\RincianKain;
use Illuminate\Http\Request;
use App\Models\UkuranPakaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProduksiCreateRequest;

class ProduksiController extends Controller
{
    public function index()
    {
        $queryModel = Produksi::orderBy('created_at', 'desc')
            ->get();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.produksi.daftarproduksi', compact('queryModel'));
    }

    public function laporanproduksi()
    {
        $queryModel = Produksi::orderBy('created_at', 'desc')
            ->get();

        return view('laporan.produksi', compact('queryModel'));
    }

    public function create()
    {
        $ukurans = Ukuran::all();
        $produks = Produk::all();
        $kains = Kain::all();
        $karyawans = Karyawan::all();

        return view('master.produksi.insertproduksi', compact('ukurans', 'produks', 'kains', 'karyawans'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validatedData = $request->validate([
                'id' => 'required|unique:nota_produksis,id,',
                'tanggal_mulai' => 'required',
                // 'dataNota.*.id-nota' => 'required|unique:nota_kains,id,',
                // 'dataNota.*.id-kain' => 'required',
                // 'dataNota.*.qty-kain' => 'required',
                // 'dataNota.*.tgl-mulai' => 'required',
                // 'dataNota.*.karyawan' => 'required',
                // 'dataTarget.*.id-produk' => 'required',
                // 'dataTarget.*.ukuran' => 'required',
                // 'dataTarget.*.qty-pakaian' => 'required',
            ], [
                'id.required' => 'Wajib diisi!',
                'id.unique' => 'Kode Produksi sudah ada',
                'tanggal_mulai.required' => 'Wajib diisi!',
                // 'dataNota.*.id-nota.required' => 'Wajib diisi!',
                // 'dataNota.*.id-nota.unique' => 'Kode Nota Potong sudah ada',
                // 'dataNota.*.id-kain.required' => 'Wajib diisi!',
                // 'dataNota.*.qty-kain.required' => 'Wajib diisi!',
                // 'dataNota.*.tgl-mulai.required' => 'Wajib diisi!',
                // 'dataNota.*.karyawan.required' => 'Wajib diisi!',
                // 'dataTarget.*.id-produk.required' => 'Wajib diisi!',
                // 'dataTarget.*.ukuran.required' => 'Wajib diisi!',
                // 'dataTarget.*.qty-pakaian.required' => 'Wajib diisi!',
            ]);

            //TANGGAL PRODUKSI
            $tgl_mulai_produksi = $validatedData['tanggal_mulai'];
            $tgl_selesai_produksi = $request->input('tanggal_selesai');

            //change to timestamp format Y-m-d H:i:s
            $tgl_mulai_produksi_format = Carbon::createFromTimestamp(strtotime($tgl_mulai_produksi))->format('Y-m-d H:i:s');
            $tgl_selesai_produksi_format = "";

            if ($tgl_selesai_produksi == null) {
                $status_produksi = "Dalam Proses";
                $tgl_selesai_produksi_format = null;
            } else {
                $status_produksi = "Selesai";
                $tgl_selesai_produksi_format = Carbon::createFromTimestamp(strtotime($tgl_selesai_produksi))->format('Y-m-d H:i:s');
            }

            //INPUT KE TABEL nota_produksis
            $DataProduksi = [
                'id' => $validatedData['id'],
                'tgl_mulai' => $tgl_mulai_produksi_format,
                'tgl_selesai' => $tgl_selesai_produksi_format,
                'status' => $status_produksi,
                'keterangan' => $request->input('keterangan-produksi'),
                'created_by' => 1, //NUNGGU HAK AKSES
                'updated_by' => 1, //NUNGGU HAK AKSES
            ];

            $ProduksiTabel = Produksi::create($DataProduksi);

            $dataTargetToInsert = $request->input('dataTarget');
            $dataNotaToInsert = $request->input('dataNota');

            // $formattedDataNota = [];
            // $formattedDataRincianKain = [];
            // $formattedDataTarget = [];

            if ($ProduksiTabel) {

                foreach ($dataNotaToInsert as $data) {

                    //TANGGAL NOTA POTONG KAIN
                    $tgl_mulai_nota_potong = $data['tgl-mulai'];
                    $tgl_selesai_nota_potong = $data['tgl-selesai'];

                    //change to timestamp format Y-m-d H:i:s
                    $tgl_mulai_nota_potong_format = Carbon::createFromTimestamp(strtotime($tgl_mulai_nota_potong))->format('Y-m-d H:i:s');
                    $tgl_selesai_nota_potong_format = "";

                    if ($tgl_selesai_nota_potong == null) {
                        $status_potong = "Dalam Proses";
                        $tgl_selesai_nota_potong_format = null;
                    } else {
                        $status_potong = "Selesai";
                        $tgl_selesai_nota_potong_format = Carbon::createFromTimestamp(strtotime($tgl_selesai_nota_potong))->format('Y-m-d H:i:s');
                    }

                    // $formattedDataNota[] = [
                    //     'nota_produksis_id' => $ProduksiTabel->id,
                    //     'karyawans_id' => $data['karyawan'],
                    //     'id' => $data['id-nota'],
                    //     'tgl_mulai' => $tgl_mulai_nota_potong_format,
                    //     'tgl_selesai' => $tgl_selesai_nota_potong_format,
                    //     'status' => $status_potong,
                    // ];

                    NotaKain::insertOrIgnore([
                        'nota_produksis_id' => $ProduksiTabel->id,
                        'karyawans_id' => $data['karyawan'],
                        'id' => $data['id-nota'],
                        'tgl_mulai' => $tgl_mulai_nota_potong_format,
                        'tgl_selesai' => $tgl_selesai_nota_potong_format,
                        'status' => $status_potong,
                    ]);

                    //INPUT KE TABEL rincian_kains
                    // $formattedDataRincianKain[] = [
                    //     'nota_kains_id' => $data['id-nota'],
                    //     'nota_kains_nota_produksis_id' => $ProduksiTabel->id,
                    //     'kains_id' => $data['id-kain'],
                    //     'qty_kain' => $data['qty-kain'],
                    // ];

                    RincianKain::insert([
                        'nota_kains_id' => $data['id-nota'],
                        'nota_kains_nota_produksis_id' => $ProduksiTabel->id,
                        'kains_id' => $data['id-kain'],
                        'qty_kain' => $data['qty-kain'],
                    ]);

                    //Update stok kain
                    $stokKain = Kain::select('stok')
                        ->where('id', $data['id-kain'])
                        ->value('stok');

                    $stokKain -= $data['qty-kain'];

                    Kain::where('id', $data['id-kain'])
                        ->update([
                            'stok' => $stokKain,
                        ]);
                }

                foreach ($dataTargetToInsert as $data) {

                    //Update stok tabel ukuran_pakaians
                    //cek datanya dulu pada tabel ada datanya atau tidak
                    // $ukuranPakaian = UkuranPakaian::where('pakaians_id', $data['id-produk'])
                    //     ->where('ukurans_id', $data['ukuran'])
                    //     ->first();

                    // if ($ukuranPakaian == null) {

                    //Insert awal tabel ukuran_pakaians
                    // DB::table('ukuran_pakaians')
                    //     ->insert([
                    //         'pakaians_id' => $data['id-produk'],
                    //         'ukurans_id' => $data['ukuran'],
                    //         'incoming_stok' => $data['qty-pakaian'],
                    //     ]);

                    DB::table('ukuran_pakaians')
                        ->updateOrInsert(
                            [
                                'pakaians_id' => $data['id-produk'],
                                'ukurans_id' => $data['ukuran'],
                            ],
                            [
                                'incoming_stok' => $data['qty-pakaian'],
                            ]
                        );

                    // $formattedDataTarget[] = [
                    //     'nota_produksis_id' => $ProduksiTabel->id,
                    //     'ukuran_pakaians_pakaians_id' => $data['id-produk'],
                    //     'ukuran_pakaians_ukurans_id' => $data['ukuran'],
                    //     'qty_pakaian' => $data['qty-pakaian'],
                    // ];

                    HasilProduk::insertOrIgnore([
                        'nota_produksis_id' => $ProduksiTabel->id,
                        'ukuran_pakaians_pakaians_id' => $data['id-produk'],
                        'ukuran_pakaians_ukurans_id' => $data['ukuran'],
                        'qty_pakaian' => $data['qty-pakaian'],
                    ]);

                    //Update stok pakaians
                    $stokIncomingProduk = Produk::select('incoming_stok')
                        ->where('id', $data['id-produk'])
                        ->value('incoming_stok');

                    $stokIncomingProduk += $data['qty-pakaian'];

                    // dd($stokIncomingProduk);

                    Produk::where('id', $data['id-produk'])
                        ->update([
                            'incoming_stok' => $stokIncomingProduk,
                        ]);

                    // } else {

                    // $formattedDataTarget[] = [
                    //     'nota_produksis_id' => $ProduksiTabel->id,
                    //     'ukuran_pakaians_pakaians_id' => $data['id-produk'],
                    //     'ukuran_pakaians_ukurans_id' => $data['ukuran'],
                    //     'qty_pakaian' => $data['qty-pakaian'],
                    // ];

                    // HasilProduk::insert([
                    //     'nota_produksis_id' => $ProduksiTabel->id,
                    //     'ukuran_pakaians_pakaians_id' => $data['id-produk'],
                    //     'ukuran_pakaians_ukurans_id' => $data['ukuran'],
                    //     'qty_pakaian' => $data['qty-pakaian'],
                    // ]);

                    // //Update incoming stok tabel ukuran_pakaians
                    // DB::table('ukuran_pakaians')
                    //     ->where('pakaians_id', $data['id-produk'])
                    //     ->where('ukurans_id', $data['ukuran'])
                    //     ->update([
                    //         'incoming_stok' => $data['qty-pakaian'],
                    //     ]);
                    // }
                }

                // $notaKain = NotaKain::insertOrIgnore($formattedDataNota);
                // $hasilPakaian = HasilProduk::insertOrIgnore($formattedDataTarget);

                // Jika insert ke tabel rincian_kains berhasil
                // if ($notaKain) {

                //     $rincianKain = RincianKain::insert($formattedDataRincianKain);

                //     if ($rincianKain) {
                //         // Maka lakukan update stok masing-masing kain
                //         foreach ($dataNotaToInsert as $data) {
                //             //Update stok kain
                //             $stokKain = Kain::select('stok')
                //                 ->where('id', $data['id-kain'])
                //                 ->value('stok');

                //             $stokKain -= $data['qty-kain'];

                //             DB::table('kains')
                //                 ->where('id', $data['id-kain'])
                //                 ->update([
                //                     'stok' => $stokKain,
                //                 ]);
                //         }
                //     }
                // }

                // Jika insert ke tabel hasil_pakaians berhasil
                // if ($hasilPakaian) {

                //     // Maka lakukan update incoming_stok masing-masing produk
                //     foreach ($dataTargetToInsert as $data) {
                //         //Update stok kain
                //         $stokIncomingProduk = Produk::select('incoming_stok')
                //             ->where('id', $data['id-produk'])
                //             ->value('incoming_stok');

                //         $stokIncomingProduk += $data['qty-pakaian'];

                //         // dd($stokIncomingProduk);

                //         DB::table('pakaians')
                //             ->where('id', $data['id-produk'])
                //             ->update([
                //                 'incoming_stok' => $stokIncomingProduk,
                //             ]);
                //     }
                // }
            }

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('produksi.create');


        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('produksi.create');
        }

    }

    public function show($id)
    {
        $infoProduksi = Produksi::where('nota_produksis.id', $id)
            ->get();

        $detailTarget = HasilProduk::join('ukurans', 'ukurans.id', '=', 'hasil_pakaians.ukuran_pakaians_ukurans_id')
            ->join('pakaians', 'pakaians.id', '=', 'hasil_pakaians.ukuran_pakaians_pakaians_id')
            ->select('hasil_pakaians.ukuran_pakaians_pakaians_id as id_produk', 'pakaians.nama', 'ukurans.ukuran', 'hasil_pakaians.qty_pakaian')
            ->where('hasil_pakaians.nota_produksis_id', $id)
            // ->groupBy('hasil_pakaians.ukuran_pakaians_pakaians_id')
            ->orderBy('hasil_pakaians.ukuran_pakaians_pakaians_id', 'asc')
            ->get();

        $detailNotaKain = Karyawan::join('nota_kains', 'nota_kains.karyawans_id', '=', 'karyawans.id')
            ->join('rincian_kains', 'rincian_kains.nota_kains_id', '=', 'nota_kains.id')
            ->select('nota_kains.id as nota_kain_id', 'nota_kains.tgl_mulai', 'nota_kains.tgl_selesai', 'nota_kains.status', 'rincian_kains.*', 'karyawans.nama')
            ->where('nota_kains.nota_produksis_id', $id)
            ->get();

        // dd($detailNotaKain);


        return view('master.produksi.detailproduksi', compact('infoProduksi', 'detailTarget', 'detailNotaKain'));
    }

    public function edit($id)
    {
        $ukurans = Ukuran::all();
        $produks = Produk::all();
        $kains = Kain::all();
        $karyawans = Karyawan::all();

        $infoProduksi = Produksi::where('nota_produksis.id', $id)
            ->get();

        $detailTarget = HasilProduk::join('ukurans', 'ukurans.id', '=', 'hasil_pakaians.ukuran_pakaians_ukurans_id')
            ->join('pakaians', 'pakaians.id', '=', 'hasil_pakaians.ukuran_pakaians_pakaians_id')
            ->select('hasil_pakaians.ukuran_pakaians_pakaians_id as id_produk', 'pakaians.nama', 'ukurans.ukuran', 'ukurans.id as id_ukuran', 'hasil_pakaians.qty_pakaian')
            ->where('hasil_pakaians.nota_produksis_id', $id)
            ->orderBy('hasil_pakaians.ukuran_pakaians_pakaians_id', 'asc')
            ->get();

        $detailNotaKain = Karyawan::join('nota_kains', 'nota_kains.karyawans_id', '=', 'karyawans.id')
            ->join('rincian_kains', 'rincian_kains.nota_kains_id', '=', 'nota_kains.id')
            ->select('nota_kains.id as nota_kain_id', 'nota_kains.tgl_mulai', 'nota_kains.tgl_selesai', 'rincian_kains.*', 'karyawans.nama as nama_karyawan', 'karyawans.id as id_karyawan')
            ->where('nota_kains.nota_produksis_id', $id)
            ->get();


        return view('master.produksi.editproduksi', compact('infoProduksi', 'detailTarget', 'detailNotaKain', 'ukurans', 'produks', 'kains', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            //TANGGAL PRODUKSI
            $tgl_selesai_produksi = $request->input('tanggal_selesai');

            //change to timestamp format Y-m-d H:i:s
            $tgl_selesai_produksi_format = "";

            if ($tgl_selesai_produksi == null) {
                $status_produksi = "Dalam Proses";
                $tgl_selesai_produksi_format = null;
            } else {
                $status_produksi = "Selesai";
                $tgl_selesai_produksi_format = Carbon::createFromTimestamp(strtotime($tgl_selesai_produksi))->format('Y-m-d H:i:s');
            }

            $dataTargetToInsert = $request->input('dataTarget');
            $dataNotaToInsert = $request->input('dataNota');

            Produksi::where('id', $id)
                ->update([
                    'tgl_selesai' => $tgl_selesai_produksi_format,
                    'status' => $status_produksi,
                    'keterangan' => $request->input('keterangan-produksi'),
                    'updated_by' => 2, // NUNGGU HAK AKSES
                ]);


            foreach ($dataNotaToInsert as $data) {

                //TANGGAL NOTA POTONG KAIN
                $tgl_selesai_nota_potong = $data['tgl-selesai'];

                //change to timestamp format Y-m-d H:i:s
                $tgl_selesai_nota_potong_format = "";

                if ($tgl_selesai_nota_potong == null) {
                    $status_potong = "Dalam Proses";
                    $tgl_selesai_nota_potong_format = null;
                } else {
                    $status_potong = "Selesai";
                    $tgl_selesai_nota_potong_format = Carbon::createFromTimestamp(strtotime($tgl_selesai_nota_potong))->format('Y-m-d H:i:s');
                }

                NotaKain::where('nota_produksis_id', $id)
                    ->where('id', $data['id-nota'])
                    ->update([
                        'tgl_selesai' => $tgl_selesai_nota_potong_format,
                        'status' => $status_potong,
                    ]);
            }

            $stok = 0;
            $array = [];

            foreach ($dataTargetToInsert as $data) {

                $array[] = [
                    'id-produk' => $data['id-produk'],
                    'qty-produk' => $data['qty-pakaian'],
                ];

                // dd($dataTargetToInsert);

                HasilProduk::where('nota_produksis_id', $id)
                    ->where('ukuran_pakaians_pakaians_id', $data['id-produk'])
                    ->where('ukuran_pakaians_ukurans_id', $data['id-ukuran'])
                    ->update([
                        'qty_pakaian' => $data['qty-pakaian'],
                    ]);

                UkuranPakaian::where('pakaians_id', $data['id-produk'])
                    ->where('ukurans_id', $data['id-ukuran'])
                    ->update([
                        'incoming_stok' => $data['qty-pakaian'],
                    ]);


                Produk::where('id', $data['id-produk'])
                    ->update([
                        'incoming_stok' => 0,
                    ]);

            }

            // dd($array);

            foreach ($array as $data) {
                // Update stok pakaians
                $stokIncomingProduk = Produk::select('incoming_stok')
                    ->where('id', $data['id-produk'])
                    ->value('incoming_stok');

                $stokIncomingProduk += $data['qty-produk'];


                Produk::where('id', $data['id-produk'])
                    ->update([
                        'incoming_stok' => $stokIncomingProduk,
                    ]);
            }


            if ($tgl_selesai_produksi != null) {

                foreach ($dataTargetToInsert as $data) {

                    // Pindah incoming_stok ke stok asli tabel ukuran_pakaians
                    DB::table('ukuran_pakaians')
                        ->where('pakaians_id', $data['id-produk'])
                        ->where('ukurans_id', $data['id-ukuran'])
                        ->update([
                            'incoming_stok' => 0,
                        ]);

                    //Update total stok tabel ukuran_pakaians
                    $stokUkuranPakaian = UkuranPakaian::select('qty')
                        ->where('pakaians_id', $data['id-produk'])
                        ->where('ukurans_id', $data['id-ukuran'])
                        ->value('qty');

                    $stokUkuranPakaian += $data['qty-pakaian'];

                    DB::table('ukuran_pakaians')
                        ->where('pakaians_id', $data['id-produk'])
                        ->where('ukurans_id', $data['id-ukuran'])
                        ->update([
                            'qty' => $stokUkuranPakaian,
                        ]);

                    // Pindah incoming_stok ke stok asli tabel pakaians
                    DB::table('pakaians')
                        ->where('id', $data['id-produk'])
                        ->update([
                            'incoming_stok' => 0,
                        ]);

                    //Update total stok tabel pakaian
                    $stokPakaian = Produk::select('total_qty')
                        ->where('id', $data['id-produk'])
                        ->value('total_qty');

                    $stokPakaian += $data['qty-pakaian'];

                    DB::table('pakaians')
                        ->where('id', $data['id-produk'])
                        ->update([
                            'total_qty' => $stokPakaian,
                        ]);
                }
            }


            DB::commit();

            toast('Perubahan data berhasil!', 'success');
            return redirect()->route('produksi.edit', $id);

        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();

            toast('Perubahan data gagal!', 'warning');
            return redirect()->route('produksi.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // ===========================================================================
            // Update stok kain
            $listRincianKain = RincianKain::where('nota_kains_nota_produksis_id', $id)
                ->get();

            foreach ($listRincianKain as $data) {
                $stokKain = Kain::where('id', $data['kains_id'])
                    ->value('stok');

                $stokKain += $data['qty_kain'];

                Kain::where('id', $data['kains_id'])
                    ->update([
                        'stok' => $stokKain,
                    ]);
            }

            // =========================================================
            // Update incoming_stok dari ukuran_pakaian dan pakaian

            $listHasilPakaian = HasilProduk::where('nota_produksis_id', $id)
                ->get();

            foreach ($listHasilPakaian as $data) {
                // Update incoming_stok ukuran_pakaians
                $incomingUkuranPakaian = UkuranPakaian::where('pakaians_id', $data['ukuran_pakaians_pakaians_id'])
                    ->where('ukurans_id', $data['ukuran_pakaians_ukurans_id'])
                    ->value('incoming_stok');

                $incomingUkuranPakaian -= $data['qty_pakaian'];

                UkuranPakaian::where('pakaians_id', $data['ukuran_pakaians_pakaians_id'])
                    ->where('ukurans_id', $data['ukuran_pakaians_ukurans_id'])
                    ->update([
                        'incoming_stok' => $incomingUkuranPakaian,
                    ]);

                // Update incoming_stok pakaians
                $incomingPakaian = Produk::where('id', $data['ukuran_pakaians_pakaians_id'])
                    ->value('incoming_stok');

                $incomingPakaian -= $data['qty_pakaian'];

                Produk::where('id', $data['ukuran_pakaians_pakaians_id'])
                    ->update([
                        'incoming_stok' => $incomingPakaian,
                    ]);
            }

            // Menghapus tabel yang berhubungan dengan produksi
            DB::statement('SET foreign_key_checks=0;');
            Produksi::where('id', $id)->delete();
            // DB::statement('SET foreign_key_checks=1;');

            // DB::statement('SET foreign_key_checks=0;');
            NotaKain::where('nota_produksis_id', $id)->delete();
            // DB::statement('SET foreign_key_checks=1;');

            // DB::statement('SET foreign_key_checks=0;');
            RincianKain::where('nota_kains_nota_produksis_id', $id)->delete();
            // DB::statement('SET foreign_key_checks=1;');

            // DB::statement('SET foreign_key_checks=0;');
            HasilProduk::where('nota_produksis_id', $id)->delete();
            DB::statement('SET foreign_key_checks=1;');

            

            DB::commit();
            alert()->success('Hore!', 'Data Deleted Successfully');
            return redirect()->route('produksi.index');

        } catch (\Exception $e) {

            DB::rollBack();

            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('produksi.index');
        }
    }
}
