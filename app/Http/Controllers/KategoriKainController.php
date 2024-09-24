<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kain;
use App\Models\User;
use App\Models\KategoriKain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKainController extends Controller
{
    public function index()
    {
        $kategoris = KategoriKain::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.kategorikain.daftarkategorikain', compact('kategoris'));
    }

    public function create()
    {
        return view('master.kategorikain.insertkategorikain');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required|unique:kategori_kains,nama,',
        ], [
            'nama.required' => 'Wajib diisi!',
            'nama.unique' => 'Nama sudah terdaftar!',
        ]);

        try {
            KategoriKain::create([
                'nama' => $validatedData['nama'],
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('kategorikain.create');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('kategorikain.create')->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kategoris = KategoriKain::find($id);

        return view('master.kategorikain.editkategorikain', compact('kategoris'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required|unique:kategori_kains,nama,',
        ], [
            'nama.required' => 'Wajib diisi!',
            'nama.unique' => 'Nama sudah terdaftar!',
        ]);

        try {
            KategoriKain::find($id)
                ->update([
                    'nama' => $validatedData['nama'],
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('kategorikain.index');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Pengubahan data gagal!', 'warning');
            return redirect()->route('kategorikain.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $cekKategoriKain = Kain::where('kategori_kain_id', $id)
                ->first();

            if ($cekKategoriKain == null) {

                KategoriKain::find($id)->delete();

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('kategorikain.index');
            } else {

                alert()->error('Gagal!', 'Data kategori kain masih digunakan!');
                return redirect()->route('kategorikain.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            // return redirect()->route('kategorikain.index');
        }
    }
}
