@extends('cork.cork')

@section('title', 'Ubah Data Produksi')

@section('csseditproduksi')
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

@section('konteneditproduksi')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produksi.index') }}">Produksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" class="row g-3" method="POST"
        action="{{ route('produksi.update', $infoProduksi[0]->id) }}">
        @csrf
        @method("PUT")
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Produksi</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $infoProduksi[0]->id }}" id="input-kode-produksi"
                                    class="form-control @error('id') is-invalid @enderror" name="id"
                                    placeholder="Kode Produksi" readonly>
                                @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Mulai</label>
                            {{-- <input
                                class="form-control flatpickr flatpickr-input active @error('tanggal_mulai') is-invalid @enderror"
                                id="tanggal_mulai" name="tanggal_mulai" type="text"
                                value="{{ date('d-m-Y', strtotime($infoProduksi[0]->tgl_mulai)) }}"
                                placeholder="Tanggal Mulai"> --}}
                            <input type="text" value="{{ date('d-m-Y', strtotime($infoProduksi[0]->tgl_mulai)) }}"
                                id="tanggal_mulai" class="form-control" name="tanggal_mulai" readonly>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Selesai</label>
                            @if ($infoProduksi[0]->tgl_selesai == null)
                            <input class="form-control" id="tanggal_selesai" name="tanggal_selesai" type="text"
                                value="{{ old('tanggal_selesai') }}" placeholder="Tanggal Selesai" readonly>
                            @else
                            <input class="form-control" id="tanggal_selesai" name="tanggal_selesai" type="text"
                                value="{{ date('d-m-Y', strtotime($infoProduksi[0]->tgl_selesai)) }}"
                                placeholder="Tanggal Selesai" readonly>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Keterangan Produksi</label>
                        <textarea class="form-control @error('keterangan-produksi') is-invalid @enderror"
                            value="" id="input-keterangan-produksi" rows="4"
                            placeholder="Keterangan Produksi" name="keterangan-produksi">{{ $infoProduksi[0]->keterangan }}</textarea>
                        {{-- @error('keterangan-produksi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror --}}
                    </div>

                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Target Produksi</h5>
                <div class="table-responsive">
                    <table class="table item-table target-produk">
                        <thead>
                            <tr>
                                <th class="">Kode Produk</th>
                                <th class="">Nama Produk</th>
                                <th class="">Ukuran</th>
                                <th class="">Qty Produk</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody class="target-produk-row">
                            @foreach ($detailTarget as $index=>$dataTarget)

                                <tr>
                                    <td>
                                        {{-- <select
                                            class="form-select @error('dataTarget[{{ $index }}][id-produk]') is-invalid @enderror"
                                            id="input-kode-produk-{{ $index }}"
                                            name="dataTarget[{{ $index }}][id-produk]"
                                            onchange="updateNamaProduk({{ $index }})">
                                            <option selected disabled value="">Pilih Kode Produk...</option>
                                            @foreach ($produks as $produk)
                                            @if ( $dataTarget['id_produk'] == $produk->id)
                                            <option value="{{ $produk->id }}" selected>{{ $produk->id }}</option>
                                            @else
                                            <option value="{{ $produk->id }}">{{ $produk->id }}</option>
                                            @endif
                                            @endforeach
                                        </select> --}}
                                        <input type="text" value="{{ $dataTarget['id_produk'] }}"
                                            id="input-kode-produk-{{ $index }}" class="form-control"
                                            name="dataTarget[{{ $index }}][id-produk]" readonly>
                                    </td>
                                    <td width="450px">
                                        <input type="text" value="{{ $dataTarget['nama'] }}"
                                            id="input-nama-produk-{{ $index }}" class="form-control"
                                            name="dataTarget[{{ $index }}][nama-produk]" placeholder="Nama Produk"
                                            readonly>
                                    </td>
                                    <td width="200px">
                                        {{-- <select
                                            class="form-select @error('dataTarget[{{ $index }}][ukuran]') is-invalid @enderror"
                                            id="input-ukuran-{{ $index }}" name="dataTarget[{{ $index }}][ukuran]">
                                            <option selected disabled value="">Pilih Ukuran...</option>
                                            @foreach ($ukurans as $ukuran)
                                            @if ( $dataTarget['id_ukuran'] == $ukuran->id)
                                            <option value="{{ $ukuran->id }}" selected>{{ $ukuran->ukuran }}</option>
                                            @else
                                            <option value="{{ $ukuran->id }}">{{ $ukuran->ukuran }}</option>
                                            @endif
                                            @endforeach
                                        </select> --}}
                                        <input type="text" value="{{ $dataTarget['ukuran'] }}"
                                            id="input-ukuran-{{ $index }}" class="form-control"
                                            name="dataTarget[{{ $index }}][ukuran]" readonly>
                                        <input type="hidden" value="{{ $dataTarget['id_ukuran'] }}" id="input-ukuran-{{ $index }}" class="form-control"
                                                name="dataTarget[{{ $index }}][id-ukuran]">


                                    </td>
                                    <td width="200px">
                                        {{-- <input type="text" value="{{ $dataTarget['qty_pakaian'] }}"
                                            id="input-qty-pakaian-{{ $index }}"
                                            class="form-control @error('dataTarget[{{ $index }}][qty-pakaian]') is-invalid @enderror"
                                            name="dataTarget[{{ $index }}][qty-pakaian]" placeholder="Qty Produk"> --}}
                                        <input type="text" value="{{ $dataTarget['qty_pakaian'] }}"
                                            id="input-qty-pakaian-{{ $index }}" class="form-control"
                                            name="dataTarget[{{ $index }}][qty-pakaian]" required>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- @endfor --}}
                        </tbody>
                    </table>

                    {{-- <input type="hidden" id="rowTargetProduk" name="rowTargetProduk"> --}}
                </div>

                {{-- <span class="btn btn-dark additemtarget">Add Item</span> --}}

            </div>

            <div class="invoice-detail-items" style="padding-top: 50px">
                <h5 class="">Nota Potong Kain</h5>
                <div class="table-responsive">
                    <table class="table item-table nota-kain">
                        <thead>
                            <tr>
                                <th class="">Kode Potong Kain</th>
                                <th class="">Kode Kain</th>
                                <th class="">Qty Kain</th>
                                <th class="">Tgl Mulai</th>
                                <th class="">Tgl Selesai</th>
                                <th class="">Karyawan</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody class="nota-kain-row">
                            @foreach ($detailNotaKain as $index => $dataNota)
                            <tr>
                                <td>
                                    {{-- <input type="text" value="{{ $dataNota['nota_kain_id'] }}"
                                        id="input-id-nota-{{ $index }}"
                                        class="form-control @error('dataNota[{{ $index }}][id-nota]') is-invalid @enderror"
                                        name="dataNota[{{ $index }}][id-nota]" placeholder="Kode Potong Kain" autofocus>
                                    --}}
                                    <input type="text" value="{{ $dataNota['nota_kain_id'] }}"
                                        id="input-id-nota-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][id-nota]" readonly>
                                </td>
                                <td width="250px">
                                    {{-- <select
                                        class="form-select @error('dataNota[{{ $index }}][id-kain]') is-invalid @enderror"
                                        id="input-id-kain-{{ $index }}" name="dataNota[{{ $index }}][id-kain]">
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($kains as $kain)
                                        @if ($dataNota['kains_id'] == $kain->id)
                                        <option value="{{ $kain->id }}" selected>{{ $kain->id }} - {{ $kain->stok }}
                                        </option>
                                        @else
                                        <option value="{{ $kain->id }}">{{ $kain->id }} - {{ $kain->stok }}</option>
                                        @endif
                                        @endforeach
                                    </select> --}}
                                    <input type="text" value="{{ $dataNota['kains_id'] }}"
                                        id="input-id-kain-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][id-kain]" readonly>
                                </td>
                                <td width="150px">
                                    {{-- <input type="text" value="{{ $dataNota['qty_kain'] }}"
                                        id="input-qty-kain-{{ $index }}"
                                        class="form-control @error('dataNota[{{ $index }}][qty-kain]') is-invalid @enderror"
                                        name="dataNota[{{ $index }}][qty-kain]" placeholder="Qty Kain"> --}}
                                    <input type="text" value="{{ $dataNota['qty_kain'] }}"
                                        id="input-qty-kain-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][qty-kain]" readonly>
                                </td>
                                <td width="180px">
                                    {{-- <input name="dataNota[{{ $index }}][tgl-mulai]"
                                        id="input-tgl-mulai-{{ $index }}"
                                        class="form-control flatpickr flatpickr-input active @error('dataNota[{{ $index }}][tgl-mulai]') is-invalid @enderror"
                                        type="text" placeholder="Pilih tanggal.."
                                        value="{{ date('d-m-Y', strtotime($dataNota['tgl_mulai'])) }}"> --}}
                                    <input type="text" value="{{ date('d-m-Y', strtotime($dataNota['tgl_mulai'])) }}"
                                        id="input-tgl-mulai-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][tgl-mulai]" readonly>
                                </td>
                                <td width="180px">
                                    @if ($dataNota['tgl_selesai'] == null)
                                    <input name="dataNota[{{ $index }}][tgl-selesai]"
                                        id="input-tgl-selesai-{{ $index }}"
                                        class="form-control flatpickr flatpickr-input active"
                                        type="text" placeholder="Pilih Tanggal.."
                                        value="{{ $dataNota['tgl_selesai'] }}">
                                    @else
                                    <input name="dataNota[{{ $index }}][tgl-selesai]"
                                        class="form-control"
                                        type="text" id="input-tgl-selesai-{{ $index }}"
                                        value="{{ date('d-m-Y', strtotime($dataNota['tgl_selesai'])) }}" readonly>
                                    @endif
                                </td>
                                <td>
                                    {{-- <select
                                        class="form-select @error('dataNota[{{ $index }}][karyawan]') is-invalid @enderror"
                                        id="input-karyawan-{{ $index }}" name="dataNota[{{ $index }}][karyawan]">
                                        <option selected disabled value="">Pilih Karyawan...</option>
                                        @foreach ($karyawans as $karyawan)
                                        @if ($dataNota['id_karyawan'] == $karyawan->id)
                                        <option value="{{ $karyawan->id }}" selected>{{ $karyawan->nama }}</option>
                                        @else
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                        @endif
                                        @endforeach
                                    </select> --}}
                                    <input type="text" value="{{ $dataNota['nama_karyawan'] }}"
                                        id="input-karyawan-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][karyawan]" readonly>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- <input type="hidden" id="rowNotaKain" name="rowNotaKain"> --}}
                </div>

                {{-- <span class="btn btn-dark additemnota">Add Item</span> --}}
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

@section('jseditproduksi')

<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>


<script>
    function sendValue() {
    $('#rowNotaKain').val($('.nota-kain tbody tr').length);
    $('#rowtargetProduk').val($('.target-produk tbody tr').length);
};
</script>

<script>
    var table = document.querySelector('.nota-kain-row');
    var rowCount = table.rows.length;

for (let index = 0; index < rowCount; index++) {
    // var dateMulai = document.querySelector('#input-tgl-mulai-' + index);
    // var defaultDateMulai = dateMulai.value;

    // var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-' + index), {
    //     dateFormat: "d-m-Y",
    //     defaultDate: defaultDateMulai
    // });

    var dateSelesai = document.querySelector('#input-tgl-selesai-' + index);
    var defaultDateSelesai = dateSelesai.value;
    
    console.log(defaultDateSelesai);

    if (defaultDateSelesai == 0){
        var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-' + index), {
        dateFormat: "d-m-Y",
        });
    }

    
    
}

// var dateMulaiProduksi = document.querySelector('#tanggal_mulai');
// var defaultDateMulaiProduksi = dateMulaiProduksi.value;

// var tglMulaiProduksi = flatpickr(document.getElementById('tanggal_mulai'), {
//     dateFormat: "d-m-Y",
//     defaultDate: defaultDateMulaiProduksi
//     });

var dateSelesaiProduksi = document.querySelector('#tanggal_selesai');
var defaultDateSelesaiProduksi = dateSelesaiProduksi.value;

var tglSelesaiProduksi = flatpickr(document.getElementById('tanggal_selesai'), {
    dateFormat: "d-m-Y",
    defaultDate: defaultDateSelesaiProduksi
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