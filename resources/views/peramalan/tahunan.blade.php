@extends('cork.cork')

@section('title', 'Peramalan Tahunan')

@section('cssperamalantahunan')
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

@section('kontenperamalantahunan')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Peramalan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tahunan</li>
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
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                        <label for="validationCustom01" class="form-label">Kode Kain - Jenis Kain</label>
                        <select class="form-select" id="validationCustom01" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($kain as $listkain)
                                <option>{{ $listkain->kode }} - {{ $listkain->jenis_kain }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Target Tahun</label>
                        <select class="form-select" id="validationCustom02" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($targettahun as $listtahun)
                                <option>{{ $listtahun }}</option>
                            @endforeach                           
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Mulai Data Dari Tahun</label>
                        <select class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($datatahun as $listtahun)
                            <option>{{ $listtahun }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <label for="validationCustom06" class="form-label">Range Month</label>
                        <input id="rangeCalendarFlatpickr" class="form-control flatpickr flatpickr-input active"
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

<div class="row layout-top-spacing">
    <div id="chartColumn" class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Hasil Peramalan Tahunan CTP3619 - Katun Polynosic Untuk Tahun 2024</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <p>Hasil peramalan Katun Polynosic untuk Tahun 2024 adalah sebesar 850.000 Yard dengan
                        tingkat akurasi peramalan sebesar 8% sehingga peramalan dinyatakan Sangat Baik</p>
                </div>
                <div id="s-peramalan" class=""></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsperamalantahunan')
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