<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\NotaBeli;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.supplier.daftarsupplier', compact('suppliers'));
    }

    public function create()
    {

        return view('master.supplier.insertsupplier');
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ], [
            'nama.required' => 'Wajib diisi!',
            'no_hp.required' => 'Wajib diisi!',
        ]);

        try {

            Supplier::create([
                'nama' => $validatedData['nama'],
                'no_hp' => $validatedData['no_hp'],
                'alamat' => $request->input('alamat'),
                'email' => $request->input('email'),
                'keterangan' => $request->input('keterangan'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('supplier.create');

        } catch (\Exception $e) {
            DB::rollback();
            echo ($e);

            toast('Penambahan data gagal!', 'warning');
            // return redirect()->route('supplier.create')->withInput();
        }
    }

    public function show($id)
    {
        $suppliers = Supplier::find($id);

        $riwayatPemesanan = NotaBeli::join('nota_beli_details', 'nota_beli_details.nota_beli_id', '=', 'nota_belis.id')
            ->where('nota_belis.supplier_id', $id)
            ->groupBy('nota_belis.id')
            ->orderBy('nota_belis.tgl_pesan', 'desc')
            ->limit(5)
            ->get();

        return view('master.supplier.detailsupplier', compact('suppliers', 'riwayatPemesanan'));
    }

    public function edit($id)
    {
        $suppliers = Supplier::find($id);

        return view('master.supplier.editsupplier', compact('suppliers'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ], [
            'nama.required' => 'Wajib diisi!',
            'no_hp.required' => 'Wajib diisi!',
            'email.required' => 'Wajib diisi!',
        ]);

        try {

            Supplier::find($id)
                ->update([
                    'nama' => $validatedData['nama'],
                    'no_hp' => $validatedData['no_hp'],
                    'alamat' => $request->input('alamat'),
                    'email' => $request->input('email'),
                    'keterangan' => $request->input('keterangan'),
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('supplier.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('supplier.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $cekSupplierNotaBeli = NotaBeli::where('supplier_id', $id)
                ->first();

            if ($cekSupplierNotaBeli == null) {

                Supplier::find($id)->delete();

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('supplier.index');
            } else {
                alert()->error('Gagal!', 'Tidak bisa menghapus data karena data supplier berhubungan dengan data lain');
                return redirect()->route('supplier.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            // return redirect()->route('supplier.index');
        }
    }
}
