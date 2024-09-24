@extends('cork.cork')

@section('title', 'Estimasi Kain')

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
            <li class="breadcrumb-item">Estimasi Kain</li>
        </ol>
    </nav>
</div>

<div class="row mb-4 layout-spacing">
    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('notabeli.store') }}">
        @csrf
        <div class="widget-content widget-content-area ecommerce-create-section">
            <div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-sm-12 col-form-label col-form-label-sm">Kode Produk <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="produk" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($produks as $item)
                                <option value="{{ $item->id }}" {{ old('produk')==$item->kode_produk ?
                                    'selected' : '' }}>{{ $item->kode_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="invoice-detail-items" style="padding-top: 10px">
                <h5 class="">Detail Ukuran</h5>
                <div class="table-responsive">
                    <table class="table item-table data-kain">
                        <thead>
                            <tr>
                                @foreach ($ukurans as $item)
                                    <th class="">{{ $item->nama }}</th>
                                @endforeach
                                
                            </tr>
                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($ukurans as $item)
                                    <td>
                                        <input type="number" value="{{ old('dataKain[0][qty_roll]') }}" id="input-qty-roll-0" class="form-control"
                                            name="dataKain[0][qty_roll]" min=0 required>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
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

@endsection