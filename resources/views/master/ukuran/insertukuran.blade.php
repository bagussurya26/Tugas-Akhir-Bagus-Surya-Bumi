@extends('cork.cork')

@section('title', 'Tambah Data Ukuran')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">
@endsection

@section('konten')
@include('sweetalert::alert')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('ukuran.index') }}">Ukuran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->


<div class="row">

    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('ukuran.store') }}">
        @csrf

        <div class="col-lg-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row layout-spacing">
                    <div class="col">
                        <label>Nama <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukkan nama..." required>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="col">
                        <label>Kategori <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <select class="form-select @error('kategori') is-invalid @enderror" name="kategori"
                                required>
                                <option selected disabled value="">Choose...</option>
                                <option value="RS" {{ old('kategori')=='RS' ? 'selected' : '' }}>REGULAR SIZE</option>
                                <option value="BZ" {{ old('kategori')=='BZ' ? 'selected' : '' }}>BIG SIZE</option>
                            </select>
                            @error('kategori')
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
@endsection