<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    Document Title-->
    <title>Plesir</title>
    <!-- ===============================================-->

    <!--    Favicons-->
    <meta name="theme-color" content="#ffffff">
    <!-- ===============================================-->

    <!--    Stylesheets-->
    <link href="{{ URL::to('web/assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('web/assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <!-- ===============================================-->
</head>

<body>
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 bg-light opacity-85" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="index.html"><img class="d-inline-block align-top img-fluid" src="{{ URL::to('assets/img/plesir.png') }}" alt="" width="75" /></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item px-3"><a class="nav-link fw-medium active" aria-current="page" href="#top">Home</a></li>
                        <li class="nav-item px-3"><a class="nav-link fw-medium" href="#jelajah">Jelajahi Wisata</a></li>
                        <li class="nav-item px-3"><a class="nav-link fw-medium" href="#about">Tentang Kami</a></li>
                        <li class="nav-item px-3"><a class="nav-link fw-medium" href="#">Kerjasama</a></li>
                    </ul>
                    <form class="d-flex">
                        <div class="btn btn-lg btn-primary bg-gradient order-0">
                            <a href="{{ route('register') }}" class="text-white text-decoration-none">Masuk</a>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Navbar -->

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
                                        <a href="#jelajah" class="btn btn-secondary rounded-pill py-3 px-4 animated slideIn{{ $loop->first ? 'Right' : 'Left' }}">Jelajahi Sekarang</a>
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

        {{-- content page --}}
        @yield('content')

        <!-- Footer -->
        <section class="py-0" id="contact">
            <div class="bg-holder" style="background-image:url(assets/img/illustrations/footer-bg.png);background-position:center;background-size:cover;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row justify-content-lg-between min-vh-10" style="padding-top:5rem">
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h6 class="mb-3 text-1000 fw-semi-bold">PLESIR </h6>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="#!">Jelajahi Wisata</a></li>
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="#!">Tentang Kami</a></li>
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="#!">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h6 class="mb-3 text-1000 fw-semi-bold">KATEGORI</h6>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            @foreach($categories->take(4) as $category)
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="#!">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @if($categories->count() > 4)
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h6 class="mb-3 text-1000 fw-semi-bold">KATEGORI LAINNYA</h6>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            @foreach($categories->skip(4) as $category)
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="#!">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h6 class="mb-3 text-1000 fw-semi-bold">KERJASAMA</h6>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="#!">Cara bergabung</a></li>
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="#!">Testimoni</a></li>
                        </ul>
                    </div>
                    <div class="col-8 col-lg-auto mb-3">
                        <div class="col-12 col-lg-auto mb-4 mb-md-6 mb-lg-0 order-0"> <img class="mb-4" src="{{ URL::to('assets/img/plesir.png') }}" width="150" alt="jadoo" />
                            <p class="fs--1 text-secondary mb-0 fw-medium">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi, expedita? Adipisci.</p>
                        </div>
                    </div>
                </div>
                <hr class="text-300 mb-0" />
                <div class="row flex-center py-5">
                    <div class="col-12 col-sm-8 col-md-6 text-center text-md-start"> <a class="text-decoration-none" href="#"><img class="d-inline-block align-top img-fluid" src="{{ URL::to('assets/img/plesir.png') }}" alt="" width="40" /></a></div>
                    <div class="col-12 col-sm-8 col-md-6">
                        <p class="fs--1 text-dark my-2 text-center text-md-end">&copy; Plesir&nbsp;
                            <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1F3A63" viewBox="0 0 16 16">
                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                            </svg>&nbsp;by&nbsp;<a class="text-dark" href="https://themewagon.com/" target="_blank">Faizal </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap" rel="stylesheet">
</body>

</html>