@extends('cork.cork')

@section('title')
{{ $detailSupplier[0]->nama}}
@endsection

@section('cssdetailsupplier')
<link href="{{ asset('assets/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

{{--
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/splide/splide.min.css') }}"> --}}


<link href="{{ asset('assets/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/apps/ecommerce-details.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-details.css') }}" rel="stylesheet" type="text/css">

@endsection


@section('kontendetailsupplier')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$detailSupplier[0]->nama }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

{{-- @if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif --}}

<div class="page-meta row layout-spacing ">
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
                                    <h6>Id Supplier <span class="summary-count">{{ $detailSupplier[0]->id }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-nama">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Nama Supplier <span class="summary-count">{{ $detailSupplier[0]->nama}}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-nohp">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>No. Telp/HP <span class="summary-count">{{ $detailSupplier[0]->no_hp }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-alamat">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Alamat <span class="summary-count">{{ $detailSupplier[0]->alamat }}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-email">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Email <span class="summary-count">{{ $detailSupplier[0]->email}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-norek">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>No. Rekening <span class="summary-count">{{ $detailSupplier[0]->no_rek}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-keterangan">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Keterangan <span class="summary-count">{{ $detailSupplier[0]->keterangan}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row layout-spacing">

    {{-- Area Riwayat Pembelian --}}
    <div class="col-lg-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Riwayat Pembelian</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Datang</th>
                                <th>Kode Nota</th>
                                <th>Kode Kain</th>
                                {{-- <th class="text-center">Supplier</th> --}}
                                <th class="text-center">Total Roll</th>
                                <th class="text-center">Total Yard</th>
                                <th class="text-end">Harga per yard</th>
                                <th class="text-end">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPemesanan as $dataRiwayatPesan)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($dataRiwayatPesan->tgl_pesan)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($dataRiwayatPesan->tgl_datang)) }}</td>
                                <td>{{ $dataRiwayatPesan->id }}</td>
                                <td>{{ $dataRiwayatPesan->kains_id }}</td>
                                {{-- <td class="text-center">{{ $dataRiwayatPesan->nama }}</td> --}}
                                <td class="text-center">{{ $dataRiwayatPesan->qty_roll }}</td>
                                <td class="text-center">{{ $dataRiwayatPesan->yard }}</td>
                                <td class="text-end">@currency($dataRiwayatPesan->harga_satuan)</td>
                                <td class="text-end">@currency($dataRiwayatPesan->subtotal)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsdetailsupplier')
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
        });

        multiCheck(c3);
        
</script>
@endsection