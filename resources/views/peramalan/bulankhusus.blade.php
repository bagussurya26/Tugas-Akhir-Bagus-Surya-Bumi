@extends('cork.cork')

@section('title', 'Peramalan Bulan Khusus')

@section('cssperamalanbulankhusus')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{ asset('assets/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/plugins/css/light/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/plugins/css/dark/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
    type="text/css">

<link href="{{ asset('assets/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('kontenperamalanbulankhusus')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Peramalan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bulan Khusus</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-top-spacing">
    <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Insert Data</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form class="row g-3" method="POST" action="{{ route('peramalan.inputbulankhusus') }}">
                    @csrf
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Kode Kain - Jenis Kain</label>
                        <select class="form-select" id="validationCustom01" name="id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($kain as $listkain)
                                {{-- <option value="{{ $listkain->id }}">{{ $listkain->id }} - {{ $listkain->jenis_kain }}</option> --}}
                                @if ($id == $listkain->id)
                                <option value="{{ $listkain->id }}" selected>{{ $listkain->id }} - {{ $listkain->jenis_kain }}</option>
                                @else
                                <option value="{{ $listkain->id }}">{{ $listkain->id }} - {{ $listkain->jenis_kain }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Target Bulan</label>
                        <select class="form-select" id="validationCustom02" name="targetbulan" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($targetbulan as $listbulan)
                                {{-- <option value="{{ $listbulan }}">{{ $listbulan }}</option> --}}
                                @if ($targetbln == $listbulan)
                                <option value="{{ $listbulan }}" selected>{{ $listbulan }}</option>
                                @else
                                <option value="{{ $listbulan }}">{{ $listbulan }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom03" class="form-label">Mulai Data Dari Tahun</label>
                        <select class="form-select" id="validationCustom03" name="mulaitahun" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($datatahun as $listtahun)
                                {{-- <option value="{{ $listtahun }}">{{ $listtahun }}</option> --}}
                                @if ($mulaithn == $listtahun)
                                <option value="{{ $listtahun }}" selected>{{ $listtahun }}</option>
                                @else
                                <option value="{{ $listtahun }}">{{ $listtahun }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <label for="validationCustom06" class="form-label">Range Month</label>
                        <input id="monthCalendarFlatpickr" class="form-control flatpickr flatpickr-input active"
                            type="text" placeholder="Select Month.." required>
                        <div class="invalid-feedback">
                            Looks good!
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{!! $chart->container() !!}

<script src="{{ $chart->cdn() }}"></script>

{!! $chart->script() !!}



{{-- <div class="row layout-top-spacing">
    <div id="chartColumn" class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Hasil Peramalan CTP3619 - Katun Polynosic - Bulanan Oktober 2023</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <p>Hasil Peramalan Katun Polynosic Untuk Bulan Januari 2024 Adalah Sebesar 850.000 Yard Dengan
                        Tingkat Akurasi Peramalan Sebesar 8% Sehingga Peramalan Dinyatakan Sangat Baik</p>
                </div>
                <div id="s-peramalan" class=""></div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('jsperamalanbulankhusus')
<script src="{{ asset('assets/src/plugins/src/highlight/highlight.pack.js') }}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('assets/src/assets/js/scrollspyNav.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/apex/custom-apexcharts.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/scrollspyNav.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endsection