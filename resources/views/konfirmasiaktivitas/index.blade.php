@extends('cork.cork')

@section('title', 'Konfirmasi Aktivitas')

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
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Aktivitas</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-spacing page-meta">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th class="text-center dt-no-sorting" style="width: 5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($kains as $kain)
                        <tr>
                            <td><a href="{{ route('kain.show', $kain->id) }}">{{
                                    $kain->kode_kain }}</a></td>
                            <td><a href="{{ route('kain.show', $kain->id) }}">{{
                                    $kain->nama }}</a></td>
                            <td>{{ $kain->warna }}</td>
                            <td class="text-center">{{ $kain->raks->lokasi }}</td>

                            @if ($kain->stok < 1) <td class="text-center"><span
                                    class="badge badge-light-danger">Habis</span></td>
                                @elseif ($kain->stok <= 100) <td class="text-center"><span
                                        class="badge badge-light-warning">Hampir
                                        Habis</span></td>
                                    @else
                                    <td class="text-center"><span class="badge badge-light-success">Masih Ada</span>
                                    </td>
                                    @endif

                                    <td>{{ $kain->stok }}</td>

                                    <td class="text-center">

                                        <form method="POST" action="{{ route('kain.destroy', $kain->id) }}">
                                            @csrf
                                            @method("DELETE")

                                            <a class="btn btn-light-primary btn-icon bs-tooltip"
                                                href="{{ route('kain.edit', $kain->id) }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit" data-original-title="Edit"><i
                                                    data-feather="edit-3"></i></a>

                                            <a class="btn btn-light-danger btn-icon bs-tooltip"
                                                href="{{ route('kain.destroy', $kain->id) }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete" data-confirm-delete="true"
                                                data-original-title="Delete" type="submit"><i
                                                    data-feather="trash"></i></a>
                                        </form>
                                    </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
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

@endsection