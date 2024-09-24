@extends('cork.cork')

@section('title', 'Peramalan Bulan Khusus')

@section('css')
<link href="{{ asset('assets/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/src/plugins/css/light/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/plugins/css/dark/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/src/tomSelect/tom-select.default.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/tagify/tagify.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/dark/tagify/custom-tagify.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/css/light/tagify/custom-tagify.css') }}">

<link href="{{ asset('assets/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('konten')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Peramalan</li>
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
                <form method="POST" action="{{ route('bulankhusus.proses') }}">
                    @csrf
                    <div class="row layout-spacing">

                        {{-- <div class="col-3">
                            <label class="form-label">Target Bulan <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="target_bulan" id="target_bulan" oninput="getTahun()"
                                required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($bulantarget as $data)
                                <option value="{{ $data }}" {{ old('target_bulan')==$data ? 'selected' : '' }}>{{ $data
                                    }}
                                </option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="col">
                            <label class="form-label">Target Bulan <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <input type="text" class="form-control" name="users-list-tags" placeholder="Choose.."
                                required>
                        </div>


                        {{-- <div class="col-3">
                            <label class="form-label">Mulai Data Dari Tahun <small
                                    class="text-muted ms-2 pb-1">(Required)</small></label>
                            <select class="form-select" name="data_tahun" id="data_tahun" required>
                            </select>
                        </div> --}}

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
                                {{-- <option value="4" {{ old('data_tahun')==4 ? 'selected' : '' }}>4 tahun sebelum
                                </option> --}}
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
                                <option selected disabled value="Semua">Semua</option>

                            </select>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Ukuran</label>
                            <select class="form-select" name="ukuran" id="input-ukuran-produk">
                                <option selected disabled value="Semua">Semua</option>

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



@if(session()->has('bulankhusus'))

@php
$bulankhususs = session('bulankhusus');
@endphp


<div id="tabsSimple" class="col-xl-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        {{-- <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Vertical Pill</h4>
                </div>
            </div>
        </div> --}}
        <div class="widget-content widget-content-area">

            <div class="vertical-pill">

                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        @foreach ($bulankhususs as $index => $bulankhusus)
                        <button class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{ $bulankhusus['id'] }}-tab"
                            data-bs-toggle="pill" data-bs-target="#{{ $bulankhusus['id'] }}" type="button" role="tab"
                            aria-controls="{{ $bulankhusus['id'] }}"
                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">{{ $bulankhusus['key'] }}</button>
                        @endforeach
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">

                        @foreach ($bulankhususs as $index => $bulankhusus)

                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="{{ $bulankhusus['id'] }}"
                            role="tabpanel" aria-labelledby="{{ $bulankhusus['id'] }}" tabindex="0">

                            @foreach ($bulankhusus['value'] as $data)

                            <div class="row">
                                <div id="chartColumn" class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    <div class="statbox widget box box-shadow">
                                        <div class="widget-header">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                    <h4>Hasil Peramalan Produk {{ $bulankhusus['jenis']=='kategori' ?
                                                        'Kategori' : '' }}
                                                        <b>{{ $bulankhusus['key'] }}</b> - Bulan Khusus <b>{{
                                                            end($data['waktuDisplay']) }}</b>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content widget-content-area">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <p>Hasil peramalan produk {{ $bulankhusus['jenis']=='kategori' ?
                                                    'Kategori' : '' }} <b>{{
                                                        $bulankhusus['key']
                                                        }}</b> untuk Bulan <b>{{
                                                        end($data['waktuDisplay']) }}</b> dengan
                                                    acuan data penjualan Bulan <b>{{
                                                        reset($data['waktuDisplay']) }}</b>
                                                    adalah
                                                    sejumlah <b>{{ end($data['dataWMA']) }} Pcs</b> dengan
                                                    persentase kesalahan peramalan sebesar <b>
                                                        @php
                                                        $lastMAPE = end($data['dataMAPE']);
                                                        if ($lastMAPE <= 10) {
                                                            $displayMAPE='persentase kesalahan peramalan <= 10%' ; }
                                                            elseif ($lastMAPE <=20) {
                                                            $displayMAPE='10% < persentase kesalahan peramalan <= 20%' ; }
                                                            elseif ($lastMAPE <=50) {
                                                            $displayMAPE='20% < persentase kesalahan peramalan <= 50%' ; }
                                                            else { $displayMAPE='persentase kesalahan peramalan > 50%' ; }
                                                            @endphp {{ $lastMAPE> 100 ? 100 :
                                                            $lastMAPE }}%</b>, sehingga
                                                    peramalan
                                                    dinyatakan
                                                    <b>{{ $data['akurasi'] }} ({{ $displayMAPE }})</b>
                                                </p>
                                            </div>
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <p id="result-{{ $data['id'] }}"></p>
                                            </div>
                                            <div id="peramalan-{{ $data['id'] }}" class=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endif
@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/highlight/highlight.pack.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>
<script src="{{ asset('assets/src/plugins/src/tagify/tagify.min.js') }}"></script>

{{-- Custom tagify --}}
<script>
    var inputElm = document.querySelector('input[name=users-list-tags]');
    
    function tagTemplate(tagData){
    return `
    <tag title="${tagData.email}" contenteditable='false' spellcheck='false' tabIndex="-1"
        class="tagify__tag ${tagData.class ? tagData.class : ""}" ${this.getAttributes(tagData)}>
        <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
        <div>
            <div class='tagify__tag__avatar-wrap'>
                <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
            </div>
            <span class='tagify__tag-text'>${tagData.name}</span>
        </div>
    </tag>
    `
    }
    
    function suggestionItemTemplate(tagData){
    return `
    <div ${this.getAttributes(tagData)} class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}' tabindex="0"
        role="option">
        ${ tagData.avatar ? `
        <div class='tagify__dropdown__item__avatar-wrap'>
            <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
        </div>` : ''
        }
        <strong>${tagData.name}</strong>
    </div>
    `
    }

    function getKodeProduk(id) {
        var bulantarget = @json($bulantarget);
        var selectedProduk = bulantarget.find(produk => produk.id == id);
        
        return selectedProduk ? selectedProduk.kode_produk : '';
    }

    console.log(@json($bulantarget));
    
    // initialize Tagify on the above input node reference
    var usrList = new Tagify(inputElm, {
    tagTextProp: 'name', // very important since a custom template is used with this property as text
    enforceWhitelist: true,
    skipInvalid: true, // do not remporarily add invalid tags
    dropdown: {
    closeOnSelect: false,
    enabled: 0,
    classname: 'users-list',
    searchKeys: ['name'] // very important to set by which keys to search for suggesttions when typing
    },
    templates: {
    // tag: tagTemplate,
    dropdownItem: suggestionItemTemplate
    },
    whitelist: @json($bulantarget)
    })
    
    usrList.on('dropdown:show dropdown:updated', onDropdownShow)
    usrList.on('dropdown:select', onSelectSuggestion)
    
    var addAllSuggestionsElm;
    
    function onDropdownShow(e){
    var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;
    
    if( usrList.suggestedListItems.length > 1 ){
    addAllSuggestionsElm = getAddAllSuggestionsElm();
    
    // insert "addAllSuggestionsElm" as the first element in the suggestions list
    dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild)
    }
    }
    
    function onSelectSuggestion(e){
    if( e.detail.elm == addAllSuggestionsElm )
    usrList.dropdown.selectAll();
    }
    
    // create a "add all" custom suggestion element every time the dropdown changes
    function getAddAllSuggestionsElm(){
    // suggestions items should be based on "dropdownItem" template
    return usrList.parseTemplate('dropdownItem', [{
    class: "addAll",
    name: "Pilih Semua Bulan",
    email: usrList.whitelist.reduce(function(remainingSuggestions, item){
    return usrList.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1
    }, 0) + " Members"
    }]
    )
    }
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

        // console.log(listUkuran);

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

{{-- Data tahun --}}
<script>
    function getTahun() {
    var target_bulan = document.getElementById("target_bulan").value
    console.log(target_bulan);
    fetch('/getTahun/' + target_bulan)
        .then(response => response.json())
        .then(data => {
            console.log('test')
            let ukuranProduk = document.getElementById("data_tahun");
            ukuranProduk.innerHTML = '';           
            
            let option = document.createElement('option');
                option.text = "Select...";
                option.value = "";
                ukuranProduk.appendChild(option);

            data.forEach(datatahun => {
                let option = document.createElement('option');
                option.text = datatahun;
                option.value = datatahun;
                ukuranProduk.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
    }

</script>

{{-- Setting Grafik --}}
<script>
    window.addEventListener("load", function(){

    @if(session()->has('bulankhusus'))

    var bulankhusus = @json(session('bulankhusus'));

    bulankhusus.forEach(function (category) {

        category.value.forEach(function (data) {

            // console.log(data);

            // let categoryData = bulankhusus[category];

            var arrayWaktuDisplay = data.waktuDisplay;
            var arrayWMA = data.dataWMA;
            var arrayAktual = data.dataAktualDisplay;
            var arrayMAPE = data.dataMAPE;
            var index = data.id;

            // console.log(data.arrAktualHitungan);

            // console.log('Selected element: ', document.querySelector("#peramalan-" + index));

            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
        "November", "December"];

            var parts = arrayWaktuDisplay[2].split(' ');
            var inputMonthName = parts[0];
            var inputYear = parseInt(parts[1], 10);
            var inputMonthIndex = months.indexOf(inputMonthName);
            

            const inputMonth = parseInt(arrayWaktuDisplay[2]);
            const currentYear = new Date().getFullYear();
            const currentMonthIndex = new Date().getMonth();

            console.log(currentMonthIndex);
            console.log(inputMonthIndex);
            console.log(inputYear);
            console.log(currentYear);
            
            let resultText = '';
            if (inputYear < currentYear || (inputYear===currentYear && inputMonthIndex < currentMonthIndex)) { resultText='' ; } 
            else if (inputYear === currentYear && inputMonthIndex === currentMonthIndex) { resultText='Dengan catatan: Bulan '+arrayWaktuDisplay[2]+' masih belum berakhir, sehingga dapat mempengaruhi hasil peramalan dan indikator kelayakan peramalannya.' ; } 
            else { resultText='Dengan catatan: Bulan '+arrayWaktuDisplay[2]+' masih belum berakhir, sehingga dapat mempengaruhi hasil peramalan dan indikator kelayakan peramalannya.' ; } 
            document.getElementById('result-' + index).innerText=resultText;

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
                    },
                    //  {
                    //     name: 'Tingkat Akurasi (MAPE) (%)',
                    //     data: arrayMAPE
                    // }
                ],
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
                    series: [{
                        name: 'Aktual',
                        data: arrayAktual,
                    }, {
                        name: 'Peramalan (WMA)',
                        data: arrayWMA,
                    }],
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
    })
    @endif
})
</script>
@endsection