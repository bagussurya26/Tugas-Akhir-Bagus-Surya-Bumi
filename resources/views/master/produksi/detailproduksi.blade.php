@extends('cork.cork')

@section('title')
Detail Produksi - {{ $produksis->kode_produksi }}
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

<link href="{{ asset('assets/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/src/tomSelect/tom-select.default.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">

@endsection


@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produksi.index') }}">Produksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $produksis->kode_produksi }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row">
    {{-- Informasi produksi --}}
    <div class="col-12 layout-top-spacing">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Informasi</h3>
                    <div class="button-action text-end">
                        @if ($produksis->status == 'Dalam Proses')
                        <button class="btn btn-success  mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#konfirmProduksi">Konfirmasi
                            Selesai</button>
                        @endif
                    </div>
                </div>

                <div class="order-summary">
                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Kode Produksi <span class="summary-count">{{ $produksis->kode_produksi }}
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-status">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($produksis->status == 'Dalam Proses')
                                    <h6>Status <span class="badge badge-light-warning">{{ $produksis->status
                                            }}</span>
                                    </h6>
                                    @else
                                    <h6>Status <span class="badge badge-light-success">{{ $produksis->status
                                            }}</span>
                                    </h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Karyawan <span class="summary-count">{{ $produksis->karyawans->nama }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-tgl-mulai">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Tanggal Mulai <span class="summary-count">{{ $produksis->tgl_mulai }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-tgl-selesai">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    @if ($produksis->tgl_selesai == null)
                                    <h6>Tanggal Selesai <span class="summary-count">Belum Selesai</span></h6>
                                    @else
                                    <h6>Tanggal Selesai <span class="summary-count">{{ $produksis->tgl_selesai }}</span>
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

    {{-- Area Rincian --}}
    <div class="col-12">
        <div class="summary layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Rincian Produksi</h3>
                    {{-- <div class="button-action text-end">
                        <button class="btn btn-primary  mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#targetProduk">Edit</button>
                    </div> --}}
                </div>
                <div class="table-responsive">
                    <table class="table style-3 table-hover">
                        <thead>
                            <tr>
                                <th>Kode Produk</th>
                                <th>Warna</th>
                                <th class="text-center">Ukuran</th>
                                <th class="text-center">Qty (Pcs)</th>
                                <th>Kain Utama</th>
                                <th class="text-center">Qty Kain (M)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $prevColor = null;
                            @endphp
                            @foreach ($targetProduks as $item)
                            <tr>
                                @if ($item->warna == $prevColor)
                                <td><a href="{{ route('produk.show', $item->produk_id) }}"></td>
                                <td></td>
                                @else
                                <td><a href="{{ route('produk.show', $item->produk_id) }}">{{
                                        $item->kode_produk }}</td>
                                <td>{{ $item->warna }}</td>
                                @endif
                                <td class="text-center">{{ $item->nama_ukuran }}</td>
                                <td class="text-center">{{ $item->qty_produk }}</td>
                                <td>{{ $item->kode_kain }}</td>
                                <td class="text-center">{{ $item->qty_kain }}</td>
                            </tr>
                            @php
                            $prevColor = $item->warna;
                            @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Keterangan Produksi --}}
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
                @if ($produksis->keterangan != null || $produksis->keterangan != "")
                <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4" role="alert">
                    {{ $produksis->keterangan }}
                </div>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    Belum ada keterangan.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


{{-- Modal Potong Kain Selesai --}}
{{-- <div class="modal fade modal-notification" id="konfirmNotaPotong" tabindex="-1" role="dialog"
    aria-labelledby="standardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" id="standardModalLabel">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="text-center" style="width: 100%; height:100%">
                    <i style="width: 50%; height: 50%; object-fit: cover; color: #F7C500;"
                        data-feather="alert-triangle"></i>
                </div>
                <H4>Konfirmasi penyelesaian potong kain</H4>
                <H6>Apakah anda yakin?</H6>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                    data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('produksi.update.notapotong', $produksis->id) }}">
                    @csrf
                    @method("PUT")
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{-- Modal Produksi Selesai --}}
<div class="modal fade inputForm-modal" id="konfirmProduksi" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produksi.update', $produksis->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Konfirmasi Produksi <b>{{ $produksis->kode_produksi }}</b> Selesai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">

                    @foreach ($produkwarnas as $item)

                    <div class="invoice-detail-items" style="padding-top: 10px">
                        <h5>{{ $item->warna }}</h5>
                        <div class="table-responsive">
                            <table class="table item-table">
                                <thead>
                                    <tr>
                                        <th class="">Ukuran</th>
                                        <th class="" style="width:40%">Qty (Pcs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $relatedData = App\Models\ListKain::join('komposisi', 'list_kains.id',
                                    '=',
                                    'komposisi.list_kain_id')
                                    ->join('produk_ukuran', 'produk_ukuran.id','=','komposisi.produk_ukuran_id')
                                    ->join('ukurans', 'ukurans.id', '=', 'produk_ukuran.ukuran_id')
                                    ->join('produk_warna', 'produk_warna.id', '=', 'produk_ukuran.produk_warna_id')
                                    ->select('produk_ukuran.*', 'komposisi.*', 'ukurans.nama')
                                    ->where('list_kains.nota_produksi_id', $produksis->id)
                                    ->where('produk_warna.id', $item->id)
                                    ->get();
                                    @endphp

                                    @foreach ($relatedData as $data2)

                                    <tr>
                                        <td>
                                            <label>{{ $data2->nama }}</label>
                                        </td>
                                        <td>
                                            <input type="number" value="{{ $data2->qty_produk }}" class="form-control"
                                                min=1 name="dataTarget[{{ $data2->list_kain_id }}][{{ $data2->id }}]" required>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        {{-- <button type="button" class="btn btn-dark btn-tambah-resep me-3">Tambah</button> --}}

                    </div>
                    @endforeach

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" placeholder="Masukkan keterangan..."
                                name="keterangan">{{ $produksis->keterangan }}</textarea>
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

{{-- Modal Input Keterangan --}}
<div class="modal fade inputForm-modal" id="inputKeterangan" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produksi.update.keterangan', $produksis->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Keterangan Produksi <b>{{ $produksis->kode_produksi }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" placeholder="Masukkan keterangan..."
                                name="keterangan">{{ $produksis->keterangan }}</textarea>
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

{{-- Modal Input Target Produk --}}
{{-- <div class="modal fade inputForm-modal modal-xl" id="targetProduk" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('produksi.update.target', $produksis->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Target Produk Produksi <b>{{ $produksis->kode_produksi }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="bs-stepper stepper-form-one">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#defaultStep-one">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Target Produk</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#defaultStep-two">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Target Qty</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">

                                <div id="defaultStep-one" class="content" role="tabpanel">

                                    <div class="row mb-4">

                                        <div class="col-4">
                                            <label>Kode Produk <small
                                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                                            <div class="col-sm-12">
                                                <select class="form-select" id="input-produk" name="produk_id"
                                                    oninput="namaUkuran()" autocomplete="off" required>
                                                    <option selected disabled value="">Choose...</option>
                                                    @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}" {{ $targetProduks[0]->
                                                        produk_id==$produk->
                                                        id ?
                                                        'selected' : '' }}>{{ $produk->kode_produk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Nama Produk</label>
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('nama_produk') }}" class="form-control"
                                                    name="nama_produk" id="input-nama-produk" readonly>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="button-action mt-5 text-end">
                                        <button type="button" id="btn-nxt1"
                                            class="btn btn-secondary btn-nxt">Next</button>
                                    </div>

                                </div>

                                <div id="defaultStep-two" class="content" role="tabpanel">
                                    <div id="area-target">
                                    </div>

                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                    </div>

                                </div>
                            </div>
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
</div> --}}

@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/glightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/splide/splide.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/apps/ecommerce-details.js') }}"></script>

<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>

<script src="{{ asset('assets/src/plugins/src/stepper/bsStepper.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/stepper/custom-bsStepper.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>

{{-- Setting Table --}}
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

{{-- Tanggal --}}
<script>
    var tglTerima = flatpickr(document.getElementById('tanggal_terima'), {allowInput:true,});
</script>

{{-- Tom Select --}}
<script>
    new TomSelect("#input-produk",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect("#input-karyawan",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

{{-- Get Nama, Warna, Ukuran Produk --}}
<script>
    $(document).ready(function () {
        
        // GetNama
        var idproduk = document.getElementById("input-produk").value;
        var selectedNama = getNamaProduk(idproduk);
        document.getElementById("input-nama-produk").value = selectedNama;

        // GetWarna
        var selectedId = document.getElementById("input-produk").value;
        $("#area-target").empty();
        fetch('/getWarnaProduk/' + selectedId)
                .then(response => response.json())
                .then(data => {

                    data.forEach(item => {

                        $html = '<div class="invoice-detail-items target-'+ item.id +'" style="padding-top: 10px">' +
                            '<h5 id="warna-produk-'+ item.id +'">'+item.warna+'</h5>' +
                            '<div class="table-responsive">' +
                                '<table class="table item-table target-produk">' +
                                    '<thead>' +
                                        '<tr>' +
                                            '<th class="text-center" style="width:10%">Ukuran</th>' +
                                            '<th class="">Qty (Pcs)</th>' +
                                        '</tr>' +
                                    '</thead>' +
                                    '<tbody id="tbody-'+ item.id +'">' +
                                    '</tbody>' +
                                '</table>' +
                            '</div>' +
                            '</div>';
                        
                        $("#area-target").append($html);

                        getUkuranProduk(item.id);
                    });
                })
                .catch(error => console.error('Error:', error));
        
    })

        function namaUkuran() {
            updateNamaProduk();
            getWarnaProduk();
        }

        function updateNamaProduk() {
            var selectedId = document.getElementById("input-produk").value;
            var selectedNama = getNamaProduk(selectedId);
            var selectedKode = getKodeProduk(selectedId);
            document.getElementById("input-nama-produk").value = selectedNama;

            $("#kode-produksi").empty();
            $("#tgl-mulai-produksi").empty();
            $("#kode-produk-target").empty();

            var currentTimestamp = $.now();
            var currentDate = new Date(currentTimestamp);
            var formattedDate = currentDate.getFullYear();
            var lastTwoDigits = formattedDate % 100;
            // console.log("Current Date:", lastTwoDigits);

            var kodeProduksi = lastTwoDigits + selectedKode;

            // console.log("Kode produksi:", kodeProduksi);

            $("#kode-produksi").text(kodeProduksi);
            $("#kode-produk-target").text('Target Produk ' + selectedKode);
            

            var currentTimestamp = $.now();
            
            // Convert the timestamp to a Date object
            var currentDate = new Date(currentTimestamp);
            
            // Function to format the date and time in Indonesian
            function formatIndonesianDateTime(date) {
            var options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            };
            
            var formattedDate = date.toLocaleString('id-ID', options);
            var formattedTimezone = 'WIB';
            
            return formattedDate + ' ' + formattedTimezone;
            }
            
            // Format the date and time as a string in Indonesian
            var formattedIndonesianDateTime = formatIndonesianDateTime(currentDate);
            
            // Display the formatted date and time in the console or wherever needed
            // console.log("Formatted Date and Time in Indonesian:", formattedIndonesianDateTime);

            $("#tgl-mulai-produksi").text(formattedIndonesianDateTime);
        }
        
        function getNamaProduk(id) {
            var produks = @json($produks);
            var selectedProduk = produks.find(produk => produk.id == id);
            
            return selectedProduk ? selectedProduk.nama : '';
        }

        function getKodeProduk(id) {
            var produks = @json($produks);
            var selectedProduk = produks.find(produk => produk.id == id);
            
            return selectedProduk ? selectedProduk.kode_produk : '';
        }

        function getWarnaProduk() {
            var selectedId = document.getElementById("input-produk").value;
            $("#area-target").empty();
            fetch('/getWarnaProduk/' + selectedId)
                .then(response => response.json())
                .then(data => {

                    data.forEach(item => {

                        $html = '<div class="invoice-detail-items target-'+ item.id +'" style="padding-top: 10px">' +
                            '<h5 id="warna-produk-'+ item.id +'">'+item.warna+'</h5>' +
                            '<div class="table-responsive">' +
                                '<table class="table item-table target-produk">' +
                                    '<thead>' +
                                        '<tr>' +
                                            '<th class="text-center" style="width:10%">Ukuran</th>' +
                                            '<th class="">Qty (Pcs)</th>' +
                                        '</tr>' +
                                    '</thead>' +
                                    '<tbody id="tbody-'+ item.id +'">' +
                                    '</tbody>' +
                                '</table>' +
                            '</div>' +
                            '</div>';
                        
                        $("#area-target").append($html);

                        getUkuranProduk(item.id);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function getUkuranProduk(id) {
            fetch('/getUkuranProduk/' + id)
                .then(response => response.json())
                .then(data => {

                    data.forEach(item => {

                        var html = '<tr>' +
                                '<td class="text-center">'+
                                    '<h6>'+item.nama+'</h6>' +
                                '</td>'+
                                
                                '<td>'+
                                    '@php $found = false; @endphp'+
                                    
                                    '@foreach ($targetProduks as $data)'+

                                    '@if ( $data->id == ' + id + ' && $data->ukuran_id == ' + item.id + ')'+                                   
                                    '<input type="number" class="form-control" min="0" value="{{ $data->qty_produk }}" name="dataTarget['+id+']['+item.id+'][qty]" id="input-qty-'+id+'-'+item.id+'" required>'+
                                    '@php $found = true; @endphp'+
                                    '@endif'+
                                    '@endforeach'+
                                    
                                    '@if (!$found)'+
                                    '<input type="number" class="form-control" min="0" value="0" name="dataTarget['+id+']['+item.id+'][qty]" id="input-qty-'+id+'-'+item.id+'" required>'+
                                    '@endif'+

                                '</td>'+
                                
                            '</tr>';
        
                        $("#tbody-" + id).append(html);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
</script>

{{-- Target produk dan Estimasi Kain --}}
<script>
    $("#btn-nxt2").on("click", function() {
        var resultArray = [];

        $("#th-warna-produk").empty();
        $("#td-ukuran-produk").empty();
        $("#td-qty-produk").empty();

        $html1 = '<th>Warna</th>';
        
        $("#th-warna-produk").append($html1);
        
        $html2 = '<td>Ukuran</td>';
        
        $("#td-ukuran-produk").append($html2);
        
        $html3 = '<td>Qty (Pcs)</td>';
        
        $("#td-qty-produk").append($html3);
        
        $('input[type="number"]').each(function(index) {
            var id = $(this).attr('id');
            var qty = $(this).val();

            var match = id.match(/(\d+)-(\d+)$/);

            var number1 = match[1];
            var number2 = match[2];

            var namaUkuran = getNamaUkuran(number2);
            var warna = getWarna(number1);

            if (qty != 0) {
                var obj = {
                    "produk_warna_id": number1,
                    "ukuran_id": number2,
                    "qty": qty
                };

                resultArray.push(obj);

                $html1 = '<th class="text-center">'+warna+'</th>';
                
                $("#th-warna-produk").append($html1);

                $html2 = '<td class="text-center">'+namaUkuran+'</td>';
                
                $("#td-ukuran-produk").append($html2);

                $html3 = '<td class="text-center">'+qty+'</td>';
                
                $("#td-qty-produk").append($html3);
            }
            
        });

        // Estimasi Kebutuhan

        $("#th-kode-kain").empty();
        $("#td-qty-kain").empty();
        
        $html1 = '<th>Kode Kain</th>';
        
        $("#th-kode-kain").append($html1);
        
        $html2 = '<td>Qty (Meter)</td>';
        
        $("#td-qty-kain").append($html2);

        resultArray.forEach(element => {
            
            var kain = getKain(element.produk_warna_id);

            kain.forEach(data => {

                var qty = 800;

                if (data.tipe !== 'KOMBINASI') {
                    $html1 = '<th class="text-center">'+data.kode_kain+'</th>';
                    
                    $("#th-kode-kain").append($html1);
                    
                    $html2 = '<td class="text-center">'+qty+'</td>';
                    
                    $("#td-qty-kain").append($html2);
                }

            });
        });
        
    })

    function getKain(id) {
        var reseps = @json($reseps);
        var selectedKain = reseps.filter(data => data.produk_warna_id == id);
        
        return selectedKain ? selectedKain : '';
    }

    function getWarna(id) {
        var produkwarnas = @json($produkwarnas);
        var selectedWarna = produkwarnas.find(data => data.id == id);
        
        return selectedWarna ? selectedWarna.warna : '';
    }

    function getNamaUkuran(id) {
        var ukurans = @json($ukurans);
        var selectedUkuran = ukurans.find(data => data.id == id);
        
        return selectedUkuran ? selectedUkuran.nama : '';
    }
</script>

@endsection