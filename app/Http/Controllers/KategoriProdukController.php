<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\DB;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoris = KategoriProduk::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.kategoriproduk.daftarkategoriproduk', compact('kategoris'));
    }

    public function create()
    {
        return view('master.kategoriproduk.insertkategoriproduk');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required|unique:kategori_produks,nama,',
        ], [
            'nama.required' => 'Wajib diisi!',
            'nama.unique' => 'Nama sudah terdaftar!',
        ]);

        try {
            KategoriProduk::create([
                'nama' => $validatedData['nama'],
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('kategoriproduk.create');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('kategoriproduk.create')->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kategoris = KategoriProduk::find($id);

        return view('master.kategoriproduk.editkategoriproduk', compact('kategoris'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required|unique:kategori_produks,nama,',
        ], [
            'nama.required' => 'Wajib diisi!',
            'nama.unique' => 'Nama sudah terdaftar!',
        ]);

        $kategoriproduk = KategoriProduk::find($id);

        try {
            KategoriProduk::find($id)
                ->update([
                    'nama' => $validatedData['nama'],
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('kategoriproduk.index');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Pengubahan data gagal!', 'warning');
            return redirect()->route('kategoriproduk.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $kategoriproduk = KategoriProduk::find($id);

        try {

            $cekKategoriProduk = Produk::where('kategori_produk_id', $id)
                ->first();

            if ($cekKategoriProduk == null) {

                KategoriProduk::find($id)->delete();

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('kategoriproduk.index');
            } else {

                alert()->error('Gagal!', 'Data kategori produk masih digunakan!');
                return redirect()->route('kategoriproduk.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('kategoriproduk.index');
        }
    }
}
