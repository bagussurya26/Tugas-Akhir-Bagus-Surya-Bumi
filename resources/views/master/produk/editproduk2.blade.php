@extends('cork.cork')

@section('title', 'Ubah Data Produk')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/elements/alert.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/stepper/custom-bsStepper.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/stepper/custom-bsStepper.css') }}">

<link href="{{ asset('assets/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.show', $produks->id) }}">{{ $produks->kode_produk
                    }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-top-spacing" id="cancel-row">

    <div id="wizard_Default" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="bs-stepper stepper-form-one">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#defaultStep-one">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Informasi Produk</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#defaultStep-two">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Ukuran dan Harga</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form enctype="multipart/form-data" class="row g-3" method="POST"
                            action="{{ route('produk.update', $produks->id) }}">
                            @csrf
                            @method("PUT")
                            <div id="defaultStep-one" class="content" role="tabpanel">
                                <div class="row layout-top-spacing">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Nama Produk <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <input type="text" value="{{ $produks->nama }}" class="form-control"
                                                name="nama" placeholder="Masukkan nama..." autofocus required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Kategori <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <input type="text" value="{{ $produks->kategori_produks->nama }}"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Lokasi Rak <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <select class="form-select" name="rak_id" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($raks as $rak)
                                                <option value="{{ $rak->id }}" {{ $produks->rak_id==$rak->id ?
                                                    'selected' : '' }}>{{ $rak->lokasi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Tipe Body Fit <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <input type="text" value="{{ $produks->tipe_fit }}" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Tipe Lengan <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <input type="text" value="{{ $produks->tipe_lengan }}" class="form-control"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="input-keterangan">Keterangan</label>
                                            <textarea class="form-control" value="{{ $produks->keterangan }}" rows="3"
                                                placeholder="Keterangan" name="keterangan"></textarea>
                                        </div>
                                    </div>

                                    @if ($produks->foto != null || $produks->foto != "")
                                    <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4"
                                        role="alert">
                                        <strong>{{ $produks->foto }}</strong> Silahkan memberikan foto pada input di
                                        bawah jika ingin
                                        mengganti
                                        foto.</button>
                                    </div>
                                    @else
                                    <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4"
                                        role="alert">
                                        <strong>Foto Produk belum ada!</strong> Silahkan memberikan foto pada input di
                                        bawah.
                                    </div>
                                    @endif

                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Upload Foto <small class="text-muted ms-2 pb-1">(File must type .png,
                                                    .jpeg,
                                                    .jpg)</label>
                                            <div class="col-sm-12">
                                                <input type="file" name="foto"
                                                    class="form-control @error('foto') is-invalid @enderror">
                                                @error('foto')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-action text-end">
                                    <button type="button" class="btn btn-secondary btn-nxt" disabled>Next</button>
                                </div>

                            </div>
                            <div id="defaultStep-two" class="content" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table item-table ukuran">
                                        <thead>
                                            <tr>
                                                <th class="">Ukuran</th>
                                                <th class="">Harga</th>
                                            </tr>
                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detailUkurans as $index=>$item)
                                            <tr>
                                                <td class="">{{ $item->nama }}</td>
                                                <td>
                                                    <input type="hidden" value="{{ $item->ukuran_id }}"
                                                        name="dataProduk[{{ $index }}][ukuran]">
                                                    <input type="number" value="{{ $item->harga }}"
                                                        id="input-harga-{{ $index }}" class="form-control"
                                                        name="dataProduk[{{ $index }}][harga]" min=0>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="button-action mt-5 text-end">
                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="submit" class="btn btn-success me-3 btn-submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/stepper/custom-bsStepper.min.js') }}"></script>

{{-- Required Step --}}
<script>
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
</script>

{{-- Required Step --}}
<script>
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
                $('.btn-submit').prop('disabled', false);
            } else {
                $('.btn-submit').prop('disabled', true);
            }
        });

        // Trigger change event on page load to check initial state of required fields
        $('#defaultStep-two [required]').trigger('change');
    });
</script>

{{-- Ukuran --}}
<script>
    function getUkuran() {
        var tipe_fit = document.getElementById("tipe_fit").value
        if (tipe_fit === 'BIG SIZE'){
            var kategori = 'BZ';
        }
        else if (tipe_fit === 'REGULAR' || tipe_fit === 'SLIM') {
            var kategori = 'RS';
        }

        fetch('/getUkuran/' + kategori)
            .then(response => response.json())
            .then(data => {
                console.log(data)

                $(".ukuran tbody").html('');

                data.forEach(item => {
                    $html = '<tr>' +
                        '<td class="">'+item.nama+'</td>' +
                        '<td>' +
                            '<input type="hidden" value="'+item.id+'" name="dataProduk['+item.id+'][ukuran]">' +
                            '<input type="number" value="0" id="input-harga-'+item.id+'" class="form-control"' +
                                        ' name="dataProduk['+item.id+'][harga]" min=0>' +
                            '</td>' +
                        '</tr>';

                    $(".ukuran tbody").append($html);
                });
            })
            .catch(error => console.error('Error:', error));
    }
    function getUkuranEdit(id) {

        var tipe_fit = document.getElementById("tipe_fit").value

        if (tipe_fit === 'BIG SIZE'){
            var kategori = 'BZ';
        }
        else if (tipe_fit === 'REGULAR' || tipe_fit === 'SLIM') {
            var kategori = 'RS';
        }

        fetch('/getUkuranEdit/' + kategori + '/' + id)
            .then(response => response.json())
            .then(data => {
                console.log(data)

                $(".ukuran tbody").html('');

                if (data.length === 0) {
                    getUkuran();
                }
                else {                   
                    data.forEach(item => {
                    $html = '<tr>' +
                        '<td class="">'+item.nama+'</td>' +
                        '<td>' +
                            '<input type="hidden" value="'+item.ukuran_id+'" name="dataProduk['+item.ukuran_id+'][ukuran]">' +
                            '<input type="number" value="'+item.harga+'" id="input-harga-'+item.ukuran_id+'" class="form-control"' +
                                                ' name="dataProduk['+item.ukuran_id+'][harga]" min=0>' +
                            '</td>' +
                        '</tr>';
                    
                    $(".ukuran tbody").append($html);
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

{{-- Tipe --}}
<script>
    function getTipe() {
        var kategori = document.getElementById("kategori").value;

        $("#tipe_fit").html('');
        $("#tipe_lengan").html('');

        if (kategori === "4") {
            $html = '<option selected disabled value="">Choose...</option>'+
            '<option value="REGULAR" {{ $produks->tipe_fit=="REGULAR" ? "selected" : "" }}>REGULAR</option>'+
            '<option value="BIG SIZE" {{ $produks->tipe_fit=="BIG SIZE" ? "selected" : "" }}>BIG SIZE</option>';

            $html2 = '<option selected disabled value="">Choose...</option>'+
            '<option value="PENDEK" {{ $produks->tipe_lengan=="PENDEK" ? "selected" : "" }}>PENDEK</option>'+
            '<option value="PANJANG" {{ $produks->tipe_lengan=="PANJANG" ? "selected" : "" }}>PANJANG</option>'+
            '<option value="MANSET" {{ $produks->tipe_lengan=="MANSET" ? "selected" : "" }}>MANSET</option>';
        } else {
            $html = '<option selected disabled value="">Choose...</option>'+
            '<option value="REGULAR" {{ $produks->tipe_fit=="REGULAR" ? "selected" : "" }}>REGULAR</option>'+
            '<option value="SLIM" {{ $produks->tipe_fit=="SLIM" ? "selected" : "" }}>SLIM</option>'+
            '<option value="BIG SIZE" {{ $produks->tipe_fit=="BIG SIZE" ? "selected" : "" }}>BIG SIZE</option>';

            $html2 = '<option selected disabled value="">Choose...</option>'+
            '<option value="PENDEK" {{ $produks->tipe_lengan=="PENDEK" ? "selected" : "" }}>PENDEK</option>'+
            '<option value="MANSET" {{ $produks->tipe_lengan=="MANSET" ? "selected" : "" }}>MANSET</option>';
        }

        $("#tipe_fit").append($html);
        $("#tipe_lengan").append($html2);
    }
</script>

{{-- Resep --}}
<script>
    function deletes(idx) {
        var deleteTarget = document.querySelector('#delete-' + idx);
        if (deleteTarget) {
            var row = deleteTarget.closest('tr');
            if (row) {
                row.remove();
            }
        }
    }

    var rowCount = $('.resep-kain tbody tr').length;
    
    var currentIndex = rowCount;
    
    $(".btn-tambah").on("click", function() {
    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deletes('+currentIndex+')" id="delete-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"> <circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg< /a></li>'+
                '</ul>'+
            '</td>'+
        '<td>' +
            '<select class="form-select @error("dataResep['+currentIndex+'][kain]") is-invalid @enderror" id="input-kain-produk-'+currentIndex+'" name="dataResep['+currentIndex+'][kain]" required> <option selected disabled value="">Choose...</option> @foreach ($kains as $item) <option value="{{ $item->id }}" {{ old("dataResep['+currentIndex+'][kain]")==$item->id ? "selected" : ""}}>{{ $item->kode_kain }} - {{ $item->nama }}</option> @endforeach </select>' +
            '</td>' +
        '</tr>';
    
    $(".resep-kain tbody").append($html);
    currentIndex++;
    });

</script>
@endsection