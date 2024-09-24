@extends('cork.cork')

@section('title', 'Daftar Musim')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/dark/table/datatable/custom_dt_custom.css') }}">

<link href="{{ asset('assets/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Musim</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="page-meta">
    <button class="btn btn-primary mb-2 me-4" data-bs-toggle="modal" data-bs-target="#tambahmusim">
        <i data-feather="plus"></i>
        <span class="btn-text-inner">Tambah Musim</span>
    </button>
</div>

<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 table-hover">
                    <thead>
                        <tr>
                            <th style="width: 8%;">Id</th>
                            <th>Nama Musim</th>
                            <th class="text-center dt-no-sorting" style="width: 5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($musims as $data)
                        <tr>
                            <td><a href="{{ route('musim.show', $data->id) }}">{{
                                    $data->id }}</a></td>
                            <td><a href="{{ route('musim.show', $data->id) }}">{{
                                    $data->nama }}</a></td>

                            <td class="text-center">

                                <form method="POST" action="{{ route('musim.destroy', $data->id) }}">
                                    @csrf
                                    @method("DELETE")

                                    <a class="btn btn-light-danger btn-icon bs-tooltip"
                                        href="{{ route('musim.destroy', $data->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete" data-confirm-delete="true"
                                        data-original-title="Delete" type="submit"><i data-feather="trash"></i></a>
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

{{-- Modal Tambah Musim --}}
<div class="modal fade inputForm-modal" id="tambahmusim" tabindex="-1" role="dialog"
    aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('musim.store') }}">
                @csrf
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Tambah Musim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><i
                            data-feather="x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label>Nama Musim <small class="text-muted ms-2 pb-1">(Required)</small></label>
                                <input type="text" value="" class="form-control" name="nama"
                                    placeholder="Masukkan nama..." autofocus required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal"
                        id="btn-submit-tambah-musim">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>

{{-- Setting table --}}
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

{{-- Required Tambah Musim --}}
<script>
    $(document).ready(function () {

        function checkRequiredFields() {
            var allFieldsFilled = true;

            $('#tambahmusim [required]').each(function () {
                if ($(this).val() === null || $(this).val() === '') {
                        allFieldsFilled = false;
                        return false;
                }
            });

            if (allFieldsFilled) {
                $('#btn-submit-tambah-musim').prop('disabled', false);
            } else {
                $('#btn-submit-tambah-musim').prop('disabled', true);
            }
        }

        checkRequiredFields()

        $('#tambahmusim [required]').on('input', function () {
            checkRequiredFields()
        });
    });
</script>

@endsection