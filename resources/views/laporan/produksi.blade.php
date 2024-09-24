@extends('cork.cork')

@section('title', 'Laporan Produksi')

@section('csslaporanproduksi')
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">
<!-- END PAGE LEVEL STYLES -->
@endsection

@section('kontenlaporanproduksi')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode Produksi</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($queryModel as $dataproduksi)
                        <tr>
                            <td><a href="{{ route('produksi.show', $dataproduksi->id) }}">{{
                                    $dataproduksi->id }}</a></td>
                            <td>{{ date('d-m-Y',
                                strtotime($dataproduksi->tgl_mulai)) }}</td>
                        
                            @if ($dataproduksi->tgl_selesai = 'null')
                            <td>Belum Selesai</td>
                            @else
                            <td>{{ date('d-m-Y',
                                strtotime($dataproduksi->tgl_selesai)) }}</td>
                            @endif
                        
                        
                            @if ($dataproduksi->status = 'Dalam Proses') <td class="text-center"><span class="badge badge-light-warning">{{
                                    $dataproduksi->status }}</span></td>
                            @else
                            <td class="text-center"><span class="badge badge-light-success">{{ $dataproduksi->status
                                    }}</span>
                            </td>
                            @endif
                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('jslaporanproduksi')
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