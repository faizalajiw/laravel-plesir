@extends('layouts.web')
@section('content')
<!-- Banner -->
<section class="py-0" id="header">
    <div class="bg-holder d-none d-md-block" style="background-image:url(assets/img/illustrations/hero.png);background-position:right top;background-size:contain;">
    </div>
    <!--/.bg-holder-->

    <div class="container">
        <div class="row align-items-center min-vh-75 min-vh-lg-100">
            <div class="col-md-7 col-lg-6 col-xxl-5 py-6 text-sm-start text-center">
                <h1 class="mt-6 mb-sm-4 fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Plesir <br class="d-block d-lg-block" />Jelajahi Tegal</h1>
                <p class="mb-4 fs-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt est, voluptatum beatae ab id necessitatibus nemo iste itaque similique. Eos.</p><a class="btn btn-lg btn-primary" href="#" role="button">Jelajah</a>
            </div>
        </div>
    </div>
</section>
<!-- Banner -->

<!-- About -->
<section class="pt-5 pt-md-9" id="service">
    <div class="container">
        <div class="mb-7 text-center">
            <h3 class="fs-lg-2 fs-2 py-2 fw-bold font-normal">Tentang Kami</h3>
            <h5 class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, voluptatum?</h5>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="assets/img/service/street-sign.png" width="70" alt="Service" />
                        <h4 class="my-3">Beragam Wisata</h4>
                        <p class="mb-0 fw-medium">Lebih dari 20 wisata menarik di Tegal bisa anda temukan disini.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="assets/img/service/destination.png" width="70" alt="Service" />
                        <h4 class="my-3">Rute Perjalanan</h4>
                        <p class="mb-0 fw-medium">Mengetahui jarak tujuan destinasi wisata dari tempat Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="assets/img/service/search.png" width="70" alt="Service" />
                        <h4 class="my-3">Voice Search</h4>
                        <p class="mb-0 fw-medium">Temukan destinasi wisata dengan pencarian berbasis suara.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="assets/img/service/deal.png" width="75" alt="Service" />
                        <h4 class="my-3">Kerjasama</h4>
                        <p class="mb-0 fw-medium">Menawarkan kerjasama untuk mempromosikan objek wisata.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of .container-->
</section>
<!-- About -->

<!-- Jelajah Wisata -->
<section class="pt-5">
    <div class="container">
        <div class="row flex-center mb-5">
            <div class="col-lg-8 text-center">
                <h1 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5">Jelajahi Wisata</h1>
                <hr class="mx-auto text-primary my-4" style="height:3px; width:70px;" />
                <p class="mx-auto">Maecenas et eros non quam ultricies interdum. Proin ac dolor vel neque ullamcorper blandit vitae et felis. Morbi ante urna, imperdiet vel neque vitae, porta ullamcorper metus. Quisque bibendum venenatis eros sed commodo. Nullam ultrices tortor non diam ullamcorper auctor. In urna tellus, auctor sit amet est ut, scelerisque volutpat diam.</p>
            </div>
        </div>
        <div class="row h-100 flex-center">
            <div class="row flex-lg-center">
                <div class="col-md-12">
                    <!-- CAROUSEL IMAGE -->
                    <div id="carouselCategory" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                        <div class="carousel-inner">
                            @php
                            $chunks = $categories->chunk(4); // Membagi data categories menjadi kelompok-kelompok dengan maksimal 4 data per kelompok
                            @endphp

                            @foreach ($chunks as $key => $chunk)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="5000">
                                <div class="row h-100 gap-5 justify-content-center">
                                    @foreach ($chunk as $category)
                                    <div class="col-4 col-sm-4 col-xl-2 mb-3 hover-top px-2">
                                        <div class="card h-100 w-100 text-white">
                                            <a class="stretched-link" href="!#">
                                                <img class="img-fluid" src="{{ $category->image }}" alt="" />
                                            </a>
                                            <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                                                <h5 class="text-white fs--1">{{ $category->name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            <!-- CAROUSEL IMAGE -->
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

                </div>
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>
<!-- Jelajah Wisata -->

@endsection