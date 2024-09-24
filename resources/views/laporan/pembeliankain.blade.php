@extends('cork.cork')

@section('title', 'Laporan Pembelian Kain')

@section('csslaporanpembeliankain')
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">
<!-- END PAGE LEVEL STYLES -->
@endsection

@section('kontenlaporanpembeliankain')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pembelian Kain</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                {{-- <div class="table-form">
                    <div class="form-group row mr-3">
                        <label for="min" class="col-sm-5 col-form-label col-form-label-sm">Minimum stok:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form-control-sm" name="min" id="min" placeholder="">
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="max" class="col-sm-5 col-form-label col-form-label-sm">Maximum stok:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form-control-sm" name="max" id="max" placeholder="">
                        </div>
                    </div>
                </div> --}}
                <table id="html5-extension" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            
                            <th>Invoice ID</th>
                            {{-- <th>Tanggal Pesan</th>
                            <th>Tanggal Datang</th>
                            <th>Tanggal Bayar</th>                            --}}
                            <th>Kode Kain</th>
                            <th>Jenis Kain</th>
                            <th>Supplier</th>
                            <th class="text-center">Qty Roll</th>
                            <th class="text-center">Panjang Yard</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($queryModel as $datalaporanpembelian)
                        <tr>
                            <td><span class="inv-number">{{ $datalaporanpembelian->id }}</span></td>
                            {{-- <td>{{ date('d-m-Y', strtotime($datalaporanpembelian->tgl_pesan)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($datalaporanpembelian->tgl_datang)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($datalaporanpembelian->tgl_bayar)) }}</td> --}}
                            <td>{{ $datalaporanpembelian->kains_id }}</td>
                            <td>{{ $datalaporanpembelian->jenis_kain }}</td>
                            <td>{{ $datalaporanpembelian->nama }}</td>
                            <td class="text-center">{{ $datalaporanpembelian->qty_roll }}</td>
                            <td class="text-center">{{ $datalaporanpembelian->yard }}</td>
                            <td class="text-end">@currency($datalaporanpembelian->subtotal)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('jslaporanpembeliankain')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>

<script src="{{ asset('assets/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/custom_miscellaneous.js') }}"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection