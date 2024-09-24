@extends('cork.cork')

@section('title', 'Tambah Data Buy Order')

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

@section('konteninsertbuyorder')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('buyorder.index') }}">Buy Order</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('buyorder.store') }}">
        @csrf
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Buy Order</label>
                            <input type="text" value="{{ old('id') }}" id="input-kode-buyorder"
                                class="form-control @error('id') is-invalid @enderror" name="id"
                                placeholder="Kode Buy Order" autofocus required>
                            @error('id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Supplier</label>
                            <select class="form-select @error('supplier') is-invalid @enderror" id="input-supplier"
                                name="supplier" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($suppliers as $supplier)
                                @if (old('supplier') == $supplier->id)
                                <option value="{{ $supplier->id }}" selected>{{ $supplier->nama }}</option>
                                @else
                                <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Karyawan</label>
                            <select class="form-select @error('karyawan') is-invalid @enderror" id="input-karyawan"
                                name="karyawan" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($karyawans as $karyawan)
                                @if (old('karyawan') == $karyawan->id)
                                <option value="{{ $karyawan->id }}" selected>{{ $karyawan->nama }}</option>
                                @else
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('karyawan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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
                                @if (old('tipe_pembayaran') == "Bank")
                                <option value="Bank" selected>Bank</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank+Cash">Bank+Cash</option>
                                @elseif (old('tipe_pembayaran') == "Cash")
                                <option value="Bank">Bank</option>
                                <option value="Cash" selected>Cash</option>
                                <option value="Bank+Cash">Bank+Cash</option>
                                @elseif (old('tipe_pembayaran') == "Bank+Cash")
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
                        <textarea class="form-control" value="{{ old('keterangan') }}" id="input-keterangan" rows="4"
                            placeholder="Keterangan" name="keterangan"></textarea>
                    </div>
                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Detail Kain</h5>
                <div class="table-responsive">
                    <table class="table item-table kain">
                        <thead>
                            <tr>
                                <th class=""></th>
                                <th class="">Kode Kain</th>
                                <th class="">Total Roll</th>
                                <th class="">Total Panjang</th>
                                <th class="">Harga Satuan</th>
                                <th class="">Subtotal</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="delete-item-row">
                                    <ul class="table-controls">
                                        <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete"><i
                                                    data-feather="x-circle"></i></a></li>
                                    </ul>
                                </td>
                                <td>
                                    <select class="form-select" id="input-kode-kain-0" name="dataKain[0][id-kain]"
                                        required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($kains as $kain)
                                        @if (old('dataKain[0][id-kain]') == $kain->id)
                                        <option value="{{ $kain->id }}" selected>{{ $kain->id }}</option>
                                        @else
                                        <option value="{{ $kain->id }}">{{ $kain->id }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td width="150px">
                                    <input type="text" value="{{ old('dataKain[0][qty-roll]') }}" id="input-qty-roll-0"
                                        class="form-control" name="dataKain[0][qty-roll]" placeholder="Total Roll"
                                        onchange="handleInputRoll(0)" required>
                                </td>
                                <td width="150px">
                                    <input type="text" value="{{ old('dataKain[0][qty-panjang]') }}"
                                        id="input-qty-panjang-0" class="form-control" name="dataKain[0][qty-panjang]"
                                        placeholder="Total Panjang" onchange="handleInputSubtotal(0)" required>
                                </td>
                                <td width="200px">
                                    <input type="text" value="{{ old('dataKain[0][harga-satuan]') }}"
                                        id="input-harga-satuan-0" class="form-control" name="dataKain[0][harga-satuan]"
                                        placeholder="Harga Satuan" onchange="handleInputSubtotal(0)" dir="rtl" required>
                                </td>
                                <td width="250px">
                                    <input type="text" value="{{ old('dataKain[0][subtotal]') }}" id="input-subtotal-0"
                                        class="form-control" name="dataKain[0][subtotal]" dir="rtl"
                                        placeholder="Subtotal" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- <input type="hidden" id="rowTargetProduk" name="rowTargetProduk"> --}}
                </div>

                <div class="row mb-4" style="justify-content: space-between">
                    <div class="col-sm-2">
                        <span class="btn btn-dark additemkain">Add Item</span>
                    </div>

                    <div class="col-sm-3" style="align-item: right">
                        <div class="row" style="justify-content: start">
                            <div class="col-sm-3">
                                <label>Total Roll</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" id="input-total-roll" name="total_roll" type="text"
                                    value="{{ old('total_roll') }}" placeholder="Total Roll" readonly>
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
                                    value="{{ old('grand_total') }}" dir="rtl" placeholder="Grand Total" readonly>
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

@section('jsinsertbuyorder')

<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>

<script>
    function deleteItemRow() {
    deleteItem = document.querySelectorAll('.delete-item');
    for (var i = 0; i < deleteItem.length; i++) {
        deleteItem[i].addEventListener('click', function () {
            this.parentElement.parentNode.parentNode.parentNode.remove();
            })
        }
    }

    var currentIndex = 0;
    
    document.getElementsByClassName('additemkain')[0].addEventListener('click', function () {
    // console.log('cek add item nota')

    currentIndex++;
    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
            '</ul>'+
        '</td>'+
        '<td>'+
            '<select class="form-select" id="input-kode-kain-'+currentIndex+'" name="dataTarget['+currentIndex+'][id-kain]" required>'+
                '<option selected disabled value="">Choose...</option>'+
                '@foreach ($kains as $kain)'+
                '@if (old("dataKain['+currentIndex+'][id-kain]") == $kain->id)'+
                '<option value="{{ $kain->id }}" selected>{{ $kain->id }}</option>'+
                '@else'+
                '<option value="{{ $kain->id }}">{{ $kain->id }}</option>'+
                '@endif'+
                '@endforeach'+
            '</select>'+
        '</td>'+
        '<td width="150px">'+
            '<input type="text" value="{{ old("dataKain['+currentIndex+'][qty-roll]") }}" id="input-qty-roll-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][qty-roll]" placeholder="Total Roll" onchange="handleInputRoll('+currentIndex+')" required>'+
        '</td>'+
        '<td width="150px">'+
            '<input type="text" value="{{ old("dataKain['+currentIndex+'][qty-panjang]") }}" id="input-qty-panjang-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][qty-panjang]" placeholder="Total Panjang"'+
                'onchange="handleInputSubtotal('+currentIndex+')" required>'+
        '</td>'+
        '<td width="200px">'+
            '<input type="text" value="{{ old("dataKain['+currentIndex+'][harga-satuan]") }}" id="input-harga-satuan-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][harga-satuan]" placeholder="Harga Satuan"'+
                'onchange="handleInputSubtotal('+currentIndex+')" dir="rtl" required>'+
        '</td>'+
        '<td width="250px">'+
            '<input type="text" value="{{ old("dataKain['+currentIndex+'][subtotal]") }}" id="input-subtotal-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][subtotal]" dir="rtl" placeholder="Subtotal" readonly>'+
        '</td>'+
        '</tr>';
    
        // console.log($html);
    
    $(".kain tbody").append($html);
    deleteItemRow();

    });
</script>

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