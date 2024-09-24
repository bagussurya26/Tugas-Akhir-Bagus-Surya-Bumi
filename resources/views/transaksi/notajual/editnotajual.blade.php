@extends('cork.cork')

@section('title', 'Ubah Data Buy Order')

@section('cssinsertbuyorder')
<link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/filepond.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/tagify/tagify.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/tagify/custom-tagify.css') }}">
<link href="{{ asset('assets/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet"
    type="text/css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/tagify/custom-tagify.css') }}">
<link href="{{ asset('assets/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css') }}" />

<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

{{--
<link rel="stylesheet" href="{{ asset('assets/src/plugins/src/sweetalerts2/sweetalerts2.css') }}"> --}}

@endsection

@section('konteneditbuyorder')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('buyorder.index') }}">Buy Order</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" class="row g-3" method="POST"
        action="{{ route('buyorder.update', $infoBuyOrder[0]->id) }}">
        @csrf
        @method("PUT")
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Buy Order</label>
                            <input type="text" value="{{ $infoBuyOrder[0]->id }}" id="input-kode-buyorder"
                                class="form-control" name="id"
                                placeholder="Kode Buy Order" readonly>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Supplier</label>
                            <input class="form-control" id="input-supplier" name="supplier" type="text"
                                value="{{ $infoBuyOrder[0]->nama_supplier }}" readonly>
                            <input type="hidden" value="{{ $infoBuyOrder[0]->suppliers_id }}" id="input-supplier" class="form-control"
                                    name="supplier">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Karyawan</label>
                            <input class="form-control" id="input-karyawan" name="karyawan" type="text"
                                value="{{ $infoBuyOrder[0]->nama_karyawan }}" readonly>
                            <input type="hidden" value="{{ $infoBuyOrder[0]->karyawans_id }}" id="input-karyawan" class="form-control"
                                name="karyawan">
                        </div>
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Pesan</label>
                            <input
                                class="form-control flatpickr flatpickr-input active @error('tanggal_pesan') is-invalid @enderror"
                                id="tanggal_pesan" name="tanggal_pesan" type="text" value="{{ old('tanggal_pesan') }}"
                                placeholder="Tanggal Pesan" required>
                            @error('tanggal_pesan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Datang</label>
                            <input class="form-control flatpickr flatpickr-input active" id="tanggal_datang"
                                name="tanggal_datang" type="text" value="{{ old('tanggal_datang') }}"
                                placeholder="Tanggal Datang">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Bayar</label>
                            <input class="form-control flatpickr flatpickr-input active" id="tanggal_bayar"
                                name="tanggal_bayar" type="text" value="{{ old('tanggal_bayar') }}"
                                placeholder="Tanggal Bayar">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tipe Pembayaran</label>
                            <select class="form-select @error('tipe_pembayaran') is-invalid @enderror"
                                id="input-tipe-pembayaran" name="tipe_pembayaran" required>
                                <option selected disabled value="">Choose...</option>
                                @if ($infoBuyOrder[0]->tipe_pembayaran == "Bank")
                                <option value="Bank" selected>Bank</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank+Cash">Bank+Cash</option>
                                @elseif ($infoBuyOrder[0]->tipe_pembayaran == "Cash")
                                <option value="Bank">Bank</option>
                                <option value="Cash" selected>Cash</option>
                                <option value="Bank+Cash">Bank+Cash</option>
                                @elseif ($infoBuyOrder[0]->tipe_pembayaran == "Bank+Cash")
                                <option value="Bank">Bank</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank+Cash" selected>Bank+Cash</option>
                                @else
                                <option value="Bank">Bank</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank+Cash">Bank+Cash</option>
                                @endif
                            </select>
                            @error('tipe_pembayaran')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Keterangan</label>
                        <textarea class="form-control" value="{{ $infoBuyOrder[0]->keterangan }}" id="input-keterangan"
                            rows="4" placeholder="Keterangan" name="keterangan"></textarea>
                    </div>
                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Detail Kain</h5>
                <div class="table-responsive">
                    <table class="table item-table kain">
                        <thead>
                            <tr>
                                <th class="">Kode Kain</th>
                                <th class="">Total Roll</th>
                                <th class="">Total Panjang</th>
                                <th class="">Harga Satuan</th>
                                <th class="">Subtotal</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            @foreach ($detailKain as $index=>$dataKain)
                            <tr>
                                <td>
                                    <input type="text" value="{{ $dataKain['kains_id'] }}"
                                        id="input-id-kain-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][id-kain]" readonly>
                                </td>
                                <td width="150px">
                                    <input type="text" value="{{ $dataKain['qty_roll'] }}"
                                        id="input-qty-roll-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][qty-roll]" readonly>
                                </td>
                                <td width="150px">
                                    <input type="text" value="{{ $dataKain['yard'] }}"
                                        id="input-qty-panjang-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][qty-panjang]" readonly>
                                </td>
                                <td width="200px">
                                    <input type="text" value="@currency($dataKain['harga_satuan'])"
                                        id="input-harga-satuan-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][harga-satuan]" dir="rtl" readonly>
                                </td>
                                <td width="250px">
                                    <input type="text" value="@currency($dataKain['subtotal'])"
                                        id="input-subtotal-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][subtotal]" dir="rtl" readonly>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- <input type="hidden" id="rowTargetProduk" name="rowTargetProduk"> --}}
                </div>

                <div class="row mb-4" style="justify-content: space-between">
                    {{-- <div class="col-sm-2">
                        <span class="btn btn-dark additemkain">Add Item</span>
                    </div> --}}

                    <div class="col-sm-3" style="align-item: right">
                        <div class="row" style="justify-content: start">
                            <div class="col-sm-3">
                                <label>Total Roll</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" id="input-total-roll" name="total_roll" type="text"
                                    value="{{ $infoBuyOrder[0]->total_qty }}" placeholder="Total Roll" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4" style="align-item: right">
                        <div class="row" style="justify-content: space-between">
                            <div class="col-sm-3">
                                <label>Grand Total</label>
                            </div>
                            <div class="col" style="padding-right: 33px">
                                <input class="form-control" id="input-grand-total" name="grand_total" type="text"
                                    value="@currency($infoBuyOrder[0]->grand_total)" dir="rtl" placeholder="Grand Total"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invoice-detail-note">
                    <div class="row">
                        <div class="col-md-12 align-self-center">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <button class="btn btn-danger w-100">Reset</button>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <button class="btn btn-success w-100 submit" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>


@endsection

@section('jseditbuyorder')

<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>


<script>
    var tglPesan = flatpickr(document.getElementById('tanggal_pesan'), {
    dateFormat: "d-m-Y",
    // defaultDate: new Date()
    });
    var tglDatang = flatpickr(document.getElementById('tanggal_datang'), {
    dateFormat: "d-m-Y",
    // defaultDate: new Date()
    });
    var tglBayar = flatpickr(document.getElementById('tanggal_bayar'), {
    dateFormat: "d-m-Y",
    // defaultDate: new Date()
    });
</script>

<script>
    function handleInputSubtotal(idx) {
    // Do something with the input value
    var qtyPanjang = document.getElementById("input-qty-panjang-" + idx).value
    var harga = document.getElementById("input-harga-satuan-" + idx).value
    var subtotal = harga * qtyPanjang;
    document.getElementById('input-subtotal-' + idx).value = subtotal;

    var grandTotal = Number(document.getElementById('input-grand-total').value)
    var subttl = Number(document.getElementById('input-subtotal-' + idx).value)
    // console.log(grandTotal);
    var newGrandTotal = grandTotal + subttl
    document.getElementById('input-grand-total').value = newGrandTotal;
    }

    function handleInputRoll(idx) {
    
    var totalRoll = Number(document.getElementById('input-total-roll').value)
    var qtyRoll = Number(document.getElementById('input-qty-roll-' + idx).value)
    var newTotalRoll = totalRoll + qtyRoll
    document.getElementById('input-total-roll').value = newTotalRoll;
    }
</script>

@endsection