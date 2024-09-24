@extends('cork.cork')

@section('title', 'Daftar Produk')

@section('cssdaftarproduk')
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

@section('kontendaftarproduk')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="page-meta">
    <a href="{{ route('produk.create') }}">
        <button class="btn btn-primary  mb-2 me-4">
            <i data-feather="plus"></i>
            <span class="btn-text-inner">Tambah Data</span>
        </button>
    </a>
    {{-- <a href="{{ route('produk.delete') }}">
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
                <table id="style-3" class="table style-3 dt-table-hover">
                    <thead>
                        <tr>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            {{-- <th>Tipe Fit Badan</th>
                            <th>Tipe Lengan</th> --}}
                            <th class="text-center">Lokasi Rak</th>
                            <th class="text-center">Status</th>
                            <th>Total Stok</th>
                            <th class="text-end">Harga</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($queryModel as $dataproduk)
                        <tr>
                            <td><a href="{{ route('produk.show', $dataproduk->id) }}">{{ $dataproduk->kode_pakaian }}</a></td>
                            <td><a href="{{ route('produk.show', $dataproduk->id) }}">{{ $dataproduk->nama }}</a></td>
                            <td>{{ $dataproduk->kategori_nama }}</td>
                            {{-- <td>{{ $dataproduk->tipe_fit }}</td>
                            <td>{{ $dataproduk->tipe_lengan }}</td> --}}
                            <td class="text-center">{{ $dataproduk->raks->lokasi }}</td>

                            @if ($dataproduk->total_qty < 1) <td class="text-center"><span
                                    class="badge badge-light-danger">Habis</span></td>
                                @elseif ($dataproduk->total_qty <= 100) <td class="text-center"><span
                                        class="badge badge-light-warning">Hampir
                                        Habis</span></td>
                                    @else
                                    <td class="text-center"><span class="badge badge-light-success">Masih Ada</span>
                                    </td>
                                    @endif

                                    <td>{{ $dataproduk->total_qty }}</td>
                                    <td class="text-end">{{ $dataproduk->harga }}</td>

                                    <td class="text-center">

                                        <form method="POST" action="{{ route('produk.destroy', $dataproduk->id) }}">
                                            @csrf
                                            @method("DELETE")

                                            <a class="btn btn-light-primary btn-icon bs-tooltip"
                                                href="{{ route('produk.edit', $dataproduk->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                data-original-title="Edit"><i data-feather="edit-3"></i></a>

                                            <a class="btn btn-light-danger btn-icon bs-tooltip"
                                                href="{{ route('produk.destroy', $dataproduk->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                data-confirm-delete="true" data-original-title="Delete" type="submit"><i
                                                    data-feather="trash"></i></a>

                                            {{-- <a href="{{ route('kain.destroy', $datakain->id) }}"
                                                class="btn btn-danger" data-confirm-delete="true"
                                                type="submit">Delete</a> --}}
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

@section('jsdaftarproduk')
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
            "pageLength": 10
        });

        multiCheck(c3);
</script>

<script>
    document.querySelector('.warning-confirm1').addEventListener('click', function() {
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
    Swal.fire(
    'Deleted!',
    'Your file has been deleted.',
    'success'
    )
    }
    })
    })
</script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection