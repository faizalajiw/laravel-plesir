<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Menu</span>
                </li>

                <!-- DASHBOARD -->
                <li class="{{set_active(['dashboard', 'dashboard/admin-wisata', 'dashboard/user'])}}">
                    @if (Session::get('role_name') === 'Super Admin')
                    <a href="{{ route('dashboard') }}" class="{{set_active(['dashboard'])}}"><i class="fas feather-grid"></i>
                        <span>Dashboard</span>
                    </a>
                    @endif
                    @if (Session::get('role_name') === 'Admin Wisata')
                    <a href="{{ route('dashboard/admin-wisata') }}" class="{{set_active(['dashboard/admin-wisata'])}}"><i class="fas feather-grid"></i>
                        <span>Dashboard</span>
                    </a>
                    @endif
                    @if (Session::get('role_name') === 'Pengguna')
                    <a href="{{ route('dashboard/user') }}" class="{{set_active(['dashboard/user'])}}"><i class="fas feather-grid"></i>
                        <span>Dashboard</span>
                    </a>
                    @endif
                </li>
                <!-- DASHBOARD -->

                <!-- USER MANAGEMENT -->
                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['list/users'])}}">
                    <a href="#"><i class="fas fa-users-cog"></i>
                        <span>Manajemen User</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('list/users') }}" class="{{set_active(['list/users'])}}">Semua</a>
                        </li>
                        <li>
                            <a href="{{ route('list/users/admin') }}" class="{{set_active(['list/users/admin'])}}">Admin Wisata</a>
                        </li>
                        <li>
                            <a href="{{ route('list/users/pengguna') }}" class="{{set_active(['list/users/pengguna'])}}">Pengguna</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- USER MANAGEMENT -->

                <!-- SLIDER -->
                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['list/sliders','sliders/create','sliders/edit'])}}">
                    <a href="#"><i class="fas fa-image"></i>
                        <span>Slider Banner</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('list/sliders') }}" class="{{set_active(['list/sliders'])}}">View Banner</a>
                        </li>
                        <li>
                            <a href="{{ route('sliders/create') }}" class="{{set_active(['sliders/create'])}}">Tambah Banner</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- SLIDER -->

                <!-- KATEGORI -->
                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['list/categories','categories/create','categories/edit'])}}">
                    <a href="#"><i class="fas fa-th-list"></i>
                        <span>Kategori</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('list/categories') }}" class="{{set_active(['list/categories'])}}">View Kategori</a>
                        </li>
                        <li>
                            <a href="{{ route('categories/create') }}" class="{{set_active(['categories/create'])}}">Tambah Kategori</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- KATEGORI -->

                <!-- TEMPAT -->
                <!-- SUPER ADMIN & ADMIN WISATA -->
                @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Admin Wisata')
                <li class="submenu {{set_active(['list/places','places/create','places/edit'])}}">
                    <a href="#"><i class="fas fa-map-marked-alt"></i>
                        <span>Tempat</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        @if (Session::get('role_name') === 'Super Admin')
                        <li><a href="{{ route('list/places') }}" class="{{set_active(['list/places'])}}">Kelola Tempat</a></li>
                        @endif
                        @if (Session::get('role_name') === 'Admin Wisata')
                        <li><a href="{{ route('list/my_places') }}" class="{{set_active(['list/my_places'])}}">Kelola Tempat</a></li>
                        @endif
                        <li><a href="{{ route('places/create') }}" class="{{set_active(['places/create'])}}">Tambah Tempat</a></li>
                    </ul>
                </li>
                @endif
                <!-- TEMPAT -->

                <!-- DATA PENGUNJUNG -->
                <!-- ADMIN WISATA -->
                @if (Session::get('role_name') === 'Admin Wisata')
                <li class="submenu {{set_active(['list/history','visitor/create'])}}">
                    <a href="#"><i class="fas fa-chart-line"></i>
                        <span>Data Pengunjung</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('list/history') }}" class="{{set_active(['list/history'])}}">Kelola Pengunjung</a></li>
                        <li><a href="{{ route('visitor/create') }}" class="{{set_active(['visitor/create'])}}">Tambah Data</a></li>
                    </ul>
                </li>
                @endif
                <!-- DATA PENGUNJUNG -->

                <!-- RATING & ULASAN -->
                @if (Session::get('role_name') === 'Admin Wisata' || Session::get('role_name') === 'Pengguna')
                <li class="submenu {{set_active(['list/review','review/create'])}}">
                    <a href="#"><i class="fas fa-star"></i>
                        <span>Rating & Ulasan</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        @if (Session::get('role_name') === 'Admin Wisata')
                        <li><a href="{{ route('list/my_review_tempat') }}" class="{{set_active(['list/my_review_tempat'])}}">Lihat Ulasan</a></li>
                        @endif
                        @if (Session::get('role_name') === 'Pengguna')
                        <li><a href="{{ route ('list/my_review') }}" class="{{set_active(['list/my_review'])}}">Lihat Ulasan</a></li>
                        <li><a href="{{ route ('review/create') }}" class="{{set_active(['review/create'])}}">Nilai Tempat</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                <!-- RATING & ULASAN -->

                <li class="menu-title">
                    <span>Akun</span>
                </li>

                <!-- Profile -->
                <li class="{{set_active(['profile/user'])}}">
                    <a href="{{ route('profile/user') }}" class="{{set_active(['profile/user'])}}"><i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </li>
                <!-- Profile -->
                <li>
                    <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>