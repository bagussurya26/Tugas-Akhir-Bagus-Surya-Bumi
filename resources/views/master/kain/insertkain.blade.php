@extends('cork.cork')

@section('title', 'Tambah Data Kain')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">
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
            <li class="breadcrumb-item"><a href="{{ route('kain.index') }}">Kain</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->


<div class="row">

    <form enctype="multipart/form-data" method="POST" action="{{ route('kain.store') }}">
        @csrf

        <div class="col-lg-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-4">
                        <label>Kode Kain <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('kode_kain') }}"
                                class="form-control @error('kode_kain') is-invalid @enderror" name="kode_kain"
                                placeholder="Masukkan kode..." autofocus required>
                            @error('kode_kain')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Nama Kain <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror"
                                name="nama" placeholder="Masukkan nama..." required>
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
                        <label>Warna<small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('warna') }}"
                                class="form-control @error('warna') is-invalid @enderror" name="warna"
                                placeholder="Masukkan warna..." required>
                            @error('warna')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Lebar<small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="number" value="{{ old('lebar') }}" class="form-control @error('lebar') is-invalid @enderror"
                                name="lebar" placeholder="Masukkan lebar..." min=0 step="0.01" required>
                            @error('lebar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Kategori Kain<small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <select class="form-select @error('kategori_kain_id') is-invalid @enderror" name="kategori_kain_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_kain_id') == $kategori->id ?
                                'selected' : '' }}>{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_kain_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Lokasi Rak <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <select class="form-select @error('rak_id') is-invalid @enderror" name="rak_id" id="rak" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($raks as $rak)
                            <option value="{{ $rak->id }}" {{ old('rak_id') == $rak->id ?
                                'selected' : '' }}>{{ $rak->lokasi }}</option>
                            @endforeach
                        </select>
                        @error('rak_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Keterangan</label>
                        <textarea class="form-control"
                            value="{{ old('keterangan') }}" rows="3" placeholder="Keterangan"
                            name="keterangan"></textarea>
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label>Upload Foto <small class="text-muted ms-2 pb-1">(File must type .png, .jpeg,
                            .jpg)</small></label>
                        <div class="col-sm-12">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept=".png, .jpeg, .jpg">
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col text-end">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>

            </div>

        </div>
    </form>

</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>

{{-- Tom Select --}}
<script>
    new TomSelect("#rak",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>
@endsection