@extends('layouts.error')
@section('content')
<div class="main-wrapper">
    <div class="error-box">
        <a href="{{route('home')}}">
            <img src="/images/404.png" alt="Error Image">
        </a>
        <a href="{{route('home')}}" class="btn btn-primary">Go to Homepage</a>
    </div>
</div>
@endsection