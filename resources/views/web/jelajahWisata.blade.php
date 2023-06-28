@extends('layouts.web')
@section('content')
<!-- Carousel Banner -->
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
            <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                <img class="d-block w-100" src="{{ $slider->image }}" style="height: 500;object-fit: cover;" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-{{ $loop->first ? 'start' : 'end' }}">
                            <div class="col-lg-8 text-{{ $loop->first ? 'start' : 'end' }}">
                                <p class="fs-4 text-white">Jelajahi Tegal</p>
                                <h1 class=" text-white mb-5 animated slideInRight">{{ $slider->title }}</h1>
                                <a href="#jelajah" class="btn btn-light rounded-pill py-3 px-4 animated slideIn{{ $loop->first ? 'Right' : 'Left' }}">Jelajahi Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Carousel Banner -->

<!-- Jelajah Wisata -->
<section class="pt-5" id="jelajah">
    <div class="container">
        <div class="row flex-center mb-3">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5">Jelajah Wisata</h2>
                <hr class="mx-auto text-primary my-4" style="height:3px; width:70px;" />
            </div>
        </div>

        <!-- SEARCH -->
        <div class="row height d-flex justify-content-center align-items-center mb-5">
            <div class="col-md-6">
                <div class="form">
                    <i class="fa fa-search"></i>
                    <form action="{{ route('cari-wisata') }}" method="GET">
                        <input type="text" id="search-input" class="form-control form-input" name="query" placeholder="Cari Destinasi...">
                        <span class="left-pan"><i class="fa fa-microphone"></i></span>
                    </form>
                </div>
            </div>
        </div>
        <!-- SEARCH -->

        <!-- PLACE -->
        <div id="carouselCategory" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
            <div class="carousel-inner">
                @php
                $groupedReviewsChunks = $groupedReviews->chunk(6); // Membagi data menjadi kelompok dengan max 6 data
                $active = 'active';
                @endphp
                @foreach($groupedReviewsChunks as $chunk)
                <div class="carousel-item {{ $active }}">
                    <div class="row">
                        @foreach($chunk as $review)
                        @php
                        $firstReview = $review->first();
                        $place = $firstReview->place;
                        $averageRating = round($review->avg('rating'), 1);
                        $reviewCount = $review->count();
                        @endphp
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <a class="stretched-link" href="{{ route('detail-wisata', $place->slug) }}">
                                    <div class="bg-image hover-overlay mb-2">
                                        @if ($place->images->isNotEmpty())
                                        <img class="img-fluid" style="height: 190px; width: 1550px;  object-fit: cover; justify-content: center;" src="{{ asset($place->images->first()->image) }}" alt="Place Image" />
                                        @endif
                                    </div>
                                </a>
                                <div class="p-3">
                                    @if ($reviewCount > 0)
                                    <h6 class="mb-2">Nilai {{ round($averageRating, 1) }}
                                        <i class="fas fa-star text-warning"></i>
                                        (dari {{ $reviewCount }} ulasan)<span></span>
                                    </h6>
                                    @else
                                    <h6 class="mb-2">Belum ada ulasan</h6>
                                    @endif
                                    <h5 class="card-title fw-bold">{{$place->title}}</h5>
                                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-danger"></i>{{$place->address}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @php
                $active = ''; // Hapus kelas 'active' setelah carousel item pertama
                @endphp
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
        <!-- PLACE -->
    </div>
</section>
<!-- Jelajah Wisata -->

<script>
    // Mendapatkan referensi elemen-elemen yang diperlukan
    const searchInput = document.getElementById('search-input');
    const microphoneIcon = document.querySelector('.fa-microphone');

    // Buat instance dari SpeechRecognition
    const recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition || window.msSpeechRecognition)();

    // Konfigurasi SpeechRecognition
    recognition.lang = 'id-ID'; // Atur bahasa yang digunakan (disesuaikan dengan kebutuhan Anda)

    // Tambahkan event listener saat microphone icon diklik
    microphoneIcon.addEventListener('click', () => {
        recognition.start(); // Memulai pengenalan suara
    });

    // Tangani hasil pengenalan suara
    recognition.addEventListener('result', (event) => {
        const transcript = event.results[0][0].transcript; // Mendapatkan teks hasil pengenalan suara
        searchInput.value = transcript; // Mengisi nilai input teks dengan teks hasil pengenalan suara

        searchInput.closest('form').submit();
    });
</script>
@endsection