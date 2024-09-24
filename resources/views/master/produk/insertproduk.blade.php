@extends('cork.cork')

@section('title', 'Tambah Data Produk')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/stepper/custom-bsStepper.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/stepper/custom-bsStepper.css') }}">

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/src/tomSelect/tom-select.default.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Warna</span>
                                </span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#defaultStep-three">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Ukuran dan Harga</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#defaultStep-four">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">4</span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Resep Kain</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('produk.store') }}">
                            @csrf

                            <div id="defaultStep-one" class="content" role="tabpanel">
                                <div class="row layout-top-spacing">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Nama Produk <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <input type="text" value="{{ old('nama') }}" class="form-control"
                                                name="nama" placeholder="Masukkan nama..." autofocus required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Kategori <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <select class="form-select" name="kategori_produk_id" oninput="getKategori()"
                                                id="kategori" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" {{
                                                    old('kategori_produk_id')==$kategori->id ?
                                                    'selected' : '' }}>{{ $kategori->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Lokasi Rak <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <select class="form-select" name="rak_id" id="rak" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($raks as $rak)
                                                <option value="{{ $rak->id }}" {{ old('rak_id')==$rak->id ?
                                                    'selected' : '' }}>{{ $rak->lokasi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label for="fit">Tipe Body Fit <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <select class="form-select" name="tipe_fit" oninput="getUkuran()"
                                                id="tipe_fit" required>
                                                <option selected disabled value="">Choose...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label for="lengan">Tipe Lengan <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <select class="form-select" name="tipe_lengan" id="tipe_lengan" required>
                                                <option selected disabled value="">Choose...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="input-keterangan">Keterangan</label>
                                            <textarea class="form-control" value="{{ old('keterangan') }}" rows="3"
                                                placeholder="Keterangan" name="keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-action text-end">
                                    <button type="button" id="btn-nxt1" class="btn btn-secondary btn-nxt">Next</button>
                                </div>

                            </div>
                            <div id="defaultStep-two" class="content" role="tabpanel">
                                <div class="invoice-detail-items" style="padding-top: 10px">
                                    <h5 class="">Warna Produk</h5>
                                    <div class="table-responsive">
                                        <table class="table item-table warna">
                                            <thead>
                                                <tr>
                                                    <th class=""></th>
                                                    <th class="">Warna <small
                                                            class="text-muted ms-2 pb-1">(Required)</small></th>
                                                    <th class="">Foto</th>
                                                </tr>
                                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="delete-item-row"></td>
                                                    <td>
                                                        <input type="text" value="{{ old('dataWarna[0][warna]') }}"
                                                            class="form-control" style="text-transform: uppercase" name="dataWarna[0][warna]"
                                                            placeholder="Masukkan warna..." id="input-warna-0" onchange="getResep(0)" required>
                                                    </td>
                                                    <td>
                                                        <input type="file" name="dataWarna[0][foto]"
                                                            class="form-control" accept=".png, .jpeg, .jpg">
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-dark btn-tambah-warna me-3">Tambah
                                        Warna</button>

                                </div>

                                <div class="button-action mt-5 text-end">
                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="button" id="btn-nxt2" class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-three" class="content" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table item-table ukuran">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Ukuran</th>
                                                <th class="">Harga</th>
                                            </tr>
                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="button-action mt-5 text-end">
                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="button" id="btn-nxt3" class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-four" class="content" role="tabpanel">
                                <div id="area-resep">

                                    <div class="invoice-detail-items warna-0" style="padding-top: 10px">
                                        <h5 id="warna-resep-0"></h5>
                                        <div class="table-responsive">
                                            <table class="table item-table resep-kain">
                                                <thead>
                                                    <tr>
                                                        <th class=""></th>
                                                        <th class="">Kode Kain</th>
                                                        <th class="" style="width:25%">Tipe</th>
                                                    </tr>
                                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                                </thead>
                                                <tbody id="tbody-0">
                                                    <tr>
                                                        <td class="delete-item-row"></td>
                                                        <td>
                                                            <input type="hidden" value="0" name="dataResep[0][0][produk_warna]">
                                                            <select class="form-select" name="dataResep[0][0][kain]" id="input-kain-0-0"
                                                                required>
                                                                <option selected disabled value="">Choose...</option>
                                                                @foreach ($kains as $item)
                                                                <option value="{{ $item->id }}" {{
                                                                    old('dataResep[0][0][kain]')==$item->
                                                                    id ?
                                                                    'selected' : '' }}>{{ $item->kode_kain }} - {{
                                                                    $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-select" name="dataResep[0][0][tipe]"
                                                                id="input-tipe-0-0" required>
                                                                <option disabled value="">Choose...</option>
                                                                <option value="UTAMA" selected>UTAMA</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <button type="button" class="btn btn-dark btn-tambah-resep me-3">Tambah</button>

                                    </div>

                                </div>

                                <div class="button-action mt-5 text-end">
                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="submit" class="btn btn-success btn-submit">Submit</button>
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
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>

{{-- Tom Select --}}
<script>
    new TomSelect("#rak",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    new TomSelect("#input-kain-0-0",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
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
                        '<td class="text-center"><h6>'+item.nama+'</h6></td>' +
                        '<td>' +
                            '<input type="hidden" value="'+item.id+'" name="dataUkuran['+item.id+'][ukuran]">' +
                            '<input type="number" value="0" id="input-harga-'+item.id+'" step=0.01 class="form-control"' +
                                        ' name="dataUkuran['+item.id+'][harga]" min=0>' +
                            '</td>' +
                        '</tr>';

                    $(".ukuran tbody").append($html);
                });
            })
            .catch(error => console.error('Error:', error));
    }
</script>

{{-- Tipe --}}
<script>
    function getKategori() {
        var kategori = document.getElementById("kategori").value;

        console.log('kategori : ' + kategori);

        $("#tipe_fit").html('');
        $("#tipe_lengan").html('');

        if (kategori === "4") {
            $html = '<option selected disabled value="">Choose...</option>'+
            '<option value="REGULAR">REGULAR</option>'+
            '<option value="BIG SIZE">BIG SIZE</option>';

            $html2 = '<option selected disabled value="">Choose...</option>'+
            '<option value="PENDEK">PENDEK</option>'+
            '<option value="PANJANG">PANJANG</option>'+
            '<option value="MANSET">MANSET</option>';
        } else {
            $html = '<option selected disabled value="">Choose...</option>'+
            '<option value="REGULAR">REGULAR</option>'+
            '<option value="SLIM">SLIM</option>'+
            '<option value="BIG SIZE">BIG SIZE</option>';

            $html2 = '<option selected disabled value="">Choose...</option>'+
            '<option value="PENDEK">PENDEK</option>'+
            '<option value="MANSET">MANSET</option>';
        }

        $("#tipe_fit").append($html);
        $("#tipe_lengan").append($html2);
    }
</script>

{{-- Delete Warna --}}
<script>
    function deletes(idx) {
        var deleteTarget = document.querySelector('#delete-' + idx);
        if (deleteTarget) {
            var row = deleteTarget.closest('tr');
            if (row) {
                row.remove();

                $('.warna-'+idx).remove();
            }
        }

        function checkRequiredFields2() {
            var allFieldsFilled2 = true;
            $('#defaultStep-two [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled2 = false;
                        return false; // exit loop if any required field is empty
                    }
            });
            return allFieldsFilled2;
        }

        if (checkRequiredFields2()) {
            $('#btn-nxt2').prop('disabled', false);
        } else {
            $('#btn-nxt2').prop('disabled', true);
        }
    }  
</script>

{{-- Delete Resep --}}
<script>
    function deleteResep(idx) {

        var arrayIndex = [];
    
        // Mnyimpan index dari warna
        $('.warna tbody tr td input[id^="input-warna-"]').each(function() {
            var currentId = $(this).attr('id');
            if (currentId) {
                var numericPart = parseInt((currentId.split('-')[2] || ''), 10);
                if (!isNaN(numericPart)) {
                    arrayIndex.push(numericPart);
                }
            }
        });
        
        arrayIndex.forEach(element => {
            var deleteTarget = document.querySelector('#delete-resep-' + element + '-' + idx);
            if (deleteTarget) {
                var row = deleteTarget.closest('tr');
                if (row) {
                    row.remove();
                }
            }
        });

        function checkRequiredStep4() {
            var allFieldsFilled = true;
            $('#defaultStep-four [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });

            if (allFieldsFilled) {
                $('.btn-submit').prop('disabled', false);
            } else {
                $('.btn-submit').prop('disabled', true);
            }
        }

        checkRequiredStep4();

        $('#defaultStep-four [required]').on('input', function () {
            checkRequiredStep4();
        });
    }  
</script>

{{-- Warna --}}
<script>
    $(".btn-tambah-warna").on("click", function() {

    var indexWarna = 0;
    
    // Function mencari index terakhir dari input warna
    $('.warna tbody tr td input[id^="input-warna-"]').each(function() {
        var currentId = $(this).attr('id');
        if (currentId) {
            var numericPart = parseInt((currentId.split('-')[2] || ''), 10);
            indexWarna = isNaN(numericPart) ? indexWarna : Math.max(indexWarna, numericPart);
        }
    });

    indexWarna++;
    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deletes('+indexWarna+')" id="delete-'+indexWarna+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"> <circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg< /a></li>'+
                '</ul>'+
            '<td>'+
                '<input type="text" value="{{ old("dataWarna['+indexWarna+'][warna]") }}" style="text-transform: uppercase" class="form-control" name="dataWarna['+indexWarna+'][warna]"'+
                    'placeholder="Masukkan warna..." id="input-warna-'+indexWarna+'" onchange="getResep('+indexWarna+')" required>'+
            '</td>'+
            '<td>'+
                '<input type="file" name="dataWarna['+indexWarna+'][foto]" class="form-control" accept=".png, .jpeg, .jpg">'+
            '</td>'+
        '</tr>';
    
    $(".warna tbody").append($html);

    $html = '<div class="invoice-detail-items warna-'+indexWarna+'" style="padding-top: 50px">' +
        '<h5 id="warna-resep-'+indexWarna+'"></h5>' +
        '<div class="table-responsive">' +
        '<table class="table item-table resep-kain">' +
            '<thead>' +
                '<tr>' +
                    '<th class=""></th>' +
                    '<th class="">Kode Kain</th>' +
                    '<th class="" style="width:25%">Tipe</th>' +
                '</tr>' +
                '<tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>' +
            '</thead>' +
            '<tbody id="tbody-'+indexWarna+'">' +
        '</tbody>' +
        '</table>' +
        '</div>' +
       '</div>';
        
    $("#area-resep").append($html);

    var arrayIndex = [];
    var arrayValueTipe = [];
    
    // Mnyimpan index dari resep index 0
    $('#tbody-0 tr td select[id^="input-kain-"]').each(function() {
        var currentId = $(this).attr('id');
        if (currentId) {
            var numericPart = parseInt((currentId.split('-')[3] || ''), 10);
            if (!isNaN(numericPart)) {
                arrayIndex.push(numericPart);
            }
        }
    });

    // Menyimpan value tipe resep warna pertama
    $('#tbody-0 tr td select[id^="input-tipe-"]').each(function() {
        arrayValueTipe.push($(this).val());
    });

    console.log(arrayValueTipe);

    // PROSES TAMBAH WARNA RESEP
    arrayIndex.forEach((element, index) => {

        if (index === 0) {
            $html = '<tr>' +
        '<td class="delete-item-row" ></td>'+
        '<td>' +
            '<input type="hidden" value="'+indexWarna+'" name="dataResep['+indexWarna+']['+index+'][produk_warna]">'+
            '<select class="form-select" name="dataResep['+indexWarna+']['+index+'][kain]" id="input-kain-'+indexWarna+'-'+index+'" required> <option selected disabled value="">Choose...</option> @foreach ($kains as $item) <option value="{{ $item->id }}" {{ old("dataResep['+indexWarna+']['+index+'][kain]")==$item->id ? "selected" : ""}}>{{ $item->kode_kain }} - {{ $item->nama }}</option> @endforeach </select>' +
            '</td>' +
            '<td style="width:25%">' +
                '<input type="text" value="UTAMA" class="form-control" name="dataResep['+indexWarna+']['+index+'][tipe]" readonly>' +
            '</td>' +
        '</tr>';
        } else {
            $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" id="delete-resep-'+indexWarna+'-'+index+'"></a></li>'+
                '</ul>'+
            '</td>'+
        '<td>' +
            '<select class="form-select" name="dataResep['+indexWarna+']['+index+'][kain]" id="input-kain-'+indexWarna+'-'+index+'" required> <option selected disabled value="">Choose...</option> @foreach ($kains as $item) <option value="{{ $item->id }}" {{ old("dataResep['+indexWarna+']['+index+'][kain]")==$item->id ? "selected" : ""}}>{{ $item->kode_kain }} - {{ $item->nama }}</option> @endforeach </select>' +
            '</td>' +
            '<td style="width:10%">' +
                '<input type="text" value="'+arrayValueTipe[index]+'" class="form-control" name="dataResep['+indexWarna+']['+index+'][tipe]" id="input-tipe-'+indexWarna+'-'+index+'" readonly>' +
            '</td>' +
        '</tr>';
        }  
    
        $("#tbody-"+indexWarna).append($html);

        new TomSelect("#input-kain-" + indexWarna + '-' + index,{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
        }
    });

    });

    function checkButtonStatus() {
        var valueWarna = true;
        var values = [];

        $('[id^="input-warna-"]').each(function() {
            var value1 = $(this).val().toUpperCase();
            $(this).val(value1);

            if (value1 === "" || values.includes(value1)) {
                valueWarna = false;
                return false;
            }
            values.push(value1);
        });

        $('#btn-nxt2').prop('disabled', !valueWarna);
    }

    checkButtonStatus();

    $(document).on('input', '[id^="input-warna-"]', function() {
        checkButtonStatus();
    });

    function checkRequiredStep4() {
            var allFieldsFilled = true;
            $('#defaultStep-four [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });

            if (allFieldsFilled) {
                $('.btn-submit').prop('disabled', false);
            } else {
                $('.btn-submit').prop('disabled', true);
            }
        }

        checkRequiredStep4();

        $('#defaultStep-four [required]').on('input', function () {
            checkRequiredStep4();
        });
    
    });
</script>

{{-- Warna Resep --}}
<script>
    function getResep(idx) {
        var warna = $('#input-warna-' + idx).val();

        $('#warna-resep-' + idx).text(warna);
    }
</script>

{{-- Resep --}}
<script>
    $(".btn-tambah-resep").on("click", function() {

    var arrayIndex = [];
    
    // Mnyimpan index dari warna
    $('.warna tbody tr td input[id^="input-warna-"]').each(function() {
        var currentId = $(this).attr('id');
        if (currentId) {
            var numericPart = parseInt((currentId.split('-')[2] || ''), 10);
            if (!isNaN(numericPart)) {
                arrayIndex.push(numericPart);
            }
        }
    });

    var currentIndex = 0;
    
    // Function mencari index terakhir resep
    $('.resep-kain #tbody-0 tr td select[id^="input-kain-"]').each(function() {
        var currentId = $(this).attr('id');
        if (currentId) {
            var numericPart = parseInt((currentId.split('-')[3] || ''), 10);
            currentIndex = isNaN(numericPart) ? currentIndex : Math.max(currentIndex, numericPart);
        }
    });

    currentIndex++;

    // PROSES TAMBAH
    arrayIndex.forEach(warna => {
        if (warna === 0) {
            $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deleteResep('+currentIndex+')" id="delete-resep-'+warna+'-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"> <circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg< /a></li>'+
                '</ul>'+
            '</td>'+
        '<td>' +
            '<input type="hidden" value="'+warna+'" name="dataResep['+warna+']['+currentIndex+'][produk_warna]">'+
            '<select class="form-select" name="dataResep['+warna+']['+currentIndex+'][kain]" id="input-kain-'+warna+'-'+currentIndex+'" required> <option selected disabled value="">Choose...</option> @foreach ($kains as $item) <option value="{{ $item->id }}" {{ old("dataResep['+warna+']['+currentIndex+'][kain]")==$item->id ? "selected" : ""}}>{{ $item->kode_kain }} - {{ $item->nama }}</option> @endforeach </select>' +
        '</td>' +
        '<td>' +
                '<select class="form-select" name="dataResep['+warna+']['+currentIndex+'][tipe]" oninput="getTipe('+currentIndex+')" id="input-tipe-'+warna+'-'+currentIndex+'" required>' +
                    '<option selected disabled value="">Choose...</option>' +
                    '<option value="UTAMA" {{ old("dataResep['+warna+']['+currentIndex+'][tipe]")=="UTAMA" ? "selected" : "" }}>UTAMA</option>' +
                    '<option value="KOMBINASI" {{ old("dataResep['+warna+']['+currentIndex+'][tipe]")=="KOMBINASI" ? "selected" : "" }}>KOMBINASI</option>' +
                '</select>' +
        '</td>' +
        '</tr>';
        } else {
            $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);"id="delete-resep-'+warna+'-'+currentIndex+'"></svg</a></li>'+
                '</ul>'+
            '</td>'+
        '<td>' +
            '<input type="hidden" value="'+warna+'" name="dataResep['+warna+']['+currentIndex+'][produk_warna]">'+
            '<select class="form-select" name="dataResep['+warna+']['+currentIndex+'][kain]" id="input-kain-'+warna+'-'+currentIndex+'" required> <option selected disabled value="">Choose...</option> @foreach ($kains as $item) <option value="{{ $item->id }}" {{ old("dataResep['+warna+']['+currentIndex+'][kain]")==$item->id ? "selected" : ""}}>{{ $item->kode_kain }} - {{ $item->nama }}</option> @endforeach </select>' +
        '</td>' +
        '<td>' +
            '<input type="text" value="" class="form-control" name="dataResep['+warna+']['+currentIndex+'][tipe]" id="input-tipe-'+warna+'-'+currentIndex+'" readonly>' +
        '</td>' +
        '</tr>';
        }
        
        $("#tbody-"+warna).append($html);

        new TomSelect("#input-kain-" + warna + '-' + currentIndex,{
            create: true,
            sortField: {
            field: "text",
            direction: "asc"
            }
        });
    });


    function checkRequiredFields() {
        var allFieldsFilled = true;
        $('#defaultStep-four [required]').each(function () {
            if ($(this).val() === null || $(this).val() === '') {
                    allFieldsFilled = false;
                    return false;
                }
        });

        if (allFieldsFilled) {
            $('.btn-submit').prop('disabled', false);
        } else {
            $('.btn-submit').prop('disabled', true);
        }
    }

    checkRequiredFields();

    $('#defaultStep-four [required]').on('input', function () {
        checkRequiredFields();
    });
    
    });

</script>

{{-- Change Tipe --}}
<script>
    function getTipe(idx) {

        console.log(idx);

        var tipe = $('#input-tipe-0-' + idx).val();

        var arrayIndex = [];
    
        // Mnyimpan index dari warna
        $('.warna tbody tr td input[id^="input-warna-"]').each(function() {
            var currentId = $(this).attr('id');
            if (currentId) {
                var numericPart = parseInt((currentId.split('-')[2] || ''), 10);
                if (!isNaN(numericPart)) {
                    arrayIndex.push(numericPart);
                }
            }
        });

        arrayIndex.forEach(warna => {
            if (warna != 0) {
                $('#input-tipe-'+ warna + '-' + idx).val(tipe);
            }
        });
    };

</script>

{{-- Required Step 1 --}}
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
        $('#defaultStep-one [required]').on('input', function () {
            if (checkRequiredFields()) {
                $('#btn-nxt1').prop('disabled', false);
            } else {
                $('#btn-nxt1').prop('disabled', true);
            }
        });

        // Trigger change event on page load to check initial state of required fields
        $('#defaultStep-one [required]').trigger('input');
    });
</script>

{{-- Required Step 2 --}}
<script>
    $("#btn-nxt1").on("click", function() {

        function checkButtonStatus() {
            var valueWarna = true;

            $('[id^="input-warna-"]').each(function() {
                var value = $(this).val();
                if (value === "" ) {
                    valueWarna = false;
                    return false;
                }
            })
            
            if (valueWarna) {
                $('#btn-nxt2').prop('disabled', false);
            } else {
                $('#btn-nxt2').prop('disabled', true);
            }
        }

        checkButtonStatus();

        $(document).on('input', '[id^="input-warna-"]', function() {
            checkButtonStatus();
        });
    });
</script>

{{-- Required Step 3 --}}
<script>
    $("#btn-nxt2").on("click", function() {

        function checkButtonStatus() {
            var valueHarga = true;

            $('[id^="input-harga-"]').each(function() {
                var value = $(this).val();
                if (value === "" || parseInt(value) < 0) {
                    valueHarga = false;
                    return false;
                }
            });
            
            if (valueHarga === true) {
                $('#btn-nxt3').prop('disabled', false);
            } else {
                $('#btn-nxt3').prop('disabled', true);
            }
        }

        checkButtonStatus();

        $(document).on('input', '[id^="input-harga-"]', function() {
            var value = $(this).val();
            if (value < 0) {
                $(this).val(Math.abs(value));
            }

            checkButtonStatus();
        });
    });
</script>

{{-- Required Step 4 --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#defaultStep-four [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });

            if (allFieldsFilled) {
                $('.btn-submit').prop('disabled', false);
            } else {
                $('.btn-submit').prop('disabled', true);
            }
        }

        checkRequiredFields();

        $('#defaultStep-four [required]').on('input', function () {
            checkRequiredFields();
        });
    });
</script>

@endsection