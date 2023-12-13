@extends('templating.components.master')

@section('main-content')
    <div class="card">
        <div class="card-body">
            <h2>Suara Kandidat per TPS</h2>
            <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                @csrf
                <select class="form-control select2" id="pilihkandidattps" name="pilihkandidattps">
                    @foreach ($listtps as $key => $option)
                        <option value="{{ $option->id }}">{{ $option->voting_place_name }}</option>
                    @endforeach
                </select>
                <input type="submit" class="btn btn-primary mt-1" value="Ganti TPS">
            </form>
            @isset($tampilnamakandidattps->voting_place_name)
                <h5 class="mt-3">Data {{ $tampilnamakandidattps->voting_place_name }}</h5>
            @endisset
            @if ($datapertps == null)
                <h5>Data belum tersedia</h5>
            @endif
            <div id="suarakandidatpertps"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2>Suara Kandidat per Desa</h2>
            <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                @csrf
                <select class="form-control select2" id="pilihkandidatdesa" name="pilihkandidatdesa">
                    @foreach ($listdesa as $key => $option)
                        <option value="{{ $option->id }}">{{ $option->sub_district_name }}</option>
                    @endforeach
                </select>
                <input type="submit" class="btn btn-primary mt-1" value="Ganti Desa">
            </form>
            @isset($tampilnamakandidatdesa->sub_district_name)
                <h5 class="mt-3">Data {{ $tampilnamakandidatdesa->sub_district_name }}</h5>
            @endisset
            @if ($dataperdesa == null)
                <h5>Data belum tersedia</h5>
            @endif
            <div id="suarakandidatperdesa"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h2>Suara Kandidat per Kecamatan</h2>
                    <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                        @csrf
                        <select class="form-control select2" id="pilihkandidatkecamatan" name="pilihkandidatkecamatan">
                            @foreach ($listkecamatan as $key => $option)
                                <option value="{{ $option->id }}">{{ $option->district_name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-primary mt-1" value="Ganti Kecamatan">
                    </form>
                    @isset($tampilnamakandidatkecamatan->district_name)
                        <h5 class="mt-3">Data {{ $tampilnamakandidatkecamatan->district_name }}</h5>
                    @endisset
                    @if ($dataperkecamatan == null)
                        <h5>Data belum tersedia</h5>
                    @endif
                    <div id="suarakandidatperkecamatan"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h2>Suara Kandidat per Dapil</h2>
                    <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                        @csrf
                        <select class="form-control select2" id="pilihkandidatdapil" name="pilihkandidatdapil">
                            @foreach ($listdapil as $key => $option)
                                <option value="{{ $option->id }}">{{ $option->electoral_district_name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-primary mt-1" value="Ganti Dapil">
                    </form>
                    @isset($tampilnamakandidatdapil->electoral_district_name)
                        <h5 class="mt-3">Data {{ $tampilnamakandidatdapil->electoral_district_name }}</h5>
                    @endisset
                    @if ($dataperdapil == null)
                        <h5>Data belum tersedia</h5>
                    @endif
                    <div id="suarakandidatperdapil"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2>Suara Partai per Desa</h2>
            <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                @csrf
                <select class="form-control select2" id="pilihdesa" name="pilihdesa">
                    @foreach ($listdesa as $key => $option)
                        <option value="{{ $option->id }}">{{ $option->sub_district_name }}</option>
                    @endforeach
                </select>
                <input type="submit" class="btn btn-primary mt-1" value="Ganti Desa">
            </form>
            @isset($tampilnamadesa->sub_district_name)
                <h5 class="mt-3">Data {{ $tampilnamadesa->sub_district_name }}</h5>
            @endisset
            @if ($datapartaiperdesa == null)
                <h5>Data belum tersedia</h5>
            @endif
            <div id="suarapartaiperdesa"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2>Suara Partai per TPS</h2>
                    <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                        @csrf
                        <select class="form-control select2" id="pilihtps" name="pilihtps">
                            @foreach ($listtps as $key => $option)
                                <option value="{{ $option->id }}">{{ $option->voting_place_name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-primary mt-1" value="Ganti TPS">
                    </form>
                    @isset($tampilnamatps->voting_place_name)
                        <h5 class="mt-3">Data {{ $tampilnamatps->voting_place_name }}</h5>
                    @endisset
                    @if ($datapartaipertps == null)
                        <h5>Data belum tersedia</h5>
                    @endif
                    <div id="suarapartaipertps"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2>Suara Partai per Kecamatan</h2>
                    <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                        @csrf
                        <select class="form-control select2" id="pilihkecamatan" name="pilihkecamatan">
                            @foreach ($listkecamatan as $key => $option)
                                <option value="{{ $option->id }}">{{ $option->district_name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-primary mt-1" value="Ganti Kecamatan">
                    </form>
                    @isset($tampilnamakecamatan->district_name)
                        <h5 class="mt-3">Data {{ $tampilnamakecamatan->district_name }}</h5>
                    @endisset
                    @if ($datapartaiperkecamatan == null)
                        <h5>Data belum tersedia</h5>
                    @endif
                    <div id="suarapartaiperkecamatan"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2>Suara Partai per Dapil</h2>
                    <form action="/dashboard/superadmin/perolehan-suara" method="POST">
                        @csrf
                        <select class="form-control select2" id="pilihdapil" name="pilihdapil">
                            @foreach ($listdapil as $key => $option)
                                <option value="{{ $option->id }}">{{ $option->electoral_district_name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-primary mt-1" value="Ganti Dapil">
                    </form>
                    @isset($tampilnamadapil->electoral_district_name)
                        <h5 class="mt-3">Data {{ $tampilnamadapil->electoral_district_name }}</h5>
                    @endisset
                    @if ($datapartaiperdapil == null)
                        <h5>Data belum tersedia</h5>
                    @endif
                    <div id="suarapartaiperdapil"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-page')
    <script>
        var chart = {
            series: [{
                name: "Suara kandidat",
                data: {!! json_encode($datapertps) !!}
            }, ],

            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: {
                    show: true
                },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: {
                    enabled: false
                },
            },


            palette: 'palette1',


            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
                },
            },
            markers: {
                size: 0
            },

            dataLabels: {
                enabled: false,
            },


            legend: {
                show: false,
            },


            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },

            xaxis: {
                type: "category",
                categories: {!! json_encode($labelspertps) !!},
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color"
                    },
                },
            },


            yaxis: {
                show: true,
                min: 0,
                // max: 400,
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },


            tooltip: {
                theme: "light"
            },

            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        }
                    },
                }
            }]


        };

        var chart = new ApexCharts(document.querySelector("#suarakandidatpertps"), chart);
        chart.render();

        var chart = {
            series: [{
                name: "Suara kandidat",
                data: {!! json_encode($dataperdesa) !!}
            }, ],

            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: {
                    show: true
                },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: {
                    enabled: false
                },
            },


            palette: 'palette1',


            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
                },
            },
            markers: {
                size: 0
            },

            dataLabels: {
                enabled: false,
            },


            legend: {
                show: false,
            },


            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },

            xaxis: {
                type: "category",
                categories: {!! json_encode($labelsperdesa) !!},
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color"
                    },
                },
            },


            yaxis: {
                show: true,
                min: 0,
                // max: 400,
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },


            tooltip: {
                theme: "light"
            },

            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        }
                    },
                }
            }]


        };

        var chart = new ApexCharts(document.querySelector("#suarakandidatperdesa"), chart);
        chart.render();


        var pie = {
            color: "#adb5bd",
            series: {!! json_encode($dataperkecamatan) !!},
            labels: {!! json_encode($labelsperkecamatan) !!},
            chart: {
                // width: 200,
                height: 300,
                toolbar: {
                    show: true
                },
                type: "pie",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },


            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val.toFixed(2) + "%";
                }
            },
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                labels: {
                    colors: '#333'
                }
            },

            palette: 'palette1',

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#suarakandidatperkecamatan"), pie);
        chart.render();

        var pie = {
            color: "#adb5bd",
            series: {!! json_encode($dataperdapil) !!},
            labels: {!! json_encode($labelsperdapil) !!},
            chart: {
                // width: 180,
                height:300,
                type: "pie",
                toolbar: {
                    show: true
                },

                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val.toFixed(2) + "%";
                }
            },
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                labels: {
                    colors: '#333'
                }
            },
            
            palette: 'palette1',

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#suarakandidatperdapil"), pie);
        chart.render();

        var pie = {
            color: "#adb5bd",
            series: {!! json_encode($datapartaipertps) !!},
            labels: {!! json_encode($labelspartaipertps) !!},
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },
            palette: 'palette1',

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#suarapartaipertps"), pie);
        chart.render();

        var chart = {
            series: [{
                name: "Suara kandidat",
                data: {!! json_encode($datapartaiperdesa) !!}
            }, ],

            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: {
                    show: true
                },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: {
                    enabled: false
                },
            },


            palette: 'palette1',


            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
                },
            },
            markers: {
                size: 0
            },

            dataLabels: {
                enabled: false,
            },


            legend: {
                show: false,
            },


            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },

            xaxis: {
                type: "category",
                categories: {!! json_encode($labelspartaiperdesa) !!},
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color"
                    },
                },
            },


            yaxis: {
                show: true,
                min: 0,
                // max: 400,
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },


            tooltip: {
                theme: "light"
            },

            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        }
                    },
                }
            }]


        };

        var chart = new ApexCharts(document.querySelector("#suarapartaiperdesa"), chart);
        chart.render();

        var pie = {
            color: "#adb5bd",
            series: {!! json_encode($datapartaiperkecamatan) !!},
            labels: {!! json_encode($labelspartaiperkecamatan) !!},
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },
            palette: 'palette1',

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#suarapartaiperkecamatan"), pie);
        chart.render();

        var pie = {
            color: "#adb5bd",
            series: {!! json_encode($datapartaiperdapil) !!},
            labels: {!! json_encode($labelspartaiperdapil) !!},
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },
            palette: 'palette1',

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#suarapartaiperdapil"), pie);
        chart.render();
    </script>
@endsection
