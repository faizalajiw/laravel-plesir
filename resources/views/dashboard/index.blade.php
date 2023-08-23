@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Dashboard</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- HEADER -->
        <div class="page-header mb-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ Session::get('name') }}</li>
                        </ul>
                        <h3 class="page-title">Hai {{ Session::get('name') }}!</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- HEADER -->

        <!-- CARD -->
        @if (Session::get('role_name') === 'Super Admin')
        <div class="row mt-5">
            <!-- CARD 1 -->
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{ route('list/users/pengguna') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Pengguna</h6>
                                    <h3>{{ $penggunaCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- CARD 1 -->

            <!-- CARD 2 -->
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{ route('list/users/admin') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Admin Wisata</h6>
                                    <h3>{{ $adminCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- CARD 2 -->

            <!-- CARD 3 -->
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{ route('list/categories') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Kategori Wisata</h6>
                                    <h3>{{ $categoryCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <i class="fas fa-th-list"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- CARD 3 -->

            <!-- CARD 4 -->
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{ route('list/places') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Tempat Wisata</h6>
                                    <h3>{{ $placeCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- CARD 4 -->
        </div>
        @endif
        <!-- CARD -->

        <!-- Statistik -->
        @if (Session::get('role_name') === 'Admin Wisata')
        <div class="row mb-3">
            <div class="col-md-12 col-lg-8">
                <div class="card card-chart">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                        <div id="chart-data" data-labels="{{ json_encode($labels) }}" data-quantities="{{ json_encode($quantities) }}"></div>
                        @if ($order->isEmpty())
                        <tr>
                            <td colspan="11">
                                <div class="text-center">
                                    <p class="text-muted mt-3">Tidak ada data pengunjung yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </div>
                </div>
            </div>

            <div hidden class="col-md-12 col-lg-8 d-flex">
                <div hidden class="card flex-fill student-space comman-shadow">
                    <div hidden class="card-header d-flex align-items-center">
                        <h5 hidden class="card-title">Data Pengunjung</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-0 star-table table-hover table-center mb-0 datatable table-striped">
                                <thead class="table-thread">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Wisata</th>
                                        <th class="text-center">Jumlah Tiket</th>
                                        <th class="text-center">Total Harga</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $list)
                                    @if ($list->status === 'Berhasil')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->place_title }}</td>
                                        <td class="text-center">{{ $list->quantity }}</td>
                                        <td class="text-center">{{ $list->total }}</td>
                                        <td>{{ date('d-m-Y', strtotime($list->tanggal)) }}</td>
                                        <td class="badge rounded-pill bg-success text-white my-2">{{ $list->status }}</td>
                                        <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const chartDataElement = document.getElementById('chart-data');
            const labels = JSON.parse(chartDataElement.getAttribute('data-labels'));
            const quantities = JSON.parse(chartDataElement.getAttribute('data-quantities'));

            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, //Tanggal
                    datasets: [{
                        label: 'Jumlah Pengunjung',
                        data: quantities, //Total Penjualan Tiket
                        backgroundColor: 'rgba(3, 4, 94, 1)',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal',
                                color: 'black',
                                font: {
                                    size: 16
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Pengunjung',
                                color: 'black',
                                font: {
                                    size: 16
                                }
                            }
                        }
                    }
                }
            });
        </script>
        @endif
        <!-- Statistik -->

        @if (Session::get('role_name') === 'Pengguna')
        <div class="text-center">
            <img class="img-fluid" src="{{ URL::to('assets/img/login.png') }}" alt="Logo">
        </div>
        @endif
    </div>


    @section('script')
    <!-- CHART JS -->
    <!-- <script src="{{ URL::to('assets/plugins/chartjs/chart.js') }}"></script> -->
    <!-- <script src="{{ URL::to('assets/plugins/chartjs/bar-chart-data.js') }}"></script> -->
    <!-- <script src="{{ URL::to('assets/plugins/chartjs/pie-chart-data.js') }}"></script> -->

    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    @endsection

    @endsection