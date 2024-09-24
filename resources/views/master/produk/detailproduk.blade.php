@extends('cork.cork')

@section('title')
{{ $produks->kode_produk }} - {{ $produks->nama }}
@endsection

@section('css')
<link href="{{ asset('assets/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/light/apps/ecommerce-details.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-details.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/elements/alert.css') }}">

<link href="{{ asset('assets/src/assets/css/dark/components/carousel.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/carousel.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/src/tomSelect/tom-select.default.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/stepper/custom-bsStepper.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/stepper/custom-bsStepper.css') }}">
@endsection


@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $produks->kode_produk }} - {{
                $produks->nama }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-top-spacing">
    {{-- Area Detail --}}
    <div class="col-xl-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Informasi</h3>
                    <div class="button-action text-end">
                        <button class="btn btn-primary mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#editinformasiproduk">Ubah Informasi Dasar</button>
                        <button class="btn btn-success mb-2 me-4" id="btn-tambah-warna" data-bs-toggle="modal"
                            data-bs-target="#tambahwarnaproduk">Tambah Warna & Resep</button>
                        <button class="btn btn-info mb-2 me-4" id="btn-ubah-warna" data-bs-toggle="modal"
                            data-bs-target="#editwarnaproduk">Ubah Warna & Resep</button>
                        <button class="btn btn-warning mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#edithargaproduk">Ubah Harga</button>
                    </div>
                </div>

                <div class="order-summary">

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Kode Produk <span class="summary-count">{{ $produks->kode_produk }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-nama">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Nama Produk <span class="summary-count">{{ $produks->nama }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-kategori">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Kategori Produk <span class="summary-count">{{ $produks->kategori_produks->nama
                                            }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-fit">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Tipe Body Fit <span class="summary-count">{{ $produks->tipe_fit
                                            }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-lengan">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Tipe Lengan <span class="summary-count">{{ $produks->tipe_lengan
                                            }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-merk">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Lokasi Rak <span class="summary-count">{{ $produks->raks->lokasi }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Foto -->
    @foreach ($produks->produk_warna as $item)
    <div class="col">
        <div class="user-profile layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">{{ $produks->kode_produk }} warna {{ $item->warna }}</h3>
                </div>
                <div class="col-xl-30 layout-top-spacing">
                    @if ($item->foto != null || $item->foto != "")
                    <a href="{{ asset('uploads/produks/' . $item->foto) }}" class="defaultGlightbox glightbox-content">
                        <img src="{{ asset('uploads/produks/' . $item->foto) }}" alt="{{ $item->foto }}"
                            class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" />
                    </a>
                    @else
                    <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                        Foto Produk belum ada.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Ukuran --}}
    <div id="tabsSimple" class="col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Ukuran</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="simple-tab">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($produks->produk_warna as $index=>$item)
                        <li class="nav-item" role="presentation">
                            @if ($index == 0)
                            <button class="nav-link active" id="{{ $item->warna }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $item->warna }}-tab-pane-ukuran" type="button" role="tab"
                                aria-controls="{{ $item->warna }}-tab-pane" aria-selected="true">{{ $item->warna
                                }}</button>
                            @else
                            <button class="nav-link" id="{{ $item->warna }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $item->warna }}-tab-pane-ukuran" type="button" role="tab"
                                aria-controls="{{ $item->warna }}-tab-pane" aria-selected="false">{{ $item->warna
                                }}</button>
                            @endif
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        @foreach ($produks->produk_warna as $index=>$item)
                        @if ($index == 0)
                        <div class="tab-pane fade show active" id="{{ $item->warna }}-tab-pane-ukuran" role="tabpanel"
                            aria-labelledby="{{ $item->warna }}-tab" tabindex="0">
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table style-3 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ukuran</th>
                                                @foreach ($item->produk_ukuran as $data)
                                                <th class="text-center">{{ $data->ukurans->nama }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Harga</td>
                                                @foreach ($item->produk_ukuran as $data)
                                                <td class="text-center">@currency($data->harga)</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Stok (Pcs)</td>
                                                @foreach ($item->produk_ukuran as $data)
                                                <td class="text-center">{{ $data->stok }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Stok mendatang (Pcs)</td>
                                                @foreach ($item->produk_ukuran as $data)
                                                <td class="text-center">{{ $data->incoming_stok }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="tab-pane fade" id="{{ $item->warna }}-tab-pane-ukuran" role="tabpanel"
                            aria-labelledby="{{ $item->warna }}-tab" tabindex="0">
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table style-3 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ukuran</th>
                                                @foreach ($item->produk_ukuran as $data)
                                                <th class="text-center">{{ $data->ukurans->nama }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Harga</td>
                                                @foreach ($item->produk_ukuran as $data)
                                                <td class="text-center">@currency($data->harga)</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Stok (Pcs)</td>
                                                @foreach ($item->produk_ukuran as $data)
                                                <td class="text-center">{{ $data->stok }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Stok mendatang (Pcs)</td>
                                                @foreach ($item->produk_ukuran as $data)
                                                <td class="text-center">{{ $data->incoming_stok }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Resep Kain --}}
    <div id="tabsSimple" class="col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Resep Kain</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="simple-tab">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($produks->produk_warna as $index=>$item)
                        <li class="nav-item" role="presentation">
                            @if ($index == 0)
                            <button class="nav-link active" id="{{ $item->warna }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $item->warna }}-tab-pane-resep" type="button" role="tab"
                                aria-controls="{{ $item->warna }}-tab-pane" aria-selected="true">{{ $item->warna
                                }}</button>
                            @else
                            <button class="nav-link" id="{{ $item->warna }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $item->warna }}-tab-pane-resep" type="button" role="tab"
                                aria-controls="{{ $item->warna }}-tab-pane" aria-selected="false">{{ $item->warna
                                }}</button>
                            @endif
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        @foreach ($produks->produk_warna as $index=>$item)
                        @if ($index == 0)
                        <div class="tab-pane fade show active" id="{{ $item->warna }}-tab-pane-resep" role="tabpanel"
                            aria-labelledby="{{ $item->warna }}-tab" tabindex="0">
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table style-3 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tipe</th>
                                                @foreach ($item->kains as $data)
                                                <th class="text-center">{{ $data->pivot->tipe }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Kode Kain</td>
                                                @foreach ($item->kains as $data)
                                                <td class="text-center">{{ $data->kode_kain }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Foto</td>
                                                @foreach ($item->kains as $data)
                                                <td class="text-center"><img
                                                        src="{{ asset('uploads/kains/' . $data->foto) }}"
                                                        alt="{{ $data->foto }}" class="img-fluid"
                                                        style="width: 20%; height: 20%; object-fit: cover;" /></td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="tab-pane fade" id="{{ $item->warna }}-tab-pane-resep" role="tabpanel"
                            aria-labelledby="{{ $item->warna }}-tab" tabindex="0">
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table style-3 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tipe</th>
                                                @foreach ($item->kains as $data)
                                                <th class="text-center">{{ $data->pivot->tipe }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Kode Kain</td>
                                                @foreach ($item->kains as $data)
                                                <td class="text-center">{{ $data->kode_kain }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Foto</td>
                                                @foreach ($item->kains as $data)
                                                <td class="text-center"><img
                                                        src="{{ asset('uploads/kains/' . $data->foto) }}"
                                                        alt="{{ $data->foto }}" class="img-fluid"
                                                        style="width: 20%; height: 20%; object-fit: cover;" /></td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Keterangan --}}
    <div class="col-12">
        <div class="summary layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Keterangan</h3>
                    <div class="button-action text-end">
                        <button class="btn btn-primary  mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#inputKeterangan">Edit</button>
                    </div>
                </div>
                @if ($produks->keterangan != null || $produks->keterangan != "")
                <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4" role="alert">
                    {{ $produks->keterangan }}
                </div>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    Belum ada keterangan.
                </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Area Riwayat Produksi --}}
    <div class="col-12">
        <div class="summary layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Riwayat Produksi</h3>
                    <a href="{{ route('produksi.produk', $produks->id) }}" class="">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table style-3 table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Kode Produksi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">Ukuran</th>
                                <th class="text-center">Stok (Pcs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produksis as $data)
                            <tr>
                                <td><a href="{{ route('produksi.show', $data->id) }}">{{
                                        $data->tgl_mulai }}</a></td>

                                @if ($data->tgl_selesai == null)
                                <td><a href="{{ route('produksi.show', $data->id) }}">Belum Selesai</a></td>
                                @else
                                <td><a href="{{ route('produksi.show', $data->id) }}">{{
                                        $data->tgl_selesai }}</a></td>
                                @endif

                                <td><a href="{{ route('produksi.show', $data->id) }}">{{
                                        $data->kode_produksi }}</a></td>

                                @if ( $data->status == 'Dalam Proses')
                                <td class="text-center"><span class="badge badge-light-warning">{{
                                        $data->status
                                        }}</span></td>
                                @else
                                <td class="text-center"><span class="badge badge-light-success">{{
                                        $data->status
                                        }}</span></td>
                                @endif

                                <td class="text-center">{{ $data->warna }}</td>
                                <td class="text-center">{{ $data->nama_ukuran }}</td>
                                <td class="text-center">{{ $data->qty_produk }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Area Riwayat Penjualan --}}
    <div class="col-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Riwayat Penjualan</h3>
                    <a href="{{ route('notajual.produk', $produks->id) }}" class="">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table style-3 table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode Nota</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">Ukuran</th>
                                <th class="text-center">Qty (Pcs)</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualans as $data)
                            <tr>
                                <td><a href="{{ route('notajual.show', $data->id) }}">{{ $data->tgl_pesan }}</a></td>

                                <td><a href="{{ route('notajual.show', $data->id) }}">{{ $data->kode_nota }}</a></td>

                                <td class="text-center">{{ $data->warna }}</td>
                                <td class="text-center">{{ $data->nama_ukuran }}</td>
                                <td class="text-center">{{ $data->qty_produk }}</td>
                                <td class="text-end">@currency($data->harga)</td>
                                <td class="text-end">@currency($data->subtotal)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Input Keterangan --}}
<div class="modal fade inputForm-modal" id="inputKeterangan" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produk.update.keterangan', $produks->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Keterangan Produk <b>{{ $produks->kode_produk }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" placeholder="Masukkan keterangan..."
                                name="keterangan">{{ $produks->keterangan }}</textarea>
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

{{-- Modal Ubah Info Dasar --}}
<div class="modal fade inputForm-modal" id="editinformasiproduk" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produk.update.info', $produks->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Info Dasar <b>{{ $produks->kode_produk }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Nama Produk <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="{{ $produks->nama }}" id="input-nama-produk"
                                    class="form-control" name="nama" placeholder="Masukkan nama..." autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Lokasi Rak <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <select class="form-select" name="rak_id" id="input-rak-produk" required>
                                    <option selected disabled value="">Choose...</option>
                                    @foreach ($raks as $rak)
                                    <option value="{{ $rak->id }}" {{ $produks->rak_id==$rak->id ?
                                        'selected' : '' }}>{{ $rak->lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal"
                        id="btn-submit-info-dasar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tambah Warna dan Resep --}}
<div class="modal modal-lg fade inputForm-modal" id="tambahwarnaproduk" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produk.insert.warna', $produks->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Tambah Resep & Warna <b>{{ $produks->kode_produk }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Warna <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="" class="form-control" style="text-transform: uppercase"
                                    name="warna" placeholder="Masukkan warna..." autofocus required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control" accept=".png, .jpeg, .jpg">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <h5><b>Resep</b></h5>
                    </div>

                    <div class="row mb-4">
                        <div class="col-3">
                            <h6><b>Tipe</b></h6>
                        </div>
                        <div class="col">
                            <h6><b>Kode Kain</b><small class="text-muted ms-2 pb-1">(Required)</small></h6>
                        </div>
                    </div>
                    @foreach ($produks->produk_warna[0]->kains as $index => $item)
                    <div class="row mb-4">
                        <div class="col-3">
                            <h6>{{ $item->pivot->tipe }}</h6>
                            <input type="hidden" value="{{ $item->pivot->tipe }}" name="dataResepTambah[{{ $index }}][tipe]">
                        </div>
                        <div class="col">
                            <select class="form-select" name="dataResepTambah[{{ $index }}][kain]"
                                id="input-kain-tambah-{{ $index }}" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($kains as $items)
                                <option value="{{ $items->id }}">{{ $items->kode_kain }} - {{
                                    $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    @endforeach


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal"
                        id="btn-submit-tambah-warna">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Ubah Warna dan Resep --}}
<div class="modal modal-lg fade inputForm-modal" id="editwarnaproduk" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produk.update.warna', $produks->id) }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Ubah Warna & Resep <b>{{ $produks->kode_produk }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="bs-stepper stepper-form-one">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#defaultStep-one">
                                <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Warna</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-two">
                                <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Resep</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <div id="defaultStep-one" class="content" role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col">
                                        <h6 class="">Warna <small class="text-muted ms-2 pb-1">(Required)</small>
                                        </h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">Kode Kain <small class="text-muted ms-2 pb-1">(Required)</small>
                                        </h6>
                                    </div>
                                </div>

                                <div class="kain-list">
                                    @foreach ($produkwarnas as $index => $item)
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" value="{{ $item->warna }}" class="form-control"
                                                name="dataWarna[{{ $item->id }}][warna]" placeholder="Masukkan warna..."
                                                style="text-transform: uppercase" id="input-warna-{{ $item->id }}"
                                                required>
                                        </div>
                                        <div class="col">
                                            <input type="file" name="dataWarna[{{ $item->id }}][foto]"
                                                class="form-control" accept=".png, .jpeg, .jpg">
                                            @if ($item->foto != null || $item->foto != "")
                                            <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4"
                                                role="alert">
                                                <strong>{{ $item->foto }}</strong> Silahkan memasukan file
                                                foto pada input di
                                                atas jika ingin
                                                mengganti
                                                foto.</button>
                                            </div>
                                            @else
                                            <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4"
                                                role="alert">
                                                <strong>Foto Produk belum ada!</strong> Silahkan memasukkan
                                                file
                                                foto pada input di
                                                atas.
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="button-action text-end">
                                    <button type="button" id="btn-nxt1" class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>

                            <div id="defaultStep-two" class="content" role="tabpanel">
                                <div id="area-resep">

                                    @foreach ($produkwarnas as $index => $data)
                                    <div class="invoice-detail-items warna-{{ $data->id }}" style="padding-top: 10px">
                                        <h5 id="warna-resep-{{ $data->id }}">{{ $data->warna }}</h5>
                                        <div class="table-responsive">
                                            <table class="table item-table resep-kain">
                                                <thead>
                                                    <tr>
                                                        <th class="" style="width:25%">Tipe</th>
                                                        <th class="">Kode Kain</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody-{{ $data->id }}">
                                                    @foreach ($data->kains as $idx => $item)
                                                    <tr>
                                                        <td>
                                                            <h6>{{ $item->pivot->tipe }}</h6>
                                                            <input type="hidden" value="{{ $item->pivot->tipe }}"
                                                                name="dataResep[{{ $data->id }}][{{ $idx }}][tipe]">
                                                        </td>
                                                        <td>
                                                            <select class="form-select"
                                                                name="dataResep[{{ $data->id }}][{{ $idx }}][kain]"
                                                                id="input-kain-{{ $data->id }}-{{ $idx }}" required>
                                                                <option selected disabled value="">Choose...
                                                                </option>
                                                                @foreach ($kains as $value)
                                                                <option value="{{ $value->id }}" {{ $item->
                                                                    pivot->kain_id==$value->id ?
                                                                    'selected' : '' }}>{{ $value->kode_kain }} - {{
                                                                    $value->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    @endforeach

                                </div>

                                <div class="button-action text-end">
                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal"
                        id="btn-submit-ubah-warna">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Ubah Harga --}}
<div class="modal fade inputForm-modal" id="edithargaproduk" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produk.update.harga', $produks->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Ubah Harga <b>{{ $produks->kode_produk }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div id="tabsSimple" class="col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                    
                                <div class="simple-tab">
                    
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($produks->produk_warna as $index=>$item)
                                        <li class="nav-item" role="presentation">
                                            @if ($index == 0)
                                            <button class="nav-link active" id="{{ $item->warna }}-tab-harga" data-bs-toggle="tab"
                                                data-bs-target="#{{ $item->warna }}-tab-pane" type="button" role="tab"
                                                aria-controls="{{ $item->warna }}-tab-pane" aria-selected="true">{{ $item->warna
                                                }}</button>
                                            @else
                                            <button class="nav-link" id="{{ $item->warna }}-tab-harga" data-bs-toggle="tab"
                                                data-bs-target="#{{ $item->warna }}-tab-pane" type="button" role="tab"
                                                aria-controls="{{ $item->warna }}-tab-pane" aria-selected="false">{{ $item->warna
                                                }}</button>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                    
                                    <div class="tab-content" id="myTabContent">
                                        @foreach ($produks->produk_warna as $index=>$item)
                                        @if ($index == 0)
                                        <div class="tab-pane fade show active" id="{{ $item->warna }}-tab-pane" role="tabpanel"
                                            aria-labelledby="{{ $item->warna }}-tab-harga" tabindex="0">
                                            <div class="widget-content widget-content-area">
                                                <div class="table-responsive">
                                                    <table class="table style-3 table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Ukuran</th>
                                                                <th class="">Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item->produk_ukuran as $index => $data)
                                                            <tr>
                                                                <td class="text-center">
                                                                    <h6>{{ $data->ukurans->nama }}</h6>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" value="{{ $data->ukuran_id }}" name="dataProduk[{{ $data->id }}][ukuran]">
                                                                    <input type="number" value="{{ $data->harga }}" id="input-harga-{{ $data->id }}" class="form-control"
                                                                        name="dataProduk[{{ $data->id }}][harga]" min=0 step=0.01>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="tab-pane fade" id="{{ $item->warna }}-tab-pane" role="tabpanel"
                                            aria-labelledby="{{ $item->warna }}-tab-harga" tabindex="0">
                                            <div class="widget-content widget-content-area">
                                                <div class="table-responsive">
                                                    <table class="table style-3 table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Ukuran</th>
                                                                <th class="">Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item->produk_ukuran as $index => $data)
                                                            <tr>
                                                                <td class="text-center">
                                                                    <h6>{{ $data->ukurans->nama }}</h6>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" value="{{ $data->ukuran_id }}" name="dataProduk[{{ $data->id }}][ukuran]">
                                                                    <input type="number" value="{{ $data->harga }}" id="input-harga-{{ $data->id }}"
                                                                        class="form-control" name="dataProduk[{{ $data->id }}][harga]" min=0 step=0.01>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal"
                        id="btn-submit-harga">Submit</button>
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
<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/custom-glightbox.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/stepper/custom-bsStepper.min.js') }}"></script>

{{-- Setting tabel --}}
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

{{-- Tom Select Rak--}}
<script>
    new TomSelect("#input-rak-produk",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

</script>

{{-- Tom Select Resep--}}
<script>
    $('[id^="input-kain-tambah-"]').each(function() {
        var id = $(this).attr('id')

        new TomSelect("#" + id,{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    })

    $('#editwarnaproduk [id^="input-kain-"]').each(function() {
        var id = $(this).attr('id')

        new TomSelect("#" + id,{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    })
    
</script>

{{-- Required Info Dasar --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#input-rak-produk').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });

            $('#input-nama-produk').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });

            if (allFieldsFilled) {
                $('#btn-submit-info-dasar').prop('disabled', false);
            } else {
                $('#btn-submit-info-dasar').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('#input-rak-produk').on('input', function () {
            checkRequiredFields()
        });

        $('#input-nama-produk').on('input', function () {
            checkRequiredFields()
        });
    });
</script>

{{-- Required Ubah Harga --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('input[id^="input-harga-"]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });
            if (allFieldsFilled) {
                $('#btn-submit-harga').prop('disabled', false);
            } else {
                $('#btn-submit-harga').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('input[id^="input-harga-"]').on('input', function () {
            var value = $(this).val();

            if (value < 0) {
                $(this).val(Math.abs(value));
            }

            checkRequiredFields()
        });
    });
</script>

{{-- Required Tambah WarnaResep --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#tambahwarnaproduk [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });
            if (allFieldsFilled) {
                $('#btn-submit-tambah-warna').prop('disabled', false);
            } else {
                $('#btn-submit-tambah-warna').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('#tambahwarnaproduk [required]').on('input', function () {
            checkRequiredFields()
        });
    });
</script>

{{-- Required Ubah WarnaResep --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#editwarnaproduk [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });
            if (allFieldsFilled) {
                $('#btn-nxt1').prop('disabled', false);
                $('#btn-submit-ubah-warna').prop('disabled', false);
            } else {
                $('#btn-nxt1').prop('disabled', true);
                $('#btn-submit-ubah-warna').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('#editwarnaproduk [required]').on('input', function () {
            checkRequiredFields()
        });

        function checkRequiredFields() {
            var valueWarna = true;
            var required = true;
            var values = [];

            $('#editwarnaproduk [id^="input-warna-"]').each(function() {
                var value1 = $(this).val().toUpperCase();
                $(this).val(value1);

                if (value1 === "" || values.includes(value1)) {
                    valueWarna = false;
                    return false;
                }
                values.push(value1);
            });

            $('#editwarnaproduk [required]').each(function() {
                if ($(this).val() === null || $(this).val() === '') {
                    required = false;
                    return false;
                }
            });

            // $('#btn-nxt2').prop('disabled', !valueWarna);
            if (valueWarna && required) {
                $('#btn-nxt1').prop('disabled', false);
                $('#btn-submit-ubah-warna').prop('disabled', false);
            } else {
                $('#btn-nxt1').prop('disabled', true);
                $('#btn-submit-ubah-warna').prop('disabled', true);
            }
        }

        checkRequiredFields();

        $('#editwarnaproduk [required]').on('input', function () {
            checkRequiredFields()
        });
    });
</script>


@endsection