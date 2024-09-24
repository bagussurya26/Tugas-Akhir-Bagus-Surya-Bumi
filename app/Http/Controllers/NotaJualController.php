<?php

namespace App\Http\Controllers;

use App\Models\WarnaProduk;
use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\NotaJual;
use App\Models\JualDetail;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NotaJualController extends Controller
{
    public function index()
    {
        $penjualans = NotaJual::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('transaksi.notajual.daftarnotajual', compact('penjualans'));
    }

    public function getPenjualanProduk($filter)
    {
        $penjualans = NotaJual::join('nota_jual_details', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
            ->join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->where('produk_id', $filter)
            ->groupBy('kode_nota')
            ->get();

        $kode_produk = Produk::where('id', $filter)->value('kode_produk');

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('transaksi.notajual.daftarnotajualproduk', compact('penjualans', 'kode_produk'));
    }

    public function create()
    {
        $produks = Produk::all();
        $kategoris = KategoriProduk::all();

        return view('transaksi.notajual.insertnotajual', compact('produks', 'kategoris'));
    }

    public function getKategori()
    {

        $month = now()->format('m');
        $year = now()->format('y');
        $nextInvoiceNumber = NotaJual::max('id') + 1;
        $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
        $invoiceCode = 'INV' . $month . $year . $invoiceNumber;

        $tgl = now()->format('d-m-Y H:i:s');

        return response()->json(['tgl' => $tgl, 'invoiceCode' => $invoiceCode]);

        // return response()->json($invoiceCode, $tgl);
    }

    public function getInfoProduk($idwarna, $idukuran)
    {
        $warnaproduk = WarnaProduk::join('produks', 'produk_warna.produk_id', '=', 'produks.id')
            ->select('kode_produk', 'warna')
            ->where('produk_warna.id', $idwarna)
            ->first();

        $ukuran = Ukuran::where('id', $idukuran)
            ->value('nama');

        return response()->json(['kode_produk' => $warnaproduk->kode_produk, 'warna' => $warnaproduk->warna, 'ukuran' => $ukuran]);

        // return response()->json($invoiceCode, $tgl);
    }

    public function getProdukWarna($id)
    {
        $produkwarna = WarnaProduk::join('produks', 'produk_warna.produk_id', '=', 'produks.id')
            ->select('produks.kode_produk', 'produk_warna.*')
            ->where('produks.id', $id)
            ->get();

        // dd($ukuranproduk);
        return response()->json($produkwarna);
    }

    public function getUkuranProduk($id)
    {
        $ukuranproduk = UkuranProduk::join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
            ->select('ukurans.id', 'ukurans.nama', 'produk_ukuran.stok', 'produk_ukuran.harga')
            ->where('produk_ukuran.produk_warna_id', $id)
            // ->where('produk_ukuran.stok', '>', 0)
            ->get();

        // dd($ukuranproduk);
        return response()->json($ukuranproduk);
    }

    public function getHargaProduk($idwarna, $idukuran)
    {
        $hargaproduk = UkuranProduk::where('produk_warna_id', $idwarna)
            ->where('ukuran_id', $idukuran)
            ->get();

        // dd($ukuranproduk);
        return response()->json($hargaproduk);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $notajual = NotaJual::create([
                'kode_nota' => $request->input('input-kode-nota'),
                'tgl_pesan' => now(),
                'total_qty' => $request->input('input-total-pcs'),
                'grand_total' => $request->input('input-grand-total'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            // DETAIL
            $dataJual = $request->input('dataJual');

            foreach ($dataJual as $indexwarna => $data) {

                foreach ($data as $indexukuran => $item) {

                    $produk_ukuran = UkuranProduk::where('produk_warna_id', $indexwarna)
                        ->where('ukuran_id', $indexukuran)
                        ->first();

                    JualDetail::create([
                        'nota_jual_id' => $notajual->id,
                        'produk_ukuran_id' => $produk_ukuran->id,
                        'qty_produk' => $item['qty_produk'],
                        'harga' => $item['harga'],
                        'subtotal' => $item['subtotal'],
                    ]);

                    // SETTING STOK
                    $produk_ukuran->decrement('stok', $item['qty_produk']);
                }
            }

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('notajual.create');


        } catch (\Exception $e) {

            DB::rollback();

            echo ($e);

            toast('Penambahan data gagal!', 'warning');
            // return redirect()->route('notajual.create')->withInput();
        }
    }

    public function show($id)
    {
        $penjualans = NotaJual::find($id);

        $detailNotaJual = JualDetail::join('produk_ukuran', 'nota_jual_details.produk_ukuran_id', '=', 'produk_ukuran.id')
            ->join('ukurans', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
            ->join('produk_warna', 'produk_ukuran.produk_warna_id', '=', 'produk_warna.id')
            ->join('produks', 'produk_warna.produk_id', '=', 'produks.id')
            ->select('nota_jual_details.*', 'ukurans.nama as nama_ukuran', 'ukurans.id as id_ukuran', 'produks.kode_produk', 'produk_warna.*')
            ->where('nota_jual_details.nota_jual_id', $id)
            ->orderBy('kode_produk', 'asc')
            ->orderBy('warna', 'asc')
            ->orderBy('id_ukuran', 'asc')
            ->get();

        return view('transaksi.notajual.detailnotajual', compact('penjualans', 'detailNotaJual'));
    }
}
