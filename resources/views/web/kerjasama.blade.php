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

<!-- Bekerja Sama -->
<section class="py-5 pt-md-7" id="kerjasama">
    <div class="container">
        <div class="mb-7 text-center">
            <h2 class="fs-md-3 fs-lg-4 fs-xl-5 py-2 fw-bold font-medium">Bekerja Sama</h2>
            <hr class="mx-auto text-primary my-4" style="height:3px; width:70px;" />
            <p class="px-1 fs-1">Menjadi mitra setia bagi para pengelola wisatawan dan pelaku bisnis</p>
        </div>
        <!-- Section 1 -->
        <div class="row mb-8">
            <div class="col-lg-4 col-sm-4">
                <h4 class="fs-md-3 fs-lg-3 fs-xl-2 py-2 fw-bold font-medium">
                    <span class="me-2">
                        <img src="{{ asset('web/assets/img/partnership/1.png') }}" width="50" alt="Service" />
                    </span>
                    Dashboard Admin
                </h4>
                <p class="px-1 fs-1">Anda bisa melihat jumlah pengunjung harian dalam chart yang dibuat agar mudah dapat mengetahui hari dimana jumlah pengunjung ramai.</p>
            </div>
            <div class="col-lg-8 col-sm-8 text-end">
                <img src="{{ asset('web/assets/img/partnership/Dashboard.png') }}" width="500" alt="Service" />
            </div>
        </div>
        <!-- Section 1 -->

        <!-- Section 2 -->
        <div class="row mb-8">
            <div class="col-lg-8 col-sm-8">
                <img src="{{ asset('web/assets/img/partnership/Tempat.png') }}" width="500" alt="Service" />
            </div>
            <div class="col-lg-4 col-sm-4 text-end">
                <h4 class="fs-md-3 fs-lg-3 fs-xl-2 py-2 fw-bold font-medium">
                    <span class="me-2">
                        <img src="{{ asset('web/assets/img/partnership/2.png') }}" width="50" alt="Service" />
                    </span>
                    Post Tempat Wisata
                </h4>
                <p class="px-1 fs-1">Anda bisa menambahkan tempat wisata/bisnis Anda tanpa ada batasan.</p>
            </div>
        </div>
        <!-- Section 2 -->

        <!-- Section 3 -->
        <div class="row mb-8">
            <div class="col-lg-4 col-sm-4">
                <h4 class="fs-md-3 fs-lg-3 fs-xl-2 py-2 fw-bold font-medium">
                    <span class="me-2">
                        <img src="{{ asset('web/assets/img/partnership/3.png') }}" width="50" alt="Service" />
                    </span>
                    Data Pengunjung
                </h4>
                <p class="px-1 fs-1">Anda dapat memasukkan data pengunjung harian yang akan dipresentasikan dalam chart</p>
            </div>
            <div class="col-lg-8 col-sm-8 text-end">
                <img src="{{ asset('web/assets/img/partnership/Pengunjung.png') }}" width="500" alt="Service" />
            </div>
        </div>
        <!-- Section 3 -->

        <!-- Section 4 -->
        <div class="row mb-8">
            <div class="col-lg-8 col-sm-8">
                <img src="{{ asset('web/assets/img/partnership/Ulasan.png') }}" width="500" alt="Service" />
            </div>
            <div class="col-lg-4 col-sm-4 text-end">
                <h4 class="fs-md-3 fs-lg-3 fs-xl-2 py-2 fw-bold font-medium">
                    <span class="me-2">
                        <img src="{{ asset('web/assets/img/partnership/4.png') }}" width="50" alt="Service" />
                    </span>
                    Lihat Rating dan Ulasan
                </h4>
                <p class="px-1 fs-1">Anda dapat melihat data rating dan ulasan pada tempat/bisnis Anda.</p>
            </div>
        </div>
        <!-- Section 4 -->

        <div class="mb-8">
            <div class="text-center">
                <a href="https://wa.me/6281991181804?text=Halo%2C%20saya%20ingin%20bergabung%20sebagai%20admin%20wisata" class="btn btn-primary py-3 px-6">
                    <div class="fs-1 my-1"><span class="me-2"><i class="fab fa-whatsapp" style="color: #ffffff;"></i></span>Gabung Sekarang!</div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Bekerja Sama -->


@endsection