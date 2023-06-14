@extends('layouts.web')
@section('content')
<!-- Service -->
<section class="py-5 pt-md-7" id="service">
    <div class="container">
        <div class="mb-7 text-center">
            <h2 class="fs-md-3 fs-lg-4 fs-xl-5 py-2 fw-bold font-medium">Layanan Kami</h2>
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
<!-- Service -->

<!-- Jelajah Wisata -->
<section class="pt-5" id="jelajah">
    <div class="container">
        <div class="row flex-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5">Jelajahi Wisata</h2>
                <hr class="mx-auto text-primary my-4" style="height:3px; width:70px;" />
                <p class="mx-auto">Beragam wisata mulai dari wisata alam seperti pantai, laut, perbukitan, pegunungan, curug, hingga wisata kuliner, wisata sejarah, wisata spiritual, dll.</p>
            </div>
        </div>
        <div class="col-md-12">
            <!-- CAROUSEL IMAGE -->
            <div id="carouselCategory" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                <div class="carousel-inner">
                    @php
                    $chunks = $categories->chunk(3); // Membagi data categories menjadi kelompok-kelompok dengan maksimal 4 data per kelompok
                    @endphp

                    @foreach ($chunks as $key => $chunk)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="5000">
                        <div class="row h-100 gap-5 justify-content-center">
                            @foreach ($chunk as $category)
                            <div class="col-6 col-sm-4 col-xl-3 mb-3 hover-top px-2">
                                <div class="card h-100 text-white">
                                    <a class="stretched-link" href="{{ route('jelajah-wisata', ['slug' => $category->slug]) }}">
                                        <img class="img-fluid" src="{{ $category->image }}" alt="" />
                                    </a>
                                    <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                                        <h5 class="text-white fs-1">{{ $category->name }}</h5>
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
    </div>
    <!-- end of .container-->
</section>
<!-- Jelajah Wisata -->

<!-- Benefit Kerjasama -->
<section class="py-0">
    <div class="bg-holder" style="background-image:url(assets/img/illustrations/background.png);background-position:center bottom;background-size:cover;">
    </div>
    <!--/.bg-holder-->

    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-9 col-xl-5 text-center pt-6">
                <h2 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5 lh-sm mb-3 text-white">Benefit Kerjasama</h2>
                <p class="mb-5 text-white">Kesempatan untuk mempromosikan tempat wisata Anda dengan menjadi bagian dari kami.</p>
            </div>
            <div class="col-sm-9 col-md-12 col-xxl-9">
                <div class="theme-tab">
                    <ul class="nav justify-content-between">
                        <li class="nav-item" role="presentation"><a class="nav-link active fw-semi-bold" href="#bootstrap-tab1" data-bs-toggle="tab" data-bs-target="#tab1" id="tab-1"><span class="nav-item-circle-parent"><span class="nav-item-circle">01</span></span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold" href="#bootstrap-tab2" data-bs-toggle="tab" data-bs-target="#tab2" id="tab-2"><span class="nav-item-circle-parent"><span class="nav-item-circle">02</span></span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold" href="#bootstrap-tab3" data-bs-toggle="tab" data-bs-target="#tab3" id="tab-3"><span class="nav-item-circle-parent"><span class="nav-item-circle">03</span></span></a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- 1 -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab-1">
                            <div class="row align-items-center my-6 mx-auto">
                                <div class="col-md-6 col-lg-5 offset-md-1">
                                    <h3 class="fw-bold lh-base text-white">Menjangkau Pengguna Yang Lebih Luas</h3>
                                </div>
                                <div class="col-md-5 text-white offset-lg-1">
                                    <p class="fs-1 mb-0">Dengan menjadi mitra, Anda dapat menjangkau pengguna yang lebih luas.</p>
                                </div>
                            </div>
                        </div>
                        <!-- 1 -->

                        <!-- 2 -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab-2">
                            <div class="row align-items-center my-6 mx-auto">
                                <div class="col-md-6 col-lg-5 offset-md-1">
                                    <h3 class="fw-bold lh-base text-white">Post Tempat Usaha Anda</h3>
                                </div>
                                <div class="col-md-5 text-white offset-lg-1">
                                    <p class="fs-1 mb-0">Anda akan memiliki akses ke dashboard sebagai Mitra dan dapat menambahkan konten tempat wisata/usaha Anda.</p>
                                </div>
                            </div>
                        </div>
                        <!-- 2 -->

                        <!-- 3 -->
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab-3">
                            <div class="row align-items-center my-6 mx-auto">
                                <div class="col-md-12 col-lg-12 text-center mb-3">
                                    <h3 class="fw-bold lh-base text-white">Mengetahui Lebih Lanjut?</h3>
                                </div>
                                <div class="col-md-12 col-lg-12 text-primary text-center">
                                    <a class="btn btn-lg btn-light px-6" href="#" role="button">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <!-- 3 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Benefit Kerjasama -->
@endsection