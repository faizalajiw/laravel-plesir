@extends('layouts.web')
@section('content')
<!-- Jelajah Wisata -->
<section class="pt-5" id="jelajah">
    <div class="container">
        <div class="row flex-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5">{{ $categories->name }}</h2>
                <hr class="mx-auto text-primary my-4" style="height:3px; width:70px;" />
            </div>
        </div>

        <div class="col-md-12">
            <!-- CAROUSEL IMAGE -->
            <div id="carouselCategory" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                <div class="carousel-inner">
                    @php
                    $chunks = $places->chunk(3); // Membagi data places menjadi kelompok-kelompok dengan maksimal 4 data per kelompok
                    @endphp

                    @foreach ($chunks as $key => $chunk)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="5000">
                        <div class="row h-100 gap-5 justify-content-center">
                            @foreach ($chunk as $place)
                            <div class="col-6 col-sm-4 col-xl-3 mb-3 hover-top px-2">
                                <div class="card h-100">
                                    <a class="stretched-link" href="{{ route('detail-wisata', $place->slug) }}">
                                        @if ($place->images->isNotEmpty())
                                        <img class="img-fluid" src="{{ asset($place->images->first()->image) }}" alt="Place Image" />
                                        @endif
                                    </a>
                                    <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                                        <h5 class="text-white fs-1">{{ $place->title }}</h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <div class="col-12 position-relative">
                        <a class="carousel-control-prev carousel-icon z-index-2" href="#carouselCategory" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next carousel-icon z-index-2" href="#carouselCategory" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- CAROUSEL IMAGE -->
        </div>


        <!-- <div class="col-md-12">
                @foreach($places as $place)
                <h2>{{ $place->title }}</h2>
                <p>{{ $place->address }}</p>
                <div>
                    @if ($place->images->isNotEmpty())
                    <img src="{{ $place->images->first()->image }}" alt="Place Image">
                    @endif
                </div>
                @endforeach
            </div> -->
    </div>
</section>
<!-- Jelajah Wisata -->
@endsection