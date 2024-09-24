@extends('cork.cork')

@section('title', 'Ubah Data Pembelian')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/elements/alert.css') }}">
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('notabeli.index') }}">Pembelian</a></li>
            <li class="breadcrumb-item">{{ $pembelians->kode_nota }}</li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" class="row g-3" method="POST"
        action="{{ route('notabeli.update', $pembelians->id) }}">
        @csrf
        @method("PUT")

        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Nota</label>
                            <input type="text" value="{{ $pembelians->kode_nota }}" class="form-control"
                                name="kode_nota" placeholder="Masukkan kode..." readonly>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Supplier</label>
                            <input type="text" value="{{ $pembelians->suppliers->nama }}" class="form-control"
                                name="supplier_id" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Karyawan</label>
                            <input type="text" value="{{ $pembelians->karyawans->nama }}" class="form-control"
                                name="karyawan_id" readonly>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Satuan</label>
                            <input type="text" value="{{ $pembelians->satuan }}" class="form-control" name="satuan" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Pesan</label>
                            <input class="form-control" name="tgl_pesan" type="text"
                                value="{{ $pembelians->tgl_pesan }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Terima</label>
                            <input class="form-control" name="tgl_terima" type="text"
                                value="{{ $pembelians->tgl_terima }}" placeholder="Input tanggal..." {{
                                $pembelians->status!='Belum Terima'
                            ? 'readonly' : 'id=tanggal_terima' }}>
                        </div>
                    </div>

                    {{-- <div class="col">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Bayar</label>
                            <input class="form-control" name="tgl_bayar" type="text"
                                value="{{ $pembelians->tgl_bayar }}" placeholder="Input tanggal..." {{
                                $pembelians->status=='Selesai'
                            ? 'readonly' : 'id=tanggal_bayar' }}>
                        </div>
                    </div> --}}

                    
                </div>

                @if ($pembelians->foto != null || $pembelians->foto != "")
                <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4" role="alert">
                    <strong>{{ $pembelians->foto }}</strong> Silahkan memberikan foto pada input di bawah jika ingin
                    mengganti foto.</button>
                </div>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    <strong>Foto Nota belum ada!</strong> Silahkan memberikan foto pada input di bawah.
                </div>
                @endif

                <div class="row mb-4">
                    <div class="col">
                        <label>Upload Foto</label>
                        <div class="col-sm-12">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Keterangan</label>
                        <textarea class="form-control" value="{{ $pembelians->keterangan }}" rows="3"
                            placeholder="Keterangan" name="keterangan"></textarea>
                    </div>
                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Detail Kain</h5>
                <div class="table-responsive">
                    <table class="table item-table data-kain">
                        <thead>
                            <tr>
                                {{-- @if ($pembelians->status != 'Selesai')
                                <th class=""></th>
                                @endif --}}
                                <th class="">Kode Kain</th>

                                @if ($pembelians->status =='Belum Terima')
                                <th class="">Qty Roll <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="">Panjang <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                @else
                                <th class="">Qty Roll</th>
                                <th class="">Panjang</th>
                                @endif

                                <th class="">Total Panjang</th>

                                @if ($pembelians->status =='Belum Terima')
                                <th class="">Harga Satuan <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                @else
                                <th class="">Harga Satuan</th>
                                @endif
                                <th class="">Subtotal</th>
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            @foreach ($detailNotaBeli as $index => $detailPembelian)
                            <tr>
                                {{-- @if ($pembelians->status != 'Selesai')
                                <td class="delete-item-row">
                                    <ul class="table-controls">
                                        <li><a href="javascript:void(0);" onclick="deletes({{ $index }})"
                                                id="delete-{{ $index }}" class="delete-item" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete"><i
                                                    data-feather="x-circle"></i></a></li>
                                    </ul>
                                </td>
                                @endif --}}
                                <td>
                                    {{-- <select class="form-select" id="input-kode-kain-{{ $index }}"
                                        name="dataKain[{{ $index }}][kain_id]" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($kains as $kain)
                                        <option value="{{ $kain->id }}" {{ $detailPembelian['kain_id']==$kain->id ?
                                            'selected' : '' }}>{{ $kain->kode_kain }}</option>
                                        @endforeach
                                    </select> --}}
                                    <input type="text" value="{{ $detailPembelian['kode_kain'] }}" class="form-control"
                                        readonly>
                                    <input type="hidden" value="{{ $detailPembelian['kain_id'] }}" class="form-control"
                                        name="dataKain[{{ $index }}][kain_id]" readonly>
                                </td>
                                <td width="130px">
                                    <input type="number" value="{{ $detailPembelian['qty_roll'] }}"
                                        id="input-qty-roll-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][qty_roll]" oninput="handleFunctions({{ $index }})"
                                        min=1 {{ $pembelians->status=='Belum Terima' ? 'required'
                                        : 'readonly' }}>
                                </td>
                                <td width="150px">
                                    <input type="number" value="{{ $detailPembelian['panjang'] }}"
                                        id="input-panjang-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][panjang]" oninput="handleFunctions({{ $index }})"
                                        step="0.01" min="1" {{ $pembelians->status=='Belum Terima' ? 'required'
                                        : 'readonly' }}>
                                </td>
                                <td width="150px">
                                    <input type="text" value="{{ $detailPembelian['total_panjang'] }}"
                                        id="input-total-panjang-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][total_panjang]" placeholder="0"
                                        oninput="handleFunctions({{ $index }})" readonly>
                                </td>
                                <td width="200px">
                                    <input type="text" value="{{ $detailPembelian['harga'] }}"
                                        id="input-harga-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][harga]" oninput="handleFunctions({{ $index }})"
                                        dir="rtl" {{ $pembelians->status=='Belum Terima' ? 'required'
                                        : 'readonly' }}>
                                </td>
                                <td width="250px">
                                    <input type="text" value="{{ $detailPembelian['subtotal'] }}"
                                        id="input-subtotal-{{ $index }}" class="form-control"
                                        name="dataKain[{{ $index }}][subtotal]" dir="rtl" placeholder="0" readonly>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="row mb-4" style="justify-content: space-between">
                    <div class="col-sm-2">
                        {{-- @if ($pembelians->status != 'Selesai')
                        <span class="btn btn-dark additemkain">Add Item</span>
                        @endif --}}
                    </div>

                    <div class="col-sm-3" style="align-item: right">
                        <div class="row" style="justify-content: start">
                            <div class="col-sm-3">
                                <label>Total Roll</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" id="input-total-qty-roll" name="total_qty_roll" type="text"
                                    value="{{ $pembelians->total_qty_roll }}" placeholder="0" readonly>
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
                                    value="{{ $pembelians->grand_total }}" dir="rtl" placeholder="0" readonly>
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
            handleInputRollDelete(idx);
            row.remove();
        }
    }
    }

    var rowCount = $('.data-kain tbody tr').length;

    var currentIndex = rowCount;
    
    document.getElementsByClassName('additemkain')[0].addEventListener('click', function () {

    
    $html = '<tr>' +
        '<td class="delete-item-row">'+
            '<ul class="table-controls">'+
                '<li><a href="javascript:void(0);" class="delete-item" onclick="deletes('+currentIndex+')" id="delete-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
            '</ul>'+
        '</td>'+
        '<td>'+
            '<select class="form-select" id="input-kode-kain-'+currentIndex+'" name="dataKain['+currentIndex+'][kain_id]" required>'+
                '<option selected disabled value="">Choose...</option>'+
                '@foreach ($kains as $kain)'+
                '<option value="{{ $kain->id }}" {{ old("dataKain['+currentIndex+'][kain_id]")==$kain->id ? "selected" : "" }}>{{ $kain->kode_kain }}</option>'+
                '@endforeach'+
            '</select>'+
        '</td>'+
        '<td width="130px">'+
            '<input type="number" value="{{ old("dataKain['+currentIndex+'][qty_roll]") }}" id="input-qty-roll-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][qty_roll]" oninput="handleFunctions('+currentIndex+')" min=1 required>'+
        '</td>'+
        '<td width="150px">'+
        '<input type="number" value="{{ old(" dataKain['+currentIndex+'][panjang]") }}" id="input-panjang-'+currentIndex+'" class="form-control" name="dataKain['+currentIndex+'][panjang]"'+
         'oninput="handleFunctions('+currentIndex+')" step="0.01" min=1 required>'+
            '</td>'+
        '<td width="150px">'+
            '<input type="text" value="{{ old("dataKain['+currentIndex+'][total_panjang]") }}" id="input-total-panjang-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][total_panjang]" placeholder="0"'+
                'oninput="handleFunctions('+currentIndex+')" readonly>'+
        '</td>'+
        '<td width="200px">'+
            '<input type="text" value="{{ old("dataKain['+currentIndex+'][harga]") }}" id="input-harga-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][harga]"'+
                'oninput="handleFunctions('+currentIndex+')" dir="rtl" required>'+
        '</td>'+
        '<td width="250px">'+
            '<input type="text" value="{{ old("dataKain['+currentIndex+'][subtotal]") }}" id="input-subtotal-'+currentIndex+'" class="form-control"'+
                'name="dataKain['+currentIndex+'][subtotal]" dir="rtl" placeholder="0" readonly>'+
        '</td>'+
        '</tr>';
    
        // console.log($html);
    
    $(".data-kain tbody").append($html);

    currentIndex++;
    // deleteItemRow();

    });
</script>

<script>
    // var tglPesan = flatpickr(document.getElementById('tanggal_pesan'), {
    // });
    var tglTerima = flatpickr(document.getElementById('tanggal_terima'), {
    });
    var tglBayar = flatpickr(document.getElementById('tanggal_bayar'), {
    });
</script>

<script>
    function handleFunctions(index) {
        handleInputRoll(index);
        handleTotalPanjang(index);
        handleInputSubtotal(index);
    }

    var rowCount = $('.data-kain tbody tr').length;

    var previousSubtotal = [];

    for (let index = 0; index < rowCount; index++) {

        var subtotalInput = document.getElementById('input-subtotal-' + index);
        var subtotal = Number(subtotalInput.value);
        previousSubtotal[index] = subtotal;
        
    }

    function handleInputSubtotal(idx) {
        console.log(previousSubtotal);
        var totalpanjangInput = document.getElementById("input-total-panjang-" + idx);
        var hargaInput = document.getElementById("input-harga-" + idx);
        var subtotalInput = document.getElementById('input-subtotal-' + idx);
        var grandTotalInput = document.getElementById('input-grand-total');

        var totalpanjang = Number(totalpanjangInput.value);
        var harga = Number(hargaInput.value);
        var subtotal = totalpanjang * harga;

        subtotalInput.value = subtotal;

        // console.log(harga);

        var previousSubtotalValue = previousSubtotal[idx] || 0;
        var newGrandTotal = Number(grandTotalInput.value) - previousSubtotalValue + subtotal;

        grandTotalInput.value = newGrandTotal;

        previousSubtotal[idx] = subtotal;
    }

    function handleTotalPanjang(idx) {
        var panjangInput = document.getElementById("input-panjang-" + idx);
        var qtyRollInput = document.getElementById("input-qty-roll-" + idx);
        var totalPanjangInput = document.getElementById('input-total-panjang-' + idx);

        var panjang = Number(panjangInput.value);
        var qtyRoll = Number(qtyRollInput.value);
        var totalPanjang = panjang * qtyRoll;

        // Update the totalPanjang input field
        totalPanjangInput.value = totalPanjang;
    }

    var previousQtyRoll = [];  

    for (let index = 0; index < rowCount; index++) {

        var qtyRollInput = document.getElementById('input-qty-roll-' + index);
        var qtyRoll = Number(qtyRollInput.value);
        previousQtyRoll[index] = qtyRoll;
        
    }

    function handleInputRoll(idx) {
        // console.log(previousQtyRoll);
        var qtyRollInput = document.getElementById('input-qty-roll-' + idx);
        var totalQtyRollInput = document.getElementById('input-total-qty-roll');

        var qtyRoll = Number(qtyRollInput.value);
        var totalQtyRoll = Number(totalQtyRollInput.value);

        var previousQtyRollValue = previousQtyRoll[idx] || 0;
        var newTotalQtyRoll = totalQtyRoll - previousQtyRollValue + qtyRoll;

        totalQtyRollInput.value = newTotalQtyRoll;

        previousQtyRoll[idx] = qtyRoll;
    }

    function handleInputRollDelete(idx) {
        var qtyRollInput = document.getElementById('input-qty-roll-' + idx);
        var totalQtyRollInput = document.getElementById('input-total-qty-roll');

        var qtyRoll = Number(qtyRollInput.value);
        var totalQtyRoll = Number(totalQtyRollInput.value);

        var newTotalQtyRoll = totalQtyRoll - qtyRoll;

        totalQtyRollInput.value = newTotalQtyRoll;

        handleGrandTotalDelete(idx);
    }

    function handleGrandTotalDelete(idx) {
        var subtotalInput = document.getElementById('input-subtotal-' + idx);
        var grandTotalInput = document.getElementById('input-grand-total');

        var newGrandTotal = Number(grandTotalInput.value) - Number(subtotalInput.value);

        grandTotalInput.value = newGrandTotal;
    }
</script>

@endsection