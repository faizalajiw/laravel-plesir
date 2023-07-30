@extends('layouts.web')
@section('content')
<!-- Detail Tempat -->
<div class="mt-5" id="jelajah">
    <div class="container">
        <!-- ATAS -->
        <div class="row">
            <!-- KIRI -->
            <div class="col-md-12 col-lg-7 col-sm-7">
                <div class="card shadow-sm p-4 mb-5">
                    <div class="text-center" style="font-size: 25px; color: #1A3154;">{{ $places->title }}</div>
                    <div class="rating">
                        <ul class="rating list-unstyled d-flex justify-content-center">
                            <div class="me-2">{{ $averageRating }}</div>
                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$wholeStars) <li><i class="fas fa-star text-warning"></i></li>
                                @elseif ($fractionStar >= 0.5 && $i == $wholeStars + 1)
                                <li><i class="fas fa-star-half-alt text-warning"></i></li>
                                @else
                                <li><i class="far fa-star"></i></li>
                                @endif
                                @endfor
                                <span class="ms-2">({{ $reviewCount }} ulasan)</span>
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
                    <div>{!! $places->description !!}</div>
                </div>

            </div>
            <!-- KIRI -->

            <!-- KANAN -->
            <div class="col-md-12 col-lg-5 col-sm-5">
                <!-- CARD -->
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
                    @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Pengguna')
                    <a href="{{ route('review/create') }}" class="btn btn-warning my-2 py-2">
                        <div class="my-1">Beri Rating</div>
                    </a>
                    @endif
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
                            <div class="d-flex">
                                <div class="me-1">{{ $places->hours_start }} -</div>
                                <div>{{ $places->hours_end }} WIB</div>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="mb-1"><i class="fab fa-instagram me-2"></i>Instagram</div>
                            <div>
                                <a href="https://www.instagram.com/{{ $places->social_media }}" target="_blank">
                                    {{ $places->social_media }}
                                </a>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="mb-1"><i class="fas fa-globe me-2"></i>Website</div>
                            <div>{{ $places->website }}</div>
                        </div>
                    </div>
                    <!-- KETERANGAN -->
                </div>
                <!-- CARD -->

                <!-- CHART PENGUNJUNG-->
                <div class="card card-chart">
                    <div class="card-body">
                        @if ($visitor->isEmpty())
                        <div class="text-center">
                            <p class="mt-3">Tidak ada data pengunjung yang tersedia.</p>
                        </div>
                        @else
                        <canvas id="myPieChart" style="max-height: 300px;"></canvas>
                        @endif
                    </div>
                </div>
                <!-- CHART PENGUNJUNG -->
            </div>
            <!-- KANAN -->
        </div>
        <!-- ATAS -->

    </div>
</div>
<!-- Detail Tempat -->

<!-- Review -->
<div class="my-8">
    <div class="container">
        <div class="row">
            <h2 class="fw-bold fs-md-3 fs-lg-4 mb-5 text-center">Apa Kata Mereka?</h2>
            @if ($reviews->isEmpty())
            <p class="text-center">Tidak ada ulasan yang tersedia.</p>
            @else
            @foreach ($reviews as $review)
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card">
                    <div class="card-body py-4 mt-2">
                        <div class="avatar-profile">
                            <img src="{{ $review->user->image }}" class="rounded-circle shadow-1-strong" width="100" height="100" />
                        </div>
                        <div class="fw-medium fs--1 my-2 text-center">Diulas oleh {{ $review->user->name }}</div>
                        <h5 class="fw-bold text-center">{{ $review->place->title }}</h5>
                        <ul class="rating list-unstyled d-flex justify-content-center">
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
            @endif
        </div>
    </div>
</div>
<!-- Review -->

<!-- Tabel Pengunjung -->
<div hidden class="row">
    <div class="col-xl-12 col-sm-12 col-12 d-flex">
        <div class="card flex-fill student-space comman-shadow">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title">Data Pengunjung</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table star-student table-hover table-center table-borderless table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Tempat</th>
                                <th>Nama Pengelola</th>
                                <th>Senin</th>
                                <th>Selasa</th>
                                <th>Rabu</th>
                                <th>Kamis</th>
                                <th>Jumat</th>
                                <th>Sabtu</th>
                                <th>Minggu</th>
                                <th>Total</th>
                                <th style="color: transparent; background-color: #F8F9FA;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitor as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td id="place_title">{{ $list->place->title }}</td>
                                <td>{{ $list->user->name }}</td>
                                <td id="senin">{{ $list->senin }}</td>
                                <td id="selasa">{{ $list->selasa }}</td>
                                <td id="rabu">{{ $list->rabu }}</td>
                                <td id="kamis">{{ $list->kamis }}</td>
                                <td id="jumat">{{ $list->jumat }}</td>
                                <td id="sabtu">{{ $list->sabtu }}</td>
                                <td id="minggu">{{ $list->minggu }}</td>
                                <td>{{ $list->total_hari }}</td>
                                <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                            </tr>
                            @endforeach
                            @if ($visitor->isEmpty())
                            <tr>
                                <td colspan="11">
                                    <div class="text-center">
                                        <p class="mt-3">Tidak ada data pengunjung yang tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tabel Pengunjung -->

@section('script')
<!-- MAPBOX -->
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFpemFsYWppdyIsImEiOiJjbGUyYmczYWgwN3JqM3BtanB5NDZqY2xiIn0.jWcan3Z7z2mxRfrLkkjaJQ';

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

<!-- CHART JS -->
<script src="{{ URL::to('assets/plugins/chartjs/charts.js') }}"></script>
<script src="{{ URL::to('assets/plugins/chartjs/pie-chart-data.js') }}"></script>
<script src="{{ URL::to('assets/plugins/chartjs/bar-chart-data.js') }}"></script>
<!-- CHART JS -->
@endsection

@endsection