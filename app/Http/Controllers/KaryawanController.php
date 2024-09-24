<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use Carbon\Carbon;
use App\Models\User;
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
        DB::beginTransaction();

        $validatedData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ], [
            'nama.required' => 'Wajib diisi!',
            'no_hp.required' => 'Wajib diisi!',
        ]);

        try {
            Karyawan::create([
                'nama' => $validatedData['nama'],
                'no_hp' => $validatedData['no_hp'],
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('karyawan.create');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('karyawan.create')->withInput();
        }
    }

    public function show($id)
    {
        // 
    }

    public function edit($id)
    {
        $karyawans = Karyawan::find($id);

        return view('hrd.karyawan.editkaryawan', compact('karyawans'));
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
        ]);

        $karyawan = Karyawan::find($id);

        try {
            Karyawan::find($id)
                ->update([
                    'nama' => $validatedData['nama'],
                    'no_hp' => $validatedData['no_hp'],
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('karyawan.index');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Pengubahan data gagal!', 'warning');
            return redirect()->route('karyawan.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $karyawan = Karyawan::find($id);

        try {

            $cekKaryawanNotaKain = Produksi::where('karyawan_id', $id)
                ->first();

            $cekKaryawanNotaBeli = NotaBeli::where('karyawan_id', $id)
                ->first();

            if ($cekKaryawanNotaKain == null && $cekKaryawanNotaBeli == null) {

                Karyawan::find($id)->delete();

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
