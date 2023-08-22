@extends('layouts.web')
@section('content')
<title>Invoice Tiket</title>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.client_key')}}"></script>
<!-- TIKET -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center" style="margin-bottom: 35px;">
        @if (auth()->user()->role_name === 'Pengguna')
        <div class="col-12" style="margin-top: -15px">
            <!-- <a href="#" class="text-white btn"><i class="fas fa-arrow-left mr-2"></i> Kembali</a> -->
            @else
            <div class="col-12">
                @endif
                <div class="card shadow h-100" style="border-top: .25rem solid #4e73df">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center justify-content-center">
                            <div class="col h4 font-weight-bold" style="margin-bottom: 0">Invoice Tiket</div>
                            <div class="col-auto">
                                <span class="title">
                                    <div class="title-icon rotate-n-15">
                                        <i class="fas fa-ticket-alt"></i>
                                    </div>
                                    <div class="title-text ml-1">Tiket</div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p style="margin-bottom: 0; margin-top: 5px; text-align: center; font-size: 20px; font-weight: 500;">Tiket Wisata</p>
                        <h5 class="font-weight-bold text-center">
                            <div style="font-size: 35px;">
                                {{ $order->place_title }}
                            </div>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td class="text-right h5">Pesan Untuk Tanggal</td>
                                <td class="text-right h5">{{ date('l, d F Y', strtotime($order->tanggal)) }}</td>
                            </tr>
                            <tr>
                                <td class="text-right h5">Harga</td>
                                <td class="text-right h5">Rp. {{ number_format($order->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="text-right h5">Jumlah Tiket</td>
                                <td class="text-right h5">{{ $order->quantity }}</td>
                            </tr>
                            <tr>
                                <td class="text-right h5">Total Bayar</td>
                                <td class="text-right h5">Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="text-right h5">Status Pembayaran</td>
                                @if ($order->status === 'Berhasil')
                                <td class="text-right h5 badge rounded-pill bg-success text-white my-2">{{ $order->status }}</td>
                                @else
                                <td class="text-right h5 badge rounded-pill bg-warning text-white my-2">{{ $order->status }}</td>
                                @endif
                            </tr>
                        </table>
                        @if ($order->status === 'Belum Dibayar')
                        <button id="pay-button" class="btn btn-primary py-2 px-3">Lanjutkan Pembayaran</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- TIKET -->
    </div>
    
    @if ($order->status === 'Belum Dibayar')
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{$snapToken}}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location.href = '{{$order->id}}';
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
    @endif
    @endsection