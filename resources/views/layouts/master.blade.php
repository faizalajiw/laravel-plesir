<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" href="{{ URL::to('/logo.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

    <!-- <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.cs') }}s">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/simple-calendar/simple-calendar.css') }}"> -->

    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>

    <!-- MAPBOX -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                @if (Session::get('role_name') === 'Super Admin')
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ URL::to('assets/img/plesir.png') }}" alt="Logo">
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-small">
                    <img src="{{ URL::to('assets/img/plesir-small.png') }}" alt="Logo" width="30" height="30">
                </a>
                @endif
                @if (Session::get('role_name') === 'Admin Wisata')
                <a href="{{ route('dashboard/admin-wisata') }}" class="logo">
                    <img src="{{ URL::to('assets/img/plesir.png') }}" alt="Logo">
                </a>
                <a href="{{ route('dashboard/admin-wisata') }}" class="logo logo-small">
                    <img src="{{ URL::to('assets/img/plesir-small.png') }}" alt="Logo" width="30" height="30">
                </a>
                @endif
                @if (Session::get('role_name') === 'Pengguna')
                <a href="{{ route('dashboard/user') }}" class="logo">
                    <img src="{{ URL::to('assets/img/plesir.png') }}" alt="Logo">
                </a>
                <a href="{{ route('dashboard/user') }}" class="logo logo-small">
                    <img src="{{ URL::to('assets/img/plesir-small.png') }}" alt="Logo" width="30" height="30">
                </a>
                @endif
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <!-- USER MENU -->
            <ul class="nav user-menu">
                <!-- HEADER PROFILE -->
                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <div class="avatar avatar-lg text-center">
                                <img class="rounded-circle" src="{{ $user->image }}" alt="Foto">
                            </div>
                            <div class="user-text">
                                <h6>{{ Session::get('name') }}</h6>
                                <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ $user->image }}" alt="Foto" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>{{ Session::get('name') }}</h6>
                                <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('/') }}"><span><i class="fas fa-external-link-alt me-2"></i></span>Website</a>
                        <a class="dropdown-item" href="{{ route('profile/user') }}"><span><i class="fas fa-user me-2"></i></span>Profil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><span><i class="fas fa-sign-out-alt me-2"></i></span>Logout</a>
                    </div>
                </li>
                <!-- HEADER PROFILE -->
            </ul>
            <!-- USER MENU -->
        </div>
        {{-- side bar --}}
        @include('sidebar.sidebar')
        {{-- content page --}}
        @yield('content')
        <!-- <footer style="position: relative; left: 0; bottom: 0; width: 100%; text-align: center; padding: 20px 0;">
            <p>© 2023 Plesir Tegal.</p>
        </footer> -->
        <br>
        <br>
    </div>

    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>

    <!-- Load the `mapbox-gl-geocoder` plugin. -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @yield('script')
</body>

</html>