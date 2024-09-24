@extends('cork.cork')

@section('title', 'Daftar Produksi Terhapus')

@section('cssdaftardeletedproduksi')
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/dark/table/datatable/custom_dt_custom.css') }}">

<link rel="stylesheet" href="{{ asset('assets/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

<link href="{{ asset('assets/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet"
    type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet"
    type="text/css" />
<!-- END PAGE LEVEL STYLES -->
@endsection

@section('kontendaftardeletedproduksi')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produksi.index') }}">Produksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Produksi Terhapus</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

{{-- <div class="page-meta">
    <a href="{{ route('kain.create') }}">
        <button class="btn btn-primary  mb-2 me-4">
            <i data-feather="plus"></i>
            <span class="btn-text-inner">Tambah Data</span>
        </button>
    </a>
</div> --}}

<div class="page-meta row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            {{-- <th class="text-center">Status</th> --}}
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($queryModel as $dataproduksi)
                        <tr>
                            <td><a href="{{ route('produksi.show', $dataproduksi->id) }}">{{
                                    $dataproduksi->id }}</a></td>
                            <td>{{ date('d-m-Y',
                                strtotime($dataproduksi->tgl_mulai)) }}</td>
                
                            {{-- @if ($dataproduksi->tgl_selesai == null)
                            <td>Belum Selesai</td>
                            @else
                            <td>{{ date('d-m-Y',strtotime($dataproduksi->tgl_selesai)) }}</td>
                            @endif --}}
                
                
                            @if ($dataproduksi->status == 'Dalam Proses') <td class="text-center"><span
                                    class="badge badge-light-warning">{{ $dataproduksi->status }}</span></td>
                            @else
                            <td class="text-center"><span class="badge badge-light-success">{{ $dataproduksi->status
                                    }}</span>
                            </td>
                            @endif
                
                            <td class="text-center">
                                <a class="btn btn-light-primary btn-icon bs-tooltip" href="{{ route('produksi.restore', $dataproduksi->id) }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Restore" data-original-title="Restore" type="submit"><i
                                        data-feather="rotate-ccw"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsdaftardeletedproduksi')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

<script>
    c3 = $('#style-3').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 10,
        });

        multiCheck(c3);
        
</script>

<!-- END PAGE LEVEL SCRIPTS -->
@endsection