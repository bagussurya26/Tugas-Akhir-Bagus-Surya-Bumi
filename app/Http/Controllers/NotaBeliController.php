<?php

namespace App\Http\Controllers;

use App\Models\NotaBeli;
use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Ukuran;
use App\Models\Karyawan;
use App\Models\Supplier;
use App\Models\BeliDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaBeliController extends Controller
{
    public function index()
    {
        $queryModel = NotaBeli::join('karyawans', 'karyawans.id', '=', 'nota_belis.karyawans_id')
            ->join('suppliers', 'suppliers.id', '=', 'nota_belis.suppliers_id')
            ->select('nota_belis.*', 'karyawans.nama as nama_karyawan', 'suppliers.nama as nama_supplier')
            ->get();
        // dd($queryModel);

        return view('transaksi.notabeli.daftarnotabeli', compact('queryModel'));
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
            $validatedData = $request->validate([
                'kode_nota_beli' => 'required,',
                'suppliers_id' => 'required,',
                'karyawans_id' => 'required,',
                'tgl_pesan' => 'required',
                'tgl_datang' => 'required',
                'grand_total' => 'required',
                'total_qty' => 'required',
            ], [
                'kode_nota_beli.required' => 'Wajib diisi!',
                'suppliers_id.required' => 'Wajib diisi!',
                'karyawans_id.required' => 'Wajib diisi!',
                'tgl_pesan.required' => 'Wajib diisi!',
                'tgl_datang.required' => 'Wajib diisi!',
                'grand_total' => 'Wajib diisi!',
                'total_qty' => 'Wajib diisi!',
            ]);

            //TANGGAL NOTA BELI
            $tgl_pesan = $validatedData['tgl_pesan'];
            $tgl_datang = $validatedData['tgl_datang'];
            $tgl_bayar = $request->input('tanggal_bayar');

            //change to timestamp format Y-m-d H:i:s
            $tgl_pesan_format = Carbon::createFromTimestamp(strtotime($tgl_pesan))->format('Y-m-d H:i:s');
            $tgl_datang_format = Carbon::createFromTimestamp(strtotime($tgl_datang))->format('Y-m-d H:i:s');


            if ($tgl_bayar == null) {
                $status_bayar = "Belum Bayar";
                $tgl_bayar_format = null;
            } else {
                $status_bayar = "Lunas";
                $tgl_bayar_format = Carbon::createFromTimestamp(strtotime($tgl_bayar))->format('Y-m-d H:i:s');
            }

            //INPUT KE TABEL nota_belis
            $DataNotaBeli = [
                'kode_nota_beli' => $validatedData['kode_nota_beli'],
                'suppliers_id' => $validatedData['suppliers_id'],
                'karyawans_id' => $validatedData['karyawans_id'],
                'tgl_pesan' => $tgl_pesan_format,
                'tgl_datang' => $tgl_datang_format,
                'tgl_bayar' => $tgl_bayar_format,
                'status_bayar' => $status_bayar,
                'grand_total' => $validatedData['grand_total'],
                'total_qty' => $validatedData['total_qty'],
                'keterangan' => $request->input('keterangan'),
                'created_by' => 1, //NUNGGU HAK AKSES
                'updated_by' => 1, //NUNGGU HAK AKSES
            ];

            $notaBeli = NotaBeli::create($DataNotaBeli);

            $dataKainToInsert = $request->input('dataKain');

            foreach ($dataKainToInsert as $data) {

                BeliDetail::insertOrIgnore([
                    'nota_belis_id' => $notaBeli->id,
                    'kains_id' => $data['kains_id'],
                    'harga_satuan' => $data['harga_satuan'],
                    'satuan' => $data['satuan'],
                    'qty_roll' => $data['qty_roll'],
                    'total_panjang' => $data['total_panjang'],
                    'subtotal' => $data['subtotal'],
                ]);

                //Update stok kain
                $stokKain = Kain::select('stok')
                    ->where('id', $data['id-kain'])
                    ->value('stok');

                if ($data['qty-kain'] == "Yard") {
                    $stokKain /= 1.094;
                }

                dd($stokKain);

                $stokKain += $data['qty-kain'];

                Kain::where('id', $data['id-kain'])
                    ->update([
                        'stok' => $stokKain,
                    ]);
            }

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('notabeli.create');


        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('notabeli.create');
        }
    }

    public function show($id)
    {
        $infoNotaBeli = NotaBeli::join('karyawans', 'karyawans.id', '=', 'nota_belis.karyawans_id')
            ->join('suppliers', 'suppliers.id', '=', 'nota_belis.suppliers_id')
            ->select('nota_belis.*', 'karyawans.nama as nama_karyawan', 'suppliers.nama as nama_supplier')
            ->where('nota_belis.id', $id)
            ->get();

        $detailNotaBeli = BeliDetail::where('nota_belis_id', $id)
            ->get();

        // dd($detailNotaKain);

        return view('transaksi.notabeli.detailnotabeli', compact('infoNotaBeli', 'detailNotaBeli'));
    }

    public function edit($id)
    {
        $suppliers = Supplier::all();
        $kains = Kain::all();
        $karyawans = Karyawan::all();

        $infoNotaBeli = NotaBeli::join('karyawans', 'karyawans.id', '=', 'nota_belis.karyawans_id')
            ->join('suppliers', 'suppliers.id', '=', 'nota_belis.suppliers_id')
            ->select('nota_belis.*', 'suppliers.nama as nama_supplier', 'karyawans.nama as nama_karyawan')
            ->where('nota_belis.id', $id)
            ->get();

        $detailKain = BeliDetail::where('nota_belis_id', $id)
            ->get();

        return view('transaksi.notabeli.editnotabeli', compact('infoNotaBeli', 'detailKain', 'suppliers', 'kains', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'kode_nota_beli' => 'required,',
                'suppliers_id' => 'required,',
                'karyawans_id' => 'required,',
                'tgl_pesan' => 'required',
                'tgl_datang' => 'required',
                'grand_total' => 'required',
                'total_qty' => 'required',
            ], [
                'kode_nota_beli.required' => 'Wajib diisi!',
                'suppliers_id.required' => 'Wajib diisi!',
                'karyawans_id.required' => 'Wajib diisi!',
                'tgl_pesan.required' => 'Wajib diisi!',
                'tgl_datang.required' => 'Wajib diisi!',
                'grand_total' => 'Wajib diisi!',
                'total_qty' => 'Wajib diisi!',
            ]);

            //TANGGAL NOTA BELI
            $tgl_pesan = $validatedData['tgl_pesan'];
            $tgl_datang = $validatedData['tgl_datang'];
            $tgl_bayar = $request->input('tanggal_bayar');

            //change to timestamp format Y-m-d H:i:s
            $tgl_pesan_format = Carbon::createFromTimestamp(strtotime($tgl_pesan))->format('Y-m-d H:i:s');
            $tgl_datang_format = Carbon::createFromTimestamp(strtotime($tgl_datang))->format('Y-m-d H:i:s');


            if ($tgl_bayar == null) {
                $status_bayar = "Belum Bayar";
                $tgl_bayar_format = null;
            } else {
                $status_bayar = "Lunas";
                $tgl_bayar_format = Carbon::createFromTimestamp(strtotime($tgl_bayar))->format('Y-m-d H:i:s');
            }

            //INPUT KE TABEL nota_belis
            $DataNotaBeli = [
                'kode_nota_beli' => $validatedData['kode_nota_beli'],
                'suppliers_id' => $validatedData['suppliers_id'],
                'karyawans_id' => $validatedData['karyawans_id'],
                'tgl_pesan' => $tgl_pesan_format,
                'tgl_datang' => $tgl_datang_format,
                'tgl_bayar' => $tgl_bayar_format,
                'status_bayar' => $status_bayar,
                'grand_total' => $validatedData['grand_total'],
                'total_qty' => $validatedData['total_qty'],
                'keterangan' => $request->input('keterangan'),
                // 'created_by' => 1, //NUNGGU HAK AKSES
                'updated_by' => 1, //NUNGGU HAK AKSES
            ];

            $notaBeli = NotaBeli::findOrfail($id)
                ->first();

            $notaBeli->update($DataNotaBeli);

            // $dataKainToInsert = $request->input('dataKain');

            // foreach ($dataKainToInsert as $data) {

            //     BeliDetail::where('nota_belis_id', $id)
            //         ->update([
            //             'kains_id' => $data['id-kain'],
            //             'harga_satuan' => $data['harga-satuan'],
            //             'qty_roll' => $data['qty-roll'],
            //             'yard' => $data['qty-panjang'],
            //             'subtotal' => $data['subtotal'],
            //         ]);

            //     //Update stok kain
            //     $stokKain = Kain::select('stok')
            //         ->where('id', $data['id-kain'])
            //         ->value('stok');

            //     $stokKain += $data['qty-panjang'];

            //     Kain::where('id', $data['id-kain'])
            //         ->update([
            //             'stok' => $stokKain,
            //         ]);
            // }

            DB::commit();

            toast('Perubahan data berhasil!', 'success');
            return redirect()->route('notabeli.edit', $id);

        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();

            toast('Perubahan data gagal!', 'warning');
            return redirect()->route('notabeli.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            // Update stok kain
            $listBeliDetail = BeliDetail::where('nota_belis_id', $id)
                ->get();

            foreach ($listBeliDetail as $data) {
                $stokKain = Kain::where('id', $data['kains_id'])
                    ->value('stok');

                $stokKain -= $data['yard'];

                Kain::where('id', $data['kains_id'])
                    ->update([
                        'stok' => $stokKain,
                    ]);
            }

            // Menghapus tabel yang berhubungan dengan nota_beli
            DB::statement('SET foreign_key_checks=0;');
            NotaBeli::where('id', $id)->delete();
            BeliDetail::where('nota_belis_id', $id)->delete();
            DB::statement('SET foreign_key_checks=1;');


            DB::commit();
            alert()->success('Hore!', 'Data Deleted Successfully');
            return redirect()->route('produksi.index');

        } catch (\Exception $e) {

            DB::rollBack();

            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('produksi.index');
        }
    }
}
