@extends('cork.cork')

@section('title', 'Tambah Data Penjualan')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

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

<div class="row mb-4 page-meta layout-spacing">
    <form enctype="multipart/form-data" method="POST" action="{{ route('notajual.store') }}">
        @csrf
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    {{-- <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kategori Produk<small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" id="kategori" name="kategori" oninput="getKategori()" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori')==$kategori->id ?
                                    'selected' : '' }}>{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Nota</label>
                            <h5 id="kode_nota" name="kode_nota"></h5>
                            <input type="hidden" name="kode_nota_input" value="" id="kode_nota_input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Detail Penjualan</h5>
                <div class="table-responsive">
                    <table class="table item-table data-produk">
                        <thead>
                            <tr>
                                <th class=""></th>
                                <th class="">Kode Produk <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="" style="width: 15%">Warna <small
                                        class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="" style="width: 20%">Ukuran <small
                                        class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="" style="width: 13%">Qty <small
                                        class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="" style="width: 15%">Harga <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="">Subtotal</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="delete-item-row"></td>
                                <td>
                                    <select class="form-select" id="input-kode-produk-0" name="dataProduk[0][produk_id]"
                                        oninput="getWarnaProduk(0)" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($produks as $produk)
                                        <option value="{{ $produk->id }}" {{ old('dataProduk[0][produk_id]')==$produk->
                                            id ?
                                            'selected' : '' }}>{{ $produk->kode_produk }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" id="input-warna-produk-0" name="dataProduk[0][warna_id]"
                                        oninput="getUkuranProduk(0)" required>
                                        <option selected disabled value="">Choose...</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" id="input-ukuran-produk-0"
                                        name="dataProduk[0][ukuran_id]" oninput="getHargaProduk(0)" required>
                                        <option selected disabled value="">Choose...</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" value="{{ old('dataProduk[0][qty_produk]') }}"
                                        id="input-qty-produk-0" class="form-control" name="dataProduk[0][qty_produk]"
                                        oninput="handleFunctions(0)"  required>
                                </td>
                                <td>
                                    <input type="number" value="{{ old('dataProduk[0][harga]') }}" id="input-harga-0"
                                        class="form-control" name="dataProduk[0][harga]" oninput="handleFunctions(0)"
                                         required>
                                </td>
                                <td>
                                    <input type="text" value="{{ old('dataProduk[0][subtotal]') }}"
                                        id="input-subtotal-0" class="form-control" name="dataProduk[0][subtotal]"
                                        dir="rtl" placeholder="0" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="row mb-4" style="justify-content: space-between">
                    <div class="col-sm-2">
                        <span class="btn btn-dark btn-tambah-produk">Add Item</span>
                    </div>

                    <div class="col-sm-3" style="align-item: right">
                        <div class="row" style="justify-content: start">
                            <div class="col-sm-3">
                                <label>Total Qty</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" id="input-total-qty" name="total_qty" type="text"
                                    value="{{ old('total_qty') }}" placeholder="0" readonly>
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
                                    value="{{ old('grand_total') }}" dir="rtl" placeholder="0" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-end">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>

            </div>
    </form>
</div>

@endsection

@section('js')

<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>

{{-- Pertotalan --}}
<script>
    function handleFunctions(index) {
        handleTotalQty(index);
        handleInputSubtotal(index);
    }

    var previousQty = [];
    
    function handleTotalQty(idx) {
        var totalQtyInput = document.getElementById('input-total-qty');
        var qtyProdukInput = document.getElementById('input-qty-produk-' + idx);
        
        var currentQty = Number(qtyProdukInput.value);
        var prevQty = previousQty[idx] || 0;

        var newTotalQty = Number(totalQtyInput.value) - prevQty + currentQty;

        totalQtyInput.value = newTotalQty;

        previousQty[idx] = currentQty;
    }

    var previousSubtotal = [];

    function handleInputSubtotal(idx) {
        var qtyInput = document.getElementById("input-qty-produk-" + idx);
        var hargaInput = document.getElementById("input-harga-" + idx);
        var subtotalInput = document.getElementById('input-subtotal-' + idx);
        var grandTotalInput = document.getElementById('input-grand-total');

        var qty = Number(qtyInput.value);
        var harga = Number(hargaInput.value);
        var subtotal = harga * qty;

        subtotalInput.value = subtotal;

        var previousSubtotalValue = previousSubtotal[idx] || 0;
        var newGrandTotal = Number(grandTotalInput.value) - previousSubtotalValue + subtotal;

        grandTotalInput.value = newGrandTotal;

        previousSubtotal[idx] = subtotal;
    }

    function handleTotalQtyDelete(idx) {
        var totalQtyInput = document.getElementById('input-total-qty');
        var qtyProdukInput = document.getElementById('input-qty-produk-' + idx);
        
        var currentQty = Number(qtyProdukInput.value);
        
        var newTotalQty = Number(totalQtyInput.value) - currentQty;
        
        totalQtyInput.value = newTotalQty;

        handleGrandTotalDelete(idx);
    }

    function handleGrandTotalDelete(idx) {
        var subtotalInput = document.getElementById('input-subtotal-' + idx);
        var grandTotalInput = document.getElementById('input-grand-total');

        var newGrandTotal = Number(grandTotalInput.value) - Number(subtotalInput.value);

        grandTotalInput.value = newGrandTotal;
    }

    function getWarnaProduk(idx) {
        var kode = document.getElementById("input-kode-produk-" + idx).value
        fetch('/getProdukWarnaJual/' + kode)
        .then(response => response.json())
        .then(data => {
            // console.log('test')
            let warnaProduk = document.getElementById("input-warna-produk-" + idx);
            warnaProduk.innerHTML = '';
            
            let option = document.createElement('option');
                option.text = "Select...";
                option.value = "";
                warnaProduk.appendChild(option);

            data.forEach(item => {
                let option = document.createElement('option');
                option.text = item.warna;
                option.value = item.id;
                warnaProduk.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
    }

    function getUkuranProduk(idx) {
        var warna_id = document.getElementById("input-warna-produk-" + idx).value
        fetch('/getUkuranProdukJual/' + warna_id)
        .then(response => response.json())
        .then(data => {
            // console.log('test')
            let ukuranProduk = document.getElementById("input-ukuran-produk-" + idx);
            ukuranProduk.innerHTML = '';
            
            let harga = document.getElementById("input-harga-" + idx);
            harga.value= '';
            
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

    function getHargaProduk(idx) {
        var warna_id = document.getElementById("input-warna-produk-" + idx).value
        var ukuran = document.getElementById("input-ukuran-produk-" + idx).value
        fetch('/getHargaProduk/' + warna_id + '/' + ukuran)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            let hargaProduk = document.getElementById("input-harga-" + idx);
            hargaProduk.innerHTML = '';

            data.forEach(item => {

                let myNumberInput = document.getElementById("input-qty-produk-" + idx);
                myNumberInput.innerHTML = '';
                
                if (item.stok == 0) {
                    myNumberInput.min = 0;
                }
                else{
                    myNumberInput.min = 1;
                }
                
                myNumberInput.max = item.stok;

                hargaProduk.value = item.harga;

                handleFunctions(idx);
            });
        })
        .catch(error => console.error('Error:', error));
    }

</script>

{{-- Generate Kode --}}
<script>
    $(document).ready(function () {
        // function getKategori() {
        // var kategori_id = document.getElementById("kategori").value
        fetch('/getKategori')
        .then(response => response.json())
        .then(data => {
            // console.log(data);

            // let produk = document.getElementById("input-kode-produk-0");
            // produk.innerHTML = '';

            // let ukuran = document.getElementById("input-ukuran-produk-0");
            // ukuran.innerHTML = '';

            // let harga = document.getElementById("input-harga-0");
            // harga.value = '';

            let kode_nota = document.getElementById("kode_nota");
            // kode_nota.innerText = '';

            // let option = document.createElement('option');
            // option.text = "Select...";
            // option.value = "";
            // produk.appendChild(option);

            // data.produks.forEach(produks => {
            //     let option = document.createElement('option');
            //     option.text = produks.kode_produk;
            //     option.value = produks.id;
            //     produk.appendChild(option);
            // });

            let invoiceCode = data;

            kode_nota.innerText = invoiceCode;
            document.getElementById("kode_nota_input").value = invoiceCode;
        })
        .catch(error => console.error('Error:', error));
    // }
    })
</script>

{{-- Delete Produk --}}
<script>
    function deletes(idx) {

        var deleteTarget = document.querySelector('#delete-' + idx);
        if (deleteTarget) {
            var row = deleteTarget.closest('tr');
            if (row) {
                row.remove();
            }
        }

        handleFunctions(idx);
    }  
</script>

{{-- Tambah Produk --}}
<script>
    var currentIndex = 1;
    
    $(".btn-tambah-produk").on("click", function() {
    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deletes('+currentIndex+')" id="delete-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
            '</ul>'+
        '</td>'+
        '<td>'+
            '<select class="form-select" id="input-kode-produk-'+currentIndex+'" name="dataProduk['+currentIndex+'][produk_id]" oninput="getWarnaProduk('+currentIndex+')" required>'+
                '<option selected disabled value="">Choose...</option>'+
                '@foreach ($produks as $produk)'+
                '<option value="{{ $produk->id }}" {{ old("dataProduk['+currentIndex+'][produk_id]")==$produk->id ? "selected" : "" }}>{{ $produk->kode_produk }}</option>'+
                '@endforeach'+
            '</select>'+
        '</td>'+
        '<td>'+
            '<select class="form-select" id="input-warna-produk-'+currentIndex+'" name="dataProduk['+currentIndex+'][warna_id]" oninput="getUkuranProduk('+currentIndex+')" required>'+
                '<option selected disabled value="">Choose...</option>'+
            '</select>'+
        '</td>'+
        '<td>'+
            '<select class="form-select" id="input-ukuran-produk-'+currentIndex+'" name="dataProduk['+currentIndex+'][ukuran_id]" oninput="getHargaProduk('+currentIndex+')" required>'+
                '<option selected disabled value="">Choose...</option>'+
            '</select>'+
        '</td>'+
        '<td>'+
            '<input type="number" value="{{ old("dataProduk['+currentIndex+'][qty_produk]") }}" id="input-qty-produk-'+currentIndex+'" class="form-control"'+
                'name="dataProduk['+currentIndex+'][qty_produk]" oninput="handleFunctions('+currentIndex+')"  required>'+
        '</td>'+
        '<td>'+
            '<input type="number" value="{{ old("dataProduk['+currentIndex+'][harga]") }}" id="input-harga-'+currentIndex+'" class="form-control"'+
                'name="dataProduk['+currentIndex+'][harga]" oninput="handleFunctions('+currentIndex+')"  required>'+
        '</td>'+
        '<td>'+
            '<input type="text" value="{{ old("dataProduk['+currentIndex+'][subtotal]") }}" id="input-subtotal-'+currentIndex+'" class="form-control"'+
                'name="dataProduk['+currentIndex+'][subtotal]" dir="rtl" placeholder="0" readonly>'+
        '</td>'+
        '</tr>';
    
        console.log($html);
    
    $(".data-produk tbody").append($html);

    new TomSelect("#input-kode-produk-" + currentIndex,{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    currentIndex++;

    });
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

@endsection