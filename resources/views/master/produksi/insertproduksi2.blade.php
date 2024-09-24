@extends('cork.cork')

@section('title', 'Tambah Data Produksi')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/stepper/custom-bsStepper.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/stepper/custom-bsStepper.css') }}">
@endsection

@section('konten')
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

<div class="row layout-top-spacing" id="cancel-row">
    <div id="wizard_Default" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="bs-stepper stepper-form-one">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#defaultStep-two">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Informasi Produksi</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#defaultStep-three">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Assign Potong Kain</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">

                        <div id="defaultStep-two" class="content" role="tabpanel">
                            <form enctype="multipart/form-data" class="row g-3" method="POST"
                                action="{{ route('produksi.store.3') }}">
                                @csrf
                                <div class="summary layout-spacing ">
                                    <div class="widget-content widget-content-area">
                                        <div class="order-summary">
                                            <div class="summary-list summary-kode">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6>Kode Produksi<span class="summary-count">{{ $kodeproduk
                                                                    }}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="summary-list summary-tgl-mulai">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6>Tanggal Mulai<span class="summary-count">{{ $tglmulai
                                                                    }}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- List Ukuran --}}
                                    <div class="col-lg-12">
                                        <div class="summary layout-spacing ">
                                            <div class="widget-content widget-content-area">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="">Hasil Produk</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table style-3 table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Kode Produk</th>
                                                                @foreach ($targetproduk as $data)
                                                                <th class="text-center">{{ $data['kode_produk'] }}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Ukuran</td>
                                                                @foreach ($targetproduk as $data)
                                                                <td class="text-center">{{ $data['ukuran'] }}</th>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td>Qty (Pcs)</td>
                                                                @foreach ($targetproduk as $data)
                                                                <td class="text-center">{{ $data['qty']
                                                                    }}</th>
                                                                    @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Komposisi Kain --}}
                                    <div class="col-lg-12">
                                        <div class="summary layout-spacing ">
                                            <div class="widget-content widget-content-area">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="">Estimasi Komposisi Kain</h6>
                                                </div>
                                                {{-- <div class="table-responsive">
                                                    <table class="table style-3 table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Kain</th>
                                                                @foreach ($reseps as $data)
                                                                <th class="text-center">{{ $data->kode_kain }}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Foto</td>
                                                                @foreach ($reseps as $data)
                                                                <td class="text-center"><img src="{{ asset('uploads/kains/' . $data->foto) }}" alt="{{ $data->foto }}"
                                                                        class="img-fluid" style="width: 20%; height: 20%; object-fit: cover;" /></td>
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Keterangan --}}
                                    <div class="col-12">
                                        <div class="summary layout-spacing">
                                            <div class="widget-content widget-content-area">
                                                <div class="row mb-4">
                                                    <div class="col-sm-12">
                                                        <label>Keterangan Produksi</label>
                                                        <textarea class="form-control" value="{{ old('keterangan') }}"
                                                            rows="3" placeholder="Masukkan keterangan..."
                                                            name="keterangan"></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-action mt-5 text-end">
                                    <a href="{{ route('produksi.create') }}" class="btn btn-secondary btn-prev me-3">Prev</a>
                                    <button class="btn btn-secondary btn-nxt me-3">Next</button>
                                </div>
                            </form>
                        </div>
                        <div id="defaultStep-three" class="content" role="tabpanel">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/stepper/custom-bsStepper.min.js') }}"></script>

{{-- Required Step --}}
{{-- <script>
    $(document).ready(function () {
        // Function to check if all required fields are filled
        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#defaultStep-one [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false; // exit loop if any required field is empty
                    }
            });
            return allFieldsFilled;
        }

        // Enable/disable the "Next" button based on the required field completion
        $('#defaultStep-one [required]').on('input change', function () {
            if (checkRequiredFields()) {
                $('.btn-nxt').prop('disabled', false);
            } else {
                $('.btn-nxt').prop('disabled', true);
            }
        });

        // Trigger change event on page load to check initial state of required fields
        $('#defaultStep-one [required]').trigger('change');
    });
</script> --}}

{{-- Required Step --}}
{{-- <script>
    $(document).ready(function () {
        // Function to check if all required fields are filled
        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#defaultStep-two [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false; // exit loop if any required field is empty
                    }
            });
            return allFieldsFilled;
        }

        // Enable/disable the "Next" button based on the required field completion
        $('#defaultStep-two [required]').on('input change', function () {
            if (checkRequiredFields()) {
                $('.btn-nxt').prop('disabled', false);
            } else {
                $('.btn-nxt').prop('disabled', true);
            }
        });

        // Trigger change event on page load to check initial state of required fields
        $('#defaultStep-two [required]').trigger('change');
    });
</script> --}}


{{-- <script>
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

    var currentIndex = 0;
    
    $(".btn-tambah-nota").on("click", function() {

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
            '<select class="form-select @error("dataNota['+currentIndex+'][kain_id]") is-invalid @enderror" id="input-kode-kain-'+currentIndex+'" name="dataNota['+currentIndex+'][kain_id]" onchange="getMaxStok('+currentIndex+')" required>'+
                '<option selected disabled value="">Choose...</option>'+
                '@foreach ($kains as $kain) <option value="{{ $kain->id }}" {{ old("dataNota['+currentIndex2+'][kain_id]")==$kain->id ? "selected" : "" }}>{{ $kain->kode_kain }}, Stok: {{ $kain->stok }}</option> @endforeach'+
            '</select>'+
            // '@error("dataNota['+currentIndex+'][id-kain]") <div class="invalid-feedback"> {{ $message }} </div> @enderror'+
        '</td>'+
        '<td width="180px">'+
            '<input type="number" value="{{ old("dataNota['+currentIndex+'][qty_kain]") }}" class="form-control @error("dataNota['+currentIndex+'][qty_kain]") is-invalid @enderror" id="input-qty-kain-'+currentIndex+'" name="dataNota['+currentIndex+'][qty_kain]" step="0.01" min=1 required>'+
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
    

    var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-' + currentIndex), {allowInput:true,});
    var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-' + currentIndex), {allowInput:true,});
     
    });

    var currentIndex2 = 0;

    $(".btn-tambah-produk").on("click", function() {
    
    currentIndex2++;
    
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
            '<input type="number" value="{{ old("dataTarget['+currentIndex2+'][qty_produk]") }}" class="form-control @error("dataTarget['+currentIndex2+'][qty_produk]") is-invalid @enderror" id="input-qty-produk-'+currentIndex2+'" name="dataTarget['+currentIndex2+'][qty_produk]" min=1 required>' +
            // '@error("dataTarget['+currentIndex2+'][qty-pakaian]") <div class="invalid-feedback">{{ $message }}</div> @enderror'+
            '</td>' +
        '</tr>';
    
    $(".target-produk tbody").append($html);
    
    });

</script> --}}

{{-- <script>
    var tglMulai = flatpickr(document.getElementById('input-tgl-mulai-0'), {allowInput:true,});
var tglSelesai = flatpickr(document.getElementById('input-tgl-selesai-0'), {allowInput:true,});

var tglMulaiProduksi = flatpickr(document.getElementById('tanggal_mulai'), {allowInput:true,});
var tglSelesaiProduksi = flatpickr(document.getElementById('tanggal_selesai'), {});
</script> --}}

{{-- <script>
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
</script> --}}

@endsection