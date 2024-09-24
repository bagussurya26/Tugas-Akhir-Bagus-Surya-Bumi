@extends('cork.cork')

@section('title')
{{ $infoBuyOrder[0]->id }}
@endsection

@section('cssdetailnotabeli')
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


@section('kontendetailnotabeli')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('buyorder.index') }}">Buy Order</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $infoBuyOrder[0]->id }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->


<div class="row layout-spacing ">
    {{-- Area Detail --}}
    <div class="col-12 layout-top-spacing">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="">Informasi</h3>
                <div class="order-summary">
                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Kode Invoice <span class="summary-count">{{ $infoBuyOrder[0]->id }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Supplier <span class="summary-count">{{ $infoBuyOrder[0]->nama_supplier }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Karyawan<span class="summary-count">{{ $infoBuyOrder[0]->nama_karyawan }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Grand Total Harga<span class="summary-count">@currency( $infoBuyOrder[0]->grand_total ) </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Tipe Pembayaran<span class="summary-count">{{ $infoBuyOrder[0]->tipe_pembayaran }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Grand Total Roll<span class="summary-count">{{ $infoBuyOrder[0]->total_qty }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-status">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($infoBuyOrder[0]->status == 'Dalam Proses')
                                    <h6>Status <span class="badge badge-light-warning">{{ $infoBuyOrder[0]->status
                                            }}</span>
                                    </h6>
                                    @else
                                    <h6>Status <span class="badge badge-light-success">{{ $infoBuyOrder[0]->status
                                            }}</span>
                                    </h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-tgl-mulai">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Tanggal Pesan <span class="summary-count">{{ date('d-m-Y',
                                            strtotime($infoBuyOrder[0]->tgl_pesan)) }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-tgl-selesai">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($infoBuyOrder[0]->tgl_datang == null)
                                    <h6>Tanggal Datang <span class="summary-count">Belum Datang</span></h6>
                                    @else
                                    <h6>Tanggal Datang <span class="summary-count">{{ date('d-m-Y',
                                            strtotime($infoBuyOrder[0]->tgl_datang)) }}</span>
                                    </h6>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-tgl-selesai">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($infoBuyOrder[0]->tgl_bayar == null)
                                    <h6>Tanggal Bayar <span class="summary-count">Belum Bayar</span></h6>
                                    @else
                                    <h6>Tanggal Bayar <span class="summary-count">{{ date('d-m-Y',
                                            strtotime($infoBuyOrder[0]->tgl_bayar)) }}</span>
                                    </h6>
                                    @endif
                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-keterangan">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Keterangan <span class="summary-count">{{ $infoBuyOrder[0]->keterangan
                                            }}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col layout-top-spacing">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="">Detail</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode Kain</th>
                                <th class="text-center">Total Roll</th>
                                <th class="text-center">Total Yard</th>
                                <th class="text-center">Harga per Yard</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailBuyOrder as $dataBuyOrder)
                            <tr>
                                <td><a href="{{ route('kain.show', $dataBuyOrder->kains_id) }}">{{
                                        $dataBuyOrder->kains_id }}</td>
                                <td class="text-center">{{ $dataBuyOrder->qty_roll }}</td>
                                <td class="text-center">{{ $dataBuyOrder->yard }}</td>
                                <td class="text-end">@currency($dataBuyOrder->harga_satuan )</td>
                                <td class="text-end">@currency( $dataBuyOrder->subtotal )</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col layout-top-spacing">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="">Nota Potong Kain</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode Potong Kain</th>
                                <th>Kode Kain</th>
                                <th class="text-center">Qty Kain</th>
                                <th class="text-center">Tanggal Mulai</th>
                                <th class="text-center">Tanggal Selesai</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Karyawan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailNotaKain as $dataNotaKain)
                            <tr>
                                <td>{{ $dataNotaKain->nota_kain_id }}</td>
                                <td><a href="{{ route('kain.show', $dataNotaKain->kains_id) }}">{{
                                        $dataNotaKain->kains_id }}</td>
                                <td class="text-center">{{ $dataNotaKain->qty_kain }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($dataNotaKain->tgl_mulai)) }}</td>

                                @if ($dataNotaKain->tgl_selesai == null)
                                <td class="text-center">Belum Selesai</td>
                                @else
                                <td class="text-center">{{ date('d-m-Y', strtotime($dataNotaKain->tgl_selesai)) }}</td>
                                @endif

                                @if ( $dataNotaKain->status == 'Dalam Proses')
                                <td class="text-center"><span class="badge badge-light-warning">{{ $dataNotaKain->status
                                        }}</span></td>
                                @else
                                <td class="text-center"><span class="badge badge-light-success">{{ $dataNotaKain->status
                                        }}</span></td>
                                @endif

                                <td class="text-center">{{ $dataNotaKain->nama }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</div>


<div class="row layout-spacing ">

    {{-- Area Riwayat Produksi --}}
    {{-- <div class="col-lg-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Riwayat Produksi</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Datang</th>
                                <th>Kode Nota</th>
                                <th class="text-center">Supplier</th>
                                <th class="text-center">Total Roll</th>
                                <th class="text-center">Panjang Per Roll</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPemesanan as $dataRiwayatPesan)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($dataRiwayatPesan->tgl_pesan)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($dataRiwayatPesan->tgl_datang)) }}</td>
                                <td>#{{ $dataRiwayatPesan->id }}</td>
                                <td class="text-center">{{ $dataRiwayatPesan->nama }}</td>
                                <td class="text-center">{{ $dataRiwayatPesan->qty_roll }}</td>
                                <td class="text-center">{{ $dataRiwayatPesan->yard }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}



</div>
@endsection

@section('jsdetailnotabeli')
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