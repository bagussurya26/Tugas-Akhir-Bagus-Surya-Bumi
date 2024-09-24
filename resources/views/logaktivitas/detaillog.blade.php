@extends('cork.cork')

@section('title')
{{ $kains->kode_kain }} - {{ $kains->nama }}
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
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/elements/alert.css') }}">
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kain.index') }}">Kain</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $kains->kode_kain }} - {{
                $kains->nama }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row">
    <!-- Area Foto -->
    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
        <div class="user-profile">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Foto Motif</h3>
                </div>
                <div class="col-xl-30 layout-top-spacing">
                    @if ($kains->foto != null || $kains->foto != "")
                    <a href="{{ asset('uploads/kains/' . $kains->foto) }}" class="defaultGlightbox glightbox-content">
                        <img src="{{ asset('uploads/kains/' . $kains->foto) }}" alt="{{ $kains->foto }}"
                            class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" />
                    </a>
                    @else
                    <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                        Foto Kain belum ada.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Area Detail --}}
    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="order-summary">

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Kode Kain <span class="summary-count">{{ $kains->kode_kain }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Jenis Kain <span class="summary-count">{{ $kains->nama }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Warna <span class="summary-count">{{ $kains->warna }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Kategori <span class="summary-count">{{ $kains->kategori_kains->nama }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Lokasi Rak <span class="summary-count">{{ $kains->raks->lokasi }}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Stok <span class="summary-count">{{ $kains->stok }} Meter</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Incoming Stok <span class="summary-count">{{ $kains->incoming_stok }}
                                            Meter</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row layout-spacing ">
    <div class="col-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="">Keterangan</h3>
                @if ($kains->keterangan != null || $kains->keterangan != "")
                <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4" role="alert">
                    {{ $kains->keterangan }}
                </div>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    Belum ada keterangan.
                </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Area Riwayat Pembelian --}}
    <div class="col-lg-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Riwayat Pembelian</h3>
                    <a href="{{ route('notabeli.kain', $kains->id) }}" class="">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode Nota</th>
                                <th class="text-center">Supplier</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Kuantitas</th>
                                <th class="text-end">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPembelian as $pembelian)
                            <tr>
                                <td><a href="{{ route('notabeli.show', $pembelian->id) }}">{{ $pembelian->tgl_pesan
                                        }}</a></td>
                                <td><a href="{{ route('notabeli.show', $pembelian->id) }}">{{ $pembelian->kode_nota
                                        }}</a></td>
                                <td class="text-center">{{ $pembelian->nama }}</td>
                                @if ( $pembelian->status == 'Belum Bayar')
                                <td class="text-center"><span class="badge badge-light-warning">{{
                                        $pembelian->status
                                        }}</span></td>
                                @else
                                <td class="text-center"><span class="badge badge-light-success">{{
                                        $pembelian->status
                                        }}</span></td>
                                @endif

                                <td class="text-center">{{ $pembelian->total_panjang }} {{ $pembelian->satuan }}</td>
                                <td class="text-end">@currency($pembelian->harga)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Area Riwayat Produksi --}}
    <div class="col-lg-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Riwayat Produksi</h3>
                    <a href="{{ route('produksi.kain', $kains->id) }}" class="">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Kode Produksi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Stok digunakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatProduksi as $produksi)
                            <tr>
                                <td><a href="{{ route('produksi.show', $produksi->id) }}">{{ $produksi->tgl_mulai }}</a>
                                </td>

                                @if ($produksi->tgl_selesai == null)
                                <td><a href="{{ route('produksi.show', $produksi->id) }}">Belum Selesai</a></td>
                                @else
                                <td><a href="{{ route('produksi.show', $produksi->id) }}">{{ $produksi->tgl_selesai
                                        }}</a></td>
                                @endif

                                <td><a href="{{ route('produksi.show', $produksi->id) }}">{{ $produksi->kode_produksi
                                        }}</a></td>
                                @if ( $produksi->status == 'Dalam Proses')
                                <td class="text-center"><span class="badge badge-light-warning">{{
                                        $produksi->status
                                        }}</span></td>
                                @else
                                <td class="text-center"><span class="badge badge-light-success">{{
                                        $produksi->status
                                        }}</span></td>
                                @endif
                                <td class="text-center">{{ $produksi->qty_kain }} M</td>
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

@section('js')
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/splide/splide.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/apps/ecommerce-details.js') }}"></script>

<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/custom-glightbox.min.js') }}"></script>

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