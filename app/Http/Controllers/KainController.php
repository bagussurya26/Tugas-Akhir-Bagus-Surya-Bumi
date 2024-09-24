<?php

namespace App\Http\Controllers;

use App\Models\ListKain;
use App\Models\Rak;
use App\Models\Kain;
use App\Models\User;
use App\Models\Produksi;
use App\Models\BeliDetail;
use App\Models\RincianKain;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\KategoriKain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class KainController extends Controller
{

    public function index()
    {
        $kains = Kain::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.kain.daftarkain', compact('kains'));
    }

    public function create()
    {
        $raks = Rak::all();

        $kategoris = KategoriKain::all();

        return view('master.kain.insertkain', compact('raks', 'kategoris'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'kode_kain' => 'required',
            'kategori_kain_id' => 'required',
            'rak_id' => 'required',
            'nama' => 'required',
            'warna' => 'required',
            'lebar' => 'required',
            'foto' => 'image|mimes:png,jpg,jpeg',
        ], [
            'kode_kain.required' => 'Wajib diisi',
            'kategori_kain_id.required' => 'Wajib diisi!',
            'rak_id.required' => 'Wajib diisi!',
            'nama.required' => 'Wajib diisi!',
            'warna.required' => 'Wajib diisi!',
            'lebar.required' => 'Wajib diisi!',
            'foto.image' => 'Hanya menerima file berupa gambar!',
            'foto.mimes' => 'Tipe file gambar yang diijinkan: .jpg, .png, .jpeg!'
        ]);

        try {
            $kain = Kain::create([
                'kode_kain' => $validatedData['kode_kain'],
                'kategori_kain_id' => $validatedData['kategori_kain_id'],
                'rak_id' => $validatedData['rak_id'],
                'nama' => $validatedData['nama'],
                'warna' => $validatedData['warna'],
                'lebar' => $validatedData['lebar'],
                'keterangan' => $request->input('keterangan'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $randomName = Str::random(10);
                $kodeKain = $validatedData['kode_kain'];
                $extension = $image->getClientOriginalExtension();
                $imageName = $randomName . '_' . $kodeKain . '.' . $extension;
                $image->move(public_path('uploads/kains/'), $imageName);

                Kain::where('id', $kain->id)
                    ->firstOrFail()
                    ->update([
                        'foto' => $imageName,
                    ]);               
            }

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('kain.index');

        } catch (\Exception $e) {
            DB::rollback();
            // echo ($e);

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('kain.index')->withInput();
        }
    }

    public function show($id)
    {
        $kains = Kain::find($id);

        $riwayatPembelian = BeliDetail::join('nota_belis', 'nota_beli_details.nota_beli_id', '=', 'nota_belis.id')
            ->join('suppliers', 'nota_belis.supplier_id', '=', 'suppliers.id')
            ->select('nota_beli_details.*', 'nota_belis.*', 'suppliers.nama')
            ->where('nota_beli_details.kain_id', $id)
            ->orderBy('nota_belis.tgl_pesan', 'desc')
            ->limit(5)
            ->get();

        $riwayatProduksi = Produksi::join('list_kains', 'list_kains.nota_produksi_id', '=', 'nota_produksis.id')
            ->join('komposisi', 'komposisi.list_kain_id', '=', 'list_kains.id')
            ->select('nota_produksis.*', 'komposisi.*')
            ->where('list_kains.kain_id', $id)
            ->orderBy('nota_produksis.tgl_mulai', 'desc')
            ->limit(5)
            ->get();

        return view('master.kain.detailkain', compact('kains', 'riwayatPembelian', 'riwayatProduksi'));
    }

    public function edit($id)
    {
        $kains = Kain::find($id);

        $raks = Rak::all();

        $kategoris = KategoriKain::all();

        return view('master.kain.editkain', compact('kains', 'raks', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'kode_kain' => 'required',
            'kategori_kain_id' => 'required',
            'rak_id' => 'required',
            'nama' => 'required',
            'warna' => 'required',
            'lebar' => 'required',
            'foto' => 'image|mimes:png,jpg,jpeg',
        ], [
            'kode_kain.required' => 'Wajib diisi',
            'kategori_kain_id.required' => 'Wajib diisi!',
            'rak_id.required' => 'Wajib diisi!',
            'nama.required' => 'Wajib diisi!',
            'warna.required' => 'Wajib diisi!',
            'lebar.required' => 'Wajib diisi!',
            'foto.image' => 'Hanya menerima file berupa gambar!',
            'foto.mimes' => 'Tipe file gambar yang diijinkan: .jpg, .png, .jpeg!'
        ]);

        $imageNameBefore = Kain::where('id', $id)
            ->value('foto');

        $filePath = public_path('uploads/kains/') . $imageNameBefore;

        try {
            Kain::find($id)
                ->update([
                    'kode_kain' => $validatedData['kode_kain'],
                    'kategori_kain_id' => $validatedData['kategori_kain_id'],
                    'rak_id' => $validatedData['rak_id'],
                    'nama' => $validatedData['nama'],
                    'warna' => $validatedData['warna'],
                    'lebar' => $validatedData['lebar'],
                    'keterangan' => $request->input('keterangan'),
                    'updated_by' => auth()->user()->id,
                ]);

            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $randomName = Str::random(10);
                $kodeKain = $validatedData['kode_kain'];
                $extension = $image->getClientOriginalExtension();
                $imageName = $randomName . '_' . $kodeKain . '.' . $extension;
                $image->move(public_path('uploads/kains/'), $imageName);

                if (File::exists($filePath)) {

                    File::delete($filePath);
                }

                Kain::where('id', $id)
                    ->firstOrFail()
                    ->update([
                        'foto' => $imageName,
                    ]);
            }

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('kain.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('kain.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $imageName = Kain::where('id', $id)
            ->value('foto');

        $kain = Kain::find($id);

        $filePath = public_path('uploads/kains/') . $imageName;

        try {

            $cekStokKain = Kain::where('id', $id)
                ->value('stok');

            if ($cekStokKain == 0) {

                $cekKainNotaBeli = BeliDetail::where('kain_id', $id)
                    ->first();

                $cekKainListKain = ListKain::where('kain_id', $id)
                    ->first();

                if ($cekKainNotaBeli == null && $cekKainListKain == null) {

                    Kain::find($id)->delete();                  

                    DB::commit();

                    if (File::exists($filePath)) {

                        File::delete($filePath);
                    }

                    alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                    return redirect()->route('kain.index');
                } else {
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

    public function laporanstok()
    {
        $kains = Kain::all();

        return view('laporan.stokkain', compact('kains'));
    }
}
