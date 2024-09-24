@extends('cork.cork')

@section('title', 'Tambah Data Pembelian')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

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

<link href="{{ asset('assets/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('notabeli.index') }}">Pembelian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing page-meta">
    <form id="myForm" enctype="multipart/form-data" method="POST" action="{{ route('notabeli.store') }}">
        @csrf
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Nota <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <input type="text" value="{{ old('kode_nota') }}" class="form-control" name="kode_nota"
                                placeholder="Masukkan kode..." autofocus required>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Supplier <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="supplier_id" id="input-supplier" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id')==$supplier->id ?
                                    'selected' : '' }}>{{ $supplier->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Karyawan <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="karyawan_id" id="input-karyawan" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}" {{ old('karyawan_id')==$karyawan->id ?
                                    'selected' : '' }}>{{ $karyawan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Satuan<small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="satuan" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Meter" {{ old('satuan')=='Meter' ? 'selected' : '' }}>Meter</option>
                                <option value="Yard" {{ old('satuan')=='Yard' ? 'selected' : '' }}>Yard</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Pesan <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <input class="form-control flatpickr flatpickr-input active" id="tanggal_pesan"
                                name="tgl_pesan" type="text" value="{{ old('tgl_pesan') }}"
                                placeholder="Input tanggal..." required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Tanggal Terima <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <input class="form-control flatpickr flatpickr-input active" id="tanggal_terima"
                                name="tgl_terima" type="text" value="{{ old('tgl_terima') }}"
                                placeholder="Input tanggal..." required>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label>Upload Foto <small class="text-muted ms-2 pb-1">(File must type .png, .jpeg,
                                .jpg)</small></label>
                        <div class="col-sm-12">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                                accept=".png, .jpeg, .jpg">
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
                        <textarea class="form-control" value="{{ old('keterangan') }}" rows="3"
                            placeholder="Masukkan keterangan..." name="keterangan"></textarea>
                    </div>
                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <div class="row mb-4">
                    <h5 class="">Detail Kain</h5>
                </div>
                
                <div class="row mb-4">
                    <div class="col-auto">
                        <i style="color: #ffff" data-feather="x-circle"></i>
                    </div>
                    <div class="col">
                        <h6 class="">Kode Kain <small class="text-muted ms-2 pb-1">(Required)</small></h6>
                    </div>
                    <div class="col">
                        <h6 class="">Qty Roll <small class="text-muted ms-2 pb-1">(Required)</small></h6>
                    </div>
                    <div class="col">
                        <h6 class="">Panjang <small class="text-muted ms-2 pb-1">(Required)</small></h6>
                    </div>
                    <div class="col">
                        <h6 class="">Total Panjang</h6>
                    </div>
                    <div class="col">
                        <h6 class="">Harga Satuan <small class="text-muted ms-2 pb-1">(Required)</small></h6>
                    </div>
                    <div class="col">
                        <h6 class="">Subtotal</h6>
                    </div>
                </div>

                <div class="kain-list">
                    <div class="row mb-4">
                        <div class="col-auto">
                            <i data-feather="x-circle"></i>
                        </div>
                        <div class="col">
                            <select class="form-select" id="input-kode-kain-0" name="dataKain[0][kain_id]" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($kains as $kain)
                                <option value="{{ $kain->id }}" {{ old('dataKain[0][kain_id]')==$kain->id ?
                                    'selected' : '' }}>{{ $kain->kode_kain }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" value="{{ old('dataKain[0][qty_roll]') }}" id="input-qty-roll-0" class="form-control"
                                name="dataKain[0][qty_roll]" oninput="handleFunctions(0)" min=1 required>
                        </div>
                        <div class="col">
                            <input type="number" value="{{ old('dataKain[0][panjang]') }}" id="input-panjang-0" class="form-control"
                                name="dataKain[0][panjang]" oninput="handleFunctions(0)" step="0.01" min=1 required>
                        </div>
                        <div class="col">
                            <input type="text" value="{{ old('dataKain[0][total_panjang]') }}" id="input-total-panjang-0" class="form-control"
                                name="dataKain[0][total_panjang]" placeholder="0" oninput="handleFunctions(0)" readonly>
                        </div>
                        <div class="col">
                            <input type="number" value="{{ old('dataKain[0][harga]') }}" id="input-harga-0" class="form-control"
                                name="dataKain[0][harga]" min="0" oninput="handleFunctions(0)" required>
                        </div>
                        <div class="col">
                            <input type="text" value="{{ old('dataKain[0][subtotal]') }}" id="input-subtotal-0" class="form-control"
                                name="dataKain[0][subtotal]" dir="rtl" placeholder="0" readonly>
                        </div>

                    </div>

                </div>


                {{-- <div class="table-responsive">
                    <table class="table item-table data-kain">
                        <thead>
                            <tr>
                                <th class=""></th>
                                <th class="">Kode Kain <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="">Qty Roll <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="">Panjang <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="">Total Panjang</th>
                                <th class="">Harga Satuan <small class="text-muted ms-2 pb-1">(Required)</small></th>
                                <th class="">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="delete-item-row"></td>
                                <td>
                                    <select class="form-select" id="input-kode-kain-0" name="dataKain[0][kain_id]"
                                        required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($kains as $kain)
                                        <option value="{{ $kain->id }}" {{ old('dataKain[0][kain_id]')==$kain->id ?
                                            'selected' : '' }}>{{ $kain->kode_kain }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td width="130px">
                                    <input type="number" value="{{ old('dataKain[0][qty_roll]') }}"
                                        id="input-qty-roll-0" class="form-control" name="dataKain[0][qty_roll]"
                                        oninput="handleFunctions(0)" min=1 required>
                                </td>
                                <td width="150px">
                                    <input type="number" value="{{ old('dataKain[0][panjang]') }}" id="input-panjang-0"
                                        class="form-control" name="dataKain[0][panjang]" oninput="handleFunctions(0)"
                                        step="0.01" min=1 required>
                                </td>
                                <td width="150px">
                                    <input type="text" value="{{ old('dataKain[0][total_panjang]') }}"
                                        id="input-total-panjang-0" class="form-control"
                                        name="dataKain[0][total_panjang]" placeholder="0" oninput="handleFunctions(0)"
                                        readonly>
                                </td>
                                <td width="200px">
                                    <input type="number" value="{{ old('dataKain[0][harga]') }}" id="input-harga-0"
                                        class="form-control" name="dataKain[0][harga]" min="0"
                                        oninput="handleFunctions(0)" required>
                                </td>
                                <td width="250px">
                                    <input type="text" value="{{ old('dataKain[0][subtotal]') }}" id="input-subtotal-0"
                                        class="form-control" name="dataKain[0][subtotal]" dir="rtl" placeholder="0"
                                        readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                <div class="row mb-4">
                    <div class="col">
                        <span class="btn btn-dark additemkain">Add Item</span>
                    </div>

                    <div class="col-auto">
                        <div class="row mb-4">
                            <div class="col-auto d-flex align-items-center">
                                <label>Total Roll :</label>
                            </div>
                            <div class="col-5">
                                <input class="form-control" id="input-total-qty-roll" name="total_qty_roll" type="text"
                                    value="{{ old('total_qty_roll') }}" placeholder="0" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="row mb-4">
                            <div class="col-auto d-flex align-items-center">
                                <label>Grand Total :</label>
                            </div>
                            <div class="col">
                                <input class="form-control" id="input-grand-total" name="grand_total" type="text"
                                    value="{{ old('grand_total') }}" dir="rtl" placeholder="0" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-end">
                    <button class="btn btn-success" type="submit" id="submitButton">Submit</button>
                </div>
            </div>
    </form>
</div>

{{-- Modal Input Pembelian --}}
<div class="modal fade modal-notification" id="konfirmNotaBeli" tabindex="-1" role="dialog"
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
                {{-- <form method="POST" enctype="multipart/form-data" action="{{ route('notabeli.store') }}">
                    @csrf --}}
                    <button type="button" class="btn btn-success mt-2 mb-2 btn-no-effect"
                        id="confirmSubmitButton">Konfirmasi</button>
                    {{--
                </form> --}}
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
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>

{{-- Tom Select --}}
<script>
    new TomSelect("#input-supplier",{
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
    new TomSelect("#input-kode-kain-0",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

{{-- Required Step 1 --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('.ecommerce-create-section [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });
            if (allFieldsFilled) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('.ecommerce-create-section [required]').on('input', function () {
            var value = $(this).val();

            if (value < 0) {
                $(this).val(Math.abs(value));
            }

            checkRequiredFields()
        });
    });
</script>

{{-- Trigger Modal --}}
<script>
    $(document).ready(function() {

        $('#submitButton').click(function() {

            var allFilled = true;
            $('input[required]').each(function() {
                if ($(this).val() === '') {
                allFilled = false;
                return false; 
                }
            });

            if (allFilled) {
                $('#konfirmNotaBeli').modal('show');
                $('#submitButton').attr('type', 'button');
            }
            else {
                $('#submitButton').attr('type', 'submit');
            }
        });

        $('#confirmSubmitButton').click(function() {
            $('#myForm').submit();
        });

  });
</script>

{{-- Tambah Data --}}
<script>
    function deletes(idx) {
        var deleteItem = document.querySelector('#row-' + idx); 
        if (deleteItem) {
            // var row = deleteItem.closest('tr');
            // if (row) {
            //     handleInputRollDelete(idx);
            //     row.remove();
            // }
            handleInputRollDelete(idx);
            deleteItem.remove();
        }

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('.ecommerce-create-section [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });
            return allFieldsFilled;
        }

        $('.ecommerce-create-section [required]').on('input', function () {
            if (checkRequiredFields()) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        });

        $('.ecommerce-create-section [required]').trigger('input');
    }

    var currentIndex = 0;
    
    $(".additemkain").on("click", function() {

        currentIndex++;
        
        // var html = '<tr>' +
        //     '<td class="delete-item-row">'+
        //         '<ul class="table-controls">'+
        //             '<li><a href="javascript:void(0);" class="delete-item" onclick="deletes('+currentIndex+')" id="delete-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg</a></li>'+
        //         '</ul>'+
        //     '</td>'+
        //     '<td>'+
        //         '<select class="form-select" id="input-kode-kain-'+currentIndex+'" name="dataKain['+currentIndex+'][kain_id]" required>'+
        //             '<option selected disabled value="">Choose...</option>'+
        //             '@foreach ($kains as $kain)'+
        //             '<option value="{{ $kain->id }}" {{ old("dataKain['+currentIndex+'][kain_id]")==$kain->id ? "selected" : "" }}>{{ $kain->kode_kain }}</option>'+
        //             '@endforeach'+
        //         '</select>'+
        //     '</td>'+
        //     '<td width="130px">'+
        //         '<input type="number" value="{{ old("dataKain['+currentIndex+'][qty_roll]") }}" id="input-qty-roll-'+currentIndex+'" class="form-control"'+
        //             'name="dataKain['+currentIndex+'][qty_roll]" oninput="handleFunctions('+currentIndex+')" min=1 required>'+
        //     '</td>'+
        //     '<td width="150px">'+
        //     '<input type="number" value="{{ old(" dataKain['+currentIndex+'][panjang]") }}" id="input-panjang-'+currentIndex+'" class="form-control" name="dataKain['+currentIndex+'][panjang]"'+
        //     'oninput="handleFunctions('+currentIndex+')" step="0.01" min=1 required>'+
        //         '</td>'+
        //     '<td width="150px">'+
        //         '<input type="text" value="{{ old("dataKain['+currentIndex+'][total_panjang]") }}" id="input-total-panjang-'+currentIndex+'" class="form-control"'+
        //             'name="dataKain['+currentIndex+'][total_panjang]" placeholder="0"'+
        //             'oninput="handleFunctions('+currentIndex+')" readonly>'+
        //     '</td>'+
        //     '<td width="200px">'+
        //         '<input type="number" value="{{ old("dataKain['+currentIndex+'][harga]") }}" id="input-harga-'+currentIndex+'" class="form-control"'+
        //             'name="dataKain['+currentIndex+'][harga]"'+
        //             'oninput="handleFunctions('+currentIndex+')" min=0 required>'+
        //     '</td>'+
        //     '<td width="250px">'+
        //         '<input type="text" value="{{ old("dataKain['+currentIndex+'][subtotal]") }}" id="input-subtotal-'+currentIndex+'" class="form-control"'+
        //             'name="dataKain['+currentIndex+'][subtotal]" dir="rtl" placeholder="0" readonly>'+
        //     '</td>'+
        //     '</tr>';
        
        // $(".data-kain tbody").append(html);

        var html = '<div class="row mb-4" id="row-'+currentIndex+'">' +
            '<div class="col-auto">'+
                    '<a href="javascript:void(0);" class="delete-item" onclick="deletes('+currentIndex+')" id="delete-'+currentIndex+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a>'+
            '</div>'+
            '<div class="col">'+
                '<select class="form-select" id="input-kode-kain-'+currentIndex+'" name="dataKain['+currentIndex+'][kain_id]" required>'+
                    '<option selected disabled value="">Choose...</option>'+
                    '@foreach ($kains as $kain)'+
                    '<option value="{{ $kain->id }}" {{ old("dataKain['+currentIndex+'][kain_id]")==$kain->id ? "selected" : "" }}>{{ $kain->kode_kain }}</option>'+
                    '@endforeach'+
                '</select>'+
            '</div>'+
            '<div class="col">'+
                '<input type="number" value="{{ old("dataKain['+currentIndex+'][qty_roll]") }}" id="input-qty-roll-'+currentIndex+'" class="form-control"'+
                    'name="dataKain['+currentIndex+'][qty_roll]" oninput="handleFunctions('+currentIndex+')" min=1 required>'+
            '</div>'+
            '<div class="col">'+
            '<input type="number" value="{{ old(" dataKain['+currentIndex+'][panjang]") }}" id="input-panjang-'+currentIndex+'" class="form-control" name="dataKain['+currentIndex+'][panjang]"'+
            'oninput="handleFunctions('+currentIndex+')" step="0.01" min=1 required>'+
                '</div>'+
            '<div class="col">'+
                '<input type="text" value="{{ old("dataKain['+currentIndex+'][total_panjang]") }}" id="input-total-panjang-'+currentIndex+'" class="form-control"'+
                    'name="dataKain['+currentIndex+'][total_panjang]" placeholder="0"'+
                    'oninput="handleFunctions('+currentIndex+')" readonly>'+
            '</div>'+
            '<div class="col">'+
                '<input type="number" value="{{ old("dataKain['+currentIndex+'][harga]") }}" id="input-harga-'+currentIndex+'" class="form-control"'+
                    'name="dataKain['+currentIndex+'][harga]"'+
                    'oninput="handleFunctions('+currentIndex+')" min=0 required>'+
            '</div>'+
            '<div class="col">'+
                '<input type="text" value="{{ old("dataKain['+currentIndex+'][subtotal]") }}" id="input-subtotal-'+currentIndex+'" class="form-control"'+
                    'name="dataKain['+currentIndex+'][subtotal]" dir="rtl" placeholder="0" readonly>'+
            '</div>'+
            '</div>';


        $(".kain-list").append(html);

        new TomSelect("#input-kode-kain-" + currentIndex,{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('.ecommerce-create-section [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });
            if (allFieldsFilled) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('.ecommerce-create-section [required]').on('input', function () {
            var value = $(this).val();

            if (value < 0) {
                $(this).val(Math.abs(value));
            }
            
            checkRequiredFields()
        });

    });
</script>

{{-- Pertanggalan --}}
<script>
    var tglPesan = flatpickr(document.getElementById('tanggal_pesan'), { 
        allowInput: false,
        onChange: function(selectedDates, dateStr, instance) {
            console.log("tglPesan:", dateStr);
            var tglTerima = flatpickr(document.getElementById('tanggal_terima'), {allowInput:false,minDate:dateStr});
        }
    });
    var tglTerima = flatpickr(document.getElementById('tanggal_terima'), { 
        allowInput: false,
        onChange: function(selectedDates, dateStr, instance) {
            console.log("tglTerima:", dateStr);
            var tglPesan = flatpickr(document.getElementById('tanggal_pesan'), {allowInput:false,maxDate:dateStr});
        }
    });
</script>

{{-- Handle Pertotalan --}}
<script>
    var previousSubtotal = [];

    function handleInputSubtotal(idx) {
        var totalpanjangInput = document.getElementById("input-total-panjang-" + idx);
        var hargaInput = document.getElementById("input-harga-" + idx);
        var subtotalInput = document.getElementById('input-subtotal-' + idx);
        var grandTotalInput = document.getElementById('input-grand-total');

        var totalpanjang = Number(totalpanjangInput.value);
        var harga = Number(hargaInput.value);
        var subtotal = harga * totalpanjang;

        subtotalInput.value = subtotal;

        var previousSubtotalValue = previousSubtotal[idx] || 0;
        var newGrandTotal = grandTotalInput.value - previousSubtotalValue + subtotal;

        grandTotalInput.value = newGrandTotal;

        previousSubtotal[idx] = subtotal;
    }

    function handleFunctions(index) {
        handleTotalPanjang(index);
        handleInputRoll(index);
        handleInputSubtotal(index);
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

    function handleInputRoll(idx) {
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