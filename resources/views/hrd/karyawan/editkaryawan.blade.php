@extends('cork.cork')

@section('title', 'Ubah Data Karyawan')

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
            <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Karyawan</a></li>
            <li class="breadcrumb-item">{{ $karyawans->nama }}</li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->


<div class="row mb-4 layout-spacing">

    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('karyawan.update', $karyawans->id) }}">
        @csrf
        @method("PUT")

        <div class="col-lg-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-7">
                        <label>Nama Karyawan <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $karyawans->nama }}"
                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukkan nama..." autofocus required>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Nomor Handphone <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $karyawans->no_hp }}"
                                class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                placeholder="Masukkan No. Hp..." required>
                            @error('no_hp')
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

    </form>

</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>

@endsection