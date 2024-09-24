<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NotaBeli;
use App\Models\NotaJual;
use App\Models\Supplier;
use App\Models\JualDetail;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getRevenue()
    {
        $bulanTahunSekarang = Carbon::now()->subMonths(11);

        $arrayWaktuDisplay = [];
        $arrayWaktu = [];
        $arrayPembelian = [];
        $arrayPenjualan = [];


        // $cek = $bulanTahunSekarang->addMonths(1);

        for ($i = 1; $i <= 12; $i++) {
            $arrayWaktuDisplay[] = $bulanTahunSekarang->format('M y');
            $arrayWaktu[] = $bulanTahunSekarang->format('Y-m');
            $bulanTahunSekarang = $bulanTahunSekarang->addMonths(1);
        }

        // dd($arrayWaktu);

        foreach ($arrayWaktu as $data) {

            $grandTotalPembelian = NotaBeli::where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $data)
                ->sum('grand_total');

            $arrayPembelian[] = $grandTotalPembelian;

            $grandTotalPenjualan = NotaJual::where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $data)
                ->sum('grand_total');

            $arrayPenjualan[] = (float) $grandTotalPenjualan;
        }

        // dd($arrayPembelian);


        $kategori = [];
        $saleskategori = [];
        $kategoris = KategoriProduk::all();
        foreach ($kategoris as $data) {
            $kategori[] = $data['nama'];

            $totalsales = NotaJual::join('nota_jual_details', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                ->join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                ->where('kategori_produks.nama', $data['nama'])
                ->count('nota_juals.id');

            $saleskategori[] = (int) $totalsales;
        }

        // dd($saleskategori);


        $arraybatik = [];
        $arraymotif = [];
        $arraypolos = [];
        $arraytakwo = [];

        foreach ($arrayWaktu as $data) {

            $totalqtybatik = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                ->join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                ->where('kategori_produks.id', 1)
                ->where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $data)
                ->sum('nota_jual_details.qty_produk');

            $arraybatik[] = (int) $totalqtybatik;

            $totalqtymotif = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                ->join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                ->where('kategori_produks.id', 2)
                ->where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $data)
                ->sum('nota_jual_details.qty_produk');

            $arraymotif[] = (int) $totalqtymotif;

            $totalqtypolos = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                ->join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                ->where('kategori_produks.id', 3)
                ->where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $data)
                ->sum('nota_jual_details.qty_produk');

            $arraypolos[] = (int) $totalqtypolos;

            $totalqtytakwo = JualDetail::join('nota_juals', 'nota_juals.id', '=', 'nota_jual_details.nota_jual_id')
                ->join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->join('produks', 'produks.id', '=', 'produk_warna.produk_id')
                ->join('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
                ->where('kategori_produks.id', 4)
                ->where(DB::raw('DATE_FORMAT(tgl_pesan, "%Y-%m")'), '=', $data)
                ->sum('nota_jual_details.qty_produk');

            $arraytakwo[] = (int) $totalqtytakwo;
        }

        // dd($arraybatik);



        $topsuppliers = Supplier::join('nota_belis', 'nota_belis.supplier_id', '=', 'suppliers.id')
            ->select('suppliers.*', DB::raw('COUNT(nota_belis.id) as nota_beli_count'))
            ->groupBy('suppliers.id')
            ->orderByDesc('nota_beli_count')
            ->limit(5)
            ->get();

        if (auth()->user()->role == 'Pemilik') {
            return view('dashboard.sales', compact('arrayWaktuDisplay', 'arrayPembelian', 'arrayPenjualan', 'kategori', 'saleskategori', 'arraybatik', 'arraymotif', 'arraypolos', 'arraytakwo', 'topsuppliers'));
        } else {
            return view('dashboard.dash');
        }


    }
}
