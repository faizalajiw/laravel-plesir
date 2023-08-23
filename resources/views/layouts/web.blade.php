<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Document Title-->
    <!-- <title>Plesir</title> -->
    <link rel="shortcut icon" href="{{ URL::to('/logo.png') }}">
    <!-- ===============================================-->

    <!-- Favicons -->
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <!-- ===============================================-->

    <!-- Stylesheets -->
    <link href="{{ URL::to('web/assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('web/assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <!-- ===============================================-->

    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>

    <!-- MAPBOX -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <!-- Load the `mapbox-gl-geocoder` plugin. -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <!-- Load the `mapbox-gl-directions` plugin. -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css" />
    <!-- Load the `mapbox-gl-speech-synthesis` plugin. -->
    <!-- <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-speech-synthesis/v0.1.0/mapbox-gl-speech-synthesis.js"></script> -->
</head>

<body>
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light relative py-3 bg-light" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="{{ route('/') }}"><img class="d-inline-block align-top img-fluid" src="{{ URL::to('assets/img/plesir.png') }}" alt="" width="75" /></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item px-3">
                            <a class="nav-link fw-bold px-3 {{ set_active(['/','home']) }}" href="{{ route('/') }}">Home</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link fw-bold px-3 {{ set_active('web/jelajah-wisata') }}" href="{{ route('jelajah-wisata') }}">Jelajah Wisata</a>
                        </li>
                        @if (Session::get('role_name') !== 'Super Admin')
                        <li class="nav-item px-3">
                            <a class="nav-link fw-bold px-3 {{ set_active('web/kerjasama') }}" href="{{ route('kerjasama') }}">Kerja Sama</a>
                        </li>
                        @endif
                        <li class="nav-item px-3">
                            @if (Session::get('role_name') === 'Pengguna')
                            <a class="nav-link fw-bold px-3 {{ set_active('web/pesan-tiket') }}" href="{{ route('pesan-tiket') }}">Pesan Tiket</a>
                            @endif
                            @if (Session::get('role_name') === 'Admin Wisata')
                            <a class="nav-link fw-bold px-3 {{ set_active('web/checkout-tiket') }}" href="{{ route('checkout-tiket') }}">Pesan Tiket</a>
                            @endif
                        </li>
                    </ul>
                    <form class="d-flex">
                        @if (session('id'))
                        <div class="btn-group">
                            <button type="button" class="btn btn-lg btn-primary bg-gradient dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ session('name') }}
                            </button>
                            <ul class="dropdown-menu">
                                @if (Session::get('role_name') === 'Super Admin')
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-external-link-alt me-2"></i>Dashboard</a></li>
                                @endif
                                @if (Session::get('role_name') === 'Admin Wisata')
                                <li><a class="dropdown-item" href="{{ route('dashboard/admin-wisata') }}"><i class="fas fa-external-link-alt me-2"></i>Dashboard</a></li>
                                @endif
                                @if (Session::get('role_name') === 'Pengguna')
                                <li><a class="dropdown-item" href="{{ route('dashboard/user') }}"><i class="fas fa-external-link-alt me-2"></i>Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                        @else
                        <div class="btn btn-lg btn-primary bg-gradient order-0">
                            <a href="{{ route('login') }}" class="text-white text-decoration-none">Masuk</a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </nav>
        <!-- Navbar -->

        {{-- content page --}}
        @yield('content')

        <!-- Footer -->
        <section class="py-0" id="contact">
            <div class="bg-holder">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row justify-content-lg-between min-vh-10" style="padding-top:5rem">
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-3 text-1000 fw-semi-bold">PLESIR </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="{{ route('jelajah-wisata') }}">Jelajah Wisata</a></li>
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="{{ route('/') }}">Layanan Plesir</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-3 text-1000 fw-semi-bold">KERJA SAMA</h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="{{ route('kerjasama') }}">Cara bergabung</a></li>
                            <li class="mb-3"><a class="text-700 text-decoration-none" href="https://wa.me/6281991181804?text=Halo%2C%20saya%20ingin%20bergabung%20sebagai%20admin%20wisata">Gabung</a></li>
                        </ul>
                    </div>
                    <div class="col-8 col-lg-auto mb-3">
                        <div class="col-12 col-lg-auto mb-4 mb-md-6 mb-lg-0 order-0"> <img class="mb-4" src="{{ URL::to('assets/img/plesir.png') }}" width="150" alt="plesir" />
                            <p class="fs-0 text-secondary mb-0 fw-medium">Temukan keajaiban Tegal dengan Plesir!</p>
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
                            </svg>&nbsp;by&nbsp;<a class="text-dark" href="#" target="_blank">Faizal </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->

    <!--    JavaScripts-->
    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('web/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ URL::to('web/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('web/vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ URL::to('web/assets/js/theme.js') }}"></script>
    <!-- ===============================================-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- ===============================================-->
    @yield('script')
</body>

</html>