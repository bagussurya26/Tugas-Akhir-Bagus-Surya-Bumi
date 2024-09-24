<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Kain;
use App\Models\Produksi;
use App\Models\BeliDetail;
use App\Models\KategoriKain;
use App\Models\RincianKain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\KainCreateRequest;


class KainController extends Controller
{

    public function index()
    {
        $queryModel = Kain::join('raks', 'kains.raks_id', '=', 'raks.id')
            ->select('kains.*', 'raks.lokasi')
            ->orderBy('kains.created_at', 'desc')
            ->get();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);


        return view('master.kain.daftarkain', compact('queryModel'));
    }

    public function laporanstok()
    {
        $queryModel = Kain::orderBy('created_at', 'desc')
            ->get();
        // dd($queryModel);

        return view('laporan.stokkain', compact('queryModel'));
    }

    public function create()
    {
        $raks = Rak::all();

        $kategoris = KategoriKain::all();

        return view('master.kain.insertkain', compact('raks', 'kategoris'));
    }

    public function store(KainCreateRequest $request)
    {
        // return $request->file('input-foto')->store('post-images');

        DB::beginTransaction();

        try {
            $cekKain = Kain::where('kode_kain', $request->input('kode_kain'))
                ->where('warna', $request->input('warna'))
                ->first();

            if ($cekKain == null) {
                $kain = Kain::create($request->all());

                $image = $request->file('foto');

                // dd($image);
                // $name = $image->getClientOriginalName();
                // $destinationPath = public_path('/uploads/kain');
                // $id = $kain->id;
                // $newFileName = $id . '.' . $image->getClientOriginalExtension();
                // $image->move($destinationPath, $newFileName);

                
                // Save the file path to the database
                // $file = new Kain();
                // $file->foto = 'uploads/kain/' . $name;
                // $file->save();

                // Kain::where('id', $id)
                //     ->update([
                //         'foto' => $newFileName,
                //     ]);

                DB::commit();

                toast('Penambahan data berhasil!', 'success');
                return redirect()->route('kain.create');
            }
            else{
                alert()->error('Gagal!', 'Kode Kain dan Warna Kain sudah tersedia!');
                DB::commit();
                return redirect()->route('kain.create');
            }

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('kain.create');
        }


        // if ($request->hasFile('input-foto')) {

        //     $validatedData['input-foto'] = $request->file('input-foto')->store('post-images');

        //     $file = $request->file('input-foto');
        //     $kode = $request->input("input-kode");
        //     $filename = $kode . '.' . $file->extension();
        //     $folder = uniqid() . '-' . date("Ymd");
        //     $file->storeAs('baba/' . $folder, $filename);

        // }     
    }

    public function show($id)
    {
        $detailKain = Kain::join('raks', 'kains.raks_id', '=', 'raks.id')
            ->select('kains.*', 'raks.lokasi')
            ->where('kains.id', $id)
            ->get();

        $riwayatPemesanan = BeliDetail::join('nota_belis', 'nota_beli_details.nota_belis_id', '=', 'nota_belis.id')
            ->join('suppliers', 'nota_belis.suppliers_id', '=', 'suppliers.id')
            ->select('nota_beli_details.*', 'nota_belis.*', 'suppliers.nama')
            ->where('nota_beli_details.kains_id', $id)
            ->get();

        $riwayatProduksi = Produksi::join('nota_kains', 'nota_kains.nota_produksis_id', '=', 'nota_produksis.id')
            ->join('rincian_kains', 'rincian_kains.nota_kains_id', '=', 'nota_kains.id')
            ->select('nota_produksis.tgl_mulai', 'nota_produksis.tgl_selesai', 'nota_produksis.status', 'nota_produksis.id', 'rincian_kains.qty_kain')
            ->where('rincian_kains.kains_id', $id)
            ->get();

        // dd($detailKain);

        return view('master.kain.detailkain', compact('detailKain', 'riwayatPemesanan', 'riwayatProduksi'));
    }

    public function edit($id)
    {
        $detailKain = Kain::join('raks', 'kains.raks_id', '=', 'raks.id')
            ->join('kategori_kains', 'kategori_kains.id', '=', 'kains.kategori_kains_id')
            ->select('kains.*', 'raks.lokasi', 'kategori_kains.nama as nama_kategori')
            ->where('kains.id', $id)
            ->get();

        // dd($detailKain);

        $raks = Rak::all();

        $kategoris = KategoriKain::all();

        return view('master.kain.editkain', compact('detailKain', 'raks', 'kategoris'));
    }

    public function update(KainCreateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $kain = Kain::findOrfail($id)
                ->first();

            $kain->update($request->all());

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('kain.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            toast('Pengubahan data gagal!', 'warning');
            return redirect()->route('kain.edit');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $cekStokKain = Kain::where('id', $id)
                ->value('stok');

            $cekIncomingStokKain = Kain::where('id', $id)
                ->value('incoming_stok');


            if ($cekStokKain == null && $cekIncomingStokKain == null) {

                $cekKainNotaBeli = BeliDetail::where('kains_id', $id)
                    ->first();

                $cekKainRincian = RincianKain::where('kains_id', $id)
                    ->first();

                // dd($cekKainNotaBeli, $cekKainRincian);

                if ($cekKainNotaBeli == null && $cekKainRincian == null){

                    DB::statement('SET foreign_key_checks = 0');
                    $kain = Kain::find($id);
                    $kain->delete();
                    DB::statement('SET foreign_key_checks = 1');

                    DB::commit();

                    alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                    return redirect()->route('kain.index');
                }
                else{
                    alert()->error('Gagal!', 'Tidak bisa menghapus data karena data kain berhubungan dengan data lain');
                    return redirect()->route('kain.index');
                }
            } else {

                alert()->error('Gagal!', 'Kain masih memiliki stok atau incoming stok!');
                return redirect()->route('kain.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('kain.index');
        }
    }

    // public function softDelete()
    // {
    //     $queryModel = Kain::join('raks', 'kains.raks_id', '=', 'raks.id')
    //         ->select('kains.*', 'raks.lokasi')
    //         ->orderBy('kains.created_at', 'desc')
    //         ->onlyTrashed()
    //         ->get();

    //     // dd($queryModel);

    //     return view('master.kain.daftardeletedkain', compact('queryModel'));
    // }

    // public function restore($id)
    // {
    //     Produksi::withTrashed()->where('id', $id)->restore();
    //     toast('Restore data berhasil!', 'success');
    //     return redirect()->route('kain.delete');
    // }
}
