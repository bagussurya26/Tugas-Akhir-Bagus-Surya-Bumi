<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UkuranController extends Controller
{

    public function index()
    {
        $ukurans = Ukuran::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.ukuran.daftarukuran', compact('ukurans'));
    }

    public function create()
    {
        return view('master.ukuran.insertukuran');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
        ], [
            'nama.required' => 'Wajib diisi!',
            'kategori.required' => 'Wajib diisi!',
        ]);

        try {
            Ukuran::create([
                'nama' => $validatedData['nama'],
                'kategori' => $validatedData['kategori'],
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('ukuran.create');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('ukuran.create')->withInput();
        }

    }


    public function show(Ukuran $ukuran)
    {
        //
    }

    public function edit($id)
    {
        $ukurans = Ukuran::find($id);

        return view('master.ukuran.editukuran', compact('ukurans'));
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
        ], [
            'nama.required' => 'Wajib diisi!',
            'kategori.required' => 'Wajib diisi!',
        ]);

        try {
            Ukuran::find($id)
                ->update([
                    'nama' => $validatedData['nama'],
                    'kategori' => $validatedData['kategori'],
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('ukuran.index');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Pengubahan data gagal!', 'warning');
            return redirect()->route('ukuran.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $cekProdukUkuran = UkuranProduk::where('ukuran_id', $id)
                ->first();

            if ($cekProdukUkuran == null) {

                Ukuran::find($id)->delete();

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('ukuran.index');
            } else {

                alert()->error('Gagal!', 'Data rak masih digunakan!');
                return redirect()->route('ukuran.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('ukuran.index');
        }
    }
}
