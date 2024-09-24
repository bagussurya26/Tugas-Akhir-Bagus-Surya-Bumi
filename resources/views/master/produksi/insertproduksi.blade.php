@extends('cork.cork')

@section('title', 'Tambah Data Produksi')

@section('cssinsertproduksi')
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

@section('konteninsertproduksi')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produksi.index') }}">Produksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('produksi.store') }}">
        @csrf
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Produksi</label>
                            <input type="text" value="{{ old('id') }}" id="input-kode-produksi"
                                class="form-control @error('id') is-invalid @enderror" name="id"
                                placeholder="Kode Produksi" autofocus required>
                            @error('id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Mulai</label>
                            <input
                                class="form-control flatpickr flatpickr-input active @error('tanggal_mulai') is-invalid @enderror"
                                id="tanggal_mulai" name="tanggal_mulai" type="text" value="{{ old('tanggal_mulai') }}"
                                placeholder="Tanggal Mulai" required>
                            @error('tanggal_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Selesai</label>
                            <input class="form-control flatpickr flatpickr-input active" id="tanggal_selesai"
                                name="tanggal_selesai" type="text" value="{{ old('tanggal_selesai') }}"
                                placeholder="Tanggal Selesai">
                        </div>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Keterangan Produksi</label>
                        <textarea class="form-control @error('keterangan-produksi') is-invalid @enderror"
                            value="{{ old('keterangan-produksi') }}" id="input-keterangan-produksi" rows="4"
                            placeholder="Keterangan Produksi" name="keterangan-produksi"></textarea>
                        @error('keterangan-produksi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Target Produksi</h5>
                <div class="table-responsive">
                    <table class="table item-table target-produk">
                        <thead>
                            <tr>
                                <th class=""></th>
                                <th class="">Kode Produk</th>
                                <th class="">Nama Produk</th>
                                <th class="">Ukuran</th>
                                <th class="">Qty Produk</th>
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
                                    <select class="form-select"
                                        id="input-kode-produk-0" name="dataTarget[0][id-produk]"
                                        onchange="updateNamaProduk(0)" required>
                                        <option selected disabled value="">Pilih Kode Produk...</option>
                                        @foreach ($produks as $produk)
                                            @if (old('dataTarget[0][id-produk]') == $produk->id)
                                                <option value="{{ $produk->id }}" selected>{{ $produk->id }}</option>
                                            @else
                                                <option value="{{ $produk->id }}">{{ $produk->id }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- @error('dataTarget[0][id-produk]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                                <td width="450px">
                                    <input type="text" value="{{ old('dataTarget[0][nama-produk]') }}"
                                        id="input-nama-produk-0" class="form-control" name="dataTarget[0][nama-produk]"
                                        placeholder="Nama Produk" readonly>
                                </td>
                                <td width="200px">
                                    <select class="form-select"
                                        id="input-ukuran-0" name="dataTarget[0][ukuran]" required>
                                        <option selected disabled value="">Pilih Ukuran...</option>
                                        @foreach ($ukurans as $ukuran)
                                            @if (old('dataTarget[0][ukuran]') == $ukuran->id)
                                                <option value="{{ $ukuran->id }}" selected>{{ $ukuran->ukuran }}</option>
                                            @else
                                                <option value="{{ $ukuran->id }}">{{ $ukuran->ukuran }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- @error('dataTarget[0][ukuran]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                                <td width="200px">
                                    <input type="text" value="{{ old('dataTarget[0][qty-pakaian]') }}"
                                        id="input-qty-pakaian-0"
                                        class="form-control"
                                        name="dataTarget[0][qty-pakaian]" placeholder="Qty Produk" required>
                                    {{-- @error('dataTarget[0][qty-pakaian]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <input type="hidden" id="rowTargetProduk" name="rowTargetProduk">
                </div>

                <span class="btn btn-dark additemtarget">Add Item</span>

            </div>

            <div class="invoice-detail-items" style="padding-top: 50px">
                <h5 class="">Nota Potong Kain</h5>
                <div class="table-responsive">
                    <table class="table item-table nota-kain">
                        <thead>
                            <tr>
                                <th class=""></th>
                                <th class="">Kode Potong Kain</th>
                                <th class="">Kode Kain - Stok</th>
                                <th class="">Qty Kain</th>
                                <th class="">Tgl Mulai</th>
                                <th class="">Tgl Selesai</th>
                                <th class="">Karyawan</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody class="nota-kain-row">
                            <tr>
                                <td class="delete-item-row">
                                    <ul class="table-controls">
                                        <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete"><i
                                                    data-feather="x-circle"></i></a></li>
                                    </ul>
                                </td>
                                <td>
                                    <input type="text" value="{{ old('dataNota[0][id-nota]') }}" id="input-id-nota-0"
                                        class="form-control"
                                        name="dataNota[0][id-nota]" placeholder="Kode Potong Kain" autofocus required>
                                    {{-- @error('dataNota[0][id-nota]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                                <td width="250px">
                                    <select class="form-select"
                                        id="input-id-kain-0" name="dataNota[0][id-kain]" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($kains as $kain)
                                            @if (old('dataNota[0][id-kain]') == $kain->id)
                                                <option value="{{ $kain->id }}" selected>{{ $kain->id }} - {{ $kain->stok }}</option>
                                            @else
                                                <option value="{{ $kain->id }}">{{ $kain->id }} - {{ $kain->stok }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- @error('dataNota[0][id-kain]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                                <td width="150px">
                                    <input type="text" value="{{ old('dataNota[0][qty-kain]') }}" id="input-qty-kain-0"
                                        class="form-control"
                                        name="dataNota[0][qty-kain]" placeholder="Qty Kain" required>
                                    {{-- @error('dataNota[0][qty-kain]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                                <td width="180px">
                                    <input name="dataNota[0][tgl-mulai]" id="input-tgl-mulai-0"
                                        class="form-control flatpickr flatpickr-input active"
                                        type="text" placeholder="Pilih tanggal.."
                                        value="{{ old('dataNota[0][tgl-mulai]') }}" required>
                                    {{-- @error('dataNota[0][tgl-mulai]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                                <td width="180px">
                                    <input name="dataNota[0][tgl-selesai]" id="input-tgl-selesai-0"
                                        class="form-control flatpickr flatpickr-input active @error('dataNota[0][tgl-selesai]') is-invalid @enderror"
                                        type="text" placeholder="Pilih Tanggal.."
                                        value="{{ old('dataNota[0][tgl-selesai]') }}">
                                    {{-- @error('dataNota[0][tgl-selesai]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                                <td>
                                    <select class="form-select"
                                        id="input-karyawan-0" name="dataNota[0][karyawan]" required>
                                        <option selected disabled value="">Pilih Karyawan...</option>
                                        @foreach ($karyawans as $karyawan)
                                            @if (old('dataNota[0][karyawan]') == $karyawan->id)
                                                <option value="{{ $karyawan->id }}" selected>{{ $karyawan->nama }}</option>
                                            @else
                                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- @error('dataNota[0][karyawan]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <input type="hidden" id="rowNotaKain" name="rowNotaKain">
                </div>

                <span class="btn btn-dark additemnota">Add Item</span>
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
                                <button class="btn btn-success w-100 submit" type="submit"
                                    onclick="sendValue()">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection

@section('jsinsertproduksi')

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
    
    document.getElementsByClassName('additemnota')[0].addEventListener('click', function () {
    // console.log('cek add item nota')

    currentIndex++;
    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
            '</ul>'+
        '</td>'+
        '<td>'+
            '<input type="text" value="{{ old("dataNota['+currentIndex+'][id-nota]") }}" class="form-control @error("dataNota['+currentIndex+'][id-nota]") is-invalid @enderror" name="dataNota['+currentIndex+'][id-nota]" id="input-id-nota-'+currentIndex+'" placeholder="Kode Potong Kain" autofocus required>'+
            // '@error("dataNota['+currentIndex+'][id-nota]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
        '</td>'+
        '<td width="250px">'+
            '<select class="form-select @error("dataNota['+currentIndex+'][id-kain]") is-invalid @enderror" id="input-id-kain-'+currentIndex+'" name="dataNota['+currentIndex+'][id-kain]" required>'+
                '<option selected disabled value="">Pilih Kode Kain...</option>'+
                '@foreach ($kains as $kain)'+
                '@if (old("dataNota['+currentIndex+'][id-kain]") == $kain->id)'+
                '<option value="{{ $kain->id }}" selected>{{ $kain->id }} - {{ $kain->stok }}</option>'+
                '@else'+
                '<option value="{{ $kain->id }}">{{ $kain->id }} - {{ $kain->stok }}</option>'+
                '@endif'+
                '@endforeach'+
            '</select>'+
            // '@error("dataNota['+currentIndex+'][id-kain]") <div class="invalid-feedback"> {{ $message }} </div> @enderror'+
        '</td>'+
        '<td width="150px">'+
            '<input type="text" value="{{ old("dataNota['+currentIndex+'][qty-kain]") }}" class="form-control @error("dataNota['+currentIndex+'][qty-kain]") is-invalid @enderror" id="input-qty-kain-'+currentIndex+'" name="dataNota['+currentIndex+'][qty-kain]" placeholder="Qty Kain" required>'+
            // '@error("dataNota['+currentIndex+'][qty-kain]") <div class="invalid-feedback"> {{ $message }} </div> @enderror'+
        '</td>'+
        '<td width="180px">'+
            '<input name="dataNota['+currentIndex+'][tgl-mulai]" id="input-tgl-mulai-'+currentIndex+'" class="form-control flatpickr flatpickr-input active @error("dataNota['+currentIndex+'][tgl-mulai]") is-invalid @enderror" type="text" placeholder="Pilih tanggal.." value="{{ old("dataNota['+currentIndex+'][tgl-mulai]") }}" required>'+
            // '@error("dataNota['+currentIndex+'][tgl-mulai]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
        '</td>'+
        '<td width="180px">'+
            '<input name="dataNota['+currentIndex+'][tgl-selesai]" id="input-tgl-selesai-'+currentIndex+'"'+
                'class="form-control flatpickr flatpickr-input active @error("dataNota['+currentIndex+'][tgl-selesai]") is-invalid @enderror" type="text" placeholder="Pilih Tanggal.." value="{{ old("dataNota['+currentIndex+'][tgl-selesai]") }}" required>'+
            // '@error("dataNota['+currentIndex+'][tgl-selesai]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
        '</td>'+
        '<td>'+
            '<select class="form-select @error("dataNota['+currentIndex+'][karyawan]") is-invalid @enderror" id="input-karyawan-'+currentIndex+'" name="dataNota['+currentIndex+'][karyawan]" required>'+
                '<option selected disabled value="">Pilih Karyawan...</option>'+
                '@foreach ($karyawans as $karyawan)'+
                '@if (old("dataNota['+currentIndex+'][karyawan]") == $karyawan->id)'+
                '<option value="{{ $karyawan->id }}" selected>{{ $karyawan->nama }}</option>'+
                '@else'+
                '<option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>'+
                '@endif'+
                '@endforeach'+
            '</select>'+
            // '@error("dataNota['+currentIndex+'][karyawan]") <div class="invalid-feedback">{{ $message }} </div> @enderror'+
        '</td>'+
        '</tr>';
    
        // console.log($html);
    
    $(".nota-kain tbody").append($html);
    deleteItemRow();
    


    var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-' + currentIndex), {
        dateFormat: "d-m-Y",
    });
    var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-' + currentIndex), {
        dateFormat: "d-m-Y",
    });
    });

    var currentIndex2 = 0;

    document.getElementsByClassName('additemtarget')[0].addEventListener('click', function () {
    // console.log('dfdf')
    
    currentIndex2++;
    
    $html = '<tr>' +
        '<td class="delete-item-row">' +
            '<ul class="table-controls">' +
                '<li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title=""data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li></ul>' +
            '</td>' +
        '<td>' +
            '<select class="form-select @error("dataTarget['+currentIndex2+'][id-produk]") is-invalid @enderror" id="input-kode-produk-'+currentIndex2+'" name="dataTarget['+currentIndex2+'][id-produk]" onchange="updateNamaProduk('+currentIndex2+')" required><option selected disabled value="">Pilih Kode Produk...</option> @foreach ($produks as $produk) @if(old("dataTarget['+currentIndex2+'][id-produk]") == $produk->id)<option value="{{ $produk->id }}" selected>{{ $produk-> id }}</option> @else<option value="{{ $produk->id }}">{{ $produk-> id }}</option> @endif @endforeach </select>' +
            // '@error("dataTarget['+currentIndex2+'][id-produk]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
                '</td>' +
        '<td width="450px">' +
            '<input type="text" value="{{ old("dataTarget['+currentIndex2+'][nama-produk]") }}" id="input-nama-produk-'+currentIndex2+'" class="form-control" name="dataTarget['+currentIndex2+'][nama-produk]" placeholder="Nama Produk" readonly>' +
            '</td>' +
        '<td width="200px">' +
            '<select class="form-select @error("dataTarget['+currentIndex2+'][ukuran]") is-invalid @enderror"' +
                ' id="input-ukuran-'+currentIndex2+'" name="dataTarget['+currentIndex2+'][ukuran]" required>' +
                '<option selected disabled value="">Pilih Ukuran...</option>' +
                '@foreach ($ukurans as $ukuran)@if (old("dataTarget['+currentIndex2+'][ukuran]") == $ukuran->id)<option value="{{ $ukuran->id }}" selected>{{ $ukuran->ukuran }}</option> @else<option value="{{ $ukuran->id }}">{{ $ukuran->ukuran }}</option>@endif @endforeach' +
                '</select>' +
                // '@error("dataTarget['+currentIndex2+'][ukuran]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
            '</td>' +
        '<td width="200px">' +
            '<input type="text" value="{{ old("dataTarget['+currentIndex2+'][qty-pakaian]") }}" class="form-control @error("dataTarget['+currentIndex2+'][qty-pakaian]") is-invalid @enderror" id="input-qty-pakaian-'+currentIndex2+'" name="dataTarget['+currentIndex2+'][qty-pakaian]" placeholder="Qty Produk" required>' +
            // '@error("dataTarget['+currentIndex2+'][qty-pakaian]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
            '</td>' +
        '</tr>';
    
    $(".target-produk tbody").append($html);
    deleteItemRow();
    
    });

</script>

<script>
    function sendValue() {
    $('#rowNotaKain').val($('.nota-kain tbody tr').length);
    $('#rowtargetProduk').val($('.target-produk tbody tr').length);
};
</script>

<script>
    var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-0'), {
    dateFormat: "d-m-Y",
    // defaultDate: new Date()
});
var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-0'), {
    dateFormat: "d-m-Y",
    // defaultDate: new Date()
});

var tglMulaiProduksi = flatpickr(document.getElementById('tanggal_mulai'), {
    dateFormat: "d-m-Y",
    // defaultDate: new Date()
    });
    var tglSelesaiProduksi = flatpickr(document.getElementById('tanggal_selesai'), {
    dateFormat: "d-m-Y",
    // defaultDate: new Date()
    });
</script>

<script>
    function updateNamaProduk(idx) {
        var selectedId = document.getElementById("input-kode-produk-" + idx).value;
        var selectedNama = getNamaProduk(selectedId);
        document.getElementById("input-nama-produk-" + idx).value = selectedNama;
    }

    function getNamaProduk(id) {
        var produks = @json($produks);
        var selectedProduk = produks.find(produk => produk.id == id);

        return selectedProduk ? selectedProduk.nama : '';
    }
</script>

@endsection