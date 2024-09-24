@extends('cork.cork')

@section('title', 'Tambah Data User')

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
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->


<div class="row mb-4 layout-spacing">

    <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('user.store') }}">
        @csrf

        <div class="col-lg-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col">
                        <label>Nama <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukkan nama..." autofocus required>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label>Role <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <select class="form-select @error('role') is-invalid @enderror" name="role" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="Pemilik" {{ old('role')=='Pemilik' ? 'selected' : '' }}>Pemilik</option>
                            <option value="Staff" {{ old('role')=='Staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label>Username <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('username') }}"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                placeholder="Masukkan username..." required>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Password <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('password') }}"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Masukkan password..." required>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label>Email <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Masukkan email..." required>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>No. Hp <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ old('no_hp') }}"
                                class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                placeholder="Masukkan nomor..." required>
                            @error('no_hp')
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