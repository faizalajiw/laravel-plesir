@extends('layouts.error')
@section('content')
<div class="main-wrapper">
    <div class="error-box">
        <a href="{{route('dashboard')}}">
            <img src="/images/404.png" alt="Error Image">
        </a>
        <a href="{{route('dashboard')}}" class="btn btn-primary">Go to Homepage</a>
    </div>
</div>
@endsection