@extends('templating.components.master')

@section('main-content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Perolehan Suara {{ $voting_places->voting_place_name }}
                {{ $voting_places->electoral_district_name }} </h5>
            <h5 class="card-title fw-light ">{{ $voting_places->voting_place_address }}</h5>
            <h5 class="card-title fw-light mb-4 text-capitalize">{{ $voting_places->sub_district_name }},
                {{ $voting_places->district_name }}, {{ $voting_places->voting_place_city }},
                {{ $voting_places->voting_place_province }}</h5>

            @if (session('message'))
                <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show" role="alert">
                    {{ session('message')['text'] }}
                </div>
            @endif

            @php
                $isSet = App\Models\IdentityVote::where('id_voting_place', $voting_places->voting_place_encrypted_id)->exists();
            @endphp

            @if ($isSet)
                {{-- kalo ada --}}

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Suara Kandidat </h2>
                                <h5>{!! $datapertps !!} Suara</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold ">Suara Partai Per TPS</h5>
                                <p class="mb-0">*dalam diagram batang</p>
                                <div id="suarapartaipertps"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold ">Suara Partai Per TPS</h5>
                                <p class="mb-0">*dalam diagram lingkaran</p>
                                <div id="suarapartaipertpsrounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4">
                    <h2>Detail Suara Kandidat</h2>
                    <table id="example1" class="display cell-border row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kandidat</th>
                                <th>Jumlah Suara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailcandidatevotestps as $item)
                                <tr class="text-justify">
                                    <td></td>
                                    <td>{{ $item->candidate_name }}</td>
                                    <td>{{ $item->candidate_vote_vote_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="my-4">
                    <h2>Detail Suara Partai</h2>
                    <table id="example2" class="display cell-border row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kandidat</th>
                                <th>Jumlah Suara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailpartyvotestps as $item)
                                <tr class="text-justify">
                                    <td></td>
                                    <td>{{ $item->party_name }}</td>
                                    <td>{{ $item->total_vote_vote_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mb-4 text-danger"> Petugas Belum Mengisi Data </p>
            @endif

        </div>
    </div>
@endsection

@section('js-page')
    @if ($isSet)
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            var chart = {
                series: [{
                    name: "Suara partai",
                    data: {!! json_encode($datapartaipertps) !!}
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
                    categories: {!! json_encode($labelspartaipertps) !!},
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

            var chart = new ApexCharts(document.querySelector("#suarapartaipertps"), chart);
            chart.render();
        </script>
        <script>
            var chartOptions = {
                series: {!! json_encode($datapartaipertps) !!},
                chart: {
                    type: "pie",
                    height: 400,
                    toolbar: {
                        show: true
                    },
                    foreColor: "#adb0bb",
                    fontFamily: 'inherit',
                },
                labels: {!! json_encode($labelspartaipertps) !!},
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
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            height: 300
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#suarapartaipertpsrounded"), chartOptions);
            chart.render();
        </script>
        <script>
            $(document).ready(function() {
                var table = $('#example1').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print',
                    ]
                });

                function updateRowNumbers() {
                    var i = 1;
                    table.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, k) {
                        cell.innerHTML = i++;
                    });
                }
                table.on('order.dt search.dt', updateRowNumbers).draw();
                updateRowNumbers();

                $('#example td').css({
                    'word-wrap': 'break-word',
                    'white-space': 'normal',
                    'text-align': 'justify'
                });
            });
            $(document).ready(function() {
                var table = $('#example2').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print',
                    ]
                });

                function updateRowNumbers() {
                    var i = 1;
                    table.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, k) {
                        cell.innerHTML = i++;
                    });
                }
                table.on('order.dt search.dt', updateRowNumbers).draw();
                updateRowNumbers();

                $('#example td').css({
                    'word-wrap': 'break-word',
                    'white-space': 'normal',
                    'text-align': 'justify'
                });
            });
        </script>
    @endif
@endsection
