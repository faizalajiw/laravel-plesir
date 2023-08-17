@extends('layouts.error')
@section('content')
<div class="main-wrapper">
    <div class="error-box">
        <h1 style="color:darkslateblue; font-size: 70px; font-weight: bold;">Maaf..</h1>
        <h4 style="color:darkslateblue;" class="mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Data {{ $query }} tidak ditemukan.</h4>
        <div style="background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif); height: 400px; background-position: center;"></div>
        <hr>
        <a href="{{ route('/') }}" class="btn btn-primary">Ke Halaman Utama</a>
    </div>
</div>
@endsection