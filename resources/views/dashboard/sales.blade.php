@extends('cork.cork')

@section('title', 'Dashboard')

@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{ asset('assets/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('konten')
<div class="row layout-top-spacing">

  <div class="col-12 layout-spacing">
    <div class="widget widget-chart-one">
      <div class="widget-heading">
        <h5 class="">Revenue</h5>
      </div>

      <div class="widget-content">
        <div id="revenueMonthly"></div>
      </div>
    </div>
  </div>



  <div class="col-12 layout-spacing">
    <div class="widget widget-chart-one">
      <div class="widget-heading">
        <h5 class="">Jumlah Kategori Produk Terjual</h5>
      </div>

      <div class="widget-content">
        <div id="saleskategoriproduk"></div>
      </div>
    </div>
  </div>

  <div class="col layout-spacing">
    <div class="widget widget-chart-two">
      <div class="widget-heading">
        <h5 class="">Sales by Category</h5>
      </div>
      <div class="widget-content">
        <div id="chart-2" class=""></div>
      </div>
    </div>
  </div>

  <div class="col layout-spacing">
    <div class="widget widget-table-two">

      <div class="widget-heading">
        <h5 class="">Top Transaksi Supplier</h5>
      </div>

      <div class="widget-content">
        <div class="table-responsive">
          <table class="table table-scroll">
            <thead>
              <tr>
                <th>
                  <div class="th-content">Supplier</div>
                </th>
                <th>
                  <div class="th-content text-center">Total Transaksi</div>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($topsuppliers as $data)
              <tr>
                <td>
                  <div class="td-content"><a href="{{ route('supplier.show', $data->id) }}">{{ $data->nama }}</a></div>
                </td>
                <td>
                  <div class="td-content text-center">{{ $data->nota_beli_count }}</div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/plugins/src/apex/apexcharts.min.js') }}"></script>

<script>
  window.addEventListener("load", function () {

  var arrayWaktuDisplay = @json($arrayWaktuDisplay);
  var arrayPembelian = @json($arrayPembelian);
  var arrayPenjualan = @json($arrayPenjualan);

  var kategori = @json($kategori);
  var saleskategori = @json($saleskategori);

  console.log(saleskategori);

  var arraybatik = @json($arraybatik);
  var arraymotif = @json($arraymotif);
  var arraypolos = @json($arraypolos);
  var arraytakwo = @json($arraytakwo);
  
  try {

    getcorkThemeObject = localStorage.getItem("theme");
    getParseObject = JSON.parse(getcorkThemeObject)
    ParsedObject = getParseObject;

    if (ParsedObject.settings.layout.darkMode) {
      
      var Theme = 'dark';
  
      Apex.tooltip = {
          theme: Theme
      }
  
      /**
          ==============================
          |    @Options Charts Script   |
          ==============================
      */
      
      /*
          =============================
              Daily Sales | Options
          =============================
      */
      var d_2options1 = {
        chart: {
            height: 160,
            type: 'bar',
            stacked: true,
            stackType: '100%',
            toolbar: {
                show: false,
            }
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: [3, 4],
            curve: "smooth",
        },
        colors: ['#e2a03f', '#e0e6ed'],
        series: [{
            name: 'Sales',
            data: [44, 55, 41, 67, 22, 43, 21]
        },{
            name: 'Last Week',
            data: [13, 23, 20, 8, 13, 27, 33]
        }],
        xaxis: {
            labels: {
                show: false,
            },
            categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
            crosshairs: {
            show: false
            }
        },
        yaxis: {
            show: false
        },
        fill: {
            opacity: 1
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '25%',
                borderRadius: 8,
            }
        },
        legend: {
            show: false,
        },
        grid: {
            show: false,
            xaxis: {
                lines: {
                    show: false
                }
            },
            padding: {
            top: -20,
            right: 0,
            bottom: -40,
            left: 0
            }, 
        },
        responsive: [
            {
                breakpoint: 575,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 5,
                            columnWidth: '35%'
                        }
                    },
                }
            },
        ],
      }
      
      /*
          =============================
              Total Orders | Options
          =============================
      */
      var d_2options2 = {
        chart: {
          id: 'sparkline1',
          group: 'sparklines',
          type: 'area',
          height: 290,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .30,
              opacityTo: .05,
              stops: [100, 100]
          }
        },
        series: [{
          name: 'Sales',
          data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
        }],
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
        yaxis: {
          min: 0
        },
        grid: {
          padding: {
            top: 125,
            right: 0,
            bottom: 0,
            left: 0
          }, 
        },
        tooltip: {
          x: {
            show: false,
          },
          theme: Theme
        },
        colors: ['#00ab55']
      }
      
      /*
          =================================
              Revenue Monthly | Options
          =================================
      */
      var options1 = {
        chart: {
          fontFamily: 'Nunito, sans-serif',
          height: 365,
          type: 'area',
          zoom: {
              enabled: false
          },
          dropShadow: {
            enabled: true,
            opacity: 0.2,
            blur: 10,
            left: -7,
            top: 22
          },
          toolbar: {
            show: false
          },
        },
        colors: ['#e7515a', '#1b55e2',],
        dataLabels: {
            enabled: false
        },
        markers: {
          discrete: [{
          seriesIndex: 0,
          dataPointIndex: 7,
          fillColor: '#000',
          strokeColor: '#000',
          size: 5
        }, {
          seriesIndex: 2,
          dataPointIndex: 11,
          fillColor: '#000',
          strokeColor: '#000',
          size: 4
        }]
        },
        subtitle: {
          text: '',
          align: 'left',
          margin: 0,
          offsetX: 100,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#4361ee'
          }
        },
        title: {
          text: 'Dari ' + arrayWaktuDisplay[0] + ' sampai ' + arrayWaktuDisplay[11],
          align: 'left',
          margin: 0,
          offsetX: -10,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#0e1726'
          },
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
        },
        series: [{
            name: 'Expenses',
            data: arrayPembelian
        }, {
            name: 'Income',
            data: arrayPenjualan
        }],
        labels: arrayWaktuDisplay,
        xaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            show: true
          },
          labels: {
            offsetX: 0,
            offsetY: 5,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-xaxis-title',
            },
          }
        },
        yaxis: {
          labels: {
            formatter: function(value, index) {
              const formattedValue = new Intl.NumberFormat('id-ID', {
              style: 'currency',
              currency: 'IDR',
              }).format(value);
              return (formattedValue)
            },
            offsetX: -15,
            offsetY: 0,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-yaxis-title',
            },
          }
        },
        grid: {
          borderColor: '#e0e6ed',
          strokeDashArray: 5,
          xaxis: {
              lines: {
                  show: true
              }
          },   
          yaxis: {
              lines: {
                  show: false,
              }
          },
          padding: {
            top: -50,
            right: 0,
            bottom: 0,
            left: 5
          },
        }, 
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          offsetY: -50,
          fontSize: '16px',
          fontFamily: 'Quicksand, sans-serif',
          markers: {
            width: 10,
            height: 10,
            strokeWidth: 0,
            strokeColor: '#fff',
            fillColors: undefined,
            radius: 12,
            onClick: undefined,
            offsetX: -5,
            offsetY: 0
          },    
          itemMargin: {
            horizontal: 10,
            vertical: 20
          }
          
        },
        tooltip: {
          theme: Theme,
          marker: {
            show: true,
          },
          x: {
            show: false,
          }
        },
        fill: {
            type:"gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .19,
                opacityTo: .05,
                stops: [100, 100]
            }
        },
        responsive: [{
          breakpoint: 575,
          options: {
            legend: {
                offsetY: -50,
            },
          },
        }]
      }

      var options2 = {
        chart: {
          fontFamily: 'Nunito, sans-serif',
          height: 365,
          type: 'area',
          zoom: {
              enabled: false
          },
          dropShadow: {
            enabled: true,
            opacity: 0.2,
            blur: 10,
            left: -7,
            top: 22
          },
          toolbar: {
            show: false
          },
        },
        colors: ['#1b55e2', '#e7515a', '#05988A', '#e2a03f'],
        dataLabels: {
            enabled: false
        },
        markers: {
          discrete: [{
          seriesIndex: 0,
          dataPointIndex: 7,
          fillColor: '#000',
          strokeColor: '#000',
          size: 5 
        }, {
          seriesIndex: 2,
          dataPointIndex: 11,
          fillColor: '#000',
          strokeColor: '#000',
          size: 4
        }]
        },
        subtitle: {
          text: '',
          align: 'left',
          margin: 0,
          offsetX: 100,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#4361ee'
          }
        },
        title: {
          text: 'Dari ' + arrayWaktuDisplay[0] + ' sampai ' + arrayWaktuDisplay[11],
          align: 'left',
          margin: 0,
          offsetX: -10,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#e2a03f'
          },
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
        },
        series: [{
            name: 'BATIK',
            data: arraybatik
        }, {
            name: 'MOTIF',
            data: arraymotif
        }, {
            name: 'POLOS',
            data: arraypolos
        }, {
            name: 'TAKWO',
            data: arraytakwo
        }],
        labels: arrayWaktuDisplay,
        xaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            show: true
          },
          labels: {
            offsetX: 0,
            offsetY: 5,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-xaxis-title',
            },
          }
        },
        yaxis: {
          labels: {
            formatter: function(value, index) {
              return (value) + ' Pcs'
            },
            offsetX: -15,
            offsetY: 0,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-yaxis-title',
            },
          }
        },
        grid: {
          borderColor: '#e0e6ed',
          strokeDashArray: 5,
          xaxis: {
              lines: {
                  show: true
              }
          },   
          yaxis: {
              lines: {
                  show: false,
              }
          },
          padding: {
            top: -50,
            right: 0,
            bottom: 0,
            left: 5
          },
        }, 
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          offsetY: -50,
          fontSize: '16px',
          fontFamily: 'Quicksand, sans-serif',
          markers: {
            width: 10,
            height: 10,
            strokeWidth: 0,
            strokeColor: '#fff',
            fillColors: undefined,
            radius: 12,
            onClick: undefined,
            offsetX: -5,
            offsetY: 0
          },    
          itemMargin: {
            horizontal: 10,
            vertical: 20
          }
          
        },
        tooltip: {
          theme: Theme,
          marker: {
            show: true,
          },
          x: {
            show: false,
          }
        },
        fill: {
            type:"gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .19,
                opacityTo: .05,
                stops: [100, 100]
            }
        },
        responsive: [{
          breakpoint: 575,
          options: {
            legend: {
                offsetY: -50,
            },
          },
        }]
      }
      
      /*
          ==================================
              Sales By Category | Options
          ==================================
      */
      var options = {
          chart: {
              type: 'donut',
              width: 300,
              height: 430
          },
          colors: ['#622bd7', '#e2a03f', '#e7515a', '#05988A'],
          dataLabels: {
            enabled: false
          },
          legend: {
              position: 'bottom',
              horizontalAlign: 'center',
              fontSize: '14px',
              markers: {
                width: 10,
                height: 10,
                offsetX: -5,
                offsetY: 0
              },
              itemMargin: {
                horizontal: 10,
                vertical: 30
              }
          },
          plotOptions: {
            pie: {
              donut: {
                size: '75%',
                background: 'transparent',
                labels: {
                  show: true,
                  name: {
                    show: true,
                    fontSize: '29px',
                    fontFamily: 'Nunito, sans-serif',
                    color: undefined,
                    offsetY: -10
                  },
                  value: {
                    show: true,
                    fontSize: '26px',
                    fontFamily: 'Nunito, sans-serif',
                    color: '#fff',
                    offsetY: 16,
                    formatter: function (val) {
                      return val
                    }
                  },
                  total: {
                    show: true,
                    showAlways: true,
                    label: 'Total',
                    color: '#888ea8',
                    fontSize: '30px',
                    formatter: function (w) {
                    return w.globals.seriesTotals.reduce( function(a, b) {
                    return a + b
                    }, 0)
                    }
                  }
                }
              }
            }
          },
          stroke: {
            show: true,
            width: 15,
            colors: '#0E1726'
          },
          series: saleskategori,
          labels: kategori,
    
          responsive: [
            { 
              breakpoint: 1440, options: {
                chart: {
                  width: 325
                },
              }
            },
            { 
              breakpoint: 1199, options: {
                chart: {
                  width: 380
                },
              }
            },
            { 
              breakpoint: 575, options: {
                chart: {
                  width: 320
                },
              }
            },
            { 
              breakpoint: 575, options: {
                chart: {
                  width: 320
                },
              }
            },
          ],
      }

    } else {

      var Theme = 'dark';
  
      Apex.tooltip = {
          theme: Theme
      }
  
      /**
          ==============================
          |    @Options Charts Script   |
          ==============================
      */
      
      /*
          =============================
              Daily Sales | Options
          =============================
      */
      var d_2options1 = {
        chart: {
            height: 160,
            type: 'bar',
            stacked: true,
            stackType: '100%',
            toolbar: {
                show: false,
            }
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: [3, 4],
            curve: "smooth",
        },
        colors: ['#e2a03f', '#e0e6ed'],
        series: [{
            name: 'Sales',
            data: [44, 55, 41, 67, 22, 43, 21]
        },{
            name: 'Last Week',
            data: [13, 23, 20, 8, 13, 27, 33]
        }],
        xaxis: {
            labels: {
                show: false,
            },
            categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
            crosshairs: {
            show: false
            }
        },
        yaxis: {
            show: false
        },
        fill: {
            opacity: 1
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '25%',
                borderRadius: 8,
            }
        },
        legend: {
            show: false,
        },
        grid: {
            show: false,
            xaxis: {
                lines: {
                    show: false
                }
            },
            padding: {
            top: -20,
            right: 0,
            bottom: -40,
            left: 0
            }, 
        },
        responsive: [
            {
                breakpoint: 575,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 5,
                            columnWidth: '35%'
                        }
                    },
                }
            },
        ],
      }
      
      /*
          =============================
              Total Orders | Options
          =============================
      */
      var d_2options2 = {
        chart: {
          id: 'sparkline1',
          group: 'sparklines',
          type: 'area',
          height: 290,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
          opacity: 1,
          // type:"gradient",
          // gradient: {
          //     type: "vertical",
          //     shadeIntensity: 1,
          //     inverseColors: !1,
          //     opacityFrom: .30,
          //     opacityTo: .05,
          //     stops: [100, 100]
          // }
        },
        series: [{
          name: 'Sales',
          data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
        }],
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
        yaxis: {
          min: 0
        },
        grid: {
          padding: {
            top: 125,
            right: 0,
            bottom: 0,
            left: 0
          }, 
        },
        tooltip: {
          x: {
            show: false,
          },
          theme: Theme
        },
        colors: ['#00ab55']
      }
      
      /*
          =================================
              Revenue Monthly | Options
          =================================
      */
      var options1 = {
        chart: {
          fontFamily: 'Nunito, sans-serif',
          height: 365,
          type: 'area',
          zoom: {
              enabled: false
          },
          dropShadow: {
            enabled: true,
            opacity: 0.2,
            blur: 10,
            left: -7,
            top: 22
          },
          toolbar: {
            show: false
          },
        },
        colors: ['#e7515a', '#1b55e2', ],
        dataLabels: {
            enabled: false
        },
        markers: {
          discrete: [{
          seriesIndex: 0,
          dataPointIndex: 7,
          fillColor: '#000',
          strokeColor: '#000',
          size: 5
        }, {
          seriesIndex: 2,
          dataPointIndex: 11,
          fillColor: '#000',
          strokeColor: '#000',
          size: 4
        }]
        },
        subtitle: {
          text: '',
          align: 'left',
          margin: 0,
          offsetX: 100,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#4361ee'
          }
        },
        title: {
          text: 'Dari ' + arrayWaktuDisplay[0] + ' sampai ' + arrayWaktuDisplay[11],
          align: 'left',
          margin: 0,
          offsetX: -10,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#0e1726'
          },
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
        },
        series: [{
            name: 'Expenses',
            data: arrayPembelian
        }, {
            name: 'Income',
            data: arrayPenjualan
        }],
        labels: arrayWaktuDisplay,
        xaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            show: true
          },
          labels: {
            offsetX: 0,
            offsetY: 5,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-xaxis-title',
            },
          }
        },
        yaxis: {
          labels: {
            formatter: function(value, index) {
              const formattedValue = new Intl.NumberFormat('id-ID', {
              style: 'currency',
              currency: 'IDR',
              }).format(value);
              return (formattedValue)
            },
            offsetX: -15,
            offsetY: 0,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-yaxis-title',
            },
          }
        },
        grid: {
          borderColor: '#e0e6ed',
          strokeDashArray: 5,
          xaxis: {
              lines: {
                  show: true
              }
          },   
          yaxis: {
              lines: {
                  show: false,
              }
          },
          padding: {
            top: -50,
            right: 0,
            bottom: 0,
            left: 5
          },
        }, 
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          offsetY: -50,
          fontSize: '16px',
          fontFamily: 'Quicksand, sans-serif',
          markers: {
            width: 10,
            height: 10,
            strokeWidth: 0,
            strokeColor: '#fff',
            fillColors: undefined,
            radius: 12,
            onClick: undefined,
            offsetX: -5,
            offsetY: 0
          },    
          itemMargin: {
            horizontal: 10,
            vertical: 20
          }
          
        },
        tooltip: {
          theme: Theme,
          marker: {
            show: true,
          },
          x: {
            show: false,
          }
        },
        fill: {
            type:"gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .19,
                opacityTo: .05,
                stops: [100, 100]
            }
        },
        responsive: [{
          breakpoint: 575,
          options: {
            legend: {
                offsetY: -50,
            },
          },
        }]
      }

      var options2 = {
        chart: {
          fontFamily: 'Nunito, sans-serif',
          height: 365,
          type: 'area',
          zoom: {
              enabled: false
          },
          dropShadow: {
            enabled: true,
            opacity: 0.2,
            blur: 10,
            left: -7,
            top: 22
          },
          toolbar: {
            show: false
          },
        },
        colors: ['#1b55e2', '#e7515a', '#05988A', '#e2a03f'],
        dataLabels: {
            enabled: false
        },
        markers: {
          discrete: [{
          seriesIndex: 0,
          dataPointIndex: 7,
          fillColor: '#000',
          strokeColor: '#000',
          size: 5
        }, {
          seriesIndex: 2,
          dataPointIndex: 11,
          fillColor: '#000',
          strokeColor: '#000',
          size: 4
        }]
        },
        subtitle: {
          text: '',
          align: 'left',
          margin: 0,
          offsetX: 100,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#4361ee'
          }
        },
        title: {
          text: 'Dari ' + arrayWaktuDisplay[0] + ' sampai ' + arrayWaktuDisplay[11],
          align: 'left',
          margin: 0,
          offsetX: -10,
          offsetY: 20,
          floating: false,
          style: {
            fontSize: '18px',
            color:  '#0e1726'
          },
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
        },
        series: [{
            name: 'BATIK',
            data: arraybatik
        }, {
            name: 'MOTIF',
            data: arraymotif
        }, {
            name: 'POLOS',
            data: arraypolos
        }, {
            name: 'TAKWO',
            data: arraytakwo
        }],
        labels: arrayWaktuDisplay,
        xaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            show: true
          },
          labels: {
            offsetX: 0,
            offsetY: 5,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-xaxis-title',
            },
          }
        },
        yaxis: {
          labels: {
            formatter: function(value, index) {
              return (value) + ' Pcs'
            },
            offsetX: -15,
            offsetY: 0,
            style: {
                fontSize: '12px',
                fontFamily: 'Nunito, sans-serif',
                cssClass: 'apexcharts-yaxis-title',
            },
          }
        },
        grid: {
          borderColor: '#e0e6ed',
          strokeDashArray: 5,
          xaxis: {
              lines: {
                  show: true
              }
          },   
          yaxis: {
              lines: {
                  show: false,
              }
          },
          padding: {
            top: -50,
            right: 0,
            bottom: 0,
            left: 5
          },
        }, 
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          offsetY: -50,
          fontSize: '16px',
          fontFamily: 'Quicksand, sans-serif',
          markers: {
            width: 10,
            height: 10,
            strokeWidth: 0,
            strokeColor: '#fff',
            fillColors: undefined,
            radius: 12,
            onClick: undefined,
            offsetX: -5,
            offsetY: 0
          },    
          itemMargin: {
            horizontal: 10,
            vertical: 20
          }
          
        },
        tooltip: {
          theme: Theme,
          marker: {
            show: true,
          },
          x: {
            show: false,
          }
        },
        fill: {
            type:"gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .19,
                opacityTo: .05,
                stops: [100, 100]
            }
        },
        responsive: [{
          breakpoint: 575,
          options: {
            legend: {
                offsetY: -50,
            },
          },
        }]
      }
      
      /*
          ==================================
              Sales By Category | Options
          ==================================
      */
      var options = {
          chart: {
              type: 'donut',
              width: 270,
              height: 430
          },
          colors: ['#622bd7', '#e2a03f', '#e7515a', '#05988A'],
          dataLabels: {
            enabled: false
          },
          legend: {
              position: 'bottom',
              horizontalAlign: 'center',
              fontSize: '14px',
              markers: {
                width: 10,
                height: 10,
                offsetX: -5,
                offsetY: 0
              },
              itemMargin: {
                horizontal: 10,
                vertical: 30
              }
          },
          plotOptions: {
            pie: {
              donut: {
                size: '75%',
                background: 'transparent',
                labels: {
                  show: true,
                  name: {
                    show: true,
                    fontSize: '29px',
                    fontFamily: 'Nunito, sans-serif',
                    color: undefined,
                    offsetY: -10
                  },
                  value: {
                    show: true,
                    fontSize: '26px',
                    fontFamily: 'Nunito, sans-serif',
                    color: '#0e1726',
                    offsetY: 16,
                    formatter: function (val) {
                      return val
                    }
                  },
                  total: {
                    show: true,
                    showAlways: true,
                    label: 'Total',
                    color: '#888ea8',
                    fontSize: '30px',
                    formatter: function (w) {
                      return w.globals.seriesTotals.reduce( function(a, b) {
                        return a + b
                      }, 0)
                    }
                  }
                }
              }
            }
          },
          stroke: {
            show: true,
            width: 15,
            colors: '#fff'
          },
          series: saleskategori,
          labels: kategori,
    
          responsive: [
            { 
              breakpoint: 1440, options: {
                chart: {
                  width: 325
                },
              }
            },
            { 
              breakpoint: 1199, options: {
                chart: {
                  width: 380
                },
              }
            },
            { 
              breakpoint: 575, options: {
                chart: {
                  width: 320
                },
              }
            },
          ],
      }
    }
    
  
  /**
      ==============================
      |    @Render Charts Script    |
      ==============================
  */
  
  
  /*
      ============================
          Daily Sales | Render
      ============================
  */
  var d_2C_1 = new ApexCharts(document.querySelector("#daily-sales"), d_2options1);
  d_2C_1.render();
  
  /*
      ============================
          Total Orders | Render
      ============================
  */
  var d_2C_2 = new ApexCharts(document.querySelector("#total-orders"), d_2options2);
  d_2C_2.render();
  
  /*
      ================================
          Revenue Monthly | Render
      ================================
  */
  var chart1 = new ApexCharts(
      document.querySelector("#revenueMonthly"),
      options1
  );
  
  chart1.render();

  var chart2 = new ApexCharts(
      document.querySelector("#saleskategoriproduk"),
      options2
  );
  
  chart2.render();
  
  /*
      =================================
          Sales By Category | Render
      =================================
  */
  var chart = new ApexCharts(
      document.querySelector("#chart-2"),
      options
  );
  
  chart.render();
  
  /*
      =============================================
          Perfect Scrollbar | Recent Activities
      =============================================
  */
  const ps = new PerfectScrollbar(document.querySelector('.mt-container-ra'));
  
  // const topSellingProduct = new PerfectScrollbar('.widget-table-three .table-scroll table', {
  //   wheelSpeed:.5,
  //   swipeEasing:!0,
  //   minScrollbarLength:40,
  //   maxScrollbarLength:100,
  //   suppressScrollY: true
  
  // });





  /**
     * =================================================================================================
     * |     @Re_Render | Re render all the necessary JS when clicked to switch/toggle theme           |
     * =================================================================================================
     */
  
  document.querySelector('.theme-toggle').addEventListener('click', function() {

    // console.log(localStorage);

    getcorkThemeObject = localStorage.getItem("theme");
    getParseObject = JSON.parse(getcorkThemeObject)
    ParsedObject = getParseObject;

    if (ParsedObject.settings.layout.darkMode) {

      /*
      =================================
          Revenue Monthly | Options
      =================================
    */

      chart1.updateOptions({
        colors: ['#e7515a', '#2196f3', '#05988A'],
        subtitle: {
          style: {
            color:  '#00ab55'
          }
        },
        title: {
          style: {
            color:  '#bfc9d4'
          }
        },
        grid: {
          borderColor: '#191e3a',
        }
      })


      /*
      ==================================
          Sales By Category | Options
      ==================================
      */

      chart.updateOptions({
        stroke: {
          colors: '#0e1726'
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                value: {
                  color: '#bfc9d4'
                }
              }
            }
          }
        }
      })


      /*
          =============================
              Total Orders | Options
          =============================
      */

      d_2C_2.updateOptions({
        fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .30,
              opacityTo: .05,
              stops: [100, 100]
          }
        }
      })

    } else {

      /*
      =================================
          Revenue Monthly | Options
      =================================
    */

      chart1.updateOptions({
        colors: ['#1b55e2', '#e7515a', '#05988A'],
        subtitle: {
          style: {
            color:  '#4361ee'
          }
        },
        title: {
          style: {
            color:  '#0e1726'
          }
        },
        grid: {
          borderColor: '#e0e6ed',
        }
      })


      /*
      ==================================
          Sales By Category | Options
      ==================================
      */

      chart.updateOptions({
        stroke: {
          colors: '#fff'
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                value: {
                  color: '#0e1726'
                }
              }
            }
          }
        }
      })


      /*
          =============================
              Total Orders | Options
          =============================
      */

      d_2C_2.updateOptions({
        fill: {
          type:"gradient",
          opacity: 0.9,
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .45,
              opacityTo: 0.1,
              stops: [100, 100]
          }
        }
      })
      
      
    }

  })
  
  
  } catch(e) {
      console.log(e);
  }

})
</script>
@endsection