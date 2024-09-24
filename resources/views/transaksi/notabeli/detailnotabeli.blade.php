@extends('cork.cork')

@section('title')
Detail Pembelian - {{ $pembelians->kode_nota }}
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
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.css') }}">

<link href="{{ asset('assets/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('konten')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('notabeli.index') }}">Pembelian</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $pembelians->kode_nota }}</li>
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
                                    <h6><b>Kode Nota</b> <span class="summary-count">{{ $pembelians->kode_nota }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6><b>Supplier</b> <span class="summary-count">{{ $pembelians->suppliers->nama }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6><b>Karyawan</b><span class="summary-count">{{ $pembelians->karyawans->nama }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6><b>Total Qty Roll</b><span class="summary-count">{{ $pembelians->total_qty_roll }}
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6><b>Satuan Panjang</b><span class="summary-count">{{ $pembelians->satuan }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6><b>Grand Total Harga</b><span class="summary-count">@currency( $pembelians->grand_total) </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="summary-list summary-status">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($pembelians->status == "Selesai")
                                    <h6>Status <span class="badge badge-light-success">{{ $pembelians->status
                                            }}</span>
                                    </h6>
                                    @else
                                    <h6>Status <span class="badge badge-light-warning">{{ $pembelians->status
                                            }}</span>
                                    </h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="summary-list summary-tgl-mulai">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6><b>Tanggal Pesan</b> <span class="summary-count">{{ $pembelians->tgl_pesan }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-tgl-selesai">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($pembelians->tgl_terima == null)
                                    <h6><b>Tanggal Terima</b> <span class="badge badge-light-warning">{{
                                            $pembelians->status
                                            }}</span></h6>
                                    @else
                                    <h6><b>Tanggal Terima</b> <span class="summary-count">{{ $pembelians->tgl_terima }}</span>
                                    </h6>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail --}}
    <div class="col-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="">Detail</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><b>Kode Kain</b></th>
                                <th class="text-center"><b>Qty Roll</b></th>
                                <th class="text-center"><b>Panjang</b></th>
                                <th class="text-center"><b>Total Panjang</b></th>
                                <th class="text-end"><b>Harga</b></th>
                                <th class="text-end"><b>Subtotal</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailNotaBeli as $detail)
                            <tr>
                                <td><a href="{{ route('kain.show', $detail->kain_id) }}">{{
                                        $detail->kode_kain }}</td>
                                <td class="text-center">{{ $detail->qty_roll }}</td>
                                <td class="text-center">{{ $detail->panjang }}</td>
                                <td class="text-center">{{ $detail->total_panjang }}</td>
                                <td class="text-end">@currency($detail->harga )</td>
                                <td class="text-end">@currency( $detail->subtotal )</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Keterangan --}}
    <div class="col-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Keterangan</h3>
                    <div class="button-action text-end">
                        <button class="btn btn-primary  mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#inputKeterangan">Edit</button>
                    </div>
                </div>
                @if ($pembelians->keterangan != null || $pembelians->keterangan != "")
                <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4" role="alert">
                    {{ $pembelians->keterangan }}
                </div>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    Belum ada keterangan.
                </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Foto --}}
    <div class="col-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Foto Nota</h3>
                    <div class="button-action text-end">
                        <button class="btn btn-primary  mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#inputFoto">Edit</button>
                    </div>
                </div>
                @if ($pembelians->foto != null || $pembelians->foto != "")
                <a href="{{ asset('uploads/pembelians/' . $pembelians->foto) }}"
                    class="defaultGlightbox glightbox-content">
                    <img src="{{ asset('uploads/pembelians/' . $pembelians->foto) }}" alt="{{ $pembelians->foto }}"
                        class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" />
                </a>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    Foto Nota Pembelian belum ada.
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Modal Input Keterangan --}}
<div class="modal fade inputForm-modal" id="inputKeterangan" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('notabeli.update.keterangan', $pembelians->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Keterangan Pembelian <b>{{ $pembelians->kode_nota }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" placeholder="Masukkan keterangan..."
                                name="keterangan">{{ $pembelians->keterangan }}</textarea>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Input Foto --}}
<div class="modal fade inputForm-modal" id="inputFoto" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="{{ route('notabeli.update.foto', $pembelians->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Foto Nota Pembelian <b>{{ $pembelians->kode_nota }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Upload Foto <small class="text-muted ms-2 pb-1">(File must type .png, .jpeg,
                                    .jpg)</small></label>
                            <div class="col-sm-12">
                                <input type="file" name="foto" class="form-control" accept=".png, .jpeg, .jpg">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect">Submit</button>
                </div>
            </form>
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
<script src="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/custom-glightbox.min.js') }}"></script>

<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>



{{-- Tabel --}}
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