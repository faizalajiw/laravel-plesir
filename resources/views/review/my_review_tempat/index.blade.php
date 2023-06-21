@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Rating & Ulasan</title>
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

        <div class="row mt-5">
            <!-- CARD -->
            @foreach($groupedReviews as $review)
            @php
            $firstReview = $review->first(); // Mengambil ulasan pertama dari grup
            $place = $firstReview->place;
            $averageRating = $review->avg('rating');
            $reviewCount = $review->count();
            @endphp
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6 class="mb-2">Nilai {{ $averageRating }} (dari {{ $reviewCount }} ulasan)<span></span></h6>
                                <h5 class="fw-bold">{{ $place->title }}</h5>
                            </div>
                            <div class="db-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- CARD -->
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