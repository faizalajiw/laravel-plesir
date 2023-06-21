@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Detail Ulasan</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="#">Rating & Ulasan</a></li>
                        <li class="breadcrumb-item fw-bold active">Lihat Ulasan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row text-center mt-3">
            @foreach($reviews as $review)
            @if($review->place->user_id === auth()->user()->id)
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card">
                    <div class="card-body py-4 mt-2">
                        <div class="avatar-profile">
                            <img src="{{ $review->user->image }}" class="rounded-circle shadow-1-strong" width="100" height="100" />
                        </div>
                        <div class="fw-medium fs-6 my-2">Diulas oleh {{ $review->user->name }}</div>
                        <h5 class="fw-bold">{{ $review->place->title }}</h5>
                        <ul class="rating list-unstyled d-flex justify-content-center">
                            @for($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                                <li><i class="fas fa-star"></i></li>
                                @else
                                <li><i class="far fa-star"></i></li>
                                @endif
                                @endfor
                        </ul>
                        <p class="mb-2">
                            <i class="fas fa-quote-left pe-2"></i>{{ $review->ulasan }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection