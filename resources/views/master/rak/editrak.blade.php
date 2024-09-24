@extends('cork.cork')

@section('title', 'Ubah Data Rak')

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
            <li class="breadcrumb-item"><a href="{{ route('rak.index') }}">Rak</a></li>
            <li class="breadcrumb-item">{{ $raks->lokasi }}</li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row">

    <form method="POST" class="row g-3" action="{{ route('rak.update', $raks->id) }}" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="col-lg-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row layout-spacing">
                    <div class="col">
                        <label>Lokasi <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                name="lokasi" placeholder="Masukkan lokasi..."
                                value="{{ $raks->lokasi }}" required>
                            @error('lokasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col text-end">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>

        </div>

        {{-- <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12">

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
        </div> --}}
    </form>

</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
@endsection