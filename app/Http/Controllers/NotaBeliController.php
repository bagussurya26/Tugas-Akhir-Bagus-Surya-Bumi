<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Karyawan;
use App\Models\NotaBeli;
use App\Models\Supplier;
use App\Models\BeliDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NotaBeliController extends Controller
{
    public function index()
    {
        $pembelians = NotaBeli::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('transaksi.notabeli.daftarnotabeli', compact('pembelians'));
    }

    public function getPembelianKain($filter)
    {
        $pembelians = NotaBeli::join('nota_beli_details', 'nota_belis.id', '=', 'nota_beli_details.nota_beli_id')
            ->where('nota_beli_details.kain_id', $filter)
            ->get();

        $kode_kain = Kain::where('id', $filter)->value('kode_kain');

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('transaksi.notabeli.daftarnotabelikain', compact('pembelians', 'kode_kain'));
    }

    public function getPembelianSupplier($filter)
    {
        $pembelians = NotaBeli::where('supplier_id', $filter)
            ->get();

        $nama_supplier = Supplier::where('id', $filter)->value('nama');

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('transaksi.notabeli.daftarnotabelisupplier', compact('pembelians', 'nama_supplier'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $kains = Kain::all();
        $karyawans = Karyawan::all();

        return view('transaksi.notabeli.insertnotabeli', compact('suppliers', 'kains', 'karyawans'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // NOTA BELI
            $notabeli = NotaBeli::create([
                'kode_nota' => $request->input('kode_nota'),
                'supplier_id' => $request->input('supplier_id'),
                'karyawan_id' => $request->input('karyawan_id'),
                'tgl_pesan' => $request->input('tgl_pesan'),
                'tgl_terima' => $request->input('tgl_terima'),
                'satuan' => $request->input('satuan'),
                'grand_total' => $request->input('grand_total'),
                'total_qty_roll' => $request->input('total_qty_roll'),
                'keterangan' => $request->input('keterangan'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $randomName = Str::random(10);
                $kodenota = $notabeli->kode_nota;
                $extension = $image->getClientOriginalExtension();
                $imageName = $randomName . '_' . $kodenota . '.' . $extension;
                $image->move(public_path('uploads/pembelians/'), $imageName);

                NotaBeli::find($notabeli->id)
                    ->update([
                        'foto' => $imageName,
                        'updated_by' => auth()->user()->id,
                    ]);
            }

            // NOTA BELI DETAIL

            $dataKainToInsert = $request->input('dataKain');

            foreach ($dataKainToInsert as $data) {

                $totalpanjang = $data['total_panjang'];

                if ($notabeli->satuan == 'Yard') {
                    $totalpanjang /= 1.094;
                    $totalpanjang = ceil($totalpanjang * 100) / 100;
                }

                BeliDetail::create([
                    'nota_beli_id' => $notabeli->id,
                    'kain_id' => $data['kain_id'],
                    'qty_roll' => $data['qty_roll'],
                    'panjang' => $data['panjang'],
                    'total_panjang' => $data['total_panjang'],
                    'harga' => $data['harga'],
                    'subtotal' => $data['subtotal'],
                ]);

                Kain::where('id', $data['kain_id'])
                    ->increment('stok', $totalpanjang);

            }

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('notabeli.create');


        } catch (\Exception $e) {

            DB::rollback();

            echo ($e);

            toast('Penambahan data gagal!', 'warning');
            // return redirect()->route('notabeli.create')->withInput();
        }
    }

    public function show($id)
    {
        $pembelians = NotaBeli::find($id);

        $detailNotaBeli = BeliDetail::join('kains', 'nota_beli_details.kain_id', '=', 'kains.id')
            ->where('nota_beli_details.nota_beli_id', $id)
            ->get();

        return view('transaksi.notabeli.detailnotabeli', compact('pembelians', 'detailNotaBeli'));
    }

    public function edit($id)
    {
        $suppliers = Supplier::all();
        $kains = Kain::all();
        $karyawans = Karyawan::all();

        $pembelians = NotaBeli::find($id);

        $detailNotaBeli = BeliDetail::join('kains', 'nota_beli_details.kain_id', '=', 'kains.id')
            ->where('nota_beli_details.nota_beli_id', $id)
            ->get();

        return view('transaksi.notabeli.editnotabeli', compact('pembelians', 'detailNotaBeli', 'suppliers', 'kains', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'grand_total' => 'required',
            'total_qty_roll' => 'required',
            'foto' => 'image|mimes:png,jpg,jpeg',
        ], [
            'grand_total.required' => 'Wajib diisi!',
            'total_qty_roll.required' => 'Wajib diisi!',
            'foto.image' => 'Hanya menerima file berupa gambar!',
            'foto.mimes' => 'Tipe file gambar yang diijinkan: .jpg, .png, .jpeg!',
        ]);

        $imageName = NotaBeli::where('id', $id)
            ->value('foto');

        $imageNameBefore = $imageName;

        $filePath = public_path('uploads/pembelians/') . $imageNameBefore;

        $notabeli = NotaBeli::find($id);

        try {
            $tgl_terima = $request->input('tgl_terima');

            if ($tgl_terima == null) {
                $status = "Belum Terima";
            } else {
                $status = "Selesai";
            }

            NotaBeli::find($id)
                ->update([
                    'tgl_terima' => $tgl_terima,
                    'status' => $status,
                    'grand_total' => $validatedData['grand_total'],
                    'total_qty_roll' => $validatedData['total_qty_roll'],
                    'keterangan' => $request->input('keterangan'),
                    'updated_by' => auth()->user()->id,
                ]);

            $notabelis = NotaBeli::find($id);

            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $randomName = Str::random(10);
                $kodenota = $notabelis->kode_nota;
                $extension = $image->getClientOriginalExtension();
                $imageName = $randomName . '_' . $kodenota . '.' . $extension;
                $image->move(public_path('uploads/pembelians/'), $imageName);

                if (File::exists($filePath)) {

                    File::delete($filePath);
                }

                NotaBeli::find($id)
                    ->update([
                        'foto' => $imageName,
                    ]);
            }

            if ($notabeli->status == 'Belum Terima') {

                $dataKainToInsert = $request->input('dataKain');

                foreach ($dataKainToInsert as $data) {

                    $belidetails = BeliDetail::where('nota_beli_id', $id)->where('kain_id', $data['kain_id'])->first();

                    $totalpanjang = $data['total_panjang'];


                    $kain = Kain::where('id', $data['kain_id'])->first();

                    if ($notabelis->satuan == 'Yard') {
                        $totalpanjang /= 1.094;
                        $totalpanjang = ceil($totalpanjang * 100) / 100;
                    }

                    if ($belidetails->subtotal != $data['subtotal']) {
                        BeliDetail::where('nota_beli_id', $id)
                            ->where('kain_id', $data['kain_id'])
                            ->update([
                                'qty_roll' => $data['qty_roll'],
                                'panjang' => $data['panjang'],
                                'total_panjang' => $totalpanjang,
                                'harga' => $data['harga'],
                                'subtotal' => $data['subtotal'],
                            ]);
                    }

                    if ($belidetails->total_panjang != $totalpanjang) {

                        Kain::where('id', $data['kain_id'])
                            ->decrement('incoming_stok', $belidetails->total_panjang);

                        if ($status == 'Selesai') {
                            Kain::where('id', $data['kain_id'])
                                ->increment('stok', $totalpanjang);
                        } else {
                            Kain::where('id', $data['kain_id'])
                                ->increment('incoming_stok', $totalpanjang);
                        }
                    } elseif ($status == 'Selesai') {
                        Kain::where('id', $data['kain_id'])
                            ->decrement('incoming_stok', $belidetails->total_panjang);

                        Kain::where('id', $data['kain_id'])
                            ->increment('stok', $totalpanjang);
                    }
                }
            }



            DB::commit();

            toast('Perubahan data berhasil!', 'success');
            return redirect()->route('notabeli.edit', $id);

        } catch (\Exception $e) {

            DB::rollback();

            echo ($e);

            toast('Perubahan data gagal!', 'warning');
            // return redirect()->route('notabeli.edit', $id);
        }
    }

    public function updateKeterangan(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $notabelis = NotaBeli::find($id);

            NotaBeli::find($id)
                ->update([
                    'keterangan' => $request->input('keterangan'),
                ]);

            DB::commit();

            toast('Memperbarui keterangan berhasil!', 'success');
            return redirect()->route('notabeli.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Memperbarui keterangan gagal!', 'warning');
            // return redirect()->route('notabeli.show', $id);
        }
    }

    public function updateFoto(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $notabelis = NotaBeli::find($id);

            $imageNameBefore = $notabelis->foto;

            $filePath = public_path('uploads/pembelians/') . $imageNameBefore;

            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $randomName = Str::random(10);
                $kodenota = $notabelis->kode_nota;
                $extension = $image->getClientOriginalExtension();
                $imageName = $randomName . '_' . $kodenota . '.' . $extension;
                $image->move(public_path('uploads/pembelians/'), $imageName);

                if (File::exists($filePath)) {

                    File::delete($filePath);
                }

                NotaBeli::find($id)
                    ->update([
                        'foto' => $imageName,
                    ]);

            }

            DB::commit();

            toast('Memperbarui foto berhasil!', 'success');
            return redirect()->route('notabeli.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            echo ($e);

            toast('Memperbarui foto gagal!', 'warning');
            // return redirect()->route('notabeli.show', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $notabeli = NotaBeli::find($id);

        $filePath = public_path('uploads/pembelians/') . $notabeli->foto;

        try {

            if ($notabeli->status == 'Belum Terima') {

                $listBeliDetail = BeliDetail::where('nota_beli_id', $id)->get();

                foreach ($listBeliDetail as $data) {

                    $totalpanjang = $data->total_panjang;

                    if ($notabeli->satuan == 'Yard') {
                        $totalpanjang /= 1.094;
                        $totalpanjang = ceil($totalpanjang * 100) / 100;
                    }

                    $incm_stok = Kain::where('id', $data->kain_id)->value('incoming_stok');

                    Kain::where('id', $data->kain_id)
                        ->decrement('incoming_stok', $totalpanjang);


                    BeliDetail::where('nota_beli_id', $id)
                        ->where('kain_id', $data->kain_id)
                        ->delete();
                }

                NotaBeli::find($id)->delete();

                if (File::exists($filePath)) {

                    File::delete($filePath);
                }

                DB::commit();

                alert()->success('Hore!', 'Data Deleted Successfully');
                return redirect()->route('notabeli.index');
            } else {
                alert()->error('Gagal!', 'Tidak bisa menghapus data transaksi pembelian!');
                return redirect()->route('notabeli.index');
            }

        } catch (\Exception $e) {

            DB::rollBack();

            echo ($e);

            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            // return redirect()->route('notabeli.index');
        }
    }

    public function laporanpembeliankain()
    {
        $pembelians = NotaBeli::join('nota_beli_details', 'nota_belis.id', '=', 'nota_beli_details.nota_beli_id')
            ->join('kains', 'nota_beli_details.kain_id', '=', 'kains.id')
            ->join('suppliers', 'nota_belis.supplier_id', '=', 'suppliers.id')
            ->select('suppliers.nama as nama_supplier', 'kains.kode_kain', 'nota_belis.*', 'nota_beli_details.*')
            ->get();

        // $pembelians = NotaBeli::all();

        return view('laporan.pembeliankain', compact('pembelians'));
    }
}
