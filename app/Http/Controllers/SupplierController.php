<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NotaBeli;
use App\Models\Supplier;
use App\Models\BeliDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $queryModel = Supplier::orderBy('id', 'asc')->get();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.supplier.daftarsupplier', compact('queryModel'));
    }

    public function create()
    {

        return view('master.supplier.insertsupplier');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:suppliers,nama',
            'no_hp' => 'required',
            'alamat' => '',
            'email' => '',
            'no_rek' => '',
            'keterangan' => '',
        ], [
            'nama.required' => 'Wajib diisi!',
            'nama.unique' => 'Nama Sudah Ada!',
            'no_hp.required' => 'Wajib diisi!',
        ]);

        Supplier::create($validatedData);

        toast('Penambahan data berhasil!', 'success');
        return redirect()->route('supplier.create');
    }

    public function show($id)
    {
        $detailSupplier = Supplier::where('suppliers.id', $id)
            ->get();

        $riwayatPemesanan = BeliDetail::join('nota_belis', 'nota_beli_details.nota_belis_id', '=', 'nota_belis.id')
            ->join('suppliers', 'nota_belis.suppliers_id', '=', 'suppliers.id')
            ->select('nota_beli_details.*', 'nota_belis.*', 'suppliers.nama')
            ->where('suppliers.id', $id)
            ->get();

        // dd($detailKain);

        return view('master.supplier.detailsupplier', compact('detailSupplier', 'riwayatPemesanan'));
    }

    public function edit($id)
    {
        $detailSupplier = Supplier::where('suppliers.id', $id)
            ->get();

        return view('master.supplier.editsupplier', compact('detailSupplier'));
    }

    public function update(Request $request, $id)
    {
        $cekNamaSupplier = Supplier::where('id', $id)
            ->value('nama');

        $supplier = Supplier::find($id);

        if ($cekNamaSupplier == $request->input('nama')) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'no_hp' => 'required',
                'alamat' => '',
                'email' => '',
                'no_rek' => '',
                'keterangan' => '',
            ], [
                'nama.required' => 'Wajib diisi!',
                'no_hp.required' => 'Wajib diisi!',
            ]);

            $supplier->update($validatedData);
        } else {
            $validatedData = $request->validate([
                'nama' => 'required|unique:suppliers,nama',
                'no_hp' => 'required',
                'alamat' => '',
                'email' => '',
                'no_rek' => '',
                'keterangan' => '',
            ], [
                'nama.required' => 'Wajib diisi!',
                'nama.unique' => 'Nama Sudah Ada!',
                'no_hp.required' => 'Wajib diisi!',
            ]);

            $supplier->update($validatedData);
        }

        toast('Perubahan data berhasil!', 'success');
        return redirect()->route('supplier.index');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $cekKaryawanNotaBeli = NotaBeli::where('suppliers_id', $id)
                ->first();

            if ($cekKaryawanNotaBeli == null) {

                DB::statement('SET foreign_key_checks = 0');
                $supplier = Supplier::find($id);
                $supplier->delete();
                DB::statement('SET foreign_key_checks = 1');

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('supplier.index');
            } else {
                alert()->error('Gagal!', 'Tidak bisa menghapus data karena data supplier berhubungan dengan data lain');
                return redirect()->route('supplier.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('supplier.index');
        }
    }
}
