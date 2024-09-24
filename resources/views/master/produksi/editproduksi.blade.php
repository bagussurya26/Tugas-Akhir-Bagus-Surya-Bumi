@extends('cork.cork')

@section('title', 'Ubah Data Produksi')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produksi.index') }}">Produksi</a></li>
            <li class="breadcrumb-item">{{ $produksis->kode_produksi }}</li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" method="POST" action="{{ route('produksi.update', $produksis->id) }}">
        @csrf
        @method("PUT")
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Produksi</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $produksis->kode_produksi }}" id="input-kode-produksi"
                                    class="form-control @error('kode_produksi') is-invalid @enderror"
                                    placeholder="Masukkan kode..." readonly>
                                @error('kode_produksi')
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
                            <input type="text" value="{{ $produksis->tgl_mulai }}" id="tanggal_mulai"
                                class="form-control" name="tgl_mulai" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Selesai</label>

                            <input class="form-control" name="tgl_selesai" type="text"
                                value="{{ $produksis->tgl_selesai ?? old('tgl_selesai') }}"
                                placeholder="Pilih tanggal..." {{ $produksis->status=='Selesai'
                            ? 'readonly' : 'id=tanggal_selesai' }}>
                        </div>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Keterangan Produksi</label>
                        <textarea class="form-control" value="" rows="3" placeholder="Masukkan keterangan..."
                            name="keterangan">{{ $produksis->keterangan }}</textarea>
                    </div>

                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Target Produksi</h5>
                <div class="table-responsive">
                    <table class="table item-table target-produk">
                        <thead>
                            <tr>
                                {{-- @if ($produksis->status != 'Selesai')
                                <th class=""></th>
                                @endif --}}

                                <th class="">Kode Produk</th>
                                <th class="">Nama Produk</th>
                                <th class="">Ukuran</th>
                                <th class="">Qty Produk</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            @foreach ($detailTarget as $index=>$dataTarget)

                            <tr>
                                {{-- @if ($produksis->status != 'Selesai')
                                <td class="delete-item-row">
                                    <ul class="table-controls">
                                        <li><a href="javascript:void(0);" class="delete-item"
                                                onclick="deleteTarget({{ $index }})" id="deletetarget-{{ $index }}"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete"><i data-feather="x-circle"></i></a></li>
                                    </ul>
                                </td>
                                @endif --}}
                                <td>
                                    <input type="text" value="{{ $dataTarget['kode_produk'] }}" class="form-control"
                                        readonly>
                                    <input type="hidden" value="{{ $dataTarget['id_produk'] }}"
                                        id="input-id-produk-{{ $index }}" class="form-control"
                                        name="dataTarget[{{ $index }}][produk_id]">
                                </td>
                                <td width="450px">
                                    <input type="text" value="{{ $dataTarget['nama_produk'] }}"
                                        id="input-nama-produk-{{ $index }}" class="form-control"
                                        name="dataTarget[{{ $index }}][nama_produk]" readonly>
                                </td>
                                <td width="200px">
                                    <input type="text" value="{{ $dataTarget['nama_ukuran'] }}" class="form-control"
                                        readonly>
                                    <input type="hidden" value="{{ $dataTarget['id_ukuran'] }}"
                                        id="input-id-ukuran-{{ $index }}" class="form-control"
                                        name="dataTarget[{{ $index }}][ukuran_id]">
                                </td>
                                <td width="150px">
                                    <input type="number" value="{{ $dataTarget['qty_produk'] }}"
                                        id="input-qty-produk-{{ $index }}" class="form-control"
                                        name="dataTarget[{{ $index }}][qty_produk]" {{ $produksis->status=='Selesai'
                                    ? 'readonly' : 'required' }}>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- @if ($produksis->status != 'Selesai')
                <span class="btn btn-dark additemtarget">Add Item</span>
                @endif --}}
            </div>

            <div class="invoice-detail-items" style="padding-top: 50px">
                <h5 class="">Nota Potong Kain</h5>
                <div class="table-responsive">
                    <table class="table item-table nota-kain">
                        <thead>
                            <tr>
                                {{-- @if ($produksis->nota_kains[0]->status != 'Selesai')
                                <th class=""></th>
                                @endif --}}
                                <th class="">Kode Potong Kain</th>
                                <th class="">Kode Kain</th>
                                <th class="">Qty Kain</th>
                                <th class="">Tgl Mulai</th>
                                <th class="">Tgl Selesai</th>
                                <th class="">Karyawan</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            @foreach ($detailNotaKain as $index => $dataNota)
                            <tr>
                                {{-- @if ($produksis->nota_kains[0]->status != 'Selesai')
                                <td class="delete-item-row">
                                    <ul class="table-controls">
                                        <li><a href="javascript:void(0);" class="delete-item"
                                                onclick="deleteNota({{ $index }})" id="deletenota-{{ $index }}"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete"><i data-feather="x-circle"></i></a></li>
                                    </ul>
                                </td>
                                @endif --}}
                                <td>
                                    <input type="text" value="{{ $dataNota['kode_nota'] }}"
                                        id="input-id-nota-{{ $index }}" name="dataNota[{{ $index }}][id_nota]"
                                        class="form-control" readonly>
                                    {{-- <input type="hidden" value="{{ $dataNota['id_nota'] }}"
                                        id="input-id-nota-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][id_nota]"> --}}
                                </td>
                                <td width="300px">
                                    <input type="text"
                                        value="{{ $dataNota['kode_kain'] }}, Stok: {{ $dataNota['stok'] }}"
                                        class="form-control" readonly>
                                    <input type="hidden" value="{{ $dataNota['id_kain'] }}"
                                        id="input-kode-kain-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][kain_id]">
                                </td>
                                <td width="180px">
                                    <input type="number" value="{{ $dataNota['qty_kain'] }}"
                                        id="input-qty-kain-{{ $index }}" step="0.01" min="1"
                                        max="{{ $dataNota['stok'] +  $dataNota['qty_kain']}}" class="form-control"
                                        name="dataNota[{{ $index }}][qty_kain]" {{ $dataNota['status']=='Selesai'
                                        ? 'readonly' : 'required' }}>
                                </td>
                                <td width="180px">
                                    <input type="text" value="{{ $dataNota['tgl_mulai'] }}" class="form-control"
                                        name="dataNota[{{ $index }}][tgl_mulai]" readonly>
                                </td>
                                <td width="180px">
                                    <input class="form-control" name="dataNota[{{ $index }}][tgl_selesai]" type="text"
                                        value="{{ $dataNota['tgl_selesai'] }}" placeholder="Pilih tanggal" {{
                                        $dataNota['status']=='Selesai' ? 'readonly' : 'id=input-tgl-selesai-' . $index
                                        }}>
                                </td>
                                <td>
                                    <input type="text" value="{{ $dataNota['nama_karyawan'] }}" class="form-control"
                                        readonly>
                                    <input type="hidden" value="{{ $dataNota['id_karyawan'] }}"
                                        id="input-karyawan-{{ $index }}" class="form-control"
                                        name="dataNota[{{ $index }}][karyawan]">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($produksis->nota_kains[0]->status != 'Selesai')
                <span class="btn btn-dark additemnota">Add Item</span>
                @endif
            </div>

            <div class="col text-end">
                <button class="btn btn-success" type="submit">Update</button>
            </div>

            {{-- <div class="invoice-detail-note">
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
            </div> --}}
        </div>
    </form>
</div>


@endsection

@section('js')

<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>

<script>
    var rowCount = $('.nota-kain tbody tr').length;

for (let index = 0; index < rowCount; index++) {
    var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-' + index), {});
    // var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-' + index), {});
}

</script>

<script>
    function deleteTarget(idx) {
    var deleteTarget = document.querySelector('#deletetarget-' + idx);
    if (deleteTarget) {
    var row = deleteTarget.closest('tr');
    
    // Remove the row if it exists
    if (row) {
    // handleInputRollDelete(idx);
    row.remove();
    }
    }
    }

    function deleteNota(idx) {
    var deleteNota = document.querySelector('#deletenota-' + idx);
    if (deleteNota) {
    var row = deleteNota.closest('tr');
    
    // Remove the row if it exists
    if (row) {
    // handleInputRollDelete(idx);
    row.remove();
    }
    }
    }

    var rowCount = $('.nota-kain tbody tr').length;
    
    var currentIndex = rowCount;
    
    document.getElementsByClassName('additemnota')[0].addEventListener('click', function () {

    currentIndex++;
    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deleteNota('+currentIndex+')" id="deletenota-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
            '</ul>'+
        '</td>'+
        '<td>'+
            '<input type="text" value="{{ old("dataNota['+currentIndex+'][id_nota]") }}" class="form-control @error("dataNota['+currentIndex+'][id_nota]") is-invalid @enderror" name="dataNota['+currentIndex+'][id_nota]" id="input-kode-nota-'+currentIndex+'" required>'+
            // '@error("dataNota['+currentIndex+'][id-nota]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
        '</td>'+
        '<td width="300px">'+
            '<select class="form-select @error("dataNota['+currentIndex+'][kain_id]") is-invalid @enderror" id="input-kode-kain-'+currentIndex+'" name="dataNota['+currentIndex+'][kain_id]" oninput="getMaxStok('+currentIndex+')" required>'+
                '<option selected disabled value="">Choose...</option>'+
                '@foreach ($kains as $kain) <option value="{{ $kain->id }}" {{ old("dataNota['+currentIndex2+'][kain_id]")==$kain->id ? "selected" : "" }}>{{ $kain->kode_kain }}, Stok: {{ $kain->stok }}</option> @endforeach'+
            '</select>'+
            // '@error("dataNota['+currentIndex+'][id-kain]") <div class="invalid-feedback"> {{ $message }} </div> @enderror'+
        '</td>'+
        '<td width="180px">'+
            '<input type="number" value="{{ old("dataNota['+currentIndex+'][qty_kain]") }}" class="form-control @error("dataNota['+currentIndex+'][qty_kain]") is-invalid @enderror" id="input-qty-kain-'+currentIndex+'" name="dataNota['+currentIndex+'][qty_kain]" step="0.01" required>'+
            // '@error("dataNota['+currentIndex+'][qty-kain]") <div class="invalid-feedback"> {{ $message }} </div> @enderror'+
        '</td>'+
        '<td width="180px">'+
            '<input name="dataNota['+currentIndex+'][tgl_mulai]" id="input-tgl-mulai-'+currentIndex+'" class="form-control flatpickr flatpickr-input active @error("dataNota['+currentIndex+'][tgl_mulai]") is-invalid @enderror" type="text" placeholder="Pilih tanggal.." value="{{ old("dataNota['+currentIndex+'][tgl_mulai]") }}" required>'+
            // '@error("dataNota['+currentIndex+'][tgl-mulai]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
        '</td>'+
        '<td width="180px">'+
            '<input name="dataNota['+currentIndex+'][tgl_selesai]" id="input-tgl-selesai-'+currentIndex+'"'+
                'class="form-control flatpickr flatpickr-input active @error("dataNota['+currentIndex+'][tgl_selesai]") is-invalid @enderror" type="text" placeholder="Pilih Tanggal.." value="{{ old("dataNota['+currentIndex+'][tgl_selesai]") }}" required>'+
            // '@error("dataNota['+currentIndex+'][tgl-selesai]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
        '</td>'+
        '<td>'+
            '<select class="form-select @error("dataNota['+currentIndex+'][karyawan]") is-invalid @enderror" id="input-karyawan-'+currentIndex+'" name="dataNota['+currentIndex+'][karyawan]" required>'+
                '<option selected disabled value="">Choose...</option>'+
                '@foreach ($karyawans as $karyawan) <option value="{{ $karyawan->id }}" {{ old("dataNota['+currentIndex+'][karyawan]")==$karyawan->id ? "selected" : "" }}>{{ $karyawan->nama }}</option> @endforeach'+
            '</select>'+
            // '@error("dataNota['+currentIndex+'][karyawan]") <div class="invalid-feedback">{{ $message }} </div> @enderror'+
        '</td>'+
        '</tr>';
    
        // console.log($html);
    
    $(".nota-kain tbody").append($html);
    
    
    var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-' + currentIndex), {});
    var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-' + currentIndex), {});

    currentIndex++;
     
    });

    var rowCount1 = $('.target-produk tbody tr').length;
    
    var currentIndex2 = rowCount1;

    document.getElementsByClassName('additemtarget')[0].addEventListener('click', function () {

    $html = '<tr>' +
        '<td class="delete-item-row">' +
            '<ul class="table-controls">' +
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deleteTarget('+currentIndex2+')" id="deletetarget-'+currentIndex2+'" data-toggle="tooltip" data-placement="top" title=""data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li></ul>' +
            '</td>' +
        '<td>' +
            '<select class="form-select @error("dataTarget['+currentIndex2+'][produk_id]") is-invalid @enderror" id="input-id-produk-'+currentIndex2+'" name="dataTarget['+currentIndex2+'][produk_id]" oninput="updateNamaUkuran('+currentIndex2+')" required><option selected disabled value="">Choose...</option> @foreach ($produks as $produk) <option value="{{ $produk->id }}" {{ old("dataTarget['+currentIndex2+'][produk_id]")==$produk->id ? "selected" : "" }}>{{ $produk->kode_produk }}</option> @endforeach </select>' +
            // '@error("dataTarget['+currentIndex2+'][id-produk]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
                '</td>' +
        '<td width="450px">' +
            '<input type="text" value="{{ old("dataTarget['+currentIndex2+'][nama_produk]") }}" id="input-nama-produk-'+currentIndex2+'" class="form-control" name="dataTarget['+currentIndex2+'][nama_produk]" readonly>' +
            '</td>' +
        '<td width="200px">' +
            '<select class="form-select @error("dataTarget['+currentIndex2+'][ukuran_id]") is-invalid @enderror"' +
                ' id="input-ukuran-'+currentIndex2+'" name="dataTarget['+currentIndex2+'][ukuran_id]" required>' +
                // '<option selected disabled value="">Choose...</option>' +
                // '@foreach ($ukurans as $ukuran) <option value="{{ $ukuran->id }}" {{ old("dataTarget['+currentIndex2+'][ukuran_id]")==$ukuran->id ? "selected" : "" }}>{{ $ukuran->nama }}</option> @endforeach' +
                '</select>' +
                // '@error("dataTarget['+currentIndex2+'][ukuran]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
            '</td>' +
        '<td width="150px">' +
            '<input type="number" value="{{ old("dataTarget['+currentIndex2+'][qty_produk]") }}" class="form-control @error("dataTarget['+currentIndex2+'][qty_produk]") is-invalid @enderror" id="input-qty-produk-'+currentIndex2+'" name="dataTarget['+currentIndex2+'][qty_produk]" required>' +
            // '@error("dataTarget['+currentIndex2+'][qty-pakaian]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
            '</td>' +
        '</tr>';
    
    $(".target-produk tbody").append($html);

    currentIndex2++;
    
    });

</script>

<script>
    // var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-0'), {});
// var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-0'), {});

// var tglMulaiProduksi = flatpickr(document.getElementById('tanggal_mulai'), {});
var tglSelesaiProduksi = flatpickr(document.getElementById('tanggal_selesai'), {});
</script>

<script>
    function updateNamaUkuran(idx) {
        updateNamaProduk(idx);
        updateUkuranProduk(idx);
    }

    function updateUkuranProduk(idx) {
    var kode = document.getElementById("input-id-produk-" + idx).value
    fetch('/getUkuranProduk/' + kode)
        .then(response => response.json())
        .then(data => {
            console.log('test')
            let ukuranProduk = document.getElementById("input-ukuran-" + idx);
            ukuranProduk.innerHTML = '';           
            
            let option = document.createElement('option');
                option.text = "Select...";
                option.value = "";
                ukuranProduk.appendChild(option);

            data.forEach(ukuranproduk => {
                let option = document.createElement('option');
                option.text = ukuranproduk.nama +', Stok: '+ ukuranproduk.stok;
                option.value = ukuranproduk.id;
                ukuranProduk.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
    }
    
    function updateNamaProduk(idx) {
        var selectedId = document.getElementById("input-id-produk-" + idx).value;
        var selectedNama = getNamaProduk(selectedId);
        document.getElementById("input-nama-produk-" + idx).value = selectedNama;
    }

    function getNamaProduk(id) {
        var produks = @json($produks);
        var selectedProduk = produks.find(produk => produk.id == id);

        return selectedProduk ? selectedProduk.nama : '';
    }

    function getMaxStok(idx) {
    var kode = document.getElementById("input-kode-kain-" + idx).value;
    var selectedKain = getAww(kode);

    let myNumberInput = document.getElementById("input-qty-kain-" + idx);
    myNumberInput.min = 1;
    myNumberInput.max = selectedKain;
    
    console.log(selectedKain.stok);
    }

    function getAww(id) {
        var kain = @json($kains);
        var selectedKain = kain.find(kain => kain.id == id);        

        return selectedKain ? selectedKain.stok : '';
    }

    function getMinMaxStok(idx) {
    var kode = document.getElementById("input-kode-kain-" + idx).value
    fetch('/getHargaProduk/' + kode + '/' + ukuran)
    .then(response => response.json())
    .then(data => {
    console.log(data)
    
    let myNumberInput = document.getElementById("input-qty-kain-" + idx);
    myNumberInput.min = 1;
    myNumberInput.max = data;
    
    })
    .catch(error => console.error('Error:', error));
    }
</script>

@endsection