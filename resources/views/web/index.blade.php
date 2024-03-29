@extends('layouts.web')
@section('content')
{!! Toastr::message() !!}
<title>Home</title>
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
                                <a href="{{ route('jelajah-wisata') }}" class="btn btn-light rounded-pill py-3 px-4 animated slideIn{{ $loop->first ? 'Right' : 'Left' }}">Jelajahi Sekarang</a>
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

<!-- Service -->
<section class="py-5 pt-md-7" id="service">
    <div class="container">
        <div class="mb-7 text-center">
            <h2 class="fs-md-3 fs-lg-4 fs-xl-5 py-2 fw-bold font-medium">Layanan Plesir</h2>
            <p class="px-1 fs-1">Plesir menawarkan beberapa layanan untuk membantu pengguna menemukan informasi wisata menarik di Tegal</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('web/assets/img/service/street-sign.png') }}" width="70" alt="Service" />
                        <h4 class="my-3">Beragam Wisata</h4>
                        <p class="mb-0 fw-medium">Lebih dari 20 wisata menarik di Tegal bisa anda temukan disini.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('web/assets/img/service/destination.png') }}" width="70" alt="Service" />
                        <h4 class="my-3">Rute Perjalanan</h4>
                        <p class="mb-0 fw-medium">Mengetahui jarak tujuan destinasi wisata dari tempat Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('web/assets/img/service/search.png') }}" width="70" alt="Service" />
                        <h4 class="my-3">Voice Search</h4>
                        <p class="mb-0 fw-medium">Temukan destinasi wisata dengan pencarian berbasis suara.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-6">
                <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                    <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('web/assets/img/service/deal.png') }}" width="75" alt="Service" />
                        <h4 class="my-3">Kerja Sama</h4>
                        <p class="mb-0 fw-medium">Menawarkan kerja sama untuk mempromosikan objek wisata.</p>
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
        <div class="row flex-center mb-3">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5">Kategori Wisata</h2>
                <hr class="mx-auto text-primary my-4" style="height:3px; width:70px;" />
                <p class="px-1 fs-1">Beragam wisata mulai dari wisata alam seperti pantai, laut, perbukitan, pegunungan, curug, hingga wisata kuliner, wisata sejarah, wisata spiritual, dll.</p>
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

        <div class="col-md-12">
            <div class="row h-100 gap-5 justify-content-center">
                @foreach ($categories as $category)
                <div class="col-6 col-sm-4 col-xl-3 mb-3 hover-top px-2">
                    <div class="card h-100 text-white">
                        <a class="stretched-link" href="{{ route('kategori', ['slug' => $category->slug]) }}">
                            <img class="img-fluid" src="{{ $category->image }}" alt="" />
                            <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                                <h5 class="text-white fs-1">{{ $category->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- end of .container-->
</section>
<!-- Jelajah Wisata -->

<!-- Benefit Kerjasama -->
<section class="py-0">
    <div class="bg-holder" style="background-image:url(web/assets/img/illustrations/background.png);background-position:center bottom;background-size:cover;">
    </div>
    <!--/.bg-holder-->

    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-6 col-xl-6 text-center pt-6">
                <h2 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5 lh-sm mb-3 text-white">Benefit Kerja Sama</h2>
                <p class="mb-5 text-white fs-1">Kesempatan untuk mempromosikan tempat wisata Anda dengan menjadi bagian dari Plesir.</p>
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
                                    <a class="btn btn-lg btn-light px-6" href="{{ route('kerjasama') }}" role="button">Lihat Detail</a>
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
        // Mengganti kelas ikon menjadi active setelah pengenalan selesai
        microphoneIcon.classList.remove('fa-microphone');
        microphoneIcon.classList.add('fas', 'fa-microphone-alt');
        microphoneIcon.style.transform = 'scale(1.8)'; // Anda dapat menyesuaikan faktor skala sesuai kebutuhan
    });

    // Tangani hasil pengenalan suara
    recognition.addEventListener('result', (event) => {
        const transcript = event.results[0][0].transcript; // Mendapatkan teks hasil pengenalan suara
        searchInput.value = transcript; // Mengisi nilai input teks dengan teks hasil pengenalan suara

        searchInput.closest('form').submit();
    });

    // Tambahkan event listener untuk mereset ukuran ikon setelah pengenalan suara selesai
    recognition.addEventListener('end', () => {
        microphoneIcon.style.transform = 'scale(1)'; // Mengembalikan ukuran ikon ke ukuran semula
        microphoneIcon.classList.remove('fas', 'fa-microphone-alt');
        microphoneIcon.classList.add('fas', 'fa-microphone');
    });
</script>

@endsection