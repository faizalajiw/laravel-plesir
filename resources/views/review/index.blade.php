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
                        <li class="breadcrumb-item"><a href="#">Rating & Ulasan</a></li>
                        <li class="breadcrumb-item active">Semua Ulasan</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CARD -->
        <div class="row mt-5">
            @foreach($groupedReviews as $review)
            @php
            $firstReview = $review->first(); // Mengambil ulasan pertama dari grup
            $place = $firstReview->place;
            $averageRating = round($review->avg('rating'), 1);
            $reviewCount = $review->count();

            $wholeRating = floor($averageRating); // Bagian bilangan bulat dari nilai rata-rata
            $decimalRating = $averageRating - $wholeRating; // Bagian desimal dari nilai rata-rata

            $starCount = $wholeRating; // Jumlah bintang yang akan ditampilkan
            $halfStar = false; // Menyimpan informasi apakah akan menampilkan setengah bintang

            if ($decimalRating >= 0.25 && $decimalRating < 0.75) { $halfStar=true; // Setengah bintang ditampilkan jika desimal di antara 0.25 dan 0.75 } elseif ($decimalRating>= 0.75) {
                $starCount++; // Bintang penuh ditambahkan jika desimal lebih dari atau sama dengan 0.75
                }
                @endphp

                <div class="col-xl-4 col-md-6 col-12">
                    <a href="{{ route('review/detail', ['id' => $place->id]) }}">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6 class="mb-2">{{ $averageRating }}
                                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$starCount) @if ($halfStar && $i==$starCount) <i class="fas fa-star-half-alt text-warning"></i>
                                                @else
                                                <i class="fas fa-star text-warning"></i>
                                                @endif
                                                @else
                                                <i class="far fa-star"></i>
                                                @endif
                                                @endfor
                                                (dari {{ $reviewCount }} ulasan)<span></span>
                                        </h6>
                                        <h4 class="text-primary fw-bold">{{ $place->title }}</h4>
                                        <h6 class="fw-bold">{{ $place->address }}</h6>
                                    </div>
                                    <div class="db-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <!-- CARD -->
</div>
@endsection