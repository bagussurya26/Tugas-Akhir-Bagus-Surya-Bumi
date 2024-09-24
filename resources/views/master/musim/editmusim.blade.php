@extends('cork.cork')

@section('title', 'Ubah Data Kain')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/light/apps/ecommerce-create.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/assets/css/dark/apps/ecommerce-create.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/elements/alert.css') }}">
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
            <li class="breadcrumb-item">{{ $kains->kode_kain }}</li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row">

    <form method="POST" action="{{ route('kain.update', $kains->id) }}" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="col-lg-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-4">
                        <label>Kode Kain <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('kode_kain') is-invalid @enderror"
                                name="kode_kain" name="kode_kain" placeholder="Masukkan kode..."
                                value="{{ $kains->kode_kain }}" required>
                            @error('kode_kain')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Jenis Kain <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukkan nama..." value="{{ $kains->nama }}" required>
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
                        <label>Warna <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna"
                                placeholder="Masukkan warna..." value="{{ $kains->warna }}" required>
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
                            <input type="number" value="{{ $kains->lebar }}" class="form-control @error('lebar') is-invalid @enderror"
                                name="lebar" placeholder="Masukkan lebar..." min=0 step="0.01" required>
                            @error('lebar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label>Kategori Kain <small class="text-muted ms-2 pb-1">(Required)</small></label>
                        <select class="form-select @error('kategori_kain_id') is-invalid @enderror"
                            name="kategori_kain_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($kategoris as $kategori)

                            <option value="{{ $kategori->id }}" {{ $kains->kategori_kain_id==$kategori->id ?
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

                            @foreach ($raks as $rak)

                            <option value="{{ $rak->id }}" {{ $kains->rak_id==$rak->id ?
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
                        <label for="input-keterangan">Keterangan</label>
                        <textarea class="form-control" rows="3" placeholder="Keterangan"
                            value="{{ $kains->keterangan }}" name="keterangan"></textarea>
                    </div>
                </div>

                @if ($kains->foto != null || $kains->foto != "")
                <div class="alert alert-light-info alert-dismissible fade show border-0 mb-4" role="alert">
                    <strong>{{ $kains->foto }}</strong> Silahkan memberikan foto pada input di bawah jika ingin
                    mengganti
                    foto.</button>
                </div>
                @else
                <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert">
                    <strong>Foto Kain belum ada!</strong> Silahkan memberikan foto pada input di bawah.
                </div>
                @endif

                <div class="row mb-4">
                    <div class="col">
                        <label>Upload Foto <small class="text-muted ms-2 pb-1">(File must type .png, .jpeg,
                                .jpg)</small></label>
                        <div class="col-sm-12">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
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