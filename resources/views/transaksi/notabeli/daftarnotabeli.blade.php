@extends('cork.cork')

@section('title', 'Pembelian')

@section('cssdaftarnotabeli')
<!--  BEGIN CUSTOM STYLE FILE  -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('assets/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('assets/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/dark/table/datatable/custom_dt_custom.css') }}">
<!--  END CUSTOM STYLE FILE  -->
@endsection

@section('kontendaftarnotabeli')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buy Order</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="page-meta">
    <a href="{{ route('notabeli.create') }}">
        <button class="btn btn-primary  mb-2 me-4">
            <i data-feather="plus"></i>
            <span class="btn-text-inner">Tambah Data</span>
        </button>
    </a>
    {{-- <a href="{{ route('buyorder.delete') }}">
        <button class="btn btn-info  mb-2 me-4">
            <i data-feather="info"></i>
            <span class="btn-text-inner">Show Deleted Data</span>
        </button>
    </a> --}}
</div>

<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Supplier</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Total Qty Roll</th>
                            <th class="text-end">Grand Total</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($queryModel as $datanotabeli)
                        <tr>
                            <td><a href="{{ route('notabeli.show', $datanotabeli->id) }}">{{ $datanotabeli->id }}</span>
                            </td>

                            <td>{{ $databuyorder->nama_supplier }}</td>
                            {{-- <td>{{ date('d-m-Y', strtotime($databuyorder->tgl_pesan)) }}</td>

                            @if ($databuyorder->tgl_datang == null)
                            <td>Belum Datang</td>
                            @else
                            <td>{{ date('d-m-Y', strtotime($databuyorder->tgl_datang)) }}</td>
                            @endif

                            @if ($databuyorder->tgl_bayar == null)
                            <td>Belum Lunas</td>
                            @else
                            <td>{{ date('d-m-Y', strtotime($databuyorder->tgl_bayar)) }}</td>
                            @endif --}}


                            @if ($datanotabeli->status == "Selesai")
                            <td><span class="badge badge-light-success">{{ $datanotabeli->status }}</span>
                            </td>
                            {{-- @elseif ($databuyorder->stok <= 100) <td><span class="badge badge-light-warning">Hampir
                                    Habis</span></td> --}}
                                @else
                                <td class="text-center"><span class="badge badge-light-warning">{{ $datanotabeli->status }}</span></td>
                                @endif

                                <td class="text-center">{{ $datanotabeli->total_qty }}</td>
                                <td class="text-end">@currency($datanotabeli->grand_total)</td>

                                <td class="text-center">

                                    <form method="POST" action="{{ route('notabeli.destroy', $datanotabeli->id) }}">
                                        @csrf
                                        @method("DELETE")

                                        @if ($datanotabeli->status == 'Selesai')

                                        @else
                                        {{-- <a class="btn btn-light-primary btn-icon bs-tooltip"
                                            href="{{ route('notabeli.edit', $datanotabeli->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                            data-original-title="Edit"><i data-feather="edit-3"></i></a> --}}
                                        <a class="btn btn-light-danger btn-icon bs-tooltip"
                                            href="{{ route('notabeli.destroy', $datanotabeli->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                            data-confirm-delete="fa" data-original-title="Delete" type="submit"><i
                                                data-feather="trash"></i></a>
                                        @endif


                                    </form>
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

@section('jsdaftarnotabeli')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/apps/invoice-list.js') }}"></script>
<!-- END PAGE LEVEL SCRIPTS -->

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
            "pageLength": 10
        });

        multiCheck(c3);
</script>

@endsection