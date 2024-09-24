@extends('cork.cork')

@section('title', 'Tambah Data Kain')

@section('cssinsertkain')
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

<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('assets/src/plugins/src/sweetalerts2/sweetalerts2.css') }}"> --}}

@endsection

@section('konteninsertkain')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kain.index') }}">Kain</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

{{-- @if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif --}}

<div class="row mb-4 layout-spacing">

    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('kain.store') }}">
        @csrf

        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-4">
                        <label>Kode Kain</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('kode_kain') }}"
                                class="form-control @error('kode_kain') is-invalid @enderror" name="kode_kain"
                                placeholder="Kode Kain" autofocus>
                            @error('kode_kain')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Jenis Kain</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('jenis_kain') }}"
                                class="form-control @error('jenis_kain') is-invalid @enderror" id="input-jenis"
                                name="jenis_kain" placeholder="Jenis Kain">
                            @error('jenis_kain')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-5">
                        <label>Warna Kain</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('warna') }}"
                                class="form-control @error('warna') is-invalid @enderror" id="input-warna" name="warna"
                                placeholder="Warna Kain">
                            @error('warna')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Kategori Kain</label>
                        <select class="form-select @error('kategori_kains_id') is-invalid @enderror" id="kategori" name="kategori_kains_id">
                            <option selected disabled value="">Choose...</option>
                            @foreach ($kategoris as $kategoris)
                            @if (old('kategori_kains_id') == $kategoris->id)
                            <option value="{{ $kategoris->id }}" selected>{{ $kategoris->nama }}</option>
                            @else
                            <option value="{{ $kategoris->id }}">{{ $kategoris->nama }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('kategori_kains_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Lokasi Rak</label>
                        <select class="form-select @error('raks_id') is-invalid @enderror" id="rak" name="raks_id">
                            <option selected disabled value="">Choose...</option>
                            @foreach ($raks as $raks)
                            @if (old('raks_id') == $raks->id)
                            <option value="{{ $raks->id }}" selected>{{ $raks->lokasi }}</option>
                            @else
                            <option value="{{ $raks->id }}">{{ $raks->lokasi }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('raks_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="input-keterangan">Keterangan</label>
                        <textarea class="form-control"
                            value="{{ old('keterangan') }}" id="input-keterangan" rows="5" placeholder="Keterangan"
                            name="keterangan"></textarea>
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label for="input-foto">Upload Foto</label>
                        <div class="multiple-file-upload">
                            {{-- <input type="file" name="foto" id="input-foto"
                                class="filepond"
                                allow-multiple="false" allow-replace="true" max-file-size="3MB" accept="image/png, image/jpeg" check-validity="true"> --}}

                            <div class="multiple-file-upload">
                                <input type="file" class="file-upload-multiple" name="foto" multiple data-allow-reorder="true"
                                    data-max-file-size="3MB" data-max-files="1">
                            </div>
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

@section('jsinsertkain')
<script src="{{ asset('assets/src/plugins/src/filepond/filepond.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script> --}}
<script src="{{ asset('assets/src/plugins/src/filepond/custom-filepond.js') }}"></script>

<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>

<script>
FilePond.setOptions({
server: {
    process: '{{ route('kain.store') }}',

    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
    }
},
allowMultiple: false,
acceptedFileTypes: 'image/jpeg, image/png',
imagePreviewMaxFileSize: '3MB',
labelIdle: 'Drag & Drop your files or <span class="filepond--label-action">Aww</span>',
credits: false
// file: {
//     type: 'image/png',
// },
//     type: 'local',
});

</script>

@endsection