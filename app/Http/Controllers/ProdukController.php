<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rak;
use App\Models\Kain;
use App\Models\User;
use App\Models\Resep;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Produksi;
use App\Models\Komposisi;
use App\Models\JualDetail;
use App\Models\WarnaProduk;
use Illuminate\Support\Str;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();

        $stok = [];

        foreach ($produks as $key => $value) {

            $totalstok = 0;

            $stokproduk = UkuranProduk::join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->where('produk_warna.produk_id', $value['id'])
                ->get();

            foreach ($stokproduk as $keys => $values) {
                $totalstok += $values['stok'];
            }

            $stok[] = $totalstok;
        }


        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('master.produk.daftarproduk', compact('produks', 'stok'));
    }

    public function create()
    {
        $raks = Rak::all();
        $kategoris = KategoriProduk::all();
        $ukurans = Ukuran::all();
        $kains = Kain::all();

        return view('master.produk.insertproduk', compact('raks', 'kategoris', 'ukurans', 'kains'));
    }

    public function getUkuran($kategori)
    {
        $ukurans = Ukuran::where('kategori', $kategori)
            ->get();

        return response()->json($ukurans);
    }

    public function getResep(Request $request)
    {
        $dataWarna = $request->input('dataWarna');

        $data = [];

        foreach ($dataWarna as $key => $value) {
            $data = ['warna' => $value['warna']];
        }

        session($data);

        return redirect()->route('produk.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        if ($request->input('kategori_produk_id') == 1) {
            $kategori = 'AN';
        } elseif ($request->input('kategori_produk_id') == 2 || $request->input('kategori_produk_id') == 3) {
            $kategori = 'N';
        } else {
            $kategori = 'T';
        }

        if ($request->input('tipe_fit') == 'SLIM') {
            $fit = 'S';
        } elseif ($request->input('tipe_fit') == 'REGULAR') {
            $fit = 'R';
        } else {
            $fit = 'B';
        }

        if ($request->input('tipe_lengan') == 'PANJANG') {
            $lengan = 1;
        } elseif ($request->input('tipe_lengan') == 'MANSET') {
            $lengan = 2;
        } else {
            $lengan = 3;
        }

        $nextInvoiceNumber = Produk::max('id') + 1;
        $invoiceNumber = str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);

        if ($request->input('kategori_produk_id') == 4) {
            $kodeproduk = $fit . '11' . $lengan . $invoiceNumber;
        } else {
            $kodeproduk = $kategori . $fit . $lengan . $invoiceNumber;
        }


        try {

            // AREA INSERT PRODUK
            $produk = Produk::create([
                'kode_produk' => $kodeproduk,
                'kategori_produk_id' => $request->input('kategori_produk_id'),
                'rak_id' => $request->input('rak_id'),
                'nama' => $request->input('nama'),
                'tipe_fit' => $request->input('tipe_fit'),
                'tipe_lengan' => $request->input('tipe_lengan'),
                'keterangan' => $request->input('keterangan'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            // AREA INSERT WARNA
            $dataWarna = $request->input('dataWarna');

            foreach ($dataWarna as $index => $data) {
                $warnaproduk = WarnaProduk::create([
                    'produk_id' => $produk->id,
                    'warna' => $data['warna'],
                ]);

                if ($request->hasFile('dataWarna.' . $index . '.foto')) {
                    $image = $request->file('dataWarna.' . $index . '.foto');
                    $randomName = Str::random(5);
                    $extension = $image->getClientOriginalExtension();
                    $imageName = $randomName . '_' . $kodeproduk . '_' . $data['warna'] . '.' . $extension;
                    $image->move(public_path('uploads/produks/'), $imageName);

                    WarnaProduk::find($warnaproduk->id)
                        ->update([
                            'foto' => $imageName,
                        ]);

                }

                // --------------------------------------------------------------------------------------------------------------

                // AREA INSERT UKURAN DAN HARGA
                $dataUkuran = $request->input('dataUkuran');

                foreach ($dataUkuran as $data) {
                    UkuranProduk::create([
                        'produk_warna_id' => $warnaproduk->id,
                        'ukuran_id' => $data['ukuran'],
                        'harga' => $data['harga'],
                    ]);
                }

                // ---------------------------------------------------------------------------------------------------------------------

                // AREA INSERT RESEP
                $dataResep = $request->input('dataResep');

                foreach ($dataResep as $data) {

                    foreach ($data as $data2) {

                        if ($data2['produk_warna'] == $index) {

                            Resep::create([
                                'produk_warna_id' => $warnaproduk->id,
                                'kain_id' => $data2['kain'],
                                'tipe' => $data2['tipe'],
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('produk.create');

        } catch (\Exception $e) {
            DB::rollback();
            echo ($e);

            // toast('Penambahan data gagal!', 'warning');
            // return redirect()->route('produk.create')->withInput();
        }

    }

    public function show($id)
    {
        $produks = Produk::find($id);
        $raks = Rak::all();
        $kategoris = KategoriProduk::all();
        $kains = Kain::all();

        $produkwarnas = WarnaProduk::where('produk_id', $id)
            ->get();

        $reseps = Resep::join('kains', 'kains.id', '=', 'reseps.kain_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'reseps.produk_warna_id')
            ->where('produk_id', $id)
            ->get();

        $produksis = Produksi::join('list_kains', 'list_kains.nota_produksi_id', '=', 'nota_produksis.id')
            ->join('komposisi', 'list_kains.id', '=', 'komposisi.list_kain_id')
            ->join('produk_ukuran', 'produk_ukuran.id', '=', 'komposisi.produk_ukuran_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->select('nota_produksis.*', 'komposisi.*', 'produk_warna.warna', 'ukurans.nama as nama_ukuran')
            ->where('produk_warna.produk_id', $id)
            ->orderBy('nota_produksis.tgl_mulai', 'desc')
            ->limit(10)
            ->get();

        $penjualans = JualDetail::join('nota_juals', 'nota_jual_details.nota_jual_id', '=', 'nota_juals.id')
            ->join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
            ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
            ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
            ->select('nota_jual_details.*', 'nota_juals.*', 'produk_warna.warna', 'ukurans.nama as nama_ukuran')
            ->where('produk_warna.produk_id', $id)
            ->orderBy('nota_juals.tgl_pesan', 'desc')
            ->limit(10)
            ->get();

        return view('master.produk.detailproduk', compact('produks', 'reseps', 'produksis', 'penjualans', 'raks', 'kains', 'produkwarnas'));
    }

    public function edit($id)
    {
        $produks = Produk::find($id);
        $raks = Rak::all();
        $kategoris = KategoriProduk::all();
        $kains = Kain::all();

        $reseps = Resep::join('kains', 'reseps.kain_id', '=', 'kains.id')
            ->join('produk_warna', 'reseps.produk_warna_id', '=', 'produk_warna.id')
            ->where('produk_warna.produk_id', $id)
            ->get();

        return view('master.produk.editproduk', compact('produks', 'raks', 'kategoris', 'reseps', 'kains', ));
    }

    public function getUkuranEdit($kategori, $id)
    {
        $detailUkurans = Ukuran::join('produk_ukuran', 'produk_ukuran.ukuran_id', '=', 'ukurans.id')
            ->select('produk_ukuran.*', 'ukurans.nama')
            ->where('ukurans.kategori', $kategori)
            ->where('produk_ukuran.produk_id', $id)
            ->get();

        return response()->json($detailUkurans);
    }

    public function updateInfoDasarProduk(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            Produk::find($id)
                ->update([
                    'rak_id' => $request->input('rak_id'),
                    'nama' => $request->input('nama'),
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('produk.show', $id);


        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('produk.edit', $id);
        }
    }

    public function updateKeterangan(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            Produk::find($id)
                ->update([
                    'keterangan' => $request->input('keterangan'),
                    'updated_by' => auth()->user()->id,
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('produk.show', $id);


        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('produk.edit', $id);
        }
    }

    public function updateWarnaProduk(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // UPDATE WARNA PRODUK
            $dataWarna = $request->all('dataWarna');

            $produks = Produk::find($id);

            foreach ($dataWarna as $index => $data) {

                foreach ($data as $idx => $value) {

                    if (isset($value['foto'])) {

                        $warnaproduk = WarnaProduk::where('id', $idx)
                            ->first();

                        $filePath = public_path('uploads/produks/') . $warnaproduk->foto;

                        if ($request->hasFile('dataWarna.' . $idx . '.foto')) {
                            $image = $request->file('dataWarna.' . $idx . '.foto');
                            $randomName = Str::random(5);
                            $extension = $image->getClientOriginalExtension();
                            $imageName = $randomName . '_' . $produks->kode_produk . '_' . $value['warna'] . '.' . $extension;
                            $image->move(public_path('uploads/produks/'), $imageName);

                            if (File::exists($filePath)) {

                                File::delete($filePath);
                            }

                            WarnaProduk::where('id', $idx)
                                ->update([
                                    'warna' => $value['warna'],
                                    'foto' => $imageName,
                                ]);
                        }
                    } else {
                        WarnaProduk::where('id', $idx)
                            ->update([
                                'warna' => $value['warna'],
                            ]);
                    }
                }
            }

            // TAMBAH RESEP
            $dataResep = $request->input('dataResep');

            foreach ($dataResep as $index => $data) {

                foreach ($data as $idx => $value) {

                    Resep::where('produk_warna_id', $index)
                        ->where('tipe', $value['tipe'])
                        ->update([
                            'kain_id' => $value['kain'],
                        ]);
                }
            }

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('produk.show', $id);


        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('produk.edit', $id);
        }
    }

    public function updateHargaProduk(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // UPDATE WARNA PRODUK
            $dataProduk = $request->input('dataProduk');

            foreach ($dataProduk as $index => $data) {

                UkuranProduk::where('id', $index)
                    ->update([
                        'harga' => $data['harga'],
                    ]);
            }

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('produk.show', $id);


        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('produk.edit', $id);
        }
    }

    public function tambahWarnaProduk(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // TAMBAH WARNA PRODUK

            $produks = Produk::find($id);

            $warnaproduks = WarnaProduk::create([
                'produk_id' => $id,
                'warna' => $request->input('warna'),
            ]);

            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $randomName = Str::random(5);
                $extension = $image->getClientOriginalExtension();
                $imageName = $randomName . '_' . $produks->kode_produk . '_' . $warnaproduks->warna . '.' . $extension;
                $image->move(public_path('uploads/produks/'), $imageName);

                WarnaProduk::where('id', $warnaproduks->id)
                    ->firstOrFail()
                    ->update([
                        'foto' => $imageName,
                    ]);
            }

            $warnaproduksample = WarnaProduk::where('produk_id', $id)->first();

            $produkukuranssample = UkuranProduk::where('produk_warna_id', $warnaproduksample->id)->get();

            foreach ($produkukuranssample as $value) {
                UkuranProduk::create([
                    'produk_warna_id' => $warnaproduks->id,
                    'ukuran_id' => $value['ukuran_id'],
                    'harga' => $value['harga'],
                    'stok' => 0,
                    'incoming_stok' => 0
                ]);
            }

            
            // UPDATE RESEP
            $dataResepTambah = $request->input('dataResepTambah');

            foreach ($dataResepTambah as $index => $data) {

                    Resep::create([
                        'produk_warna_id' => $warnaproduks->id,
                        'kain_id' => $data['kain'],
                        'tipe' => $data['tipe']
                    ]);
            }

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('produk.show', $id);


        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('produk.edit', $id);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $produk = Produk::find($id);

        try {
            // UPDATE PRODUK
            Produk::find($id)
                ->update([
                    'rak_id' => $request->input('rak_id'),
                    'nama' => $request->input('nama'),
                    'keterangan' => $request->input('keterangan'),
                    'updated_by' => auth()->user()->id,
                ]);

            $produks = Produk::find($id);

            // UPDATE WARNA

            $dataWarna = $request->input('dataWarna');

            $datawarnasebelum = WarnaProduk::where('produk_id', $id)
                ->get();

            foreach ($dataWarna as $index => $data) {

                foreach ($datawarnasebelum as $key => $value) {

                    $filePath = public_path('uploads/produks/') . $value['foto'];

                    if ($index == $key) {

                        if ($value['warna'] != $data['warna'] && $request->hasFile('dataWarna.' . $index . '.foto')) {

                            $image = $request->file('dataWarna.' . $index . '.foto');
                            $randomName = Str::random(10);
                            $extension = $image->getClientOriginalExtension();
                            $imageName = $randomName . '_' . $produks->kode_produk . '.' . $extension;
                            $image->move(public_path('uploads/produks/'), $imageName);

                            if (File::exists($filePath)) {

                                File::delete($filePath);
                            }

                            WarnaProduk::where('produk_id', $id)
                                ->update([
                                    'warna' => $data['warna'],
                                    'foto' => $imageName,
                                ]);


                        } else if ($value['warna'] == $data['warna'] && $request->hasFile('dataWarna.' . $index . '.foto')) {

                            $image = $request->file('dataWarna.' . $index . '.foto');
                            $randomName = Str::random(10);
                            $extension = $image->getClientOriginalExtension();
                            $imageName = $randomName . '_' . $produks->kode_produk . '.' . $extension;
                            $image->move(public_path('uploads/produks/'), $imageName);

                            if (File::exists($filePath)) {

                                File::delete($filePath);
                            }

                            WarnaProduk::where('produk_id', $id)
                                ->update([
                                    'foto' => $imageName,
                                ]);

                        } else if ($value['warna'] != $data['warna']) {

                            WarnaProduk::where('produk_id', $id)
                                ->update([
                                    'warna' => $value['warna'],
                                ]);
                        }
                    } else {

                        if ($request->hasFile('dataWarna.' . $index . '.foto')) {

                            $image = $request->file('dataWarna.' . $index . '.foto');
                            $randomName = Str::random(10);
                            $extension = $image->getClientOriginalExtension();
                            $imageName = $randomName . '_' . $produks->kode_produk . '.' . $extension;
                            dd($imageName);
                            $image->move(public_path('uploads/produks/'), $imageName);

                            WarnaProduk::create([
                                'produk_id' => $id,
                                'warna' => $data['warna'],
                                'foto' => $imageName,
                            ]);
                        } else {
                            WarnaProduk::create([
                                'produk_id' => $id,
                                'warna' => $data['warna'],
                            ]);
                        }
                    }
                }
            }


            $dataProduk = $request->input('dataProduk');

            foreach ($dataProduk as $data) {

                $cek = UkuranProduk::where('produk_id', $id)
                    ->where('ukuran_id', $data['ukuran'])
                    ->first();

                if ($cek->harga != $data['harga']) {
                    UkuranProduk::where('produk_id', $id)
                        ->where('ukuran_id', $data['ukuran'])
                        ->update([
                            'harga' => $data['harga'],
                        ]);

                }

            }


            // UPDATE RESEP
            $dataResep = $request->input('dataResep');

            $dataresepsebelum = Resep::join('kains', 'reseps.kain_id', '=', 'kains.id')
                ->join('produk_warna', 'reseps.produk_warna_id', '=', 'produk_warna.id')
                ->where('produk_warna.produk_id', $id)
                ->get();

            foreach ($dataResep as $index => $data) {

                foreach ($dataresepsebelum as $key => $value) {

                    if ($index == $key) {

                        if ($value['kain_id'] != $data['kain'] && $value['tipe'] != $data['tipe']) {

                            Resep::where('produk_warna_id', $value['produk_warna_id'])
                                ->update([
                                    'kain_id' => $data['kain'],
                                    'tipe' => $data['tipe'],
                                ]);


                        } else if ($value['kain_id'] != $data['kain'] && $value['tipe'] == $data['tipe']) {

                            Resep::where('produk_warna_id', $value['produk_warna_id'])
                                ->update([
                                    'kain_id' => $data['kain'],
                                ]);
                        } else if ($value['kain_id'] == $data['kain'] && $value['tipe'] != $data['tipe']) {

                            Resep::where('produk_warna_id', $value['produk_warna_id'])
                                ->update([
                                    'tipe' => $data['tipe'],
                                ]);
                        }
                    } else {
                        Resep::create([
                            'produk_warna_id' => $dataresepsebelum->produk_warna_id,
                            'kain_id' => $data['kain'],
                            'tipe' => $data['tipe'],
                        ]);
                    }
                }
            }

            foreach ($dataResep as $data) {

                $cek = Resep::where('produk_id', $id)
                    ->where('kain_id', $data['kain'])
                    ->first();

                if ($cek != null) {
                    Resep::where('produk_id', $id)
                        ->where('kain_id', $data['kain'])
                        ->update([
                            'kain_id' => $data['kain'],
                        ]);

                } else {
                    Resep::create([
                        'produk_id' => $id,
                        'kain_id' => $data['kain_id'],
                    ]);

                }
            }

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('produk.show', $id);


        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Pengubahan data gagal!', 'warning');
            // return redirect()->route('produk.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $produk = Produk::find($id);

        try {
            $cekProdukKomposisi = Komposisi::join('produk_ukuran', 'produk_ukuran.id', '=', 'komposisi.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->where('produk_warna.produk_id', $id)
                ->first();

            $cekProdukNotaJual = JualDetail::join('produk_ukuran', 'produk_ukuran.id', '=', 'nota_jual_details.produk_ukuran_id')
                ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                ->where('produk_warna.produk_id', $id)
                ->first();

            if ($produk->stok == 0 && $produk->incoming_stok == 0 && $cekProdukKomposisi == null && $cekProdukNotaJual == null) {

                $dataprodukwarna = WarnaProduk::where('produk_id', $id)->get();

                foreach ($dataprodukwarna as $data) {

                    $filePath = public_path('uploads/produks/') . $data['foto'];

                    UkuranProduk::where('produk_warna_id', $data['id'])->delete();
                    Resep::where('produk_warna_id', $data['id'])->delete();
                    WarnaProduk::find($data['id'])->delete();

                    if (File::exists($filePath)) {

                        File::delete($filePath);
                    }
                }

                Produk::find($id)->delete();

                DB::commit();

                alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
                return redirect()->route('produk.index');

            } else {

                alert()->error('Gagal!', 'Tidak bisa menghapus data karena data produk berhubungan dengan data lain');
                return redirect()->route('produk.index');
            }

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            // return redirect()->route('produk.index');
        }
    }
}
