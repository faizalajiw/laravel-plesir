@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Home</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- HEADER -->
        <div class="page-header">
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
        <div class="row mt-5">
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
        <!-- CARD -->

        <div class="row mb-5">
            <div class="graphbox">
                <div class="box">
                    <h5 class="card-title text-center">Data Pengunjung</h5>
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="box">
                    <h5 class="card-title text-center">Data Pengunjung</h5>
                    <canvas id="myBarChart"></canvas>
                </div>

                <!-- PIE CHART PENGUNJUNG -->
                <!-- <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h5 class="card-title text-center">Data Pengunjung</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div> -->
                <!-- PIE CHART PENGUNJUNG -->
            </div>

            <div class="row">
                <!-- Aktivitas User -->
                <!-- <div class="col-xl-6 d-flex">

                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Aktivitas User</h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table star-student table-hover table-center table-borderless table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th class="text-center">Marks</th>
                                        <th class="text-center">Percentage</th>
                                        <th class="text-end">Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>PRE2209</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="profile.html">
                                                <img class="rounded-circle" src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}" width="25" alt="Star Students"> Soeng Souy
                                            </a>
                                        </td>
                                        <td class="text-center">1185</td>
                                        <td class="text-center">98%</td>
                                        <td class="text-end">
                                            <div>2019</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>PRE1245</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="profile.html">
                                                <img class="rounded-circle" src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}" width="25" alt="Star Students"> Soeng Souy
                                            </a>
                                        </td>
                                        <td class="text-center">1195</td>
                                        <td class="text-center">99.5%</td>
                                        <td class="text-end">
                                            <div>2018</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>PRE1625</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="profile.html">
                                                <img class="rounded-circle" src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}" width="25" alt="Star Students"> Soeng Souy
                                            </a>
                                        </td>
                                        <td class="text-center">1196</td>
                                        <td class="text-center">99.6%</td>
                                        <td class="text-end">
                                            <div>2017</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>PRE2516</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="profile.html">
                                                <img class="rounded-circle" src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}" width="25" alt="Star Students"> Soeng Souy
                                            </a>
                                        </td>
                                        <td class="text-center">1187</td>
                                        <td class="text-center">98.2%</td>
                                        <td class="text-end">
                                            <div>2016</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>PRE2209</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="profile.html">
                                                <img class="rounded-circle" src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}" width="25" alt="Star Students"> Soeng Souy
                                            </a>
                                        </td>
                                        <td class="text-center">1185</td>
                                        <td class="text-center">98%</td>
                                        <td class="text-end">
                                            <div>2015</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
                <!-- Aktivitas User -->
            </div>
        </div>
    </div>
    @endsection