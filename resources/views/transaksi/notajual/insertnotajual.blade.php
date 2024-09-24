@extends('cork.cork')

@section('title', 'Tambah Data Penjualan')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

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

<link href="{{ asset('assets/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('notajual.index') }}">Penjualan</a></li>
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
                        <div class="step" data-target="#defaultStep-one">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Produk</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#defaultStep-two">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Set Qty dan Harga</span>
                                </span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#defaultStep-three">
                            <button type="button" class="step-trigger" role="tab">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Informasi Penjualan</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form id="myForm" method="POST" action="{{ route('notajual.store') }}">
                            @csrf

                            <div id="defaultStep-one" class="content" role="tabpanel">
                                <div class="invoice-detail-items" style="padding-top: 10px">
                                    <div class="row mb-4">
                                        <h6>Kode Produk <small class="text-muted ms-2 pb-1">(Required)</small></h6>
                                    </div>
                                    <div class="produk-list">
                                        <div class="row mb-4">
                                            <div class="col-auto">
                                                <ul class="table-controls">
                                                    <li><i data-feather="x-circle"></i></li>
                                                </ul>
                                            </div>
                                            <div class="col">
                                                <select class="form-select" id="input-kode-produk-0"
                                                    name="dataProduk[0][produk_id]" 
                                                    required>
                                                    <option selected disabled value="">Choose...</option>
                                                    @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}" {{
                                                        old('dataProduk[0][produk_id]')==$produk->
                                                        id ?
                                                        'selected' : '' }}>{{ $produk->kode_produk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mb-4" style="justify-content: space-between">
                                        <div class="col-sm-2">
                                            <span class="btn btn-dark btn-tambah-produk">Add Item</span>
                                        </div>

                                    </div>

                                </div>

                                <div class="button-action text-end">
                                    <button type="button" id="btn-nxt1" class="btn btn-secondary btn-nxt">Next</button>
                                </div>

                            </div>
                            <div id="defaultStep-two" class="content" role="tabpanel">
                                <div id="area-ukuran">
                                </div>

                                <div class="button-action mt-5 text-end">
                                    <button type="button" id="btn-prv2"
                                        class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="button" id="btn-nxt2" class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-three" class="content" role="tabpanel">
                                <div class="summary layout-spacing ">
                                    <div class="widget-content widget-content-area">
                                        <div class="order-summary">
                                            <div class="summary-list summary-kode">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6><b>Kode Nota</b><span class="summary-count"
                                                                    id="kode-nota"></span></h6>
                                                            <input type="hidden" id="input-kode-nota"
                                                                name="input-kode-nota">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="summary-list summary-tgl-mulai">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6><b>Tanggal</b><span class="summary-count"
                                                                    id="tgl-transaksi"></span></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="summary-list">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6><b>Total Pcs</b><span class="summary-count"
                                                                    id="total-pcs"></span></h6>
                                                            <input type="hidden" id="input-total-pcs"
                                                                name="input-total-pcs">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="summary-list">
                                                <div class="summery-info">
                                                    <div class="w-summary-details">
                                                        <div class="w-summary-info">
                                                            <h6><b>Grand Total</b><span class="summary-count"
                                                                    id="grand-total"></span></h6>
                                                            <input type="hidden" id="input-grand-total"
                                                                name="input-grand-total">
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
                                                <div class="table-responsive">
                                                    <table class="table style-3 table-hover details">
                                                        <thead>
                                                            <tr>
                                                                <th><b>Kode Produk</b></th>
                                                                <th><b>Warna</b></th>
                                                                <th><b>Ukuran</b></th>
                                                                <th><b>Pcs</b></th>
                                                                <th class="text-end"><b>Harga</b></th>
                                                                <th class="text-end"><b>Subtotal</b></th>
                                                            </tr>

                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-action mt-5 text-end">
                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="button" class="btn btn-success" id="submitButton">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Modal Input Pembelian --}}
<div class="modal fade modal-notification" id="konfirmNotaJual" tabindex="-1" role="dialog"
    aria-labelledby="standardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" id="standardModalLabel">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="text-center" style="width: 100%; height:100%">
                    <i style="width: 50%; height: 50%; object-fit: cover; color: #F7C500;"
                        data-feather="alert-triangle"></i>
                </div>

                <H4>Apakah anda yakin?</H4>
                <H6>Setelah menambahkan data, tidak akan bisa merubah ataupun menghapus!</H6>
                <H6>Pastikan kebenaran data dengan teliti!</H6>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success mt-2 mb-2 btn-no-effect"
                    id="confirmSubmitButton">Konfirmasi</button>
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

{{-- Required Step 1 --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#defaultStep-one [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });

            if (allFieldsFilled) {
                $('#btn-nxt1').prop('disabled', false);
            } else {
                $('#btn-nxt1').prop('disabled', true);
            }
        }

        checkRequiredFields();

        $('#defaultStep-one [required]').on('input', function () {
            checkRequiredFields();
        });
    });
</script>

{{-- Required Step 2 --}}
<script>
    $("#btn-nxt1").on("click", function() {

        function checkButtonStatus() {
            var valueQty = false;
            var valueHarga = true;

            $('[id^="input-qty-"]').each(function() {
                var value = $(this).val();

                if (value !== "" && parseInt(value) > 0) {
                    valueQty = true;
                    return false;
                }
            });

            $('[id^="input-harga-"]').each(function() {
                var value = $(this).val();
                if (value < 0) {
                    $(this).val(Math.abs(value));
                }
                if (value === "" || parseInt(value) < 0) {
                    valueHarga = false;
                    return false;
                }
            });
            
            if (valueQty === true && valueHarga === true) {
                $('#btn-nxt2').prop('disabled', false);
            } else {
                $('#btn-nxt2').prop('disabled', true);
            }
        }

        checkButtonStatus();

        $(document).on('input', '[id^="input-qty-"]', function() {
            var value = $(this).val();
            if (value < 0) {
                $(this).val(Math.abs(value));
            }

            checkButtonStatus();
        });

        $(document).on('input', '[id^="input-harga-"]', function() {
            checkButtonStatus();
        });
    });
</script>

{{-- Trigger Modal Konfirmasi --}}
<script>
    $(document).ready(function() {
        $('#submitButton').click(function() {
            $('#konfirmNotaJual').modal('show');
        });

        $('#confirmSubmitButton').click(function() {
            $('#myForm').submit();
        });
  });
</script>

{{-- Delete Produk --}}
<script>
    function deletes(idx) {

        var deleteTarget = document.querySelector('#row-' + idx);
        if (deleteTarget) {
            // var row = deleteTarget.closest('tr');
            // if (row) {
            //     row.remove();
            //     $('.produk-'+idx).remove();
            // }
            deleteTarget.remove();
        }

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
        
        $('#defaultStep-one [required]').on('input', function () {
            if (checkRequiredFields()) {
                $('#btn-nxt1').prop('disabled', false);
            } else {
                $('#btn-nxt1').prop('disabled', true);
            }
        });
        
        $('#defaultStep-one [required]').trigger('input');
    }  
</script>

{{-- Tambah Produk --}}
<script>
    $(".btn-tambah-produk").on("click", function() {

        var indexItem;
        
        // Function mencari index terakhir dari input produk
        $('.produk-list input[id^="input-kode-produk-"]').each(function() {

            var id = $(this).attr('id');

            var parts = id.split('-');
            
            idx = parseInt(parts[3]);

            indexItem = idx;
        });

        indexItem++;
        
        $html = '<div class="row mb-4" id="row-'+indexItem+'">' +
            '<div class="col-auto">' +
                '<ul class="table-controls">'+
                    '<li><a href="javascript:void(0);" class="delete-item" onclick="deletes('+indexItem+')" id="delete-'+indexItem+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
                '</ul>'+
            '</div>'+
            '<div class="col">'+
                '<select class="form-select" id="input-kode-produk-'+indexItem+'" name="dataProduk['+indexItem+'][produk_id]" required>'+
                    '<option selected disabled value="">Choose...</option>'+
                    '@foreach ($produks as $produk)'+
                    '<option value="{{ $produk->id }}" {{ old("dataProduk['+indexItem+'][produk_id]")==$produk->id ? "selected" : "" }}>{{ $produk->kode_produk }}</option>'+
                    '@endforeach'+
                '</select>'+
            '</div>'+
            '</div>';
        
        $(".produk-list").append($html);

        new TomSelect("#input-kode-produk-" + indexItem,{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });


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

{{-- Btn Next 1 --}}
<script>
    function getUkuranProduk(id_warna, id_produk_warna) {

        fetch('/getUkuranProdukJual/' + id_warna)
            .then(response => response.json())
            .then(data => {

                $cekstok = false;

                data.forEach(item => {

                    if (item.stok > 0) {
                        $cekstok = true;
                        $html = '<tr>'+
                            '<td >'+
                                '<h6>'+item.nama+'</h6>'+
                                '</td>'+
                            '<td>'+
                                '<h6>'+item.stok+'</h6>'+
                                '</td>'+
                            '<td>'+
                                '<input type="number" class="form-control" min=0 max="'+item.stok+'" name="dataProduk['+id_warna+']['+item.id+'][qty_produk]" id="input-qty-'+id_warna+'-'+item.id+'">'+
                                '</td>'+
                            '<td>'+
                                '<input type="number" class="form-control" value='+item.harga+' min=0 max="'+item.harga+'" name="dataProduk['+id_warna+']['+item.id+'][harga]" id="input-harga-'+id_warna+'-'+item.id+'">'+
                                '</td>'+
                            '</tr>';
                        
                        $("#tbody-" + id_produk_warna).append($html);
                    }
                    else {
                        $cekstok = true;
                        $html = '<tr>'+
                            '<td>'+
                                '<h6>'+item.nama+'</h6>'+
                                '</td>'+
                            '<td>'+
                                '<h6><b>Habis</b></h6>'+
                                '</td>'+
                            '<td>'+
                                '</td>'+
                            '<td>'+
                                '</td>'+
                            '</tr>';
                        
                        $("#tbody-" + id_produk_warna).append($html);
                    }                 
                });

                if ($cekstok === false) {
                    $("#h5-" + id_produk_warna).append(' <b>(STOK HABIS!)</b>');
                }
                
            })
            .catch(error => console.error('Error:', error))

        // $('[id^="input-qty-"]').each(function(index, element){
        // // Getting the ID of each input element
        //     var inputId = $(element).attr('id');
        //     console.log('ID input:', inputId);
        // });

        // function checkRequiredFields() {
        //     var allFieldsFilled = true;
        //     console.log(allFieldsFilled);
        //     $('#tbody' + idx + ' tr td input').each(function () {
        //         var id = $(this).attr('id');
        //         console.log(id);
        //         if ($(this).val() === null || $(this).val() === '') {
        //             allFieldsFilled = false;
        //             return false;
        //         }
        //     });
        //     return allFieldsFilled;
        // }

        // $('#tbody' + idx + ' tr td input').on('input', function () {
        //     if (checkRequiredFields()) {
        //         $('#btn-nxt2').prop('disabled', false);
        //     } else {
        //         $('#btn-nxt2').prop('disabled', true);
        //     }
        // });

        // $('#tbody' + idx + ' tr td input').trigger('input');
    }

    $("#btn-nxt1").on("click", function() {

        $("#area-ukuran").empty();

        var checkerItem = 0;

        var array = [];

        $('.produk-list input[id^="input-kode-produk-"]').each(function() {

            var oldId = $(this).attr('id');
            var newId = oldId.replace('-ts-control', '');
            
            var value = document.getElementById(newId).value;

            array.push(value);
        })

        console.log(array);

        var uniqueArray = Array.from(new Set(array));

        console.log(uniqueArray);

        $.each(uniqueArray, function(index, value) {

            fetch('/getProdukWarnaJual/' + value)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    $html = '<div class="invoice-detail-items produk-'+value+'" style="padding-top: 30px">' +
                        '<h5 id="h5-'+item.id+'">'+item.kode_produk+' / '+item.warna+'</h5>' +
                        '<div class="table-responsive">' +
                            '<table class="table item-table">' +
                                '<thead>' +
                                    '<tr>' +
                                        '<th class="" style="width: 15%"><b>Ukuran</b></th>' +
                                        '<th class="" style="width: 20%"><b>Stok</b></th>' +
                                        '<th class="" style="width: 25%"><b>Qty</b></th>' +
                                        '<th class=""><b>Harga</b></th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody id="tbody-'+item.id+'">' +
                                '</tbody>' +
                                '</table>' +
                            '</div>' +
                        '</div>';

                    $("#area-ukuran").append($html);

                    getUkuranProduk(item.id, item.id);
                })
            })
            .catch(error => console.error('Error:', error))
            }); 
        })
</script>

{{-- Tom Select --}}
<script>
    new TomSelect("#input-kode-produk-0",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

{{-- Informasi Kode Nota --}}
<script>
    $("#btn-nxt2").on("click", function() {

        $("#tgl-transaksi").empty();
        $("#kode-nota").empty();
        $("#total-pcs").empty();
        $("#grand-total").empty();
        $(".details tbody").empty();

        fetch('/getKategori')
            .then(response => response.json())
            .then(data => {
                
                $("#tgl-transaksi").text(data.tgl);
                $("#kode-nota").text(data.invoiceCode);
                $("#input-kode-nota").val(data.invoiceCode);              
            })
            .catch(error => console.error('Error:', error));

        
        var grandtotal = 0;
        var totalpcs = 0;

        var rows = $('#area-ukuran').find('tr');
        
        rows.each(function(){

            var inputs = $(this).find('input');

            if (inputs.length === 2) {

                var subtotal;
                var pcs;
                var harga;
                var warna_id;
                var ukuran_id;

                console.log(inputs);
                
                inputs.each(function(){     

                    var id = $(this).attr('id');
                    var parts = id.split('-');

                    console.log(id);

                    warna_id = parseInt(parts[2]);
                    ukuran_id = parseInt(parts[3]);

                    var value = $(this).val();

                    if (id.includes('input-qty')) {
                        pcs = parseInt(value);
                    }
                    else {
                        harga = parseInt(value);
                    }
                }); 
                
                if (pcs > 0) {
                    subtotal = pcs * harga;
                    
                    var formattedCurrencyHarga = harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                    var formattedCurrencySubtotal = subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                    
                    fetch('/getInfoProduk/' + warna_id + '/' + ukuran_id)
                        .then(response => response.json())
                        .then(data => {
                            
                            var html = '<tr>'+
                                '<td>'+data.kode_produk+'</td>'+
                                '<td>'+data.warna+'</td>'+
                                '<td>'+data.ukuran+'</td>'+
                                '<td>'+
                                    '<input type="hidden" value='+pcs+' name="dataJual['+warna_id+']['+ukuran_id+'][qty_produk]">'+pcs+
                                    '</td>'+
                                '<td class="text-end">'+
                                    '<input type="hidden" value='+harga+' name="dataJual['+warna_id+']['+ukuran_id+'][harga]">'+
                                    formattedCurrencyHarga+
                                    '</td>'+
                                '<td class="text-end">'+
                                    '<input type="hidden" value='+subtotal+' name="dataJual['+warna_id+']['+ukuran_id+'][subtotal]">'+
                                    formattedCurrencySubtotal+
                                    '</td>'+
                                '</tr>';
                            
                            $(".details tbody").append(html);
                        })
                        .catch(error => console.error('Error:', error));
                    
                    totalpcs += pcs;
                    grandtotal += subtotal;
                }
            }
        });

        var formattedCurrencyGrandtotal = grandtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

        $("#total-pcs").text(totalpcs);
        $("#grand-total").text(formattedCurrencyGrandtotal);
        $("#input-total-pcs").val(totalpcs);
        $("#input-grand-total").val(grandtotal);
    });
</script>

@endsection