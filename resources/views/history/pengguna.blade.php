@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Riwayat Pemesanan</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item active">Riwayat Pemesanan</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="form-title">Riwayat Pemesanan</h3>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-table table-hover table-center mb-0 datatable table-striped">
                                <thead class="table-thread">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Wisata</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->place_title }}</td>
                                        <td>{{ $list->quantity }}</td>
                                        <td>{{ $list->total }}</td>
                                        <td>{{ date('d-m-Y', strtotime($list->tanggal)) }}</td>
                                        <td>
                                            @if ($list->status === 'Berhasil')
                                            <a href="#" class="badge rounded-pill bg-success text-white my-1 py-2">{{ $list->status }}</a>
                                            @else
                                            <a href="#" class="badge rounded-pill bg-warning text-white my-1 py-2">{{ $list->status }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($list->status === 'Berhasil')
                                            <a href="{{ route('invoice', ['id' => $list->id]) }}" class="badge rounded-pill bg-info text-white my-1 py-2">Lihat Invoice</a>
                                            @else
                                            <a href="{{ route('check', ['id' => $list->id]) }}" class="badge rounded-pill bg-secondary text-white my-1 py-2">Bayar Sekarang</a>
                                            @endif
                                        </td>
                                        <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
{{-- delete js --}}

@endsection

@endsection