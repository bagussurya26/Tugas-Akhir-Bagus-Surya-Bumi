@extends('cork.cork')

@section('title')
{{ $suppliers->nama}}
@endsection

@section('css')
<link href="{{ asset('assets/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/apps/ecommerce-details.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-details.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/elements/alert.css') }}">
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$suppliers->nama }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->


<div class="row">
    {{-- Area Detail --}}
    <div class="col layout-top-spacing">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                {{-- <h3 class="">Summary</h3> --}}
                <div class="order-summary">

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Id<span class="summary-count">{{ $suppliers->id }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-nama">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Nama<span class="summary-count">{{ $suppliers->nama}}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-nohp">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>No. Telp/HP <span class="summary-count">{{ $suppliers->no_hp }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-alamat">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($suppliers->alamat != null)
                                    <h6>Alamat <span class="summary-count">{{ $suppliers->alamat }}</span></h6>
                                    @else
                                    <h6>Alamat <span class="summary-count">-</span></h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-email">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($suppliers->email != null)
                                    <h6>Email <span class="summary-count">{{ $suppliers->email}}</span></h6>
                                    @else
                                    <h6>Email <span class="summary-count">-</span></h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-12">
        <div class="summary layout-spacing">
            <div class="widget-content widget-content-area">
                <h3 class="">Keterangan</h3>
                @if ($suppliers->keterangan != null || $suppliers->keterangan != "")
                <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4" role="alert">
                    {{ $suppliers->keterangan }}
                </div>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    Belum ada keterangan.
                </div>
                @endif

            </div>
        </div>
    </div>

    @auth
    @if(auth()->user()->hasRole('Pemilik'))
    {{-- Area Riwayat Pembelian --}}
    <div class="col-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Riwayat Pembelian</h3>
                    <a href="{{ route('notabeli.supplier', $suppliers->id) }}" class="">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Terima</th>
                                <th>Kode Nota</th>
                                <th class="text-center">Total Roll</th>
                                <th class="text-end">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPemesanan as $dataRiwayatPesan)
                            <tr>
                                <td><a href="{{ route('notabeli.show', $dataRiwayatPesan->id) }}">{{
                                        $dataRiwayatPesan->tgl_pesan }}</a></td>

                                @if ($dataRiwayatPesan->tgl_terima != null)
                                <td><a href="{{ route('notabeli.show', $dataRiwayatPesan->id) }}">{{
                                        $dataRiwayatPesan->tgl_terima }}</a></td> 
                                @else
                                <td><a href="{{ route('notabeli.show', $dataRiwayatPesan->id) }}"><span class="badge badge-light-warning">{{
                                    $dataRiwayatPesan->status }}</span></a></td>
                                </td>
                                @endif

                                
                                <td><a href="{{ route('notabeli.show', $dataRiwayatPesan->id) }}">{{
                                        $dataRiwayatPesan->kode_nota }}</a></td>
                                {{-- @if ($dataRiwayatPesan->status == 'Belum Terima') <td class="text-center"><span
                                        class="badge badge-light-warning">{{
                                        $dataRiwayatPesan->status }}</span></td>
                                @else
                                <td class="text-center"><span class="badge badge-light-success">{{
                                        $dataRiwayatPesan->status
                                        }}</span>
                                </td>
                                @endif --}}
                                <td class="text-center">{{ $dataRiwayatPesan->total_qty_roll }}</td>
                                <td class="text-end">@currency($dataRiwayatPesan->grand_total)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endauth
</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/splide/splide.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/apps/ecommerce-details.js') }}"></script>

<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>

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
            "aaSorting": [[0,'desc']],
        });

        multiCheck(c3);
        
</script>

<script>
    $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10 
        });
</script>
@endsection