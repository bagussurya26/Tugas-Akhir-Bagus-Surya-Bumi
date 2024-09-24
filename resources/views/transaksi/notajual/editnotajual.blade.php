@extends('cork.cork')

@section('title', 'Ubah Data Penjualan')

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
            <li class="breadcrumb-item"><a href="{{ route('notajual.index') }}">Penjualan</a></li>
            <li class="breadcrumb-item">{{ $penjualans->kode_nota }}</li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" class="row g-3" method="POST"
        action="{{ route('notajual.update', $penjualans->id) }}">
        @csrf
        @method("PUT")

        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Nota</label>
                            <input type="text" value="{{ $penjualans->kode_nota }}"
                                class="form-control @error('kode_nota') is-invalid @enderror" name="kode_nota"
                                placeholder="Masukkan kode..." autofocus required>
                            @error('kode_nota')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Pesan</label>
                            <input
                                class="form-control flatpickr flatpickr-input active @error('tgl_pesan') is-invalid @enderror"
                                id="tanggal_pesan" name="tgl_pesan" type="text" value="{{ $penjualans->tgl_pesan }}"
                                placeholder="Input tanggal..." required>
                            @error('tgl_pesan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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
                                <th class="">Kode Produk</th>
                                <th class="">Ukuran</th>
                                <th class="">Qty</th>
                                <th class="">Harga</th>
                                <th class="">Subtotal</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            @foreach ($detailNotaJual as $index => $detailPenjualan)
                            <tr>
                                <td class="delete-item-row">
                                    <ul class="table-controls">
                                        <li><a href="javascript:void(0);" onclick="deletes({{ $index }}, {{ $penjualans->id }})"
                                                id="delete-{{ $index }}" class="delete-item" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete"><i
                                                    data-feather="x-circle"></i></a></li>
                                    </ul>
                                </td>
                                <td>
                                    {{-- <select class="form-select" id="input-kode-produk-{{ $index }}"
                                        name="dataProduk[{{ $index }}][produk_id]"
                                        oninput="getUkuranProduk({{ $index }})" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($produks as $produk)
                                        <option value="{{ $produk->id }}" {{ $detailPenjualan['up_produk_id']==$produk->
                                            id
                                            ?
                                            'selected' : '' }}>{{ $produk->kode_produk }}</option>
                                        @endforeach
                                    </select> --}}
                                    <input type="text" value="{{ $detailPenjualan['kode_produk'] }}"
                                        id="input-kode-produk-{{ $index }}" class="form-control"
                                        name="dataProduk[{{ $index }}][produk_id]" readonly>
                                </td>
                                <td width="200px">
                                    {{-- <select class="form-select" id="input-ukuran-produk-{{ $index }}"
                                        name="dataProduk[{{ $index }}][ukuran_id]"
                                        oninput="getHargaProduk({{ $index }})" required>
                                    </select> --}}
                                    <input type="text" value="{{ $detailPenjualan['nama_ukuran'] }}"
                                        id="input-ukuran-produk-{{ $index }}" class="form-control"
                                        name="dataProduk[{{ $index }}][ukuran_id]" readonly>
                                </td>
                                <td width="130px">
                                    <input type="number" value="{{ $detailPenjualan['qty_produk'] }}"
                                        id="input-qty-produk-{{ $index }}" class="form-control"
                                        name="dataProduk[{{ $index }}][qty_produk]" readonly>
                                </td>
                                <td width="180px">
                                    <input type="text" value="{{ $detailPenjualan['harga'] }}"
                                        id="input-harga-{{ $index }}" class="form-control"
                                        name="dataProduk[{{ $index }}][harga]" dir="rtl" readonly>
                                </td>
                                <td width="200px">
                                    <input type="text" value="{{ $detailPenjualan['subtotal'] }}"
                                        id="input-subtotal-{{ $index }}" class="form-control"
                                        name="dataProduk[{{ $index }}][subtotal]" dir="rtl" placeholder="0" readonly>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="row mb-4" style="justify-content: space-between">
                    <div class="col-sm-2">
                        <span class="btn btn-dark additemproduk">Add Item</span>
                    </div>

                    <div class="col-sm-3" style="align-item: right">
                        <div class="row" style="justify-content: start">
                            <div class="col-sm-3">
                                <label>Total Qty</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" id="input-total-qty" name="total_qty" type="text"
                                    value="{{ $penjualans->total_qty }}" placeholder="0" readonly>
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
                                    value="{{ $penjualans->grand_total }}" dir="rtl" placeholder="0" readonly>
                            </div>
                        </div>
                    </div>
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
    function deletes(idx) {
        var deleteItem = document.querySelector('#delete-' + idx); 
        if (deleteItem) {
        var row = deleteItem.closest('tr');
        
        // Remove the row if it exists
        if (row) {
            handleTotalQtyDelete(idx);
            row.remove();
        }
    }
    }

    var rowCount = $('.data-produk tbody tr').length;
    
    var currentIndex = rowCount;
    
    document.getElementsByClassName('additemproduk')[0].addEventListener('click', function () {

    currentIndex++;
    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deletes('+currentIndex+')" id="delete-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
            '</ul>'+
        '</td>'+
        '<td>'+
            '<select class="form-select" id="input-kode-produk-'+currentIndex+'" name="dataProduk['+currentIndex+'][produk_id]" oninput="getUkuranProduk('+currentIndex+')" required>'+
                '<option selected disabled value="">Choose...</option>'+
                '@foreach ($produks as $produk)'+
                '<option value="{{ $produk->id }}" {{ old("dataProduk['+currentIndex+'][produk_id]")==$produk->id ? "selected" : "" }}>{{ $produk->kode_produk }}</option>'+
                '@endforeach'+
            '</select>'+
        '</td>'+
        '<td width="200px">'+
            '<select class="form-select" id="input-ukuran-produk-'+currentIndex+'" name="dataProduk['+currentIndex+'][ukuran_id]" oninput="getHargaProduk('+currentIndex+')" required>'+
            '</select>'+
        '</td>'+
        '<td width="130px">'+
            '<input type="number" value="{{ old("dataProduk['+currentIndex+'][qty_produk]") }}" id="input-qty-produk-'+currentIndex+'" class="form-control"'+
                'name="dataProduk['+currentIndex+'][qty_produk]" oninput="handleFunctions('+currentIndex+')" required>'+
        '</td>'+
        '<td width="180px">'+
            '<input type="text" value="{{ old("dataProduk['+currentIndex+'][harga]") }}" id="input-harga-'+currentIndex+'" class="form-control"'+
                'name="dataProduk['+currentIndex+'][harga]" oninput="handleFunctions('+currentIndex+')" dir="rtl"'+
                'required>'+
        '</td>'+
        '<td width="200px">'+
            '<input type="text" value="{{ old("dataProduk['+currentIndex+'][subtotal]") }}" id="input-subtotal-'+currentIndex+'" class="form-control"'+
                'name="dataProduk['+currentIndex+'][subtotal]" dir="rtl" placeholder="0" readonly>'+
        '</td>'+
        '</tr>';
    
        // console.log($html);
    
    $(".data-produk tbody").append($html);
    currentIndex++;
    // deleteItemRow();

    });
</script>

<script>
    var tglPesan = flatpickr(document.getElementById('tanggal_pesan'), {
    });
</script>

<script>
    function handleFunctions(index) {
        handleTotalQty(index);
        handleInputSubtotal(index);
    }

    var rowCount = $('.data-produk tbody tr').length;
    
    var previousQty = [];
    
    for (let index = 0; index < rowCount; index++) 
    { 
        var qtyInput = document.getElementById('input-qty-produk-' + index);
        var qty = Number(qtyInput.value);
        previousQty[index] = qty;
    }
    
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

    for (let index = 0; index < rowCount; index++) 
    { 
        var subtotalInput=document.getElementById('input-subtotal-' + index);
        var subtotal=Number(subtotalInput.value); previousSubtotal[index]=subtotal; 
    }

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

    // for (let index = 0; index < rowCount; index++) 
    // { 
    //     getUkuranProduk(index); 
    // }

    function getUkuranProduk(idx) {
    var kode = document.getElementById("input-kode-produk-" + idx).value
    fetch('/getUkuranProduk/' + kode)
        .then(response => response.json())
        .then(data => {
            console.log('test')
            let ukuranProduk = document.getElementById("input-ukuran-produk-" + idx);
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

    function getHargaProduk(idx) {
    var kode = document.getElementById("input-kode-produk-" + idx).value
    var ukuran = document.getElementById("input-ukuran-produk-" + idx).value
    fetch('/getHargaProduk/' + kode + '/' + ukuran)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            let hargaProduk = document.getElementById("input-harga-" + idx);
            hargaProduk.innerHTML = '';

            data.forEach(ukuranproduk => {

                let myNumberInput = document.getElementById("input-qty-produk-" + idx);
                myNumberInput.min = 1;
                myNumberInput.max = ukuranproduk.stok;

                hargaProduk.value = ukuranproduk.harga;

                handleFunctions(idx);
            });
        })
        .catch(error => console.error('Error:', error));
    }
</script>

@endsection