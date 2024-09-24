@extends('cork.cork')

@section('title', 'Ubah Data Kain')

@section('csseditkain')
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

@section('konteneditkain')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kain.index') }}">Kain</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row mb-4 layout-spacing layout-top-spacing">

    <form method="POST" class="row g-3" action="{{ route('kain.update', $detailKain[0]->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method("PUT")
        
        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-4">
                        <label>Kode Kain</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('kode_kain') is-invalid @enderror" name="kode_kain"
                                id="input-kode" name="kode_kain" placeholder="Kode Kain" value="{{ $detailKain[0]->kode_kain }}">
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
                            <input type="text" class="form-control @error('jenis_kain') is-invalid @enderror"
                                id="input-jenis" name="jenis_kain" placeholder="Jenis Kain"
                                value="{{ $detailKain[0]->jenis_kain }}">
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
                            <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                id="input-warna" name="warna" placeholder="Warna Kain"
                                value="{{ $detailKain[0]->warna }}">
                            @error('warna')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="rak">Kategori Kain</label>
                        <select class="form-select @error('kategori_kains_id') is-invalid @enderror" id="input-kategori" name="kategori_kains_id">
                            <option selected disabled value="">Choose...</option>
                            @foreach ($kategoris as $kategoris)

                            @if ( $detailKain[0]->nama_kategori == $kategoris->nama )
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
                        <label for="input-rak">Lokasi Rak</label>
                        <select class="form-select @error('raks_id') is-invalid @enderror" id="input-rak"
                            name="raks_id">

                            @foreach ($raks as $raks)

                            @if ( $detailKain[0]->lokasi == $raks->lokasi )
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
                        <label>Stok</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="input-stok" name="stok"
                                value="{{ $detailKain[0]->stok }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="input-keterangan">Keterangan</label>
                        <textarea class="form-control" id="input-keterangan" rows="5" placeholder="Keterangan"
                            value="{{ $detailKain[0]->keterangan }}" name="keterangan"></textarea>
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
                                <button class="btn btn-success w-100" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('jseditkain')
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