@extends('cork.cork')

@section('title', 'Tambah Data Kain')

@section('cssinsertsupplier')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/filepond.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/tagify/tagify.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/tagify/custom-tagify.css') }}">
<link href="{{ asset('assets/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet"
    type="text/css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/tagify/custom-tagify.css') }}">
<link href="{{ asset('assets/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css') }}" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

<!--  BEGIN CUSTOM STYLE FILE  -->
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">
<!--  END CUSTOM STYLE FILE  -->
@endsection

@section('konteninsertsupplier')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row mb-4 layout-spacing">

    <form method="POST" class="row g-3" action="{{ route('supplier.store') }}"
        enctype="multipart/form-data">
        @csrf

        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col">
                        <label>Nama Supplier</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="input-nama"
                                name="nama" placeholder="Nama Supplier" value="{{ old('nama') }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-8">
                        <label for="input-alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="input-alamat"
                            name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>No. Telp/HP</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="input-nohp"
                                name="no_hp" placeholder="No. Telp/HP" value="{{ old('no_hp') }}">
                            @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label for="input-email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="input-email"
                            name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-7">
                        <label for="input-norek">No. Rekening</label>
                        <input type="text" class="form-control @error('no_rek') is-invalid @enderror" id="input-norek"
                            name="no_rek" placeholder="No. Rekening" value="{{ old('no_rek') }}">
                        @error('no_rek')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="input-keterangan">Keterangan</label>
                        <textarea class="form-control" id="input-keterangan" rows="5" placeholder="Keterangan"
                            value="{{ old('keterangan') }}" name="keterangan"></textarea>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label for="product-images">Upload Foto</label>
                        <div class="multiple-file-upload">
                            <input type="file" name="foto" id="input-foto"
                                class="filepond file-upload-multiple @error('foto') is-invalid @enderror"
                                allow-multiple="false" allow-replace="true" max-file-size="3MB" check-validity="true">
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="row">
                <div class="col-xxl-12 col-xl-8 col-lg-8 col-md-7 mt-xxl-0 mt-4">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-danger w-100">Reset</button>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success w-100" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('jsinsertsupplier')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/src/plugins/src/filepond/filepond.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
{{-- <script src="{{ asset('assets/src/plugins/src/filepond/custom-filepond.js') }}"></script> --}}

<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>

<script>
    const inputElement = document.querySelector('input[id="input-foto"]');
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server: {
            process: '{{ route('kain.store') }}',
            revert: '{{ route('kain.store') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        },
        // file: {
        //     type: 'image/png',
        // },
        // type: 'local',
    });
</script>
@endsection