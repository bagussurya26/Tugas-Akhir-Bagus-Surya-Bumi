<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rak;
use App\Models\Kain;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RakController extends Controller
{
    public function index()
    {
        $raks = Rak::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.rak.daftarrak', compact('raks'));
    }

    public function create()
    {
        return view('master.rak.insertrak');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'lokasi' => 'required|unique:raks,lokasi,',
        ], [
            'lokasi.required' => 'Wajib diisi!',
            'lokasi.unique' => 'Rak sudah terdaftar!',
        ]);

        try {
            Rak::create([
                'lokasi' => $validatedData['lokasi'],
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('rak.create');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('rak.create')->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $raks = Rak::find($id);

        return view('master.rak.editrak', compact('raks'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'lokasi' => 'required|unique:raks,lokasi,',
        ], [
            'lokasi.required' => 'Wajib diisi!',
            'lokasi.unique' => 'Rak sudah terdaftar!',
        ]);

        try {
            Rak::find($id)
                ->update([
                    'lokasi' => $validatedData['lokasi'],
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('rak.index');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Pengubahan data gagal!', 'warning');
            return redirect()->route('rak.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $cekRakKain = Kain::where('rak_id', $id)
                ->first();

            $cekRakProduk = Produk::where('rak_id', $id)
                ->first();

            if ($cekRakProduk == null && $cekRakKain == null) {

                Rak::find($id)->delete();

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('rak.index');
            } else {

                alert()->error('Gagal!', 'Data rak masih digunakan!');
                return redirect()->route('rak.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('rak.index');
        }
    }
}
