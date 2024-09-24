<?php

namespace App\Http\Controllers;

use App\Models\Komposisi;
use App\Models\ListKain;
use App\Models\WarnaProduk;
use Carbon\Carbon;
use App\Models\Kain;
use App\Models\User;
use App\Models\Resep;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Karyawan;
use App\Models\Produksi;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduksiController extends Controller
{
    public function index()
    {
        $produksis = Produksi::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.produksi.daftarproduksi', compact('produksis'));
    }

    public function getProduksiKain($filter)
    {
        $produksis = Produksi::join('list_kains', 'nota_produksis.id', '=', 'list_kains.nota_produksi_id')
            ->join('komposisi', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->select('nota_produksis.*')
            ->where('list_kains.kain_id', $filter)
            ->get();

        $kode_kain = Kain::where('id', $filter)->value('kode_kain');

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.produksi.daftarproduksikain', compact('produksis', 'kode_kain'));
    }

    public function getProduksiProduk($idproduk)
    {
        $produksis = Produksi::join('list_kains', 'nota_produksis.id', '=', 'list_kains.nota_produksi_id')
            ->join('komposisi', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->join('produk_ukuran', 'produk_ukuran.id', '=', 'komposisi.produk_ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->where('produk_warna.produk_id', $idproduk)
            ->groupBy('nota_produksis.id')
            ->get();

        $kode_produk = Produk::where('id', $idproduk)->value('kode_produk');

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.produksi.daftarproduksiproduk', compact('produksis', 'kode_produk'));
    }

    public function create()
    {
        $produkukurans = UkuranProduk::join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->select('produk_ukuran.*', 'ukurans.nama', 'produk_warna.warna')
            ->get();
        $produks = Produk::all();
        $kains = Kain::all();
        $karyawans = Karyawan::all();
        $produkwarnas = WarnaProduk::all();
        $reseps = Resep::join('kains', 'reseps.kain_id', '=', 'kains.id')
            ->join('produk_warna', 'reseps.produk_warna_id', '=', 'produk_warna.id')
            ->join('produk_ukuran', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
            ->select('reseps.tipe', 'reseps.kain_id', 'produk_ukuran.id', 'kains.kode_kain')
            ->get();
        $produksis = Produksi::all();

        return view('master.produksi.insertproduksi', compact('produkukurans', 'produks', 'kains', 'karyawans', 'produkwarnas', 'reseps', 'produksis'));
    }

    public function getWarnaProduk($id)
    {
        $warnaproduk = WarnaProduk::where('produk_id', $id)
            ->get();

        return response()->json($warnaproduk);
    }

    public function getAvgQty($produk_ukuran_id)
    {
        $idproduk = WarnaProduk::join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->where('produk_ukuran.id', $produk_ukuran_id)
            ->value('produk_id');

        $idukuran = UkuranProduk::join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->where('produk_ukuran.id', $produk_ukuran_id)
            ->value('ukurans.id');

        $cekkomposisi = Komposisi::join('produk_ukuran', 'produk_ukuran.id', '=', 'komposisi.produk_ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->where('produk_warna.produk_id', $idproduk)
            ->where('produk_ukuran.ukuran_id', $idukuran)
            ->first();

        $lebarkain = Resep::join('produk_warna', 'produk_warna.id', '=', 'reseps.produk_warna_id')
            ->join('kains', 'kains.id', '=', 'reseps.kain_id')
            ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->where('produk_ukuran.id', $produk_ukuran_id)
            ->where('reseps.tipe', 'UTAMA')
            ->value('lebar');

        $ukuran = Ukuran::join('produk_ukuran', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->where('produk_ukuran.id', $produk_ukuran_id)
            ->value('nama');

        $produks = Produk::join('produk_warna', 'produks.id', '=', 'produk_warna.produk_id')
            ->join('produk_ukuran', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->where('produk_ukuran.id', $produk_ukuran_id)
            ->first();

        if ($cekkomposisi == null) {

            if ($lebarkain >= 1.15 && $lebarkain < 1.5) {
                if ($produks->tipe_lengan == 'PENDEK') {
                    if ($ukuran == 'M' || $ukuran == 'L' || $ukuran == 'XL') {
                        $AvgQty = 1.75;
                    } elseif ($ukuran == '2XL') {
                        $AvgQty = 2;
                    } elseif ($ukuran == '3XL') {
                        $AvgQty = 2.25;
                    } else {
                        $AvgQty = 2.5;
                    }
                } else {
                    if ($ukuran == 'M' || $ukuran == 'L' || $ukuran == 'XL') {
                        $AvgQty = 2;
                    } elseif ($ukuran == '2XL') {
                        $AvgQty = 2.25;
                    } elseif ($ukuran == '3XL') {
                        $AvgQty = 2.5;
                    } else {
                        $AvgQty = 2.75;
                    }
                }
            } else {
                if ($produks->tipe_lengan == 'PENDEK') {
                    if ($ukuran == 'M' || $ukuran == 'L' || $ukuran == 'XL') {
                        $AvgQty = 1.25;
                    } elseif ($ukuran == '2XL') {
                        $AvgQty = 1.5;
                    } elseif ($ukuran == '3XL') {
                        $AvgQty = 1.75;
                    } else {
                        $AvgQty = 2;
                    }
                } else {
                    if ($ukuran == 'M' || $ukuran == 'L' || $ukuran == 'XL') {
                        $AvgQty = 1.5;
                    } elseif ($ukuran == '2XL') {
                        $AvgQty = 1.75;
                    } elseif ($ukuran == '3XL') {
                        $AvgQty = 2;
                    } else {
                        $AvgQty = 2.25;
                    }
                }

            }

        } else {

            $komposisi = Komposisi::join('produk_ukuran', 'produk_ukuran.id', '=', 'komposisi.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->where('produk_warna.produk_id', $idproduk)
                ->where('produk_ukuran.ukuran_id', $idukuran)
                ->get();

            $sumQtyProduk = 0;
            $sumQtyKain = 0;

            foreach ($komposisi as $value) {

                $sumQtyProduk += $value['qty_produk'];
                $sumQtyKain += $value['qty_kain'];
            }

            $AvgQty = Round($sumQtyKain / $sumQtyProduk, 2);
        }

        return response()->json(['avgQty' => $AvgQty, 'ukuran' => $ukuran]);
    }

    public function getUkuranProduk($id)
    {
        $ukuranproduk = UkuranProduk::join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
            ->select('ukurans.nama', 'produk_ukuran.*')
            ->where('produk_ukuran.produk_warna_id', $id)
            ->get();

        // dd($ukuranproduk);
        return response()->json($ukuranproduk);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $produksi = Produksi::create([
                'karyawan_id' => $request->input('karyawan_id'),
                'kode_produksi' => $request->input('kode-produksi'),
                'tgl_mulai' => now(),
                'status' => "Dalam Proses",
                'keterangan' => $request->input('keterangan'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            // $properti = [];
            // $propertistok = [];
            // $nomortarget = 1;
            // $nomorstok = 1;

            // $properti[] = 'karyawan : ' . Karyawan::where('id', $produksi->karyawan_id)->value('nama');
            // $properti[] = 'kode_produksi : ' . $produksi->kode_produksi;
            // $properti[] = 'tgl_mulai : ' . $produksi->tgl_mulai;
            // $properti[] = 'status : ' . $produksi->status;
            // $properti[] = 'keterangan : ' . $produksi->keterangan;
            // $properti[] = ' ';
            // $properti[] = '== TARGET PRODUK ==';

            $dataTarget = $request->input('dataTarget');
            $dataKain = $request->input('dataKain');

            // dd($dataTarget, $dataKain);

            // KAIN
            foreach ($dataKain as $produk_ukuran_id => $data) {

                // dd($dataTarget[$produk_ukuran_id]);

                foreach ($data as $kain_id => $estimQty) {

                    $ceklistkain = ListKain::where('nota_produksi_id', $produksi->id)
                        ->where('kain_id', $kain_id)
                        ->first();

                    if ($ceklistkain == null) {
                        ListKain::create([
                            'nota_produksi_id' => $produksi->id,
                            'kain_id' => $kain_id,
                            'qty_kain_total' => $estimQty,
                        ]);
                    } else {
                        ListKain::find($ceklistkain->id)
                            ->increment('qty_kain_total', $estimQty);
                    }

                    $idlistkain = ListKain::where('nota_produksi_id', $produksi->id)
                        ->where('kain_id', $kain_id)
                        ->value('id');

                    Komposisi::create([
                        'list_kain_id' => $idlistkain,
                        'produk_ukuran_id' => $produk_ukuran_id,
                        'qty_kain' => $estimQty,
                        'qty_produk' => $dataTarget[$produk_ukuran_id],
                    ]);

                    Kain::where('id', $kain_id)
                        ->decrement('stok', $estimQty);

                    UkuranProduk::where('id', $produk_ukuran_id)
                        ->increment('incoming_stok', $dataTarget[$produk_ukuran_id]);
                }
            }


            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('produksi.index');


        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Penambahan data gagal!', 'warning');
            // return redirect()->route('produksi.create')->withInput();
        }

    }

    public function show($id)
    {
        $produksis = Produksi::find($id);

        $title = 'Konfirmasi Selesai Potong Kain';
        $text = "Apakah anda yakin ingin mengkonfimasi?";
        confirmDelete($title, $text);

        $produks = Produk::all();
        $reseps = Resep::join('kains', 'reseps.kain_id', '=', 'kains.id')->get();
        $ukurans = Ukuran::all();

        $produkwarnas = WarnaProduk::join('produk_ukuran', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
            ->join('komposisi', 'komposisi.produk_ukuran_id', '=', 'produk_ukuran.id')
            ->join('list_kains', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->select('produk_warna.*')
            ->where('list_kains.nota_produksi_id', $id)
            ->groupBy('produk_warna.warna')
            ->get();

        $targetProduks = Komposisi::join('list_kains', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->join('produk_ukuran', 'produk_ukuran.id', '=', 'komposisi.produk_ukuran_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
            ->join('reseps', 'reseps.produk_warna_id', '=', 'produk_warna.id')
            ->join('kains', 'reseps.kain_id', '=', 'kains.id')
            ->select('produks.kode_produk', 'produk_warna.*', 'ukurans.nama as nama_ukuran', 'komposisi.*', 'ukurans.id as ukuran_id', 'kains.kode_kain')
            ->where('list_kains.nota_produksi_id', $id)
            ->where('reseps.tipe', 'UTAMA')
            ->get();

        $penggunaankains = Komposisi::join('list_kains', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->join('kains', 'list_kains.kain_id', '=', 'kains.id')
            ->select('list_kains.*', 'kains.kode_kain', 'komposisi.*')
            ->where('list_kains.nota_produksi_id', $id)
            ->get();

        return view('master.produksi.detailproduksi', compact('produksis', 'targetProduks', 'penggunaankains', 'produkwarnas', 'produks', 'reseps', 'ukurans'));
    }


    public function updateKeterangan(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            Produksi::find($id)
                ->update([
                    'keterangan' => $request->input('keterangan'),
                ]);


            DB::commit();

            toast('Memperbarui keterangan berhasil!', 'success');
            return redirect()->route('produksi.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Memperbarui keterangan gagal!', 'warning');
            // return redirect()->route('produksi.edit', $id);
        }
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // UPDATE PRODUKSI
            Produksi::find($id)
                ->update([
                    'tgl_selesai' => now(),
                    'status' => 'Selesai',
                    'keterangan' => $request->input('keterangan'),
                    'updated_by' => auth()->user()->id,
                ]);


            // UPDATE RINCIAN
            $dataTarget = $request->input('dataTarget');

            foreach ($dataTarget as $list_kain_id => $data) {

                foreach ($data as $produk_ukuran_id => $qty_produk) {

                    $qtyproduksebelum = Komposisi::where('produk_ukuran_id', $produk_ukuran_id)
                        ->where('list_kain_id', $list_kain_id)
                        ->value('qty_produk');


                    ListKain::find($list_kain_id)
                        ->decrement('qty_kain_total', $qtyproduksebelum);

                    ListKain::find($list_kain_id)
                        ->increment('qty_kain_total', $qty_produk);



                    Komposisi::where('list_kain_id', $list_kain_id)
                        ->where('produk_ukuran_id', $produk_ukuran_id)
                        ->decrement('qty_produk', $qtyproduksebelum);

                    Komposisi::where('list_kain_id', $list_kain_id)
                        ->where('produk_ukuran_id', $produk_ukuran_id)
                        ->increment('qty_produk', $qty_produk);


                    UkuranProduk::find($produk_ukuran_id)
                        ->decrement('incoming_stok', $qtyproduksebelum);

                    UkuranProduk::find($produk_ukuran_id)
                        ->increment('stok', $qty_produk);

                }
            }

            DB::commit();

            toast('Perubahan data berhasil!', 'success');
            return redirect()->route('produksi.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Perubahan data gagal!', 'warning');
            // return redirect()->route('produksi.show', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        // $produksi = Produksi::find($id);

        try {

            $listKomposisi = ListKain::join('komposisi', 'list_kains.id', '=', 'komposisi.list_kain_id')
                ->where('list_kains.nota_produksi_id', $id)
                ->get();

            foreach ($listKomposisi as $data) {

                Kain::find($data->kain_id)
                    ->increment('stok', $data->qty_kain);

                UkuranProduk::find($data->produk_ukuran_id)
                    ->decrement('incoming_stok', $data->qty_produk);

                Komposisi::where('list_kain_id', $data->list_kain_id)
                    ->where('produk_ukuran_id', $data->produk_ukuran_id)
                    ->delete();
            }

            ListKain::where('nota_produksi_id', $id)->delete();

            Produksi::find($id)->delete();


            DB::commit();
            alert()->success('Hore!', 'Data Deleted Successfully');
            return redirect()->route('produksi.index');

        } catch (\Exception $e) {

            DB::rollBack();

            echo ($e);

            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            // return redirect()->route('produksi.index');
        }
    }

    public function laporanproduksi()
    {
        $produksis = Produksi::join('list_kains', 'nota_produksis.id', '=', 'list_kains.nota_produksi_id')
            ->join('komposisi', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->join('produk_ukuran', 'produk_ukuran.id', '=', 'komposisi.produk_ukuran_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
            ->select('produks.kode_produk', 'ukurans.nama', 'produk_warna.warna', 'komposisi.qty_produk', 'nota_produksis.*')
            ->get();

        return view('laporan.produksi', compact('produksis'));
    }

    public function laporanpenggunaankain()
    {
        $penggunaankains = Komposisi::join('list_kains', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->join('kains', 'kains.id', '=', 'list_kains.kain_id')
            ->join('nota_produksis', 'list_kains.nota_produksi_id', '=', 'nota_produksis.id')
            ->join('karyawans', 'karyawans.id', '=', 'nota_produksis.karyawan_id')
            ->select('kains.kode_kain', 'komposisi.*', 'nota_produksis.*', 'karyawans.nama')
            ->get();

        return view('laporan.penggunaankain', compact('penggunaankains'));
    }
}
