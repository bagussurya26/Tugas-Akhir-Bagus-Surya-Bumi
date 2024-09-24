<?php

namespace App\Http\Controllers;

use App\Models\Musim;
use App\Models\Produksi;
use App\Models\BeliDetail;
use App\Models\MusimDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MusimController extends Controller
{
    public function index()
    {
        $musims = Musim::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.musim.daftarmusim', compact('musims'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            Musim::where('id', $id)
                ->update([
                    'nama' => $request->input('nama'),
                ]);

            DB::commit();

            toast('Perubahan data berhasil!', 'success');
            return redirect()->route('musim.show', $id);

        } catch (\Exception $e) {
            DB::rollback();
            // echo ($e);

            toast('Perubahan data gagal!', 'warning');
            return redirect()->route('musim.show', $id)->withInput();
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            Musim::create([
                'nama' => $request->input('nama'),
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('musim.index');

        } catch (\Exception $e) {
            DB::rollback();
            // echo ($e);

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('musim.index')->withInput();
        }
    }

    public function show($id)
    {
        $musims = Musim::find($id);
        $musimdetail = MusimDetail::where('musim_id', $id)->orderBy('tahun', 'desc')->get();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.musim.detailmusim', compact('musims', 'musimdetail'));
    }


    public function editdetail(Request $request, $id)
    {
        DB::beginTransaction();

        $idmusim = MusimDetail::Where('id', $id)->value('musim_id');

        try {
            MusimDetail::where('id', $id)
                ->update([
                    'tahun' => $request->input('tahun'),
                    'bulan_awal' => $request->input('bulan_awal'),
                    'bulan_akhir' => $request->input('bulan_akhir'),
                ]);

            DB::commit();

            toast('Perubahan data berhasil!', 'success');
            return redirect()->route('musim.show', $idmusim);

        } catch (\Exception $e) {
            DB::rollback();
            // echo ($e);

            toast('Perubahan data gagal!', 'warning');
            return redirect()->route('musim.show', $idmusim)->withInput();
        }
    }

    public function insertdetail(Request $request)
    {
        DB::beginTransaction();

        $idmusim = $request->input('musim_id');

        try {
            MusimDetail::create([
                'musim_id' => $request->input('musim_id'),
                'tahun' => $request->input('tahun'),
                'bulan_awal' => $request->input('bulan_awal'),
                'bulan_akhir' => $request->input('bulan_akhir'),
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('musim.show', $idmusim);

        } catch (\Exception $e) {
            DB::rollback();
            // echo ($e);

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('musim.show', $idmusim)->withInput();
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            MusimDetail::where('musim_id', $id)->delete();
            Musim::find($id)->delete();

            DB::commit();

            alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
            return redirect()->route('musim.index');

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('musim.index');
        }
    }
}
