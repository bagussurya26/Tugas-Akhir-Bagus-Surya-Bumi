<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Produksi;
use App\Models\Rak;
use App\Models\KategoriProduk;
use App\Models\UkuranPakaian;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukCreateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryModel = Produk::join('raks', 'pakaians.raks_id', '=', 'raks.id')
            ->join('kategori_pakaians', 'pakaians.kategori_pakaians_id', '=', 'kategori_pakaians.id')
            ->select('pakaians.*', 'raks.lokasi', 'kategori_pakaians.nama as kategori_nama')
            ->orderBy('pakaians.created_at', 'desc')
            ->get();


        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        // dd($queryModel);

        return view('master.produk.daftarproduk', compact('queryModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listRak = Rak::all();

        $listKategori = KategoriProduk::all();

        return view('master.produk.insertproduk', compact('listRak', 'listKategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukCreateRequest $request)
    {
        $produk = Produk::create($request->all());
        toast('Penambahan data berhasil!', 'success');
        return redirect()->route('produk.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailProduk = Produk::join('raks', 'pakaians.raks_id', '=', 'raks.id')
            ->join('kategori_pakaians', 'pakaians.kategori_pakaians_id', '=', 'kategori_pakaians.id')
            ->select('pakaians.*', 'raks.lokasi', 'kategori_pakaians.nama as kategori_nama')
            ->where('pakaians.id', $id)
            ->get();

        $detailUkuran = UkuranPakaian::join('ukurans', 'ukuran_pakaians.ukurans_id', '=', 'ukurans.id')
            ->select('ukuran_pakaians.*', 'ukurans.*')
            ->where('pakaians_id', $id)
            ->get();

        // $riwayatProduksi = Produksi::join('hasil_pakaians', 'hasil_pakaians.nota_produksis_id', '=', 'nota_produksis.id')
        //     ->join('ukuran_pakaians', 'ukuran_pakaians.pakaians_id', '=', 'hasil_pakaians.ukuran_pakaians_pakaians_id')
        //     ->join('ukurans', 'ukurans.id', '=', 'ukuran_pakaians.ukurans_id')
        //     ->select('nota_produksis.*', 'hasil_pakaians.*', 'ukuran_pakaians.*', 'ukurans.ukuran')
        //     ->where('pakaians_id', $id)
        //     // ->groupBy('ukurans.id')
        //     ->get();

        $riwayatProduksi = Produksi::join('hasil_pakaians', 'hasil_pakaians.nota_produksis_id', '=', 'nota_produksis.id')
            // ->join('ukuran_pakaians', 'ukuran_pakaians.pakaians_id', '=', 'hasil_pakaians.ukuran_pakaians_pakaians_id')
            ->join('ukurans', 'ukurans.id', '=', 'hasil_pakaians.ukuran_pakaians_ukurans_id')
            ->select('nota_produksis.*', 'hasil_pakaians.*', 'ukurans.ukuran')
            ->where('hasil_pakaians.ukuran_pakaians_pakaians_id', $id)
            // ->groupBy('ukurans.id')
            ->get();

        // dd($detailKain);

        return view('master.produk.detailproduk', compact('detailProduk', 'detailUkuran','riwayatProduksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detailProduk = Produk::join('raks', 'pakaians.raks_id', '=', 'raks.id')
            ->join('kategori_pakaians', 'pakaians.kategori_pakaians_id', '=', 'kategori_pakaians.id')
            ->select('pakaians.*', 'raks.lokasi', 'kategori_pakaians.nama as kategori_nama')
            ->orderBy('pakaians.created_at', 'desc')
            ->where('pakaians.id', $id)
            ->get();

        $listRak = Rak::all();
        $listKategori = KategoriProduk::all();

        return view('master.produk.editproduk', compact('detailProduk', 'listRak', 'listKategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukCreateRequest $request, $id)
    {
        $produk = Produk::findOrfail($id)
            ->first();

        // dd($request->all());

        $produk->update($request->all());
        // Alert::success('Success', 'Data Berhasil Diubah!');
        toast('Pengubahan data berhasil!', 'success');
        return redirect()->route('produk.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);

        // dd($kain);

        $produk->delete();
        alert()->success('Hore!', 'Data Deleted Successfully');
        return redirect()->route('produk.index');
    }

    public function softDelete()
    {
        $queryModel = Produk::join('raks', 'pakaians.raks_id', '=', 'raks.id')
            ->join('kategori_pakaians', 'pakaians.kategori_pakaians_id', '=', 'kategori_pakaians.id')
            ->select('pakaians.*', 'raks.lokasi', 'kategori_pakaians.nama as kategori_nama')
            ->orderBy('pakaians.created_at', 'desc')
            ->onlyTrashed()
            ->get();

        // dd($queryModel);

        return view('master.produk.daftardeletedproduk', compact('queryModel'));
    }

    public function restore($id)
    {
        $produk = Produk::withTrashed()->where('id', $id)->restore();
        toast('Restore data berhasil!', 'success');
        return redirect()->route('produk.delete');
    }
}
