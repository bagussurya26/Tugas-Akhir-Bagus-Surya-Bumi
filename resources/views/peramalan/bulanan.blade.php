@extends('cork.cork')

@section('title', 'Peramalan Bulanan')

@section('cssperamalanbulanan')
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

@section('kontenperamalanbulanan')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Peramalan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bulanan</li>
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
                <form enctype="multipart/form-data" class="row g-3" method="POST" action="{{ route('bulanan.proses') }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label">Kode Kain - Jenis Kain</label>
                        <select class="form-select" id="input-id-kain" name="id-kain" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($kain as $listkain)
                            <option value="{{ $listkain->id }}">{{ $listkain->id }} - {{ $listkain->jenis_kain }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Target Bulan</label>
                            <select class="form-select" id="input-target-bulan" name="target-bulan" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($targetbulan as $index=>$dataTarget)
                                <option value="{{ $dataTarget['value'] }}">{{
                                    $dataTarget['bulan'] }} {{ $dataTarget['tahun'] }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please fill the name
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mulai Data Dari Bulan</label>
                        <select class="form-select" id="input-data-bulan" name="data-bulan" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($databulan as $index=>$dataBln)
                            <option value="{{ $dataBln['value'] }}">{{ $dataBln['bulan'] }} {{
                                $dataBln['tahun'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
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
</div>
@endsection

@section('jsperamalanbulanan')
<script src="{{ asset('assets/src/plugins/src/highlight/highlight.pack.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/scrollspyNav.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/apex/apexcharts.min.js') }}"></script>
{{-- <script src="{{ asset('assets/src/plugins/src/apex/custom-apexcharts.js') }}"></script> --}}
<script src="{{ asset('assets/src/assets/js/scrollspyNav.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>

<script>
window.addEventListener("load", function(){

    getcorkThemeObject = localStorage.getItem("theme");
    getParseObject = JSON.parse(getcorkThemeObject)
    ParsedObject = getParseObject;

    if (ParsedObject.settings.layout.darkMode) {

        Apex.grid = {
            borderColor: '#191e3a'
        }
        Apex.track = {
            background: '#0e1726',
        }
        Apex.tooltip = {
            theme: 'dark'
        }

        var peramalan = {
            chart: {
                fontFamily: 'Nunito, Arial, sans-serif',
                height: 500,
                type: 'bar',
                toolbar: {
                    show: true,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Aktual (Yard)',
                data: [61, 58, 63, 60, 66]
            }, {
                name: 'Peramalan (WMA) (Yard)',
                data: [87, 105, 91, 114, 150]
            }, {
                name: 'Tingkat Akurasi (MAPE) (%)',
                data: [5, 6, 7, 8, 7]
            }],
            legend: {
                markers: {
                    width: 10,
                    height: 10,
                    offsetX: -5,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 0
                }
            },
            xaxis: {
                categories: ['Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: 'Yard'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        }

    } else {

        Apex.grid = {
            borderColor: '#ebedf2'
        }
        Apex.track = {
            background: '#e0e6ed',
        }
        Apex.tooltip = {
            theme: 'dark'
        }

        // Peramalan

        var peramalan = {
            chart: {
                fontFamily: 'Nunito, Arial, sans-serif',
                height: 500,
                type: 'bar',
                toolbar: {
                    show: true,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Aktual (Yard)',
                data: [61, 58, 63, 60, 66]
            }, {
                name: 'Peramalan (WMA) (Yard)',
                data: [87, 105, 91, 114, 150]
            }, {
                name: 'Tingkat Akurasi (MAPE) (%)',
                data: [5, 6, 7, 8, 7]
            }],
            legend: {
                markers: {
                    width: 10,
                    height: 10,
                    offsetX: -5,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 0
                }
            },
            xaxis: {
                categories: ['Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: 'Yard'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        }
    }

    var prml = new ApexCharts(
        document.querySelector("#s-peramalan"),
        peramalan
    );

    prml.render();

    document.querySelector('.theme-toggle').addEventListener('click', function() {

        getcorkThemeObject = localStorage.getItem("theme");
        getParseObject = JSON.parse(getcorkThemeObject)
        ParsedObject = getParseObject;

        // console.log(ParsedObject.settings.layout.darkMode)

        if (ParsedObject.settings.layout.darkMode) {

            prml.updateOptions({
                grid: {
                    borderColor: '#191e3a'
                },
            })


        } else {
            Apex.grid = {
                borderColor: '#ebedf2'
            }
            Apex.track = {
                background: '#e0e6ed',
            }
            Apex.tooltip = {
                theme: 'dark'
            }

            prml.updateOptions({
                grid: {
                    borderColor: '#ebedf2'
                },
            })
        }
    })

})
</script>
@endsection