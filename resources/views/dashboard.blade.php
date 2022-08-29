@extends('sb-admin/app')

@section('tittle', 'Dashboard')
@section('dashboard', 'active')

@section('content')
    <!-- Page Heading -->

    {{-- <div class="container pb-5"> --}}
    <div class="row px-5">
        <div class="col-xl-4 col-lg-6">
            <a href="{{ url('/kasmasuk', []) }}" class="text-decoration-none">
                <div class="card border-left-success shadow  py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center m-2">
                            <div class="col mr-2">
                                <div class="h6 font-weight-bold text-success text-uppercase mb-3">
                                    Total Arus Kas Masuk :</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ matauangID($kasmasuk) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-arrow-trend-up fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 mb-4">
            <a href="{{ url('/kaskeluar', []) }}" class="text-decoration-none">
                <div class="card border-left-danger shadow  py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center m-2">
                            <div class="col mr-2">
                                <div class="h6 font-weight-bold text-danger text-uppercase mb-3">
                                    Total Arus Kas Keluar :</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ matauangID($kaskeluar) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-arrow-trend-down fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card border-left-info shadow  py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center m-2">
                        <div class="col mr-2">
                            <div class="h6 font-weight-bold text-info text-uppercase mb-3">
                                Total saldo Akhir :</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ matauangID($kasmasuk - $kaskeluar) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-title">Jumlah Arus Kas Masuk dan Keluar</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-title">Jumlah Arus Kas Masuk dan Keluar Perbulan</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('doughnutChart');
        const doughnutChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Kas Masuk', 'Kas Keluar'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ $kas_masuk }}, {{ $kas_keluar }}],
                    backgroundColor: [
                        'rgba(38, 166, 91, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                    ],
                    borderColor: [
                        'rgba(38, 166, 91, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }, ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        const ctr = document.getElementById('barChart');
        const barChart = new Chart(ctr, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                        label: 'Kas Masuk',
                        data: [{{ $masuk_jan }}, {{ $masuk_feb }}, {{ $masuk_mar }},
                            {{ $masuk_apr }}, {{ $masuk_mei }}, {{ $masuk_jun }},
                            {{ $masuk_jul }}, {{ $masuk_agu }}, {{ $masuk_sep }},
                            {{ $masuk_okt }}, {{ $masuk_nov }}, {{ $masuk_des }}
                        ],
                        backgroundColor: [
                            'rgba(38, 166, 91, 0.5)',
                        ],
                        borderColor: [
                            'rgba(38, 166, 91, 1)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Kas Keluar',
                        data: [{{ $keluar_jan }}, {{ $keluar_feb }}, {{ $keluar_mar }},
                            {{ $keluar_apr }}, {{ $keluar_mei }}, {{ $keluar_jun }},
                            {{ $keluar_jul }}, {{ $keluar_agu }}, {{ $keluar_sep }},
                            {{ $keluar_okt }}, {{ $keluar_nov }}, {{ $keluar_des }}
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('/sb-admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('/sb-admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('/sb-admin/js/demo/chart-pie-demo.js') }}"></script>

@endsection
