@extends('cork.cork')

@section('title', 'Tambah Data Produk')

@section('cssinsertproduk')
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
@endsection

@section('konteninsertproduk')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="row mb-4 layout-spacing">

    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('produk.store') }}">
        @csrf
        {{-- @method("PUT") --}}

        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-4">
                        <label>Kode Produk</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('id') }}"
                                class="form-control @error('id') is-invalid @enderror" name="id"
                                placeholder="Kode Produk" autofocus>
                            @error('id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Nama Produk</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror" id="input-jenis" name="nama"
                                placeholder="Nama Produk">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label for="kategori_pakaian">Kategori</label>
                        <select class="form-select @error('kategori_pakaians_id') is-invalid @enderror"
                            id="kategori_pakaian" name="kategori_pakaians_id">
                            <option selected disabled value="">Choose...</option>
                            @foreach ($listKategori as $kategoris)
                            @if (old('kategori_pakaians_id') == $kategoris->id)
                            <option value="{{ $kategoris->id }}" selected>{{ $kategoris->nama }}</option>
                            @else
                            <option value="{{ $kategoris->id }}">{{ $kategoris->nama }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('kategori_pakaians_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="rak">Lokasi Rak</label>
                        <select class="form-select @error('raks_id') is-invalid @enderror" id="rak" name="raks_id">
                            <option selected disabled value="">Choose...</option>
                            @foreach ($listRak as $raks)
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
                    <div class="col">
                        <label for="fit">Tipe Body Fit</label>
                        <select class="form-select @error('tipe_fit') is-invalid @enderror" id="fit" name="tipe_fit">
                            <option selected disabled value="">Choose...</option>
                            @if (old('tipe_fit') == 'Regular')
                            <option value="Regular" selected>Regular</option>
                            @elseif (old('tipe_fit') == 'Slim')
                            <option value="Slim" selected>Slim</option>
                            @else
                            <option value="Regular">Regular</option>
                            <option value="Slim">Slim</option>
                            @endif
                        </select>
                        @error('tipe_fit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="lengan">Tipe Body Fit</label>
                        <select class="form-select @error('tipe_lengan') is-invalid @enderror" id="lengan"
                            name="tipe_lengan">
                            <option selected disabled value="">Choose...</option>
                            @if (old('tipe_lengan') == 'Pendek')
                            <option value="Pendek" selected>Pendek</option>
                            @elseif (old('tipe_lengan') == 'Panjang')
                            <option value="Panjang" selected>Panjang</option>
                            @else
                            <option value="Panjang">Panjang</option>
                            <option value="Pendek">Pendek</option>
                            @endif

                            i
                        </select>
                        @error('tipe_lengan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">

                    <div class="col">
                        <label>Stok</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="input-stok" name="total_qty" placeholder="Stok"
                                value="0" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <label>Harga</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="input-harga" name="harga" placeholder="Harga"
                                value="0">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="input-keterangan">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                            value="{{ old('keterangan') }}" id="input-keterangan" rows="5" placeholder="Keterangan"
                            name="keterangan"></textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label for="input-foto">Upload Foto</label>
                        <div class="multiple-file-upload">
                            <input type="file" name="foto" id="input-foto"
                                class="filepond file-upload-multiple @error('foto') is-invalid @enderror"
                                allow-multiple="false" allow-replace="true" max-file-size="3MB" check-validity="true">

                            {{-- <input type="file" class="form-control @error('input-foto') is-invalid @enderror"
                                name="input-foto" id="input-foto"> --}}
                            {{-- @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror --}}
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

@section('jsinsertproduk')
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