@extends('cork.cork')

@section('title', 'Peramalan Musiman')

@section('css')
<link href="{{ asset('assets/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/plugins/css/light/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

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
            <li class="breadcrumb-item">Peramalan</li>
            <li class="breadcrumb-item active" aria-current="page">Musiman</li>
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
                <form method="POST" action="{{ route('musiman.proses') }}">
                    @csrf
                    <div class="row layout-spacing">
                        <div class="col-3">
                            <label class="form-label">Musim <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="musim" id="musim" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($musims as $data)
                                <option value="{{ $data->id }}" {{ old('musim')==$data->id ? 'selected' : '' }}>{{
                                    $data->nama
                                    }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Target tahun <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="target_tahun" id="target_tahun" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($tahuntarget as $data)
                                <option value="{{ $data }}" {{ old('target_bulan')==$data ? 'selected' : '' }}>{{ $data
                                    }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Batasan tahun<small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="data_tahun" id="data_tahun" required>
                                {{-- <option selected disabled value="">Choose...</option> --}}
                                {{-- <option value="1" {{ old('data_tahun')==1 ? 'selected' : '' }}>1 tahun sebelum
                                </option>
                                <option value="2" {{ old('data_tahun')==2 ? 'selected' : '' }}>2 tahun sebelum</option>
                                --}}
                                <option value="3" {{ old('data_tahun')==3 ? 'selected' : '' }}>3 tahun sebelum</option>
                            </select>
                        </div>

                    </div>
                    <div class="row layout-spacing">

                        <div class="col">
                            <label class="form-label">Produk</label>
                            <select class="form-select" name="produk" id="input-kode-produk" oninput="getWarnaProduk()">
                                <option selected disabled value="">Choose..</option>
                                @foreach ($produks as $data)
                                <option value="{{ $data->id }}" {{ old('produk')==$data->id ?
                                    'selected' : '' }}>{{ $data->kode_produk }} - {{ $data->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Warna</label>
                            <select class="form-select" name="warna" id="input-warna-produk">
                                <option selected disabled value="">Semua</option>

                            </select>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Ukuran</label>
                            <select class="form-select" name="ukuran" id="input-ukuran-produk">
                                <option selected disabled value="">Semua</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session()->has('musiman'))
@php
$musimans = session('musiman');
@endphp

@foreach ($musimans as $index => $musiman)
<div class="row">
    <div id="chartColumn" class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Hasil Peramalan Produk {{ $musiman['jenis']=='kategori' ? 'Kategori' : '' }} <b>{{
                                $index }}</b> - Musiman <b>{{
                                end($musiman['waktuDisplay']) }}</b>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <p>Hasil peramalan produk {{ $musiman['jenis']=='kategori' ? 'Kategori' : '' }} <b>{{ $index
                            }}</b> untuk Musim <b>{{
                            end($musiman['waktuDisplay']) }}</b> dengan
                        acuan data penjualan Musim <b>{{ reset($musiman['waktuDisplay']) }}</b> adalah
                        sejumlah <b>{{ end($musiman['dataWMA']) }} Pcs</b> dengan
                        persentase kesalahan peramalan sebesar <b>
                            @php
                            $lastMAPE = end($musiman['dataMAPE']);
                            if ($lastMAPE <= 10) { $displayMAPE='persentase kesalahan peramalan <= 10%' ; } elseif
                                ($lastMAPE <= 20) { $displayMAPE='10% < persentase kesalahan peramalan <= 20%' ; } elseif
                                ($lastMAPE <=50) { $displayMAPE='20% < persentase kesalahan peramalan <= 50%' ; } else {
                                $displayMAPE='persentase kesalahan peramalan > 50%' ; } @endphp {{ $lastMAPE> 100 ? 100 :
                                $lastMAPE }}%</b>, sehingga peramalan
                        dinyatakan <b>{{ $musiman['akurasi'] }} ({{ $displayMAPE }})</b></p>
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <p id="result"></p>
                </div>
                <div id="peramalan-{{ $musiman['id'] }}" class=""></div>
            </div>
        </div>
    </div>
</div>
@endforeach


@endif
@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/highlight/highlight.pack.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>

{{-- Tom Select --}}
<script>
    new TomSelect("#input-kode-produk",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

{{-- Setting Produk --}}
<script>
    function getWarnaProduk() {
        var id_produk = document.getElementById("input-kode-produk").value

        var produkwarnas = @json($produkwarnas);
        var listWarna = produkwarnas.filter(function(produkwarna) {
            return produkwarna.produk_id == id_produk;
        });

        var selectElement = document.getElementById("input-warna-produk");
        selectElement.innerHTML = "";

        var defaultOption = document.createElement("option");
        defaultOption.value = "Semua";
        defaultOption.textContent = "Semua";
        defaultOption.disabled = false;
        defaultOption.selected = true;
        selectElement.appendChild(defaultOption);

        listWarna.forEach(function(produkwarna) {
        var option = document.createElement("option");
        option.value = produkwarna.id;
        option.textContent = produkwarna.warna;
        selectElement.appendChild(option);
        });

        getUkuranProduk(listWarna[0].id);
    }

    function getUkuranProduk(id_warna_produk) {

        var produkukurans = @json($produkukurans);
        var listUkuran = produkukurans.filter(function(produkukuran) {
            return produkukuran.produk_warna_id == id_warna_produk;
        });

        console.log(listUkuran);

        var selectElement = document.getElementById("input-ukuran-produk");
        selectElement.innerHTML = "";

        var defaultOption = document.createElement("option");
        defaultOption.value = "Semua";
        defaultOption.textContent = "Semua";
        defaultOption.disabled = false;
        defaultOption.selected = true;
        selectElement.appendChild(defaultOption);

        listUkuran.forEach(function(produkukuran) {
        var option = document.createElement("option");
        option.value = produkukuran.ukuran_id;
        option.textContent = produkukuran.nama;
        selectElement.appendChild(option);
        });
    }
</script>

{{-- get Bulan --}}
{{-- <script>
    function getBulan() {
    var target_bulan = document.getElementById("target_bulan").value
    console.log(target_bulan);
    fetch('/getBulan/' + target_bulan)
        .then(response => response.json())
        .then(data => {
            console.log('test')
            let ukuranProduk = document.getElementById("data_bulan");
            ukuranProduk.innerHTML = '';           
            
            let option = document.createElement('option');
                option.text = "Select...";
                option.value = "";
                ukuranProduk.appendChild(option);

            data.forEach(databulan => {
                let option = document.createElement('option');
                option.text = databulan;
                option.value = databulan;
                ukuranProduk.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
    }

</script> --}}

{{-- Setting Grafik --}}
<script>
    window.addEventListener("load", function(){

    @if(session()->has('musiman'))

    var musiman = @json(session('musiman'));

    Object.keys(musiman).forEach(function (category) {
        
        let categoryData = musiman[category];

        var arrayWaktuDisplay = categoryData.waktuDisplay;
        var arrayWMA = categoryData.dataWMA;
        var arrayAktual = categoryData.dataAktualDisplay;
        var arrayMAPE = categoryData.dataMAPE;
        var index = categoryData.id;

        // console.log(categoryData.arrAktualHitungan);

        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
        "November", "December"];

        var parts = arrayWaktuDisplay[2].split(' ');
        var inputMonthName = parts[7];
        var inputYear = parseInt(parts[8], 10);
        var inputMonthIndex = months.indexOf(inputMonthName);
        

        const inputMonth = parseInt(arrayWaktuDisplay[2]);
        const currentYear = new Date().getFullYear();
        const currentMonthIndex = new Date().getMonth();

        console.log(parts);
        console.log(currentMonthIndex);
        console.log(inputMonthIndex);
        console.log(inputYear);
        console.log(currentYear);
        
        let resultText = '';
        if (inputYear < currentYear || (inputYear===currentYear && inputMonthIndex < currentMonthIndex)) { resultText='' ; } 
        else if (inputYear === currentYear && inputMonthIndex === currentMonthIndex) { resultText='Dengan catatan: Bulan '+arrayWaktuDisplay[2]+' masih belum berakhir, sehingga dapat mempengaruhi hasil peramalan dan indikator kelayakan peramalannya.' ; } 
        else { resultText='Dengan catatan: Bulan '+arrayWaktuDisplay[2]+' masih belum berakhir, sehingga dapat mempengaruhi hasil peramalan dan indikator kelayakan peramalannya.' ; } 
        document.getElementById('result').innerText=resultText;

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
                    name: 'Aktual (Pcs)',
                    data: arrayAktual
                }, {
                    name: 'Peramalan (WMA) (Pcs)',
                    data: arrayWMA
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
                    categories: arrayWaktuDisplay,
                },
                yaxis: {
                    title: {
                        text: 'Pcs'
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
                    name: 'Aktual (Pcs)',
                    data: arrayAktual
                }, {
                    name: 'Peramalan (WMA) (Pcs)',
                    data: arrayWMA
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
                    categories: arrayWaktuDisplay,
                },
                yaxis: {
                    title: {
                        text: 'Pcs'
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
            document.querySelector("#peramalan-" + index),
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
    @endif
})
</script>
@endsection