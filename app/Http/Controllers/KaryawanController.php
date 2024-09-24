<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\NotaBeli;
use App\Models\NotaKain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $queryModel = Karyawan::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('hrd.karyawan.daftarkaryawan', compact('queryModel'));
    }

    public function create()
    {
        return view('hrd.karyawan.insertkaryawan');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:karyawans,nama',
            'no_hp' => '',
        ], [
            'nama.required' => 'Wajib diisi!',
            'nama.unique' => 'Nama Sudah Ada!',
        ]);

        Karyawan::create($validatedData);

        toast('Penambahan data berhasil!', 'success');
        return redirect()->route('karyawan.create');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $detailKaryawan = Karyawan::where('id', $id)
            ->get();

        return view('hrd.karyawan.editkaryawan', compact('detailKaryawan'));
    }

    public function update(Request $request, $id)
    {
        $cekNamaKaryawan = Karyawan::where('id', $id)
            ->value('nama');

        $karyawan = Karyawan::find($id);

        if ($cekNamaKaryawan == $request->input('nama')) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'no_hp' => '',
            ], [
                'nama.required' => 'Wajib diisi!',
            ]);
            
            $karyawan->update($validatedData);
        }
        else{
            $validatedData = $request->validate([
                'nama' => 'required|unique:karyawans,nama',
                'no_hp' => '',
            ], [
                'nama.required' => 'Wajib diisi!',
                'nama.unique' => 'Nama Sudah Ada!',
            ]);

            $karyawan->update($validatedData);
        }

        toast('Perubahan data berhasil!', 'success');
        return redirect()->route('karyawan.index');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $cekKaryawanNotaKain = NotaKain::where('karyawans_id', $id)
                ->first();

            $cekKaryawanNotaBeli = NotaBeli::where('karyawans_id', $id)
                ->first();

            if ($cekKaryawanNotaKain == null && $cekKaryawanNotaBeli == null) {

                DB::statement('SET foreign_key_checks = 0');
                $karyawan = Karyawan::find($id);
                $karyawan->delete();
                DB::statement('SET foreign_key_checks = 1');

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('karyawan.index');
            } else {
                alert()->error('Gagal!', 'Tidak bisa menghapus data karena data karyawan berhubungan dengan data lain');
                return redirect()->route('karyawan.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('karyawan.index');
        }
    }
}
