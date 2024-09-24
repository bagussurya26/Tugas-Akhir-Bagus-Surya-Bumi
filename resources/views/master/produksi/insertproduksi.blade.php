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
                        {{-- <div class="step" data-target="#defaultStep-one">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Target Produk</span>
                            </button>
                        </div>
                        <div class="line"></div> --}}
                        <div class="step" data-target="#defaultStep-one">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Target Qty</span>
                            </button>
                        </div>
                        <div class="line"></div>
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
                                <span class="bs-stepper-label">Assign Potong Kain</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form method="POST" action="{{ route('produksi.store') }}">
                            @csrf

                            {{-- <div id="defaultStep-one" class="content" role="tabpanel">

                                <div class="row mb-4">
                                    <div class="col-4">
                                        <label>Kode Produk <small
                                                class="text-muted ms-2 pb-1">(Required)</small></label>
                                        <div class="col-sm-12">
                                            <select class="form-select" id="input-produk" name="produk_id"
                                                oninput="namaUkuran()" autocomplete="off" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}" {{ old('produk_id')==$produk->
                                                    id ?
                                                    'selected' : '' }}>{{ $produk->kode_produk }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Nama Produk</label>
                                        <div class="col-sm-12">
                                            <input type="text" value="{{ old('nama_produk') }}" class="form-control"
                                                name="nama_produk" id="input-nama-produk" readonly>
                                        </div>

                                    </div>
                                </div>

                                <div class="button-action mt-5 text-end">
                                    <button type="button" id="btn-nxt1" class="btn btn-secondary btn-nxt">Next</button>
                                </div>

                            </div> --}}

                            <div id="defaultStep-one" class="content" role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Kode Produk - Nama Produk<small class="text-muted ms-2 pb-1">(Required)</small></label>
                                        <div class="col-sm-12">
                                            <select class="form-select" id="input-produk" name="produk_id" oninput="informasiTarget()" autocomplete="off"
                                                required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}" {{ old('produk_id')==$produk->
                                                    id ?
                                                    'selected' : '' }}>{{ $produk->kode_produk }} - {{ $produk->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="area-target">
                                </div>

                                <div class="button-action mt-5 text-end">
                                    {{-- <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button> --}}
                                    <button type="button" id="btn-nxt1" class="btn btn-secondary btn-nxt" disabled>Next</button>
                                </div>

                            </div>

                            <div id="defaultStep-two" class="content" role="tabpanel">

                                <div class="summary layout-spacing ">
                                    <div class="widget-content widget-content-area">
                                        <div class="order-summary">
                                            <div class="summary-list summary-kode">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6>Kode Produksi<span class="summary-count"
                                                                    id="kode-produksi"></span></h6>
                                                                    <input type="hidden" name="kode-produksi" id="input-kode-produksi">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="summary-list summary-tgl-mulai">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6>Tanggal Mulai<span class="summary-count"
                                                                    id="tgl-mulai-produksi"></span></h6>
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
                                                    <h6 id="kode-produk-target">Target Produk</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table style-3 table-hover">
                                                        <thead>
                                                            <tr id="th-warna-produk">
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="td-ukuran-produk">
                                                            </tr>
                                                            <tr id="td-qty-produk">
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
                                                    <h6 class="">Estimasi Penggunaan Kain Utama</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table style-3 table-hover">
                                                        <thead>
                                                            <tr id="th-kode-kain">
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="td-qty-kain">
                                                            </tr>
                                                            <tr id="td-avg-kain">
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="d-flex justify-content-between" id="rata-rata">
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between" id="list-ukuran">
                                                
                                                </div>
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
                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="button" id="btn-nxt2" class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>

                            <div id="defaultStep-three" class="content" role="tabpanel">

                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Karyawan <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                        <div class="col-sm-12">
                                            <select class="form-select" id="input-karyawan" name="karyawan_id"
                                                autocomplete="off" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($karyawans as $karyawan)
                                                <option value="{{ $karyawan->id }}" {{ old('karyawan_id')==$karyawan->
                                                    id ?
                                                    'selected' : '' }}>{{ $karyawan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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

{{-- Required Step 1 dan 3 --}}
<script>
    
    // Step 1
    $(document).ready(function () {
        function checkNonZeroValues() {
            var nonZeroValue = false;
            $('[id^="input-qty-"]').each(function () {
                var value = $(this).val();
                if (value > 0) {
                    nonZeroValue = true;
                    return false;
                }
            });
            
            if (nonZeroValue) {
                $('#btn-nxt1').prop('disabled', false);
            } else {
                $('#btn-nxt1').prop('disabled', true);
            }
        }

        checkNonZeroValues();

        $(document).on('input', '[id^="input-qty-"]', function () {
            var value = $(this).val();

            if (value < 0) {
                $(this).val(Math.abs(value));
            }
            else{
                $(this).val(Math.round(value));
            }

            checkNonZeroValues();
        });

        $(document).on('input', '[id^="input-produk"]', function () {
            checkNonZeroValues();
        });
    });

    // Step 3
    $(document).ready(function () {
        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#defaultStep-three [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') 
                {
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

        $('#defaultStep-three [required]').on('input change', function () {
            checkRequiredFields();
        });
    });

</script>

{{-- Get Nama, Warna, Ukuran Produk --}}
<script>
    function informasiTarget() {
        updateNamaProduk();
        getWarnaProduk();
    }

    function updateNamaProduk() {
        
        var selectedIdProduk = document.getElementById("input-produk").value;
        var selectedKodeProduk = getKodeProduk(selectedIdProduk);
        var idproduksi = getCountProduksi();
        

        $("#kode-produksi").empty();
        $("#kode-produk-target").empty();
        $("#input-kode-produksi").val("");

        var now = new Date();
        var formattedDate = now.getFullYear();
        var lastTwoDigits = formattedDate % 100;

        var kodeProduksi = lastTwoDigits + '/' + (idproduksi+1) + '/' + selectedKodeProduk;

        $("#kode-produksi").text(kodeProduksi);
        $("#input-kode-produksi").val(kodeProduksi);
        $("#kode-produk-target").text('Target Produk ' + selectedKodeProduk);
    }

    function getKodeProduk(id) {
        var produks = @json($produks);
        var selectedProduk = produks.find(produk => produk.id == id);
        
        return selectedProduk ? selectedProduk.kode_produk : '';
    }

    function getCountProduksi() {
        var produksis = @json($produksis);
        var count = produksis.length;
        return count;
    }

    function getWarnaProduk() {
        var selectedId = document.getElementById("input-produk").value;
        $("#area-target").empty();
        fetch('/getWarnaProduk/' + selectedId)
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {

                    var html = '<div class="invoice-detail-items target-'+ item.id +'" style="padding-top: 10px">' +
                        '<h5 id="warna-produk-'+ item.id +'">'+item.warna+'</h5>' +
                        '<div class="table-responsive">' +
                            '<table class="table item-table target-produk">' +
                                '<thead>' +
                                    '<tr>' +
                                        '<th class="text-center" style="width:10%">Ukuran</th>' +
                                        '<th class="">Qty (Pcs)</th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody id="tbody-'+ item.id +'">' +
                                '</tbody>' +
                            '</table>' +
                        '</div>' +
                        '</div>';
                    
                    $("#area-target").append(html);

                    getUkuranProduk(item.id);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    function getUkuranProduk(id) {
        fetch('/getUkuranProduk/' + id)
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {

                    $html = '<tr>' +
                            '<td class="text-center">'+
                                '<h6>'+item.nama+'</h6>' +
                            '</td>'+
                            '<td>'+
                                '<input type="number" min="0" id="input-qty-'+item.id+'" class="form-control">'+
                            '</td>'+
                        '</tr>';
    
                    $("#tbody-" + id).append($html);
                });
            })
            .catch(error => console.error('Error:', error));          
    }
</script>

{{-- Target produk dan Estimasi Kain --}}
<script>
    $("#btn-nxt1").on("click", function() {
        var resultArray = [];

        $("#th-warna-produk").empty();
        $("#td-ukuran-produk").empty();
        $("#td-qty-produk").empty();
        $("#tgl-mulai-produksi").empty();

        // TANGGAL PRODUKSI
        var now = new Date();
        var formattedDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var formattedTime = (hours < 10 ? '0' : '' ) + hours + ':' + (minutes < 10 ? '0' : '' ) + minutes + ':' + (seconds < 10 ? '0' : '' ) + seconds; 
        var timestamp=formattedDate + ' ' + formattedTime; 
            
        $("#tgl-mulai-produksi").text(timestamp);

        // ===============================================
        
        $("#th-warna-produk").append('<th>Warna</th>');
        $("#td-ukuran-produk").append('<td>Ukuran</td>');
        $("#td-qty-produk").append('<td>Qty (Pcs)</td>');
        
        $('input[type="number"]').each(function(index) {
            var id = $(this).attr('id');
            var qty = $(this).val();

            // console.log(id);

            // var match = id.match(/(\d+)-(\d+)$/);
            // Diatas kalo input-qty-1-1

            var produk_ukuran_id = id.split('-').pop();

            // console.log(produk_ukuran_id);

            var produkukurans = getProdukUkuran(produk_ukuran_id);

            // console.log(produkukurans);

            if (qty != 0) {
                var obj = {
                    "produk_ukuran_id": produk_ukuran_id,
                    "qty": qty
                };

                resultArray.push(obj);
                
                $("#th-warna-produk").append('<th class="text-center">'+produkukurans[0].warna+'</th>');
                $("#td-ukuran-produk").append('<td class="text-center">'+produkukurans[0].nama+'</td>');
                $("#td-qty-produk").append('<td class="text-center">'+qty+'</td>'+'<input type="hidden" name="dataTarget['+produk_ukuran_id+']" value="'+qty+'">');
            }
            
        });

        // Estimasi Kebutuhan

        var arrEstimasiKain = [];

        // console.log(resultArray);

        $("#rata-rata").empty();
        $("#list-ukuran").empty();

        var cekM = 0;
        var cekL = 0;
        var cekXL = 0;
        var cek2XL = 0;
        var cek3XL = 0;
        var cek4XL = 0;

        resultArray.forEach(element => {

            console.log(resultArray);
            
            var reseps = getResep(element.produk_ukuran_id);

            $.ajax({
                url: '/getAvgQty/' + element.produk_ukuran_id,
                type: 'GET',
                success: function(response) {

                console.log(reseps);

                reseps.forEach(data => {

                    if (data.tipe === 'UTAMA') {

                        var estimQty = element.qty * response.avgQty;
                        estimQty = Number(estimQty.toFixed(2));

                            arrEstimasiKain.push({"produk_ukuran_id": element.produk_ukuran_id, "id_kain": data.kain_id, "kode_kain": data.kode_kain, "estimQty":  estimQty, "avgQty": response.avgQty}); 
                    }
                });

                displayEstimasi(arrEstimasiKain);

                },
                error: function(xhr, status, error) {
                console.error('Error:', error);
                }
            });
        });

        function displayEstimasi(array) {
            $("#th-kode-kain").empty();
            $("#td-qty-kain").empty();
            $("#td-avg-kain").empty();

            $("#th-kode-kain").append('<th>Kode Kain</th>');
            $("#td-qty-kain").append('<td>Qty (Meter)</td>');
            $("#td-avg-kain").append('<td>Rata-rata (Meter)</td>');

            array.forEach(data => {
                $("#th-kode-kain").append('<th class="text-center"><b>'+data.kode_kain+'</b></th>');
                $("#td-qty-kain").append('<td class="text-center">'+data.estimQty+'</td>'+'<input type="hidden" name="dataKain['+data.produk_ukuran_id+']['+data.id_kain+']" value="'+data.estimQty+'">');
                $("#td-avg-kain").append('<td class="text-center">'+data.avgQty+'</td>');
            });
        }
   
    })

    function getResep(id) {
        var reseps = @json($reseps);
        var selectedKain = reseps.filter(data => data.id == id);
        
        return selectedKain ? selectedKain : '';
    }


    function getProdukUkuran(id) {
        var produkukuran = @json($produkukurans);
        var selectedData = produkukuran.filter(data => data.id == id);
        
        return selectedData ? selectedData : '';
    }
</script>

{{-- Tom Select --}}
<script>
    new TomSelect("#input-produk",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect("#input-karyawan",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

@endsection