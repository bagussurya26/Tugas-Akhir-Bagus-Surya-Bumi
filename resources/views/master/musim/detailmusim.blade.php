@extends('cork.cork')

@section('title')
{{ $musims->nama }}
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
            <li class="breadcrumb-item"><a href="{{ route('musim.index') }}">Musim</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $musims->nama }}</li>
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
                            data-bs-target="#editinformasimusim">Ubah Informasi Dasar</button>
                        <button class="btn btn-success mb-2 me-4" data-bs-toggle="modal"
                            data-bs-target="#tambahmusimdetail">Tambah Detail Musim</button>
                    </div>
                </div>

                <div class="order-summary">

                    <div class="summary-list summary-id">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Id <span class="summary-count">{{ $musims->id }} </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list summary-nama">
                        <div class="summery-info">
                            <div class="w-summary-details">
                                <div class="w-summary-info">
                                    <h6>Nama Musim<span class="summary-count">{{ $musims->nama }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Area Detail Musim --}}
    <div class="col-12">
        <div class="summary layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Detail Musim {{ $musims->nama }}</h3>
                    {{-- <a href="{{ route('musim.detail', $musims->id) }}" class="">View All</a> --}}
                </div>
                <div class="table-responsive">
                    <table class="table style-3 table-hover">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Bulan Awal</th>
                                <th>Bulan Akhir</th>
                                <th class="text-center dt-no-sorting" style="width: 5%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($musimdetail as $data)
                            <tr>
                                <td>{{ $data->tahun }}</td>
                                <td>{{ $data->bulan_awal }}</td>
                                <td>{{ $data->bulan_akhir }}</td>
                                <td class="text-center">

                                    <button class="btn btn-light-primary btn-icon bs-tooltip"
                                        id="btn-ubah-musim-detail-{{ $data->id }}"
                                        onclick="checkRequire({{ $data->id }})" data-bs-toggle="modal"
                                        data-bs-target="#ubah-musim-detail-{{ $data->id }}"><i
                                            data-feather="edit-3"></i></button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal Ubah Info Dasar --}}
<div class="modal fade inputForm-modal" id="editinformasimusim" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('musim.update', $musims->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Info Dasar <b>{{ $musims->nama }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Nama Musim <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="{{ $musims->nama }}" id="input-nama-musim"
                                    class="form-control" name="nama" placeholder="Masukkan nama..." autofocus required>
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

{{-- Modal Tambah Musim Detail --}}
<div class="modal modal-lg fade inputForm-modal" id="tambahmusimdetail" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('musimdetail.create') }}">
                @csrf
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Tambah Detail Musim <b>{{ $musims->nama }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Tahun <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="" class="form-control" name="tahun"
                                    placeholder="Masukkan tahun..." autofocus required>
                                <input type="hidden" value="{{ $musims->id }}" name="musim_id">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Bulan Awal <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="" class="form-control" name="bulan_awal"
                                    placeholder="Masukkan bulan..." autofocus required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Bulan Akhir <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="" class="form-control" name="bulan_akhir"
                                    placeholder="Masukkan bulan..." autofocus required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal"
                        id="btn-submit-tambah-musim-detail">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($musimdetail as $data)
{{-- Modal Ubah Musim Detail --}}
<div class="modal modal-lg fade inputForm-modal" id="ubah-musim-detail-{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('musimdetail.update', $data->id) }}">
                @csrf
                @method("PUT")
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Ubah Detail Musim <b>{{ $musims->nama }} {{ $data->tahun }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Tahun <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="{{ $data->tahun }}" class="form-control" name="tahun"
                                    placeholder="Masukkan tahun..." oninput="tahun({{ $data->id }})" autofocus required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Bulan Awal <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="{{ $data->bulan_awal }}" class="form-control"
                                    name="bulan_awal" placeholder="Masukkan bulan..."
                                    oninput="bulanawal({{ $data->id }})" autofocus required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Bulan Akhir <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="{{ $data->bulan_akhir }}" class="form-control"
                                    name="bulan_akhir" placeholder="Masukkan bulan..."
                                    oninput="bulanakhir({{ $data->id }})" autofocus required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal"
                        id="btn-submit-ubah-musim-detail-{{ $data->id }}">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

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

{{-- Required Info Dasar --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;

            $('#input-nama-musim').each(function () {
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

        $('#input-nama-musim').on('input', function () {
            checkRequiredFields()
        });
    });
</script>

{{-- Required Tambah Musim Detail --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;
            $('#tambahmusimdetail [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });
            if (allFieldsFilled) {
                $('#btn-submit-tambah-musim-detail').prop('disabled', false);
            } else {
                $('#btn-submit-tambah-musim-detail').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('#tambahmusimdetail [required]').on('input', function () {
            checkRequiredFields()
        });
    });
</script>

{{-- Required Ubah Musim Detail --}}
<script>
    function checkRequiredFields(id) {
        var allFieldsFilled = true;
        $('#ubah-musim-detail-'+id+' [required]').each(function () {
            if ($(this).val() === null || $(this).val() === '') {
                allFieldsFilled = false;
                return false;
            }
        });
        if (allFieldsFilled) {
            $('#btn-submit-ubah-musim-detail-' + id).prop('disabled', false);
        } else {
            $('#btn-submit-ubah-musim-detail-' + id).prop('disabled', true);
        }
    }

    function checkRequire(id) {
        checkRequiredFields(id);
    }

    function tahun(id) {
        checkRequiredFields(id);
    }

    function bulanawal(id) {
        checkRequiredFields(id);
    }

    function bulanakhir(id) {
        checkRequiredFields(id);
    }
</script>


@endsection