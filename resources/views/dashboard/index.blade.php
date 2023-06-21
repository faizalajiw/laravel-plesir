@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Home</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- HEADER -->
        <div class="page-header mb-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ Session::get('name') }}</li>
                        </ul>
                        <h3 class="page-title">Welcome {{ Session::get('name') }}!</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- HEADER -->

        <!-- CARD -->
        @if (Session::get('role_name') === 'Super Admin')
        <div class="row mb-3">
            @php
            $cards = [
            ['Pengguna', $penggunaCount, 'fas fa-user'],
            ['Admin Wisata', $adminCount, 'fas fa-users-cog'],
            ['Kategori Wisata', $categoryCount, 'fas fa-th-list'],
            ['Tempat Wisata', $placeCount, 'fas fa-map-marked-alt']
            ];
            @endphp

            @foreach ($cards as $card)
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>{{ $card[0] }}</h6>
                                <h3>{{ $card[1] }}</h3>
                            </div>
                            <div class="db-icon">
                                <i class="{{ $card[2] }}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <!-- CARD -->

        <!-- FILTER -->
        @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Admin Wisata')
        <div class="search-group-form mt-3">
            <form action="{{ route('dashboard/filter') }}" method="GET">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" name="place_id" class="form-control" style="font-size: 15px;" placeholder="Filter berdasarkan Tempat ..." value="{{ request('place') }}">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary text-white">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif
        <!-- FILTER -->

        <!-- Statistik -->
        @if (Session::get('role_name') === 'Admin Wisata')
        <div class="row mb-3">
            <div class="col-md-12 col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Data Pengunjung</h5>
                            </div>
                            <div class="col-6"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart"></canvas>
                        @if ($visitor->isEmpty())
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
            <div class="col-md-12 col-lg-8">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Data Pengunjung</h5>
                            </div>
                            <div class="col-6"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart"></canvas>
                        @if ($visitor->isEmpty())
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
        </div>
        @endif
        <!-- Statistik -->

        <!-- Tabel Data Pengunjung -->
        @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Admin Wisata')
        <div class="row mb-3">
            <div class="col-xl-12 col-sm-12 col-12 d-flex">

                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Data Pengunjung</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table star-student table-hover table-center table-borderless table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tempat</th>
                                        <th>Nama Pengelola</th>
                                        <th>Senin</th>
                                        <th>Selasa</th>
                                        <th>Rabu</th>
                                        <th>Kamis</th>
                                        <th>Jumat</th>
                                        <th>Sabtu</th>
                                        <th>Minggu</th>
                                        <th>Total</th>
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitor as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->place->title }}</td>
                                        <td>{{ $list->user->name }}</td>
                                        <td id="senin">{{ $list->senin }}</td>
                                        <td id="selasa">{{ $list->selasa }}</td>
                                        <td id="rabu">{{ $list->rabu }}</td>
                                        <td id="kamis">{{ $list->kamis }}</td>
                                        <td id="jumat">{{ $list->jumat }}</td>
                                        <td id="sabtu">{{ $list->sabtu }}</td>
                                        <td id="minggu">{{ $list->minggu }}</td>
                                        <td>{{ $list->total_hari }}</td>
                                        <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                                    </tr>
                                    @endforeach
                                    @if ($visitor->isEmpty())
                                    <tr>
                                        <td colspan="11">
                                            <div class="text-center">
                                                <p class="text-muted mt-3">Tidak ada data pengunjung yang tersedia.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Tabel Data Pengunjung -->
    </div>

    @section('script')
    <!-- CHART JS -->
    <script src="{{ URL::to('assets/plugins/chartjs/charts.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/chartjs/pie-chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/chartjs/bar-chart-data.js') }}"></script>
    @endsection

    @endsection