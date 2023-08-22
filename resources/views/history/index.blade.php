@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Riwayat Pemesanan</title>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.client_key')}}"></script>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Akun</a></li>
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
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                        <th class="text-center">Action</th>
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
                                        <td>{{ $list->tanggal }}</td>
                                        <td class="badge rounded-pill {{ $list->status === 'Belum Dibayar' ? 'bg-warning text-white' : ($list->status === 'Lunas' ? 'bg-success text-white' : '') }} my-2">{{ $list->status }}</td>
                                        <td class="id" style="color: 000; background-color: transparent;">{{ $list->id }}</td>
                                        <td>
                                            @if ($list->status === 'Belum Dibayar')
                                            <a href="{{ route('checkout', ['id' => $list->id]) }}" class="btn btn-info">Bayar Sekarang</a>
                                            @endif
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
    </div>
</div>

@section('script')
{{-- delete js --}}

@endsection

@endsection