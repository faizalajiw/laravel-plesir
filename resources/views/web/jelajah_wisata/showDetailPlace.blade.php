@extends('layouts.web')
@section('content')
<!-- Jelajah Wisata -->
<section class="pt-5" id="jelajah">
    <div class="container">
        <!-- ATAS -->
        <div class="row">
            <!-- KIRI -->
            <div class="col-md-12 col-lg-7 col-sm-7">
                <div class="card shadow-sm p-4 mb-5">
                    <div class="text-center" style="font-size: 25px; color: #1A3154;">{{ $places->title }}</div>
                    <div class="rating">
                        <ul class="rating list-unstyled d-flex justify-content-center">
                            <div class="me-2">Rating {{ $averageRating }}</div>
                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$wholeStars) <li><i class="fas fa-star text-warning"></i></li>
                                @elseif ($fractionStar >= 0.75)
                                <li><i class="fas fa-star text-warning"></i></li>
                                @elseif ($fractionStar >= 0.5)
                                <li><i class="fas fa-star-half-alt text-warning"></i></li>
                                @elseif ($fractionStar >= 0.25)
                                <li><i class="fas fa-star-half-alt text-warning"></i></li>
                                @else
                                <li><i class="far fa-star"></i></li>
                                @endif
                                @endfor
                                <span class="ms-2">(dari {{ $reviewCount }} ulasan)</span>
                        </ul>
                    </div>

                    <hr>
                    <!-- CARD CAROUSEL -->
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($places->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ $image->image }}" class="img-fluid" alt="..." style="width: 830px; height: 300px; object-fit: cover; justify-content: center; border-radius: 5px;">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- CARD CAROUSEL -->
                    <hr>
                    <div>{{ strip_tags($places->description) }}</div>
                </div>

            </div>
            <!-- KIRI -->

            <!-- KANAN -->
            <div class="col-md-12 col-lg-5 col-sm-5">
                <div class="card shadow-sm p-4 mb-5">
                    <!-- MAPS -->
                    <div class="maps">
                        <div id="mapContainer" style="height: 300px;"></div>
                        <div id="longitude" hidden>{{ $places->longitude }}</div>
                        <div id="latitude" hidden>{{ $places->latitude }}</div>
                    </div>
                    <!-- MAPS -->

                    <!-- RUTE -->
                    <a href="{{ route('rute-wisata', $places->slug) }}?longitude={{ $places->longitude }}&latitude={{ $places->latitude }}" class="btn btn-primary my-2 py-2">
                        <div class="my-1">Buka Rute</div>
                    </a>
                    <hr>
                    <!-- RUTE -->

                    <!-- KETERANGAN -->
                    <div class="row">
                        <div class="my-2">
                            <div class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Alamat</div>
                            <div>{{ $places->address }}</div>
                        </div>
                        <div class="my-2">
                            <div class="mb-1"><i class="fas fa-calendar-day me-2"></i>Hari</div>
                            <div>{{ $places->day }}</div>
                        </div>
                        <div class="my-2">
                            <div class="mb-1"><i class="fas fa-clock me-2"></i>Jam Operasional</div>
                            <div>{{ $places->operational_hours }}</div>
                        </div>
                        <div class="my-2">
                            <div class="mb-1"><i class="fab fa-instagram me-2"></i>Social Media</div>
                            <div>{{ $places->social_media }}</div>
                        </div>
                        <div class="my-2">
                            <div class="mb-1"><i class="fas fa-globe me-2"></i>Website</div>
                            <div>{{ $places->website }}</div>
                        </div>
                    </div>
                    <!-- KETERANGAN -->
                </div>
            </div>
            <!-- KANAN -->
        </div>
        <!-- ATAS -->
        <br>
        <!-- BAWAH -->
        <div class="row">
            <div class="col-12 text-center fw-bold fs-5">Apa Kata Mereka?</div>
            @foreach ($reviews as $review)
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card">
                    <div class="card-body py-4 mt-2">
                        <div class="avatar-profile">
                            <img src="{{ $review->user->image }}" class="rounded-circle shadow-1-strong" width="100" height="100" />
                        </div>
                        <div class="fw-medium fs-1 my-2">Diulas oleh {{ $review->user->name }}</div>
                        <h5 class="fw-bold">{{ $review->place->title }}</h5>
                        <ul class="rating list-unstyled d-flex">
                            <!-- <div class="me-2">{{ $review->rating }}</div> -->
                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->rating)
                                <li><i class="fas fa-star text-warning"></i></li>
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
            @endforeach
        </div>
        <!-- BAWAH -->
    </div>
</section>
<!-- Jelajah Wisata -->

@section('script')
<!-- MAPBOX -->
<script>
    mapboxgl.accessToken = '{{ env("LARAVEL_APP_MAPBOX") }}';

    // Mendapatkan nilai longitude dan latitude dari elemen dengan ID yang sesuai
    var longitude = parseFloat(document.getElementById('longitude').textContent);
    var latitude = parseFloat(document.getElementById('latitude').textContent);

    var map = new mapboxgl.Map({
        container: 'mapContainer',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [longitude, latitude],
        zoom: 15
    });

    // Membuat marker
    var marker = new mapboxgl.Marker()
        .setLngLat([longitude, latitude])
        .addTo(map);

    // Membuat popup
    var popup = new mapboxgl.Popup({
            closeOnClick: false
        })
        .setHTML('<h6>{{ $places->title }}</h6><br/><p>{{ $places->address }}</p>');

    // Menghubungkan marker dengan popup
    marker.setPopup(popup);
    marker.togglePopup();
</script>
<!-- MAPBOX -->
@endsection

@endsection