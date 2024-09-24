<?php

namespace App\Http\Controllers;

use App\Models\BuyOrder;
use App\Models\Kain;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function laporanpembeliankain()
    {
        $queryModel = Kain::join('nota_beli_details', 'kains.id', '=', 'nota_beli_details.kains_id')
        ->join('nota_belis', 'nota_beli_details.nota_belis_id', '=', 'nota_belis.id')
        ->join('suppliers', 'nota_belis.suppliers_id', '=', 'suppliers.id')
        ->select('kains.jenis_kain', 'nota_beli_details.kains_id', 'nota_beli_details.qty_roll', 'nota_beli_details.yard', 'nota_beli_details.subtotal', 'nota_belis.id', 'nota_belis.tgl_pesan', 'nota_belis.tgl_datang', 'nota_belis.tgl_bayar', 'suppliers.nama')
        ->orderBy('nota_belis.tgl_pesan', 'desc')
        ->get();
        // dd($queryModel);

        return view('laporan.pembeliankain', compact('queryModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
